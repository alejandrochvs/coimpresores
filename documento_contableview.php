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
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$documento_contable_view = new cdocumento_contable_view();
$Page =& $documento_contable_view;

// Page init
$documento_contable_view->Page_Init();

// Page main
$documento_contable_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($documento_contable->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var documento_contable_view = new ew_Page("documento_contable_view");

// page properties
documento_contable_view.PageID = "view"; // page ID
documento_contable_view.FormID = "fdocumento_contableview"; // form ID
var EW_PAGE_ID = documento_contable_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
documento_contable_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documento_contable_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documento_contable_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documento_contable->TableCaption() ?>
&nbsp;&nbsp;<?php $documento_contable_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($documento_contable->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $documento_contable_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php } ?>
</p>
<?php $documento_contable_view->ShowPageHeader(); ?>
<?php
$documento_contable_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($documento_contable->iddoctocontable->Visible) { // iddoctocontable ?>
	<tr id="r_iddoctocontable"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->iddoctocontable->FldCaption() ?></td>
		<td<?php echo $documento_contable->iddoctocontable->CellAttributes() ?>>
<div<?php echo $documento_contable->iddoctocontable->ViewAttributes() ?>><?php echo $documento_contable->iddoctocontable->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->tipo_docto->Visible) { // tipo_docto ?>
	<tr id="r_tipo_docto"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->tipo_docto->FldCaption() ?></td>
		<td<?php echo $documento_contable->tipo_docto->CellAttributes() ?>>
<div<?php echo $documento_contable->tipo_docto->ViewAttributes() ?>><?php echo $documento_contable->tipo_docto->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->consec_docto->Visible) { // consec_docto ?>
	<tr id="r_consec_docto"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->consec_docto->FldCaption() ?></td>
		<td<?php echo $documento_contable->consec_docto->CellAttributes() ?>>
<div<?php echo $documento_contable->consec_docto->ViewAttributes() ?>><?php echo $documento_contable->consec_docto->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->valor->Visible) { // valor ?>
	<tr id="r_valor"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->valor->FldCaption() ?></td>
		<td<?php echo $documento_contable->valor->CellAttributes() ?>>
<div<?php echo $documento_contable->valor->ViewAttributes() ?>><?php echo $documento_contable->valor->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->cia->Visible) { // cia ?>
	<tr id="r_cia"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->cia->FldCaption() ?></td>
		<td<?php echo $documento_contable->cia->CellAttributes() ?>>
<div<?php echo $documento_contable->cia->ViewAttributes() ?>><?php echo $documento_contable->cia->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->tercero->Visible) { // tercero ?>
	<tr id="r_tercero"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->tercero->FldCaption() ?></td>
		<td<?php echo $documento_contable->tercero->CellAttributes() ?>>
<div<?php echo $documento_contable->tercero->ViewAttributes() ?>><?php echo $documento_contable->tercero->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->fecha->FldCaption() ?></td>
		<td<?php echo $documento_contable->fecha->CellAttributes() ?>>
<div<?php echo $documento_contable->fecha->ViewAttributes() ?>><?php echo $documento_contable->fecha->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
	<tr id="r_fecha_vencimiento"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->fecha_vencimiento->FldCaption() ?></td>
		<td<?php echo $documento_contable->fecha_vencimiento->CellAttributes() ?>>
<div<?php echo $documento_contable->fecha_vencimiento->ViewAttributes() ?>><?php echo $documento_contable->fecha_vencimiento->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->estado->Visible) { // estado ?>
	<tr id="r_estado"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->estado->FldCaption() ?></td>
		<td<?php echo $documento_contable->estado->CellAttributes() ?>>
<div<?php echo $documento_contable->estado->ViewAttributes() ?>><?php echo $documento_contable->estado->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->dias_vencidos->Visible) { // dias_vencidos ?>
	<tr id="r_dias_vencidos"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->dias_vencidos->FldCaption() ?></td>
		<td<?php echo $documento_contable->dias_vencidos->CellAttributes() ?>>
<div<?php echo $documento_contable->dias_vencidos->ViewAttributes() ?>><?php echo $documento_contable->dias_vencidos->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->usuario->Visible) { // usuario ?>
	<tr id="r_usuario"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->usuario->FldCaption() ?></td>
		<td<?php echo $documento_contable->usuario->CellAttributes() ?>>
<div<?php echo $documento_contable->usuario->ViewAttributes() ?>><?php echo $documento_contable->usuario->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->descripcion->FldCaption() ?></td>
		<td<?php echo $documento_contable->descripcion->CellAttributes() ?>>
<div<?php echo $documento_contable->descripcion->ViewAttributes() ?>><?php echo $documento_contable->descripcion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->nit->Visible) { // nit ?>
	<tr id="r_nit"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->nit->FldCaption() ?></td>
		<td<?php echo $documento_contable->nit->CellAttributes() ?>>
<div<?php echo $documento_contable->nit->ViewAttributes() ?>><?php echo $documento_contable->nit->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($documento_contable->fecha_actualizacion->Visible) { // fecha_actualizacion ?>
	<tr id="r_fecha_actualizacion"<?php echo $documento_contable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $documento_contable->fecha_actualizacion->FldCaption() ?></td>
		<td<?php echo $documento_contable->fecha_actualizacion->CellAttributes() ?>>
<div<?php echo $documento_contable->fecha_actualizacion->ViewAttributes() ?>><?php echo $documento_contable->fecha_actualizacion->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$documento_contable_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($documento_contable->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$documento_contable_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumento_contable_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'documento_contable';

	// Page object name
	var $PageObjName = 'documento_contable_view';

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
	function cdocumento_contable_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documento_contable)
		if (!isset($GLOBALS["documento_contable"])) {
			$GLOBALS["documento_contable"] = new cdocumento_contable();
			$GLOBALS["Table"] =& $GLOBALS["documento_contable"];
		}
		$KeyUrl = "";
		if (@$_GET["iddoctocontable"] <> "") {
			$this->RecKey["iddoctocontable"] = $_GET["iddoctocontable"];
			$KeyUrl .= "&iddoctocontable=" . urlencode($this->RecKey["iddoctocontable"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documento_contable', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

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

		// User profile
		$UserProfile = new cUserProfile();
		$UserProfile->LoadProfile(@$_SESSION[EW_SESSION_USER_PROFILE]);

		// Security
		$Security = new cAdvancedSecurity();
		if (IsPasswordExpired())
			$this->Page_Terminate("changepwd.php");
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("documento_contablelist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("documento_contablelist.php");
		}

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
		if (@$_GET["iddoctocontable"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["iddoctocontable"]);
		}
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
	var $ExportOptions; // Export options
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $documento_contable;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["iddoctocontable"] <> "") {
				$documento_contable->iddoctocontable->setQueryStringValue($_GET["iddoctocontable"]);
				$this->RecKey["iddoctocontable"] = $documento_contable->iddoctocontable->QueryStringValue;
			} else {
				$sReturnUrl = "documento_contablelist.php"; // Return to list
			}

			// Get action
			$documento_contable->CurrentAction = "I"; // Display form
			switch ($documento_contable->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "documento_contablelist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($documento_contable->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				if ($documento_contable->Export == "email" && $documento_contable->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$documento_contable->setExportReturnUrl($documento_contable->ViewUrl()); // Add key
				$this->ExportData();
				if ($documento_contable->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "documento_contablelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$documento_contable->RowType = EW_ROWTYPE_VIEW;
		$documento_contable->ResetAttrs();
		$this->RenderRow();
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
		$documento_contable->fecha_vencimiento->setDbValue($rs->fields('fecha_vencimiento'));
		$documento_contable->estado->setDbValue($rs->fields('estado'));
		$documento_contable->dias_vencidos->setDbValue($rs->fields('dias_vencidos'));
		$documento_contable->usuario->setDbValue($rs->fields('usuario'));
		$documento_contable->estado_pago->setDbValue($rs->fields('estado_pago'));
		$documento_contable->descripcion->setDbValue($rs->fields('descripcion'));
		$documento_contable->nit->setDbValue($rs->fields('nit'));
		$documento_contable->fecha_actualizacion->setDbValue($rs->fields('fecha_actualizacion'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documento_contable;

		// Initialize URLs
		$this->AddUrl = $documento_contable->AddUrl();
		$this->EditUrl = $documento_contable->EditUrl();
		$this->CopyUrl = $documento_contable->CopyUrl();
		$this->DeleteUrl = $documento_contable->DeleteUrl();
		$this->ListUrl = $documento_contable->ListUrl();

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
		// fecha_vencimiento
		// estado
		// dias_vencidos
		// usuario
		// estado_pago
		// descripcion
		// nit
		// fecha_actualizacion

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

			// fecha_vencimiento
			$documento_contable->fecha_vencimiento->ViewValue = $documento_contable->fecha_vencimiento->CurrentValue;
			$documento_contable->fecha_vencimiento->ViewCustomAttributes = "";

			// estado
			$documento_contable->estado->ViewValue = $documento_contable->estado->CurrentValue;
			$documento_contable->estado->ViewCustomAttributes = "";

			// dias_vencidos
			$documento_contable->dias_vencidos->ViewValue = $documento_contable->dias_vencidos->CurrentValue;
			$documento_contable->dias_vencidos->ViewCustomAttributes = "";

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
					case "4":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(4) <> "" ? $documento_contable->estado_pago->FldTagCaption(4) : $documento_contable->estado_pago->CurrentValue;
						break;
					case "5":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(5) <> "" ? $documento_contable->estado_pago->FldTagCaption(5) : $documento_contable->estado_pago->CurrentValue;
						break;
					case "6":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(6) <> "" ? $documento_contable->estado_pago->FldTagCaption(6) : $documento_contable->estado_pago->CurrentValue;
						break;
					case "7":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(7) <> "" ? $documento_contable->estado_pago->FldTagCaption(7) : $documento_contable->estado_pago->CurrentValue;
						break;
					case "8":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(8) <> "" ? $documento_contable->estado_pago->FldTagCaption(8) : $documento_contable->estado_pago->CurrentValue;
						break;
					case "9":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(9) <> "" ? $documento_contable->estado_pago->FldTagCaption(9) : $documento_contable->estado_pago->CurrentValue;
						break;
					case "10":
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(10) <> "" ? $documento_contable->estado_pago->FldTagCaption(10) : $documento_contable->estado_pago->CurrentValue;
						break;
					default:
						$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->CurrentValue;
				}
			} else {
				$documento_contable->estado_pago->ViewValue = NULL;
			}
			$documento_contable->estado_pago->ViewCustomAttributes = "";

			// descripcion
			$documento_contable->descripcion->ViewValue = $documento_contable->descripcion->CurrentValue;
			$documento_contable->descripcion->ViewCustomAttributes = "";

			// nit
			$documento_contable->nit->ViewValue = $documento_contable->nit->CurrentValue;
			$documento_contable->nit->ViewCustomAttributes = "";

			// fecha_actualizacion
			$documento_contable->fecha_actualizacion->ViewValue = $documento_contable->fecha_actualizacion->CurrentValue;
			$documento_contable->fecha_actualizacion->ViewCustomAttributes = "";

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

			// fecha_vencimiento
			$documento_contable->fecha_vencimiento->LinkCustomAttributes = "";
			$documento_contable->fecha_vencimiento->HrefValue = "";
			$documento_contable->fecha_vencimiento->TooltipValue = "";

			// estado
			$documento_contable->estado->LinkCustomAttributes = "";
			$documento_contable->estado->HrefValue = "";
			$documento_contable->estado->TooltipValue = "";

			// dias_vencidos
			$documento_contable->dias_vencidos->LinkCustomAttributes = "";
			$documento_contable->dias_vencidos->HrefValue = "";
			$documento_contable->dias_vencidos->TooltipValue = "";

			// usuario
			$documento_contable->usuario->LinkCustomAttributes = "";
			$documento_contable->usuario->HrefValue = "";
			$documento_contable->usuario->TooltipValue = "";

			// descripcion
			$documento_contable->descripcion->LinkCustomAttributes = "";
			$documento_contable->descripcion->HrefValue = "";
			$documento_contable->descripcion->TooltipValue = "";

			// nit
			$documento_contable->nit->LinkCustomAttributes = "";
			$documento_contable->nit->HrefValue = "";
			$documento_contable->nit->TooltipValue = "";

			// fecha_actualizacion
			$documento_contable->fecha_actualizacion->LinkCustomAttributes = "";
			$documento_contable->fecha_actualizacion->HrefValue = "";
			$documento_contable->fecha_actualizacion->TooltipValue = "";
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
		$item->Visible = TRUE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_documento_contable\" id=\"emf_documento_contable\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_documento_contable',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Hide options for export/action
		if ($documento_contable->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $documento_contable;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $documento_contable->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;
		$this->SetUpStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecs < 0) {
			$this->StopRec = $this->TotalRecs;
		} else {
			$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
		}
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($documento_contable->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($documento_contable, "v");
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
			$documento_contable->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$documento_contable->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
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

		// Add record key QueryString
		$sQry .= "&" . substr($documento_contable->KeyUrl("", ""), 1);
		return $sQry;
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
}
?>
