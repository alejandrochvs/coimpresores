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
<?php ew_Header(FALSE, 'utf-8') ?>
<?php

// Create page object
$pagos_x_docto_preview = new cpagos_x_docto_preview();
$Page =& $pagos_x_docto_preview;

// Page init
$pagos_x_docto_preview->Page_Init();

// Page main
$pagos_x_docto_preview->Page_Main();
?>
<link href="phpcss/coimpresore2dpagos1.css" rel="stylesheet" type="text/css">
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo  $pagos_x_docto->TableCaption() ?>&nbsp;
<?php if ($pagos_x_docto_preview->TotalRecs > 0) { ?>
(<?php echo $pagos_x_docto_preview->TotalRecs ?>&nbsp;<?php echo $Language->Phrase("Record") ?>)
<?php } else { ?>
(<?php echo $Language->Phrase("NoRecord") ?>)
<?php } ?>
</p>
<?php $pagos_x_docto_preview->ShowPageHeader(); ?>
<?php if ($pagos_x_docto_preview->TotalRecs > 0) { ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table id="ewDetailsPreviewTable" name="ewDetailsPreviewTable" cellspacing="0" class="ewTable ewTableSeparate">
	<thead><!-- Table header -->
		<tr class="ewTableHeader">
<?php if ($pagos_x_docto->usuario->Visible) { // iddoctocontable ?>
			<td valign="top"><?php echo $pagos_x_docto->iddoctocontable->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // tipo_docto ?>
			<td valign="top"><?php echo $pagos_x_docto->tipo_docto->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // consec_docto ?>
			<td valign="top"><?php echo $pagos_x_docto->consec_docto->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // valor ?>
			<td valign="top"><?php echo $pagos_x_docto->valor->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // cia ?>
			<td valign="top"><?php echo $pagos_x_docto->cia->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // nit ?>
			<td valign="top"><?php echo $pagos_x_docto->nit->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // fecha ?>
			<td valign="top"><?php echo $pagos_x_docto->fecha->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // dias_vencidos ?>
			<td valign="top"><?php echo $pagos_x_docto->dias_vencidos->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // estado ?>
			<td valign="top"><?php echo $pagos_x_docto->estado->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // estado_pago ?>
			<td valign="top"><?php echo $pagos_x_docto->estado_pago->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // fecha_vencimiento ?>
			<td valign="top"><?php echo $pagos_x_docto->fecha_vencimiento->FldCaption() ?></td>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // monto_pago ?>
			<td valign="top"><?php echo $pagos_x_docto->monto_pago->FldCaption() ?></td>
<?php } ?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$pagos_x_docto_preview->RecCount = 0;
while ($pagos_x_docto_preview->Recordset && !$pagos_x_docto_preview->Recordset->EOF) {

	// Init row class and style
	$pagos_x_docto_preview->RecCount++;
	$pagos_x_docto->CssClass = "";
	$pagos_x_docto->CssStyle = "";
	$pagos_x_docto->LoadListRowValues($pagos_x_docto_preview->Recordset);

	// Render row
	$pagos_x_docto->RowType = EW_ROWTYPE_PREVIEW; // Preview record
	$pagos_x_docto->RenderListRow();
?>
	<tr<?php echo $pagos_x_docto->RowAttributes() ?>>
<?php if ($pagos_x_docto->iddoctocontable->Visible) { // iddoctocontable ?>
		<!-- iddoctocontable -->
		<td<?php echo $pagos_x_docto->iddoctocontable->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->iddoctocontable->ViewAttributes() ?>><?php echo $pagos_x_docto->iddoctocontable->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->tipo_docto->Visible) { // tipo_docto ?>
		<!-- tipo_docto -->
		<td<?php echo $pagos_x_docto->tipo_docto->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->tipo_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->tipo_docto->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->consec_docto->Visible) { // consec_docto ?>
		<!-- consec_docto -->
		<td<?php echo $pagos_x_docto->consec_docto->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->consec_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->consec_docto->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->valor->Visible) { // valor ?>
		<!-- valor -->
		<td<?php echo $pagos_x_docto->valor->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->valor->ViewAttributes() ?>><?php echo $pagos_x_docto->valor->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->cia->Visible) { // cia ?>
		<!-- cia -->
		<td<?php echo $pagos_x_docto->cia->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->cia->ViewAttributes() ?>><?php echo $pagos_x_docto->cia->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->nit->Visible) { // nit ?>
		<!-- nit -->
		<td<?php echo $pagos_x_docto->nit->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->nit->ViewAttributes() ?>><?php echo $pagos_x_docto->nit->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->fecha->Visible) { // fecha ?>
		<!-- fecha -->
		<td<?php echo $pagos_x_docto->fecha->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->fecha->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->dias_vencidos->Visible) { // dias_vencidos ?>
		<!-- dias_vencidos -->
		<td<?php echo $pagos_x_docto->dias_vencidos->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->dias_vencidos->ViewAttributes() ?>><?php echo $pagos_x_docto->dias_vencidos->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->estado->Visible) { // estado ?>
		<!-- estado -->
		<td<?php echo $pagos_x_docto->estado->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->estado->ViewAttributes() ?>><?php echo $pagos_x_docto->estado->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->estado_pago->Visible) { // estado_pago ?>
		<!-- estado_pago -->
		<td<?php echo $pagos_x_docto->estado_pago->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->estado_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->estado_pago->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
		<!-- fecha_vencimiento -->
		<td<?php echo $pagos_x_docto->fecha_vencimiento->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->fecha_vencimiento->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha_vencimiento->ListViewValue() ?></div></td>
<?php } ?>
<?php if ($pagos_x_docto->monto_pago->Visible) { // monto_pago ?>
		<!-- monto_pago -->
		<td<?php echo $pagos_x_docto->monto_pago->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->monto_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->monto_pago->ListViewValue() ?></div></td>
<?php } ?>
	</tr>
<?php
	$pagos_x_docto_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table>
</div>
</td></tr></table>
<?php
$pagos_x_docto_preview->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
if ($pagos_x_docto_preview->Recordset)
	$pagos_x_docto_preview->Recordset->Close();
}
$content = ob_get_contents();
ob_end_clean();
echo ew_ConvertToUtf8($content);
?>
<?php
$pagos_x_docto_preview->Page_Terminate();
?>
<?php

//
// Page class
//
class cpagos_x_docto_preview {

	// Page ID
	var $PageID = 'preview';

	// Table name
	var $TableName = 'pagos_x_docto';

	// Page object name
	var $PageObjName = 'pagos_x_docto_preview';

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
	function cpagos_x_docto_preview() {
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
			define("EW_PAGE_ID", 'preview', TRUE);

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
		if (is_null($Security)) $Security = new cAdvancedSecurity();
		if (IsPasswordExpired())
			exit();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			echo $Language->Phrase("NoPermission");
			exit();
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel('pagos_x_docto');
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			echo $Language->Phrase("NoPermission");
			exit();
		}
		if (!$Security->CanList()) {
			echo $Language->Phrase("NoPermission");
			exit();
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			echo $Language->Phrase("NoPermission");
			exit();
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
	var $Recordset;
	var $TotalRecs;
	var $RecCount;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $pagos_x_docto;

		// Load filter
		$qs = new cQueryString();
		$filter = $qs->GetValue("f");
		$filter = TEAdecrypt($filter, EW_RANDOM_KEY);
		if ($filter == "") $filter = "0=1";

		// Load recordset
		// Call Recordset Selecting event

		$pagos_x_docto->Recordset_Selecting($filter);
		$this->Recordset = $pagos_x_docto->LoadRs($filter);
		$this->TotalRecs = ($this->Recordset) ? $this->Recordset->RecordCount() : 0;

		// Call Recordset Selected event
		$pagos_x_docto->Recordset_Selected($this->Recordset);
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
