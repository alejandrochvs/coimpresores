<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pagos_x_doctoinfo.php" ?>
<?php include_once "historial_pagosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pagos_x_docto_delete = new cpagos_x_docto_delete();
$Page =& $pagos_x_docto_delete;

// Page init
$pagos_x_docto_delete->Page_Init();

// Page main
$pagos_x_docto_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pagos_x_docto_delete = new ew_Page("pagos_x_docto_delete");

// page properties
pagos_x_docto_delete.PageID = "delete"; // page ID
pagos_x_docto_delete.FormID = "fpagos_x_doctodelete"; // form ID
var EW_PAGE_ID = pagos_x_docto_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pagos_x_docto_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pagos_x_docto_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pagos_x_docto_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($pagos_x_docto_delete->Recordset = $pagos_x_docto_delete->LoadRecordset())
	$pagos_x_docto_deleteTotalRecs = $pagos_x_docto_delete->Recordset->RecordCount(); // Get record count
if ($pagos_x_docto_deleteTotalRecs <= 0) { // No record found, exit
	if ($pagos_x_docto_delete->Recordset)
		$pagos_x_docto_delete->Recordset->Close();
	$pagos_x_docto_delete->Page_Terminate("pagos_x_doctolist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pagos_x_docto->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $pagos_x_docto->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $pagos_x_docto_delete->ShowPageHeader(); ?>
<?php
$pagos_x_docto_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="pagos_x_docto">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($pagos_x_docto_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $pagos_x_docto->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $pagos_x_docto->iddoctocontable->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->tipo_docto->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->consec_docto->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->valor->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->cia->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->nit->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->fecha->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->dias_vencidos->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->estado->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->estado_pago->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->fecha_vencimiento->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_x_docto->monto_pago->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$pagos_x_docto_delete->RecCnt = 0;
$i = 0;
while (!$pagos_x_docto_delete->Recordset->EOF) {
	$pagos_x_docto_delete->RecCnt++;

	// Set row properties
	$pagos_x_docto->ResetAttrs();
	$pagos_x_docto->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$pagos_x_docto_delete->LoadRowValues($pagos_x_docto_delete->Recordset);

	// Render row
	$pagos_x_docto_delete->RenderRow();
?>
	<tr<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td<?php echo $pagos_x_docto->iddoctocontable->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->iddoctocontable->ViewAttributes() ?>><?php echo $pagos_x_docto->iddoctocontable->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->tipo_docto->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->tipo_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->tipo_docto->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->consec_docto->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->consec_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->consec_docto->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->valor->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->valor->ViewAttributes() ?>><?php echo $pagos_x_docto->valor->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->cia->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->cia->ViewAttributes() ?>><?php echo $pagos_x_docto->cia->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->nit->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->nit->ViewAttributes() ?>><?php echo $pagos_x_docto->nit->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->fecha->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->fecha->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->dias_vencidos->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->dias_vencidos->ViewAttributes() ?>><?php echo $pagos_x_docto->dias_vencidos->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->estado->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->estado->ViewAttributes() ?>><?php echo $pagos_x_docto->estado->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->estado_pago->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->estado_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->estado_pago->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->fecha_vencimiento->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->fecha_vencimiento->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha_vencimiento->ListViewValue() ?></div></td>
		<td<?php echo $pagos_x_docto->monto_pago->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->monto_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->monto_pago->ListViewValue() ?></div></td>
	</tr>
<?php
	$pagos_x_docto_delete->Recordset->MoveNext();
}
$pagos_x_docto_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$pagos_x_docto_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$pagos_x_docto_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpagos_x_docto_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'pagos_x_docto';

	// Page object name
	var $PageObjName = 'pagos_x_docto_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pagos_x_docto;
		if ($pagos_x_docto->UseTokenInUrl) $PageUrl .= "t=" . $pagos_x_docto->TableVar . "&"; // Add page token
		return $PageUrl;
	}

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
		global $objForm, $pagos_x_docto;
		if ($pagos_x_docto->UseTokenInUrl) {
			if ($objForm)
				return ($pagos_x_docto->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pagos_x_docto->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpagos_x_docto_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pagos_x_docto)
		if (!isset($GLOBALS["pagos_x_docto"])) {
			$GLOBALS["pagos_x_docto"] = new cpagos_x_docto();
			$GLOBALS["Table"] =& $GLOBALS["pagos_x_docto"];
		}

		// Table object (historial_pagos)
		if (!isset($GLOBALS['historial_pagos'])) $GLOBALS['historial_pagos'] = new chistorial_pagos();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pagos_x_docto', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $pagos_x_docto;

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("pagos_x_doctolist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("pagos_x_doctolist.php");
		}

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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $pagos_x_docto;

		// Load key parameters
		$this->RecKeys = $pagos_x_docto->GetRecordKeys(); // Load record keys
		$sFilter = $pagos_x_docto->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("pagos_x_doctolist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in pagos_x_docto class, pagos_x_doctoinfo.php

		$pagos_x_docto->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$pagos_x_docto->CurrentAction = $_POST["a_delete"];
		} else {
			$pagos_x_docto->CurrentAction = "I"; // Display record
		}
		switch ($pagos_x_docto->CurrentAction) {
			case "D": // Delete
				$pagos_x_docto->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($pagos_x_docto->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pagos_x_docto;

		// Call Recordset Selecting event
		$pagos_x_docto->Recordset_Selecting($pagos_x_docto->CurrentFilter);

		// Load List page SQL
		$sSql = $pagos_x_docto->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pagos_x_docto->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pagos_x_docto;
		$sFilter = $pagos_x_docto->KeyFilter();

		// Call Row Selecting event
		$pagos_x_docto->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pagos_x_docto->CurrentFilter = $sFilter;
		$sSql = $pagos_x_docto->SQL();
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
		global $conn, $pagos_x_docto;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pagos_x_docto->Row_Selected($row);
		$pagos_x_docto->iddoctocontable->setDbValue($rs->fields('iddoctocontable'));
		$pagos_x_docto->historial->setDbValue($rs->fields('historial'));
		$pagos_x_docto->tipo_docto->setDbValue($rs->fields('tipo_docto'));
		$pagos_x_docto->consec_docto->setDbValue($rs->fields('consec_docto'));
		$pagos_x_docto->valor->setDbValue($rs->fields('valor'));
		$pagos_x_docto->cia->setDbValue($rs->fields('cia'));
		$pagos_x_docto->nit->setDbValue($rs->fields('nit'));
		$pagos_x_docto->tercero->setDbValue($rs->fields('tercero'));
		$pagos_x_docto->fecha->setDbValue($rs->fields('fecha'));
		$pagos_x_docto->dias_vencidos->setDbValue($rs->fields('dias_vencidos'));
		$pagos_x_docto->estado->setDbValue($rs->fields('estado'));
		$pagos_x_docto->usuario->setDbValue($rs->fields('usuario'));
		$pagos_x_docto->estado_pago->setDbValue($rs->fields('estado_pago'));
		$pagos_x_docto->descripcion->setDbValue($rs->fields('descripcion'));
		$pagos_x_docto->fecha_vencimiento->setDbValue($rs->fields('fecha_vencimiento'));
		$pagos_x_docto->monto_pago->setDbValue($rs->fields('monto_pago'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pagos_x_docto;

		// Initialize URLs
		// Call Row_Rendering event

		$pagos_x_docto->Row_Rendering();

		// Common render codes for all row types
		// iddoctocontable
		// historial
		// tipo_docto
		// consec_docto
		// valor
		// cia
		// nit
		// tercero
		// fecha
		// dias_vencidos
		// estado
		// usuario
		// estado_pago
		// descripcion
		// fecha_vencimiento
		// monto_pago

		if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View row

			// iddoctocontable
			$pagos_x_docto->iddoctocontable->ViewValue = $pagos_x_docto->iddoctocontable->CurrentValue;
			$pagos_x_docto->iddoctocontable->ViewCustomAttributes = "";

			// historial
			$pagos_x_docto->historial->ViewValue = $pagos_x_docto->historial->CurrentValue;
			$pagos_x_docto->historial->ViewCustomAttributes = "";

			// tipo_docto
			$pagos_x_docto->tipo_docto->ViewValue = $pagos_x_docto->tipo_docto->CurrentValue;
			$pagos_x_docto->tipo_docto->ViewCustomAttributes = "";

			// consec_docto
			$pagos_x_docto->consec_docto->ViewValue = $pagos_x_docto->consec_docto->CurrentValue;
			$pagos_x_docto->consec_docto->ViewCustomAttributes = "";

			// valor
			$pagos_x_docto->valor->ViewValue = $pagos_x_docto->valor->CurrentValue;
			$pagos_x_docto->valor->ViewValue = ew_FormatCurrency($pagos_x_docto->valor->ViewValue, 0, -2, -2, -2);
			$pagos_x_docto->valor->ViewCustomAttributes = "";

			// cia
			$pagos_x_docto->cia->ViewValue = $pagos_x_docto->cia->CurrentValue;
			$pagos_x_docto->cia->ViewCustomAttributes = "";

			// nit
			$pagos_x_docto->nit->ViewValue = $pagos_x_docto->nit->CurrentValue;
			$pagos_x_docto->nit->ViewCustomAttributes = "";

			// tercero
			$pagos_x_docto->tercero->ViewValue = $pagos_x_docto->tercero->CurrentValue;
			$pagos_x_docto->tercero->ViewCustomAttributes = "";

			// fecha
			$pagos_x_docto->fecha->ViewValue = $pagos_x_docto->fecha->CurrentValue;
			$pagos_x_docto->fecha->ViewCustomAttributes = "";

			// dias_vencidos
			$pagos_x_docto->dias_vencidos->ViewValue = $pagos_x_docto->dias_vencidos->CurrentValue;
			$pagos_x_docto->dias_vencidos->ViewCustomAttributes = "";

			// estado
			$pagos_x_docto->estado->ViewValue = $pagos_x_docto->estado->CurrentValue;
			$pagos_x_docto->estado->ViewCustomAttributes = "";

			// usuario
			$pagos_x_docto->usuario->ViewValue = $pagos_x_docto->usuario->CurrentValue;
			$pagos_x_docto->usuario->ViewCustomAttributes = "";

			// estado_pago
			$pagos_x_docto->estado_pago->ViewValue = $pagos_x_docto->estado_pago->CurrentValue;
			$pagos_x_docto->estado_pago->ViewCustomAttributes = "";

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->ViewValue = $pagos_x_docto->fecha_vencimiento->CurrentValue;
			$pagos_x_docto->fecha_vencimiento->ViewCustomAttributes = "";

			// monto_pago
			$pagos_x_docto->monto_pago->ViewValue = $pagos_x_docto->monto_pago->CurrentValue;
			$pagos_x_docto->monto_pago->ViewValue = ew_FormatCurrency($pagos_x_docto->monto_pago->ViewValue, 0, -2, -2, -2);
			$pagos_x_docto->monto_pago->ViewCustomAttributes = "";

			// iddoctocontable
			$pagos_x_docto->iddoctocontable->LinkCustomAttributes = "";
			$pagos_x_docto->iddoctocontable->HrefValue = "";
			$pagos_x_docto->iddoctocontable->TooltipValue = "";

			// tipo_docto
			$pagos_x_docto->tipo_docto->LinkCustomAttributes = "";
			$pagos_x_docto->tipo_docto->HrefValue = "";
			$pagos_x_docto->tipo_docto->TooltipValue = "";

			// consec_docto
			$pagos_x_docto->consec_docto->LinkCustomAttributes = "";
			$pagos_x_docto->consec_docto->HrefValue = "";
			$pagos_x_docto->consec_docto->TooltipValue = "";

			// valor
			$pagos_x_docto->valor->LinkCustomAttributes = "";
			$pagos_x_docto->valor->HrefValue = "";
			$pagos_x_docto->valor->TooltipValue = "";

			// cia
			$pagos_x_docto->cia->LinkCustomAttributes = "";
			$pagos_x_docto->cia->HrefValue = "";
			$pagos_x_docto->cia->TooltipValue = "";

			// nit
			$pagos_x_docto->nit->LinkCustomAttributes = "";
			$pagos_x_docto->nit->HrefValue = "";
			$pagos_x_docto->nit->TooltipValue = "";

			// fecha
			$pagos_x_docto->fecha->LinkCustomAttributes = "";
			$pagos_x_docto->fecha->HrefValue = "";
			$pagos_x_docto->fecha->TooltipValue = "";

			// dias_vencidos
			$pagos_x_docto->dias_vencidos->LinkCustomAttributes = "";
			$pagos_x_docto->dias_vencidos->HrefValue = "";
			$pagos_x_docto->dias_vencidos->TooltipValue = "";

			// estado
			$pagos_x_docto->estado->LinkCustomAttributes = "";
			$pagos_x_docto->estado->HrefValue = "";
			$pagos_x_docto->estado->TooltipValue = "";

			// estado_pago
			$pagos_x_docto->estado_pago->LinkCustomAttributes = "";
			$pagos_x_docto->estado_pago->HrefValue = "";
			$pagos_x_docto->estado_pago->TooltipValue = "";

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->LinkCustomAttributes = "";
			$pagos_x_docto->fecha_vencimiento->HrefValue = "";
			$pagos_x_docto->fecha_vencimiento->TooltipValue = "";

			// monto_pago
			$pagos_x_docto->monto_pago->LinkCustomAttributes = "";
			$pagos_x_docto->monto_pago->HrefValue = "";
			$pagos_x_docto->monto_pago->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pagos_x_docto->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pagos_x_docto->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $pagos_x_docto;
		$DeleteRows = TRUE;
		$sSql = $pagos_x_docto->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $pagos_x_docto->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['iddoctocontable'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($pagos_x_docto->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($pagos_x_docto->CancelMessage <> "") {
				$this->setFailureMessage($pagos_x_docto->CancelMessage);
				$pagos_x_docto->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$pagos_x_docto->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
