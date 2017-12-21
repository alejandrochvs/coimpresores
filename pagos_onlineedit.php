<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pagos_onlineinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pagos_online_edit = new cpagos_online_edit();
$Page =& $pagos_online_edit;

// Page init
$pagos_online_edit->Page_Init();

// Page main
$pagos_online_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pagos_online_edit = new ew_Page("pagos_online_edit");

// page properties
pagos_online_edit.PageID = "edit"; // page ID
pagos_online_edit.FormID = "fpagos_onlineedit"; // form ID
var EW_PAGE_ID = pagos_online_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
pagos_online_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_idpagosonline"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_online->idpagosonline->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_idpagosonline"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_online->idpagosonline->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_usuarioid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_online->usuarioid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_usuarioid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_online->usuarioid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_llave_encripcion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_online->llave_encripcion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_url"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_online->url->FldCaption()) ?>");

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
pagos_online_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pagos_online_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pagos_online_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pagos_online->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $pagos_online->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $pagos_online_edit->ShowPageHeader(); ?>
<?php
$pagos_online_edit->ShowMessage();
?>
<form name="fpagos_onlineedit" id="fpagos_onlineedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return pagos_online_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="pagos_online">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pagos_online->idpagosonline->Visible) { // idpagosonline ?>
	<tr id="r_idpagosonline"<?php echo $pagos_online->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_online->idpagosonline->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_online->idpagosonline->CellAttributes() ?>><span id="el_idpagosonline">
<div<?php echo $pagos_online->idpagosonline->ViewAttributes() ?>><?php echo $pagos_online->idpagosonline->EditValue ?></div>
<input type="hidden" name="x_idpagosonline" id="x_idpagosonline" value="<?php echo ew_HtmlEncode($pagos_online->idpagosonline->CurrentValue) ?>">
</span><?php echo $pagos_online->idpagosonline->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_online->usuarioid->Visible) { // usuarioid ?>
	<tr id="r_usuarioid"<?php echo $pagos_online->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_online->usuarioid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_online->usuarioid->CellAttributes() ?>><span id="el_usuarioid">
<input type="text" name="x_usuarioid" id="x_usuarioid" size="30" value="<?php echo $pagos_online->usuarioid->EditValue ?>"<?php echo $pagos_online->usuarioid->EditAttributes() ?>>
</span><?php echo $pagos_online->usuarioid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_online->llave_encripcion->Visible) { // llave_encripcion ?>
	<tr id="r_llave_encripcion"<?php echo $pagos_online->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_online->llave_encripcion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_online->llave_encripcion->CellAttributes() ?>><span id="el_llave_encripcion">
<input type="text" name="x_llave_encripcion" id="x_llave_encripcion" size="30" maxlength="64" value="<?php echo $pagos_online->llave_encripcion->EditValue ?>"<?php echo $pagos_online->llave_encripcion->EditAttributes() ?>>
</span><?php echo $pagos_online->llave_encripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_online->url->Visible) { // url ?>
	<tr id="r_url"<?php echo $pagos_online->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_online->url->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_online->url->CellAttributes() ?>><span id="el_url">
<input type="text" name="x_url" id="x_url" size="30" maxlength="200" value="<?php echo $pagos_online->url->EditValue ?>"<?php echo $pagos_online->url->EditAttributes() ?>>
</span><?php echo $pagos_online->url->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$pagos_online_edit->ShowPageFooter();
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
$pagos_online_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cpagos_online_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'pagos_online';

	// Page object name
	var $PageObjName = 'pagos_online_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pagos_online;
		if ($pagos_online->UseTokenInUrl) $PageUrl .= "t=" . $pagos_online->TableVar . "&"; // Add page token
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
		global $objForm, $pagos_online;
		if ($pagos_online->UseTokenInUrl) {
			if ($objForm)
				return ($pagos_online->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pagos_online->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpagos_online_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pagos_online)
		if (!isset($GLOBALS["pagos_online"])) {
			$GLOBALS["pagos_online"] = new cpagos_online();
			$GLOBALS["Table"] =& $GLOBALS["pagos_online"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pagos_online', TRUE);

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
		global $pagos_online;

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("pagos_onlinelist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $pagos_online;

		// Load key from QueryString
		if (@$_GET["idpagosonline"] <> "")
			$pagos_online->idpagosonline->setQueryStringValue($_GET["idpagosonline"]);
		if (@$_POST["a_edit"] <> "") {
			$pagos_online->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$pagos_online->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$pagos_online->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$pagos_online->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($pagos_online->idpagosonline->CurrentValue == "")
			$this->Page_Terminate("pagos_onlinelist.php"); // Invalid key, return to list
		switch ($pagos_online->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("pagos_onlinelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$pagos_online->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $pagos_online->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$pagos_online->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$pagos_online->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$pagos_online->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $pagos_online;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pagos_online;
		if (!$pagos_online->idpagosonline->FldIsDetailKey) {
			$pagos_online->idpagosonline->setFormValue($objForm->GetValue("x_idpagosonline"));
		}
		if (!$pagos_online->usuarioid->FldIsDetailKey) {
			$pagos_online->usuarioid->setFormValue($objForm->GetValue("x_usuarioid"));
		}
		if (!$pagos_online->llave_encripcion->FldIsDetailKey) {
			$pagos_online->llave_encripcion->setFormValue($objForm->GetValue("x_llave_encripcion"));
		}
		if (!$pagos_online->url->FldIsDetailKey) {
			$pagos_online->url->setFormValue($objForm->GetValue("x_url"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pagos_online;
		$this->LoadRow();
		$pagos_online->idpagosonline->CurrentValue = $pagos_online->idpagosonline->FormValue;
		$pagos_online->usuarioid->CurrentValue = $pagos_online->usuarioid->FormValue;
		$pagos_online->llave_encripcion->CurrentValue = $pagos_online->llave_encripcion->FormValue;
		$pagos_online->url->CurrentValue = $pagos_online->url->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pagos_online;
		$sFilter = $pagos_online->KeyFilter();

		// Call Row Selecting event
		$pagos_online->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pagos_online->CurrentFilter = $sFilter;
		$sSql = $pagos_online->SQL();
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
		global $conn, $pagos_online;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$pagos_online->Row_Selected($row);
		$pagos_online->idpagosonline->setDbValue($rs->fields('idpagosonline'));
		$pagos_online->usuarioid->setDbValue($rs->fields('usuarioid'));
		$pagos_online->llave_encripcion->setDbValue($rs->fields('llave_encripcion'));
		$pagos_online->url->setDbValue($rs->fields('url'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pagos_online;

		// Initialize URLs
		// Call Row_Rendering event

		$pagos_online->Row_Rendering();

		// Common render codes for all row types
		// idpagosonline
		// usuarioid
		// llave_encripcion
		// url

		if ($pagos_online->RowType == EW_ROWTYPE_VIEW) { // View row

			// idpagosonline
			$pagos_online->idpagosonline->ViewValue = $pagos_online->idpagosonline->CurrentValue;
			$pagos_online->idpagosonline->ViewCustomAttributes = "";

			// usuarioid
			$pagos_online->usuarioid->ViewValue = $pagos_online->usuarioid->CurrentValue;
			$pagos_online->usuarioid->ViewCustomAttributes = "";

			// llave_encripcion
			$pagos_online->llave_encripcion->ViewValue = $pagos_online->llave_encripcion->CurrentValue;
			$pagos_online->llave_encripcion->ViewCustomAttributes = "";

			// url
			$pagos_online->url->ViewValue = $pagos_online->url->CurrentValue;
			$pagos_online->url->ViewCustomAttributes = "";

			// idpagosonline
			$pagos_online->idpagosonline->LinkCustomAttributes = "";
			$pagos_online->idpagosonline->HrefValue = "";
			$pagos_online->idpagosonline->TooltipValue = "";

			// usuarioid
			$pagos_online->usuarioid->LinkCustomAttributes = "";
			$pagos_online->usuarioid->HrefValue = "";
			$pagos_online->usuarioid->TooltipValue = "";

			// llave_encripcion
			$pagos_online->llave_encripcion->LinkCustomAttributes = "";
			$pagos_online->llave_encripcion->HrefValue = "";
			$pagos_online->llave_encripcion->TooltipValue = "";

			// url
			$pagos_online->url->LinkCustomAttributes = "";
			$pagos_online->url->HrefValue = "";
			$pagos_online->url->TooltipValue = "";
		} elseif ($pagos_online->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// idpagosonline
			$pagos_online->idpagosonline->EditCustomAttributes = "";
			$pagos_online->idpagosonline->EditValue = $pagos_online->idpagosonline->CurrentValue;
			$pagos_online->idpagosonline->ViewCustomAttributes = "";

			// usuarioid
			$pagos_online->usuarioid->EditCustomAttributes = "";
			$pagos_online->usuarioid->EditValue = ew_HtmlEncode($pagos_online->usuarioid->CurrentValue);

			// llave_encripcion
			$pagos_online->llave_encripcion->EditCustomAttributes = "";
			$pagos_online->llave_encripcion->EditValue = ew_HtmlEncode($pagos_online->llave_encripcion->CurrentValue);

			// url
			$pagos_online->url->EditCustomAttributes = "";
			$pagos_online->url->EditValue = ew_HtmlEncode($pagos_online->url->CurrentValue);

			// Edit refer script
			// idpagosonline

			$pagos_online->idpagosonline->HrefValue = "";

			// usuarioid
			$pagos_online->usuarioid->HrefValue = "";

			// llave_encripcion
			$pagos_online->llave_encripcion->HrefValue = "";

			// url
			$pagos_online->url->HrefValue = "";
		}
		if ($pagos_online->RowType == EW_ROWTYPE_ADD ||
			$pagos_online->RowType == EW_ROWTYPE_EDIT ||
			$pagos_online->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$pagos_online->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($pagos_online->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pagos_online->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $pagos_online;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($pagos_online->idpagosonline->FormValue) && $pagos_online->idpagosonline->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_online->idpagosonline->FldCaption());
		}
		if (!ew_CheckInteger($pagos_online->idpagosonline->FormValue)) {
			ew_AddMessage($gsFormError, $pagos_online->idpagosonline->FldErrMsg());
		}
		if (!is_null($pagos_online->usuarioid->FormValue) && $pagos_online->usuarioid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_online->usuarioid->FldCaption());
		}
		if (!ew_CheckInteger($pagos_online->usuarioid->FormValue)) {
			ew_AddMessage($gsFormError, $pagos_online->usuarioid->FldErrMsg());
		}
		if (!is_null($pagos_online->llave_encripcion->FormValue) && $pagos_online->llave_encripcion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_online->llave_encripcion->FldCaption());
		}
		if (!is_null($pagos_online->url->FormValue) && $pagos_online->url->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_online->url->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $pagos_online;
		$sFilter = $pagos_online->KeyFilter();
		$pagos_online->CurrentFilter = $sFilter;
		$sSql = $pagos_online->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// idpagosonline
			// usuarioid

			$pagos_online->usuarioid->SetDbValueDef($rsnew, $pagos_online->usuarioid->CurrentValue, 0, $pagos_online->usuarioid->ReadOnly);

			// llave_encripcion
			$pagos_online->llave_encripcion->SetDbValueDef($rsnew, $pagos_online->llave_encripcion->CurrentValue, "", $pagos_online->llave_encripcion->ReadOnly);

			// url
			$pagos_online->url->SetDbValueDef($rsnew, $pagos_online->url->CurrentValue, "", $pagos_online->url->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $pagos_online->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($pagos_online->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($pagos_online->CancelMessage <> "") {
					$this->setFailureMessage($pagos_online->CancelMessage);
					$pagos_online->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$pagos_online->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
}
?>
