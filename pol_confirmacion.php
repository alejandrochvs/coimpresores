<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "documento_contableinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php

// Create page object
$documento_contable_list = new cdocumento_contable_list();
$Page =& $documento_contable_list;

// Page init
$documento_contable_list->Page_Init();

// Page main
$documento_contable_list->Page_Main();
?>
<?php 
$sqlPagos = "SELECT * FROM pagos_online limit 1";
$rsPagos = $conn->Execute($sqlPagos);
$arPagos = ($rsPagos) ? $rsPagos->GetRows() : array();
?>
<?php 
$estados_pol = array(
	1 => "Sin abrir",
	2 => "Abierta",
	4 => "Pagada y abonada",
	5 => "Cancelada",
	6 => "Rechazada",
	7 => "En validación",
	8 => "Reversada",
	9 => "Reversada fraudulenta",
	10 => "Enviada ent. Financiera",
	11 => "Capturando datos tarjeta de crédito",
	12 => "Esperando confirmación sistema PSE",
	13 => "Activa Débitos ACH",
	14 => "Confirmando pago Efecty",
	15 => "Impreso",
	16 => "Debito ACH Registrado",
);


$llave_encripcion = $arPagos[0]["llave_encripcion"];

$usuario_id = $_POST["usuario_id"];
$estado_pol = $_POST["estado_pol"];
$riesgo = $_POST["riesgo"];
$codigo_respuesta_pol = $_POST["codigo_respuesta_pol"];
$ref_venta = $_POST["ref_venta"];
$ref_pol = $_POST["ref_pol"];
$firma = $_POST["firma"];
$medio_pago = $_POST["medio_pago"];
$tipo_medio_pago = $_POST["tipo_medio_pago"];
$cuotas = $_POST["cuotas"];
$valor = $_POST["valor"];
$moneda = $_POST["moneda"];
$iva = $_POST["iva"];
$banco_pse = $_POST["banco_pse"];
$email_comprador = $_POST["email_comprador"];

$firma2= "$llave_encripcion~$usuario_id~$ref_venta~$valor~$moneda~$estado_pol";
$firma_codificada = md5($firma2);

if($firma == strtoupper($firma_codificada)){
	$myFile = 'test_pol.txt';
	//$myContent = "Confirmada la firma digital ";
	
	$sqlhistorial = "SELECT `historial_pagos`.idhistorial_pagos, `historial_pagos`.ref_venta, `historial_pagos`.monto_pago AS pago_total, pagos_x_docto.iddoctocontable, pagos_x_docto.tipo_docto, pagos_x_docto.consec_docto, pagos_x_docto.valor, pagos_x_docto.monto_pago FROM `historial_pagos` JOIN pagos_x_docto ON ( pagos_x_docto.historial = historial_pagos.idhistorial_pagos ) WHERE historial_pagos.ref_venta LIKE '$ref_venta'";
	$rsHistorial = $conn->Execute($sqlhistorial);
	$arHistorial = ($rsHistorial) ? $rsHistorial->GetRows() : array();
	if(!empty($arHistorial)){
		$sqlUpdate = "UPDATE `historial_pagos` SET estado_pago = '".$estados_pol[$estado_pol]."', riesgo = '$riesgo', respuesta_pol =  '$codigo_respuesta_pol' WHERE idhistorial_pagos = ".$arHistorial[0]["idhistorial_pagos"];
		$conn->Execute($sqlUpdate);
	}
	for($t=0; $t< sizeof($arHistorial); $t++){
		if($estado_pol == 4){
			$updateEach = "DELETE FROM documento_contable WHERE tipo_docto = '".$arHistorial[$t]["tipo_docto"]."' and consec_docto = ".$arHistorial[$t]["consec_docto"];
		}else{
			$updateEach = "UPDATE documento_contable SET estado = '".$estados_pol[$estado_pol]."', estado_pago=$codigo_respuesta_pol WHERE tipo_docto = '".$arHistorial[$t]["tipo_docto"]."' and consec_docto = ".$arHistorial[$t]["consec_docto"];
		}
			$myContent .= $updateEach;
		$conn->Execute($updateEach);
		//$myContent .= "Refs".$arHistorial[$t]["tipo_docto"].$arHistorial[$t]["consec_docto"];
	}
	
	file_put_contents($myFile, utf8_encode($myContent)); 
	
	
}




/*
$SQLInsertHistoPagos = "INSERT INTO `historial_pagos` (`usuario`, `estado_pago`, `monto_pago`) VALUES (".CurrentUserID().", 0, $valor);";
$conn->Execute($SQLInsertHistoPagos);
$lastIDRS = $conn->Execute("select last_insert_id() as lastid");
$arlast = ($lastIDRS) ? $lastIDRS->GetRows() : array();
if (!empty($arlast)){
	$idHistorial = $arlast[0]["lastid"];
	$refVenta = "PU".$idHistorial;
	$sqlUpdate = "UPDATE `historial_pagos` SET ref_venta = '$refVenta' WHERE idhistorial_pagos = ".$idHistorial;
	$conn->Execute($sqlUpdate);
	
	//insert pagos_x_docto
	$doctos = explode( ',', $_POST["documentos"] );
	$montos = explode( ',', $_POST["montos"] );
	
	$sqlTemp = "SELECT * FROM `documento_contable` WHERE iddoctocontable IN (".implode(",",$doctos).")";
	$rsdoctos = $conn->Execute($sqlTemp);
	$arDoctos = ($rsdoctos) ? $rsdoctos->GetRows() : array();
	setlocale(LC_MONETARY, 'es_CO');
	
	for($f=0; $f<sizeof($arDoctos); $f++){
		$montopago = $montos[$f];
		$tempdias = $arDoctos[$f]["dias_vencidos"]; 
		if($tempdias == "")
			$tempdias=0;
		$sqlInsertTemp = "INSERT INTO `pagos_x_docto` ( `historial`, `tipo_docto`, `consec_docto`, `valor`, `cia`, `nit`, `monto_pago`, `tercero`, `fecha`, `dias_vencidos`, `estado`, `estado_pago`, `descripcion`, `fecha_vencimiento`, `usuario`) VALUES ($idHistorial, '".$arDoctos[$f]["tipo_docto"]."', ".$arDoctos[$f]["consec_docto"].", ".$arDoctos[$f]["valor"].", ".$arDoctos[$f]["cia"].", '".$arDoctos[$f]["nit"]."',$montopago, '".$arDoctos[$f]["tercero"]."', '".$arDoctos[$f]["fecha"]."', ".$tempdias.", '', 0, '".addslashes($arDoctos[$f]["descripcion"])."', '".$arDoctos[$f]["fecha_vencimiento"]."', ".CurrentUserID().");";
		$conn->Execute($sqlInsertTemp);
		if($f>0)
			$descripcion .= " - ";
		$descripcion .= $arDoctos[$f]["tipo_docto"]." ".$arDoctos[$f]["consec_docto"]." ($ ".number_format($montopago, 0).")";
	}
}

$firma= "$llave_encripcion~$usuarioId~$refVenta~$valor~$moneda";
$firma_codificada = md5($firma);

$SQLcomprador ="SELECT * FROM usuarios WHERE idusuario = ".CurrentUserID();
$RSUsuario = $conn->Execute($SQLcomprador);
$arUsuario = ($RSUsuario) ? $RSUsuario->GetRows() : array();

*/

?>


<form name="form1" method="post" action="<?php echo $arPagos[0]["url"]; ?>">
<table width="500" border="0" cellpadding="0" cellspacing="2"> 

<tr bgcolor="#F1F1F1">
  <td>Referencia de Transacción Online:</td>
  <td><p>
    <input name="refVenta" type="text" value="<?php echo $refVenta ?>" readonly="readonly">
  </p>
    <p>
      <input name="usuarioId" type="hidden" value="<?php echo($usuarioId) ?>" />
      <input name="valor" type="hidden" value="<?php echo $valor ?>" />
      <input name="descripcion" type="hidden" value="<?php echo $descripcion ?>" />
      <input name="iva" type="hidden" value="" />
      <input name="baseDevolucionIva" type="hidden" value="" />
      <input name="moneda" type="hidden" value="<?php echo $moneda ?>" />
      <input name="firma" type="hidden" value="<?php echo $firma_codificada ?>" />
      <input name="emailComprador" type="hidden" value="<?php echo $arUsuario[0]["email"] ?>" />
      <input name="nombreComprador" type="hidden" value="<?php echo $arUsuario[0]["empresa"] ?>" />
      <input name="prueba" type="hidden" value="1" />
      <input name="url_respuesta" type="hidden" value="" />
      <input name="url_confirmacion" type="hidden" value="" />
      
      </p></td> 
</tr>
<tr bgcolor="#F1F1F1">
  <td>&nbsp;</td>
  <td><input name="Submit" type="submit" value="Continuar a Pagos online"></td>
</tr>
</table>
</form>

<?php
$documento_contable_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumento_contable_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'documento_contable';

	// Page object name
	var $PageObjName = 'documento_contable_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $documento_contable;
		if ($documento_contable->UseTokenInUrl) $PageUrl .= "t=" . $documento_contable->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $documento_contable;
		if ($documento_contable->UseTokenInUrl) {
			if ($objForm)
				return ($documento_contable->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($documento_contable->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdocumento_contable_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documento_contable)
		if (!isset($GLOBALS["documento_contable"])) {
			$GLOBALS["documento_contable"] = new cdocumento_contable();
			$GLOBALS["Table"] =& $GLOBALS["documento_contable"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "documento_contableadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "documento_contabledelete.php";
		$this->MultiUpdateUrl = "documento_contableupdate.php";


		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documento_contable', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $documento_contable;


		// Get export parameters
		if (@$_GET["export"] <> "") {
			$documento_contable->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$documento_contable->Export = $_POST["exporttype"];
		} else {
			$documento_contable->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $documento_contable->Export; // Get export parameter, used in header
		$gsExportFile = $documento_contable->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($documento_contable->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($documento_contable->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}
		if ($documento_contable->Export == "xml") {
			header('Content-Type: text/xml' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($documento_contable->Export == "csv") {
			header('Content-Type: application/csv' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$documento_contable->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $documento_contable;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($documento_contable->Export <> "" ||
				$documento_contable->CurrentAction == "gridadd" ||
				$documento_contable->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$documento_contable->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($documento_contable->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $documento_contable->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$documento_contable->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$documento_contable->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$documento_contable->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $documento_contable->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$documento_contable->setSessionWhere($sFilter);
		$documento_contable->CurrentFilter = "";

		// Export data only
		if (in_array($documento_contable->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($documento_contable->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $documento_contable;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $documento_contable->tipo_docto, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $documento_contable->tercero, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $documento_contable->estado, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $documento_contable->descripcion, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", $lFldDataType));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $documento_contable;
		$sSearchStr = "";
		return "";
		$sSearchKeyword = $documento_contable->BasicSearchKeyword;
		$sSearchType = $documento_contable->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$documento_contable->setSessionBasicSearchKeyword($sSearchKeyword);
			$documento_contable->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $documento_contable;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$documento_contable->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $documento_contable;
		$documento_contable->setSessionBasicSearchKeyword("");
		$documento_contable->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $documento_contable;
		$bRestore = TRUE;
		if ($documento_contable->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$documento_contable->BasicSearchKeyword = $documento_contable->getSessionBasicSearchKeyword();
			$documento_contable->BasicSearchType = $documento_contable->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $documento_contable;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$documento_contable->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$documento_contable->CurrentOrderType = @$_GET["ordertype"];
			$documento_contable->UpdateSort($documento_contable->iddoctocontable); // iddoctocontable
			$documento_contable->UpdateSort($documento_contable->tipo_docto); // tipo_docto
			$documento_contable->UpdateSort($documento_contable->consec_docto); // consec_docto
			$documento_contable->UpdateSort($documento_contable->valor); // valor
			$documento_contable->UpdateSort($documento_contable->cia); // cia
			$documento_contable->UpdateSort($documento_contable->tercero); // tercero
			$documento_contable->UpdateSort($documento_contable->fecha); // fecha
			$documento_contable->UpdateSort($documento_contable->estado); // estado
			$documento_contable->UpdateSort($documento_contable->estado_pago); // estado_pago
			$documento_contable->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $documento_contable;
		$sOrderBy = $documento_contable->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($documento_contable->SqlOrderBy() <> "") {
				$sOrderBy = $documento_contable->SqlOrderBy();
				$documento_contable->setSessionOrderBy($sOrderBy);
				$documento_contable->fecha->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $documento_contable;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$documento_contable->setSessionOrderBy($sOrderBy);
				$documento_contable->iddoctocontable->setSort("");
				$documento_contable->tipo_docto->setSort("");
				$documento_contable->consec_docto->setSort("");
				$documento_contable->valor->setSort("");
				$documento_contable->cia->setSort("");
				$documento_contable->tercero->setSort("");
				$documento_contable->fecha->setSort("");
				$documento_contable->estado->setSort("");
				$documento_contable->estado_pago->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$documento_contable->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $documento_contable;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = true;
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $documento_contable, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . "<img src=\"phpimages/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $documento_contable;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $documento_contable;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$documento_contable->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$documento_contable->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $documento_contable->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$documento_contable->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$documento_contable->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$documento_contable->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $documento_contable;
		$documento_contable->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$documento_contable->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $documento_contable;

		// Call Recordset Selecting event
		$documento_contable->Recordset_Selecting($documento_contable->CurrentFilter);

		// Load List page SQL
		$sSql = $documento_contable->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$documento_contable->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $documento_contable;
		$sFilter = $documento_contable->KeyFilter();

		// Call Row Selecting event
		$documento_contable->Row_Selecting($sFilter);

		// Load SQL based on filter
		$documento_contable->CurrentFilter = $sFilter;
		$sSql = $documento_contable->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $documento_contable;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$documento_contable->Row_Selected($row);
		$documento_contable->iddoctocontable->setDbValue($rs->fields('iddoctocontable'));
		$documento_contable->tipo_docto->setDbValue($rs->fields('tipo_docto'));
		$documento_contable->consec_docto->setDbValue($rs->fields('consec_docto'));
		$documento_contable->valor->setDbValue($rs->fields('valor'));
		$documento_contable->cia->setDbValue($rs->fields('cia'));
		$documento_contable->tercero->setDbValue($rs->fields('tercero'));
		$documento_contable->fecha->setDbValue($rs->fields('fecha'));
		$documento_contable->estado->setDbValue($rs->fields('estado'));
		$documento_contable->usuario->setDbValue($rs->fields('usuario'));
		$documento_contable->estado_pago->setDbValue($rs->fields('estado_pago'));
		$documento_contable->descripcion->setDbValue($rs->fields('descripcion'));
	}

	// Load old record
	function LoadOldRecord() {
		global $documento_contable;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($documento_contable->getKey("iddoctocontable")) <> "")
			$documento_contable->iddoctocontable->CurrentValue = $documento_contable->getKey("iddoctocontable"); // iddoctocontable
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$documento_contable->CurrentFilter = $documento_contable->KeyFilter();
			$sSql = $documento_contable->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documento_contable;

		// Initialize URLs
		$this->ViewUrl = $documento_contable->ViewUrl();
		$this->EditUrl = $documento_contable->EditUrl();
		$this->InlineEditUrl = $documento_contable->InlineEditUrl();
		$this->CopyUrl = $documento_contable->CopyUrl();
		$this->InlineCopyUrl = $documento_contable->InlineCopyUrl();
		$this->DeleteUrl = $documento_contable->DeleteUrl();

		// Call Row_Rendering event
		$documento_contable->Row_Rendering();

		// Common render codes for all row types
		// iddoctocontable
		// tipo_docto
		// consec_docto
		// valor
		// cia
		// tercero
		// fecha
		// estado
		// usuario
		// estado_pago
		// descripcion

		if ($documento_contable->RowType == EW_ROWTYPE_VIEW) { // View row

			// iddoctocontable
			$documento_contable->iddoctocontable->ViewValue = $documento_contable->iddoctocontable->CurrentValue;
			$documento_contable->iddoctocontable->ViewCustomAttributes = "";

			// tipo_docto
			$documento_contable->tipo_docto->ViewValue = $documento_contable->tipo_docto->CurrentValue;
			$documento_contable->tipo_docto->ViewCustomAttributes = "";

			// consec_docto
			$documento_contable->consec_docto->ViewValue = $documento_contable->consec_docto->CurrentValue;
			$documento_contable->consec_docto->ViewCustomAttributes = "";

			// valor
			$documento_contable->valor->ViewValue = $documento_contable->valor->CurrentValue;
			$documento_contable->valor->ViewValue = ew_FormatCurrency($documento_contable->valor->ViewValue, 0, -2, -2, -2);
			$documento_contable->valor->ViewCustomAttributes = "";

			// cia
			$documento_contable->cia->ViewValue = $documento_contable->cia->CurrentValue;
			$documento_contable->cia->ViewCustomAttributes = "";

			// tercero
			$documento_contable->tercero->ViewValue = $documento_contable->tercero->CurrentValue;
			$documento_contable->tercero->ViewCustomAttributes = "";

			// fecha
			$documento_contable->fecha->ViewValue = $documento_contable->fecha->CurrentValue;
			$documento_contable->fecha->ViewValue = ew_FormatDateTime($documento_contable->fecha->ViewValue, 7);
			$documento_contable->fecha->ViewCustomAttributes = "";

			// estado
			$documento_contable->estado->ViewValue = $documento_contable->estado->CurrentValue;
			$documento_contable->estado->ViewCustomAttributes = "";

			// usuario
			if (strval($documento_contable->usuario->CurrentValue) <> "") {
				$sFilterWrk = "`idusuario` = " . ew_AdjustSql($documento_contable->usuario->CurrentValue) . "";
			$sSqlWrk = "SELECT `nit_empresa`, `username` FROM `usuarios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `nit_empresa` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$documento_contable->usuario->ViewValue = $rswrk->fields('nit_empresa');
					$documento_contable->usuario->ViewValue .= ew_ValueSeparator(0,1,$documento_contable->usuario) . $rswrk->fields('username');
					$rswrk->Close();
				} else {
					$documento_contable->usuario->ViewValue = $documento_contable->usuario->CurrentValue;
				}
			} else {
				$documento_contable->usuario->ViewValue = NULL;
			}
			$documento_contable->usuario->ViewCustomAttributes = "";

			// estado_pago
			if (strval($documento_contable->estado_pago->CurrentValue) <> "") {
				switch ($documento_contable->estado_pago->CurrentValue) {
					case "0":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(1) <> "" ? $documento_contable->estado_pago->FldTagCaption(1) : $documento_contable->estado_pago->CurrentValue;
						break;
					case "1":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(2) <> "" ? $documento_contable->estado_pago->FldTagCaption(2) : $documento_contable->estado_pago->CurrentValue;
						break;
					case "2":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(3) <> "" ? $documento_contable->estado_pago->FldTagCaption(3) : $documento_contable->estado_pago->CurrentValue;
						break;
					case "3":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(4) <> "" ? $documento_contable->estado_pago->FldTagCaption(4) : $documento_contable->estado_pago->CurrentValue;
						break;
					default:
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->CurrentValue;
				}
			} else {
				$documento_contable->estado_pago->ViewValue = NULL;
			}
			$documento_contable->estado_pago->ViewCustomAttributes = "";

			// iddoctocontable
			$documento_contable->iddoctocontable->LinkCustomAttributes = "";
			$documento_contable->iddoctocontable->HrefValue = "";
			$documento_contable->iddoctocontable->TooltipValue = "";

			// tipo_docto
			$documento_contable->tipo_docto->LinkCustomAttributes = "";
			$documento_contable->tipo_docto->HrefValue = "";
			$documento_contable->tipo_docto->TooltipValue = "";

			// consec_docto
			$documento_contable->consec_docto->LinkCustomAttributes = "";
			$documento_contable->consec_docto->HrefValue = "";
			$documento_contable->consec_docto->TooltipValue = "";

			// valor
			$documento_contable->valor->LinkCustomAttributes = "";
			$documento_contable->valor->HrefValue = "";
			$documento_contable->valor->TooltipValue = "";

			// cia
			$documento_contable->cia->LinkCustomAttributes = "";
			$documento_contable->cia->HrefValue = "";
			$documento_contable->cia->TooltipValue = "";

			// tercero
			$documento_contable->tercero->LinkCustomAttributes = "";
			$documento_contable->tercero->HrefValue = "";
			$documento_contable->tercero->TooltipValue = "";

			// fecha
			$documento_contable->fecha->LinkCustomAttributes = "";
			$documento_contable->fecha->HrefValue = "";
			$documento_contable->fecha->TooltipValue = "";

			// estado
			$documento_contable->estado->LinkCustomAttributes = "";
			$documento_contable->estado->HrefValue = "";
			$documento_contable->estado->TooltipValue = "";

			// estado_pago
			$documento_contable->estado_pago->LinkCustomAttributes = "";
			$documento_contable->estado_pago->HrefValue = "";
			$documento_contable->estado_pago->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($documento_contable->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documento_contable->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $documento_contable;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\">" . "<img src=\"phpimages/print.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\">" . "<img src=\"phpimages/exportxls.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\">" . "<img src=\"phpimages/exportdoc.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\">" . "<img src=\"phpimages/exporthtml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\">" . "<img src=\"phpimages/exportxml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\">" . "<img src=\"phpimages/exportcsv.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\">" . "<img src=\"phpimages/exportpdf.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_documento_contable\" id=\"emf_documento_contable\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_documento_contable',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fdocumento_contablelist,sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Hide options for export/action
		if ($documento_contable->Export <> "" ||
			$documento_contable->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $documento_contable;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $documento_contable->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($documento_contable->ExportAll) {
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs < 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($documento_contable->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($documento_contable, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($documento_contable->Export == "xml") {
			$documento_contable->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$documento_contable->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($documento_contable->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($documento_contable->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($documento_contable->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($documento_contable->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($documento_contable->ExportReturnUrl());
		} elseif ($documento_contable->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $Language, $documento_contable;
		$sSender = @$_GET["sender"];
		$sRecipient = @$_GET["recipient"];
		$sCc = @$_GET["cc"];
		$sBcc = @$_GET["bcc"];
		$sContentType = @$_GET["contenttype"];

		// Subject
		$sSubject = ew_StripSlashes(@$_GET["subject"]);
		$sEmailSubject = $sSubject;

		// Message
		$sContent = ew_StripSlashes(@$_GET["message"]);
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			$this->setFailureMessage($Language->Phrase("EnterSenderEmail"));
			return;
		}
		if (!ew_CheckEmail($sSender)) {
			$this->setFailureMessage($Language->Phrase("EnterProperSenderEmail"));
			return;
		}

		// Check recipient
		if (!ew_CheckEmailList($sRecipient, EW_MAX_EMAIL_RECIPIENT)) {
			$this->setFailureMessage($Language->Phrase("EnterProperRecipientEmail"));
			return;
		}

		// Check cc
		if (!ew_CheckEmailList($sCc, EW_MAX_EMAIL_RECIPIENT)) {
			$this->setFailureMessage($Language->Phrase("EnterProperCcEmail"));
			return;
		}

		// Check bcc
		if (!ew_CheckEmailList($sBcc, EW_MAX_EMAIL_RECIPIENT)) {
			$this->setFailureMessage($Language->Phrase("EnterProperBccEmail"));
			return;
		}

		// Check email sent count
		if (!isset($_SESSION[EW_EXPORT_EMAIL_COUNTER]))
			$_SESSION[EW_EXPORT_EMAIL_COUNTER] = 0;
		if (intval($_SESSION[EW_EXPORT_EMAIL_COUNTER]) > EW_MAX_EMAIL_SENT_COUNT) {
			$this->setFailureMessage($Language->Phrase("ExceedMaxEmailExport"));
			return;
		}
		if ($sEmailMessage <> "") {
			$sEmailMessage = ew_RemoveXSS($sEmailMessage);
			$sEmailMessage .= ($sContentType == "url") ? "\r\n\r\n" : "<br><br>";
		}
		if ($sContentType == "url") {
			$sUrl = ew_ConvertFullUrl(ew_CurrentPage() . "?" . $this->ExportQueryString());
			$sEmailMessage .= $sUrl; // send URL only
		} else {
			$sEmailMessage .= $EmailContent; // send HTML
		}

		// Send email
		$Email = new cEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Content = $sEmailMessage; // Content
		$Email->Format = ($sContentType == "url") ? "text" : "html";
		$Email->Charset = EW_EMAIL_CHARSET;
		$EventArgs = array();
		$bEmailSent = FALSE;
		if ($documento_contable->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count
			$_SESSION[EW_EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			$this->setSuccessMessage($Language->Phrase("SendEmailSuccess"));
		} else {

			// Sent email failure
			$this->setFailureMessage($Email->SendErrDescription);
		}
	}

	// Export QueryString
	function ExportQueryString() {
		global $documento_contable;

		// Initialize
		$sQry = "export=html";

		// Build QueryString for search
		if ($documento_contable->getSessionBasicSearchKeyword() <> "") {
			$sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . $documento_contable->getSessionBasicSearchKeyword() . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . $documento_contable->getSessionBasicSearchType();
		}

		// Build QueryString for pager
		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . $documento_contable->getRecordsPerPage() . "&" . EW_TABLE_START_REC . "=" . $documento_contable->getStartRecordNumber();
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		global $documento_contable;
		$FldParm = substr($Fld->FldVar, 2);
		$FldSearchValue = $documento_contable->getAdvancedSearch("x_" . $FldParm);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . FldSearchValue .
				"&z_" . $FldParm . "=" . $documento_contable->getAdvancedSearch("z_" . $FldParm);
		}
		$FldSearchValue2 = $documento_contable->getAdvancedSearch("y_" . $FldParm);
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . $documento_contable->getAdvancedSearch("v_" . $FldParm) .
				"&y_" . $FldParm . "=" . $FldSearchValue2 .
				"&w_" . $FldParm . "=" . $documento_contable->getAdvancedSearch("w_" . $FldParm);
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $documento_contable;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($documento_contable->usuario->CurrentValue);
			}
		}
		return TRUE;
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
		$dompdf->render();
		ob_end_clean();
		ew_DeleteTmpImages();
		$dompdf->stream($gsExportFile . ".pdf", array("Attachment" => 1)); // 0 to open in browser, 1 to download

//		exit();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
