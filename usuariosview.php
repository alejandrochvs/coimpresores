<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuarios_view = new cusuarios_view();
$Page =& $usuarios_view;

// Page init
$usuarios_view->Page_Init();

// Page main
$usuarios_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuarios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_view = new ew_Page("usuarios_view");

// page properties
usuarios_view.PageID = "view"; // page ID
usuarios_view.FormID = "fusuariosview"; // form ID
var EW_PAGE_ID = usuarios_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuarios_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarios->TableCaption() ?>
&nbsp;&nbsp;<?php $usuarios_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($usuarios->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $usuarios_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<?php if ($usuarios_view->ShowOptionLink()) { ?>
<a href="<?php echo $usuarios_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<?php if ($usuarios_view->ShowOptionLink()) { ?>
<a href="<?php echo $usuarios_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<?php if ($usuarios_view->ShowOptionLink()) { ?>
<a href="<?php echo $usuarios_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<?php if ($usuarios_view->ShowOptionLink()) { ?>
<a href="<?php echo $usuarios_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</p>
<?php $usuarios_view->ShowPageHeader(); ?>
<?php
$usuarios_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuarios->idusuario->Visible) { // idusuario ?>
	<tr id="r_idusuario"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->idusuario->FldCaption() ?></td>
		<td<?php echo $usuarios->idusuario->CellAttributes() ?>>
<div<?php echo $usuarios->idusuario->ViewAttributes() ?>><?php echo $usuarios->idusuario->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->username->Visible) { // username ?>
	<tr id="r_username"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->username->FldCaption() ?></td>
		<td<?php echo $usuarios->username->CellAttributes() ?>>
<div<?php echo $usuarios->username->ViewAttributes() ?>><?php echo $usuarios->username->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->password->Visible) { // password ?>
	<tr id="r_password"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->password->FldCaption() ?></td>
		<td<?php echo $usuarios->password->CellAttributes() ?>>
<div<?php echo $usuarios->password->ViewAttributes() ?>><?php echo $usuarios->password->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->zemail->Visible) { // email ?>
	<tr id="r_zemail"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->zemail->FldCaption() ?></td>
		<td<?php echo $usuarios->zemail->CellAttributes() ?>>
<div<?php echo $usuarios->zemail->ViewAttributes() ?>><?php echo $usuarios->zemail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->empresa->Visible) { // empresa ?>
	<tr id="r_empresa"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->empresa->FldCaption() ?></td>
		<td<?php echo $usuarios->empresa->CellAttributes() ?>>
<div<?php echo $usuarios->empresa->ViewAttributes() ?>><?php echo $usuarios->empresa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->nit_empresa->Visible) { // nit_empresa ?>
	<tr id="r_nit_empresa"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->nit_empresa->FldCaption() ?></td>
		<td<?php echo $usuarios->nit_empresa->CellAttributes() ?>>
<div<?php echo $usuarios->nit_empresa->ViewAttributes() ?>><?php echo $usuarios->nit_empresa->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->fecha_creacion->Visible) { // fecha_creacion ?>
	<tr id="r_fecha_creacion"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->fecha_creacion->FldCaption() ?></td>
		<td<?php echo $usuarios->fecha_creacion->CellAttributes() ?>>
<div<?php echo $usuarios->fecha_creacion->ViewAttributes() ?>><?php echo $usuarios->fecha_creacion->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->activo->Visible) { // activo ?>
	<tr id="r_activo"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->activo->FldCaption() ?></td>
		<td<?php echo $usuarios->activo->CellAttributes() ?>>
<div<?php echo $usuarios->activo->ViewAttributes() ?>><?php echo $usuarios->activo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($usuarios->nivel->Visible) { // nivel ?>
	<tr id="r_nivel"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->nivel->FldCaption() ?></td>
		<td<?php echo $usuarios->nivel->CellAttributes() ?>>
<div<?php echo $usuarios->nivel->ViewAttributes() ?>><?php echo $usuarios->nivel->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$usuarios_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($usuarios->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuarios_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarios_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'usuarios';

	// Page object name
	var $PageObjName = 'usuarios_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuarios;
		if ($usuarios->UseTokenInUrl) $PageUrl .= "t=" . $usuarios->TableVar . "&"; // Add page token
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
		global $objForm, $usuarios;
		if ($usuarios->UseTokenInUrl) {
			if ($objForm)
				return ($usuarios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuarios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuarios_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuarios)
		if (!isset($GLOBALS["usuarios"])) {
			$GLOBALS["usuarios"] = new cusuarios();
			$GLOBALS["Table"] =& $GLOBALS["usuarios"];
		}
		$KeyUrl = "";
		if (@$_GET["idusuario"] <> "") {
			$this->RecKey["idusuario"] = $_GET["idusuario"];
			$KeyUrl .= "&idusuario=" . urlencode($this->RecKey["idusuario"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuarios', TRUE);

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
		global $usuarios;

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
			$this->Page_Terminate("usuarioslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("usuarioslist.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$usuarios->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$usuarios->Export = $_POST["exporttype"];
		} else {
			$usuarios->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $usuarios->Export; // Get export parameter, used in header
		$gsExportFile = $usuarios->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if (@$_GET["idusuario"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["idusuario"]);
		}
		if ($usuarios->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($usuarios->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}
		if ($usuarios->Export == "xml") {
			header('Content-Type: text/xml' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($usuarios->Export == "csv") {
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
		global $Language, $usuarios;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["idusuario"] <> "") {
				$usuarios->idusuario->setQueryStringValue($_GET["idusuario"]);
				$this->RecKey["idusuario"] = $usuarios->idusuario->QueryStringValue;
			} else {
				$sReturnUrl = "usuarioslist.php"; // Return to list
			}

			// Get action
			$usuarios->CurrentAction = "I"; // Display form
			switch ($usuarios->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "usuarioslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($usuarios->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				if ($usuarios->Export == "email" && $usuarios->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$usuarios->setExportReturnUrl($usuarios->ViewUrl()); // Add key
				$this->ExportData();
				if ($usuarios->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "usuarioslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$usuarios->RowType = EW_ROWTYPE_VIEW;
		$usuarios->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $usuarios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$usuarios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$usuarios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $usuarios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$usuarios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$usuarios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$usuarios->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $usuarios;

		// Call Recordset Selecting event
		$usuarios->Recordset_Selecting($usuarios->CurrentFilter);

		// Load List page SQL
		$sSql = $usuarios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$usuarios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuarios;
		$sFilter = $usuarios->KeyFilter();

		// Call Row Selecting event
		$usuarios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuarios->CurrentFilter = $sFilter;
		$sSql = $usuarios->SQL();
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
		global $conn, $usuarios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuarios->Row_Selected($row);
		$usuarios->idusuario->setDbValue($rs->fields('idusuario'));
		$usuarios->username->setDbValue($rs->fields('username'));
		$usuarios->password->setDbValue($rs->fields('password'));
		$usuarios->zemail->setDbValue($rs->fields('email'));
		$usuarios->empresa->setDbValue($rs->fields('empresa'));
		$usuarios->nit_empresa->setDbValue($rs->fields('nit_empresa'));
		$usuarios->fecha_creacion->setDbValue($rs->fields('fecha_creacion'));
		$usuarios->activo->setDbValue($rs->fields('activo'));
		$usuarios->nivel->setDbValue($rs->fields('nivel'));
		$usuarios->perfil->setDbValue($rs->fields('perfil'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuarios;

		// Initialize URLs
		$this->AddUrl = $usuarios->AddUrl();
		$this->EditUrl = $usuarios->EditUrl();
		$this->CopyUrl = $usuarios->CopyUrl();
		$this->DeleteUrl = $usuarios->DeleteUrl();
		$this->ListUrl = $usuarios->ListUrl();

		// Call Row_Rendering event
		$usuarios->Row_Rendering();

		// Common render codes for all row types
		// idusuario
		// username
		// password
		// email
		// empresa
		// nit_empresa
		// fecha_creacion
		// activo
		// nivel
		// perfil

		if ($usuarios->RowType == EW_ROWTYPE_VIEW) { // View row

			// idusuario
			$usuarios->idusuario->ViewValue = $usuarios->idusuario->CurrentValue;
			$usuarios->idusuario->ViewCustomAttributes = "";

			// username
			$usuarios->username->ViewValue = $usuarios->username->CurrentValue;
			$usuarios->username->ViewCustomAttributes = "";

			// password
			$usuarios->password->ViewValue = "********";
			$usuarios->password->ViewCustomAttributes = "";

			// email
			$usuarios->zemail->ViewValue = $usuarios->zemail->CurrentValue;
			$usuarios->zemail->ViewCustomAttributes = "";

			// empresa
			$usuarios->empresa->ViewValue = $usuarios->empresa->CurrentValue;
			$usuarios->empresa->ViewCustomAttributes = "";

			// nit_empresa
			$usuarios->nit_empresa->ViewValue = $usuarios->nit_empresa->CurrentValue;
			$usuarios->nit_empresa->ViewCustomAttributes = "";

			// fecha_creacion
			$usuarios->fecha_creacion->ViewValue = $usuarios->fecha_creacion->CurrentValue;
			$usuarios->fecha_creacion->ViewValue = ew_FormatDateTime($usuarios->fecha_creacion->ViewValue, 11);
			$usuarios->fecha_creacion->ViewCustomAttributes = "";

			// activo
			if (strval($usuarios->activo->CurrentValue) <> "") {
				switch ($usuarios->activo->CurrentValue) {
					case "0":
						$usuarios->activo->ViewValue = $usuarios->activo->FldTagCaption(1) <> "" ? $usuarios->activo->FldTagCaption(1) : $usuarios->activo->CurrentValue;
						break;
					case "1":
						$usuarios->activo->ViewValue = $usuarios->activo->FldTagCaption(2) <> "" ? $usuarios->activo->FldTagCaption(2) : $usuarios->activo->CurrentValue;
						break;
					default:
						$usuarios->activo->ViewValue = $usuarios->activo->CurrentValue;
				}
			} else {
				$usuarios->activo->ViewValue = NULL;
			}
			$usuarios->activo->ViewCustomAttributes = "";

			// nivel
			if ($Security->CanAdmin()) { // System admin
			if (strval($usuarios->nivel->CurrentValue) <> "") {
				$sFilterWrk = "`idnivel` = " . ew_AdjustSql($usuarios->nivel->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombrenivel` FROM `niveles`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$usuarios->nivel->ViewValue = $rswrk->fields('nombrenivel');
					$rswrk->Close();
				} else {
					$usuarios->nivel->ViewValue = $usuarios->nivel->CurrentValue;
				}
			} else {
				$usuarios->nivel->ViewValue = NULL;
			}
			} else {
				$usuarios->nivel->ViewValue = "********";
			}
			$usuarios->nivel->ViewCustomAttributes = "";

			// idusuario
			$usuarios->idusuario->LinkCustomAttributes = "";
			$usuarios->idusuario->HrefValue = "";
			$usuarios->idusuario->TooltipValue = "";

			// username
			$usuarios->username->LinkCustomAttributes = "";
			$usuarios->username->HrefValue = "";
			$usuarios->username->TooltipValue = "";

			// password
			$usuarios->password->LinkCustomAttributes = "";
			$usuarios->password->HrefValue = "";
			$usuarios->password->TooltipValue = "";

			// email
			$usuarios->zemail->LinkCustomAttributes = "";
			$usuarios->zemail->HrefValue = "";
			$usuarios->zemail->TooltipValue = "";

			// empresa
			$usuarios->empresa->LinkCustomAttributes = "";
			$usuarios->empresa->HrefValue = "";
			$usuarios->empresa->TooltipValue = "";

			// nit_empresa
			$usuarios->nit_empresa->LinkCustomAttributes = "";
			$usuarios->nit_empresa->HrefValue = "";
			$usuarios->nit_empresa->TooltipValue = "";

			// fecha_creacion
			$usuarios->fecha_creacion->LinkCustomAttributes = "";
			$usuarios->fecha_creacion->HrefValue = "";
			$usuarios->fecha_creacion->TooltipValue = "";

			// activo
			$usuarios->activo->LinkCustomAttributes = "";
			$usuarios->activo->HrefValue = "";
			$usuarios->activo->TooltipValue = "";

			// nivel
			$usuarios->nivel->LinkCustomAttributes = "";
			$usuarios->nivel->HrefValue = "";
			$usuarios->nivel->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuarios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuarios->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $usuarios;

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
		$item->Body = "<a name=\"emf_usuarios\" id=\"emf_usuarios\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_usuarios',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Hide options for export/action
		if ($usuarios->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $usuarios;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $usuarios->SelectRecordCount();
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
		if ($usuarios->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($usuarios, "v");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($usuarios->Export == "xml") {
			$usuarios->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$usuarios->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($usuarios->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($usuarios->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($usuarios->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($usuarios->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($usuarios->ExportReturnUrl());
		} elseif ($usuarios->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $Language, $usuarios;
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
		if ($usuarios->Email_Sending($Email, $EventArgs))
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
		global $usuarios;

		// Initialize
		$sQry = "export=html";

		// Add record key QueryString
		$sQry .= "&" . substr($usuarios->KeyUrl("", ""), 1);
		return $sQry;
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $usuarios;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($usuarios->idusuario->CurrentValue);
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
