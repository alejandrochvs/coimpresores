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
$usuarios_add = new cusuarios_add();
$Page =& $usuarios_add;

// Page init
$usuarios_add->Page_Init();

// Page main
$usuarios_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_add = new ew_Page("usuarios_add");

// page properties
usuarios_add.PageID = "add"; // page ID
usuarios_add.FormID = "fusuariosadd"; // form ID
var EW_PAGE_ID = usuarios_add.PageID; // for backward compatibility

// extend page with ValidateForm function
usuarios_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->username->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_password"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->password->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->zemail->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_empresa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->empresa->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nit_empresa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->nit_empresa->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nit_empresa"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($usuarios->nit_empresa->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_activo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->activo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_nivel"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($usuarios->nivel->FldCaption()) ?>");

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
usuarios_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $usuarios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $usuarios_add->ShowPageHeader(); ?>
<?php
$usuarios_add->ShowMessage();
?>
<form name="fusuariosadd" id="fusuariosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return usuarios_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="usuarios">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($usuarios->username->Visible) { // username ?>
	<tr id="r_username"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->username->CellAttributes() ?>><span id="el_username">
<input type="text" name="x_username" id="x_username" size="30" maxlength="90" value="<?php echo $usuarios->username->EditValue ?>"<?php echo $usuarios->username->EditAttributes() ?>>
</span><?php echo $usuarios->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->password->Visible) { // password ?>
	<tr id="r_password"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->password->CellAttributes() ?>><span id="el_password">
<input type="password" name="x_password" id="x_password" size="30" maxlength="64"<?php echo $usuarios->password->EditAttributes() ?>>
</span><?php echo $usuarios->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->zemail->Visible) { // email ?>
	<tr id="r_zemail"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->zemail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" size="30" maxlength="250" value="<?php echo $usuarios->zemail->EditValue ?>"<?php echo $usuarios->zemail->EditAttributes() ?>>
</span><?php echo $usuarios->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->empresa->Visible) { // empresa ?>
	<tr id="r_empresa"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->empresa->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->empresa->CellAttributes() ?>><span id="el_empresa">
<input type="text" name="x_empresa" id="x_empresa" size="30" maxlength="200" value="<?php echo $usuarios->empresa->EditValue ?>"<?php echo $usuarios->empresa->EditAttributes() ?>>
</span><?php echo $usuarios->empresa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->nit_empresa->Visible) { // nit_empresa ?>
	<tr id="r_nit_empresa"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->nit_empresa->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->nit_empresa->CellAttributes() ?>><span id="el_nit_empresa">
<input type="text" name="x_nit_empresa" id="x_nit_empresa" size="30" value="<?php echo $usuarios->nit_empresa->EditValue ?>"<?php echo $usuarios->nit_empresa->EditAttributes() ?>>
</span><?php echo $usuarios->nit_empresa->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->activo->Visible) { // activo ?>
	<tr id="r_activo"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->activo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->activo->CellAttributes() ?>><span id="el_activo">
<div id="tp_x_activo" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_activo" id="x_activo" value="{value}"<?php echo $usuarios->activo->EditAttributes() ?>></label></div>
<div id="dsl_x_activo" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $usuarios->activo->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($usuarios->activo->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_activo" id="x_activo" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $usuarios->activo->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $usuarios->activo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($usuarios->nivel->Visible) { // nivel ?>
	<tr id="r_nivel"<?php echo $usuarios->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $usuarios->nivel->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $usuarios->nivel->CellAttributes() ?>><span id="el_nivel">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $usuarios->nivel->ViewAttributes() ?>><?php echo $usuarios->nivel->EditValue ?></div>
<?php } else { ?>
<select id="x_nivel" name="x_nivel"<?php echo $usuarios->nivel->EditAttributes() ?>>
<?php
if (is_array($usuarios->nivel->EditValue)) {
	$arwrk = $usuarios->nivel->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($usuarios->nivel->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $usuarios->nivel->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$usuarios_add->ShowPageFooter();
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
$usuarios_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarios_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'usuarios';

	// Page object name
	var $PageObjName = 'usuarios_add';

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
	function cusuarios_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuarios)
		if (!isset($GLOBALS["usuarios"])) {
			$GLOBALS["usuarios"] = new cusuarios();
			$GLOBALS["Table"] =& $GLOBALS["usuarios"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuarios', TRUE);

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
		if (!$Security->CanAdd()) {
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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $usuarios;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$usuarios->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$usuarios->CurrentAction = "I"; // Form error, reset action
				$usuarios->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["idusuario"] != "") {
				$usuarios->idusuario->setQueryStringValue($_GET["idusuario"]);
				$usuarios->setKey("idusuario", $usuarios->idusuario->CurrentValue); // Set up key
			} else {
				$usuarios->setKey("idusuario", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$usuarios->CurrentAction = "C"; // Copy record
			} else {
				$usuarios->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($usuarios->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("usuarioslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$usuarios->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $usuarios->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "usuariosview.php")
						$sReturnUrl = $usuarios->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$usuarios->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$usuarios->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$usuarios->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $usuarios;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $usuarios;
		$usuarios->username->CurrentValue = NULL;
		$usuarios->username->OldValue = $usuarios->username->CurrentValue;
		$usuarios->password->CurrentValue = NULL;
		$usuarios->password->OldValue = $usuarios->password->CurrentValue;
		$usuarios->zemail->CurrentValue = NULL;
		$usuarios->zemail->OldValue = $usuarios->zemail->CurrentValue;
		$usuarios->empresa->CurrentValue = NULL;
		$usuarios->empresa->OldValue = $usuarios->empresa->CurrentValue;
		$usuarios->nit_empresa->CurrentValue = NULL;
		$usuarios->nit_empresa->OldValue = $usuarios->nit_empresa->CurrentValue;
		$usuarios->activo->CurrentValue = 1;
		$usuarios->nivel->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $usuarios;
		if (!$usuarios->username->FldIsDetailKey) {
			$usuarios->username->setFormValue($objForm->GetValue("x_username"));
		}
		if (!$usuarios->password->FldIsDetailKey) {
			$usuarios->password->setFormValue($objForm->GetValue("x_password"));
		}
		if (!$usuarios->zemail->FldIsDetailKey) {
			$usuarios->zemail->setFormValue($objForm->GetValue("x_zemail"));
		}
		if (!$usuarios->empresa->FldIsDetailKey) {
			$usuarios->empresa->setFormValue($objForm->GetValue("x_empresa"));
		}
		if (!$usuarios->nit_empresa->FldIsDetailKey) {
			$usuarios->nit_empresa->setFormValue($objForm->GetValue("x_nit_empresa"));
		}
		if (!$usuarios->activo->FldIsDetailKey) {
			$usuarios->activo->setFormValue($objForm->GetValue("x_activo"));
		}
		if (!$usuarios->nivel->FldIsDetailKey) {
			$usuarios->nivel->setFormValue($objForm->GetValue("x_nivel"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $usuarios;
		$this->LoadOldRecord();
		$usuarios->username->CurrentValue = $usuarios->username->FormValue;
		$usuarios->password->CurrentValue = $usuarios->password->FormValue;
		$usuarios->zemail->CurrentValue = $usuarios->zemail->FormValue;
		$usuarios->empresa->CurrentValue = $usuarios->empresa->FormValue;
		$usuarios->nit_empresa->CurrentValue = $usuarios->nit_empresa->FormValue;
		$usuarios->activo->CurrentValue = $usuarios->activo->FormValue;
		$usuarios->nivel->CurrentValue = $usuarios->nivel->FormValue;
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

	// Load old record
	function LoadOldRecord() {
		global $usuarios;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($usuarios->getKey("idusuario")) <> "")
			$usuarios->idusuario->CurrentValue = $usuarios->getKey("idusuario"); // idusuario
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$usuarios->CurrentFilter = $usuarios->KeyFilter();
			$sSql = $usuarios->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuarios;

		// Initialize URLs
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

			// activo
			$usuarios->activo->LinkCustomAttributes = "";
			$usuarios->activo->HrefValue = "";
			$usuarios->activo->TooltipValue = "";

			// nivel
			$usuarios->nivel->LinkCustomAttributes = "";
			$usuarios->nivel->HrefValue = "";
			$usuarios->nivel->TooltipValue = "";
		} elseif ($usuarios->RowType == EW_ROWTYPE_ADD) { // Add row

			// username
			$usuarios->username->EditCustomAttributes = "";
			$usuarios->username->EditValue = ew_HtmlEncode($usuarios->username->CurrentValue);

			// password
			$usuarios->password->EditCustomAttributes = "";
			$usuarios->password->EditValue = ew_HtmlEncode($usuarios->password->CurrentValue);

			// email
			$usuarios->zemail->EditCustomAttributes = "";
			$usuarios->zemail->EditValue = ew_HtmlEncode($usuarios->zemail->CurrentValue);

			// empresa
			$usuarios->empresa->EditCustomAttributes = "";
			$usuarios->empresa->EditValue = ew_HtmlEncode($usuarios->empresa->CurrentValue);

			// nit_empresa
			$usuarios->nit_empresa->EditCustomAttributes = "";
			$usuarios->nit_empresa->EditValue = ew_HtmlEncode($usuarios->nit_empresa->CurrentValue);

			// activo
			$usuarios->activo->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", $usuarios->activo->FldTagCaption(1) <> "" ? $usuarios->activo->FldTagCaption(1) : "0");
			$arwrk[] = array("1", $usuarios->activo->FldTagCaption(2) <> "" ? $usuarios->activo->FldTagCaption(2) : "1");
			$usuarios->activo->EditValue = $arwrk;

			// nivel
			$usuarios->nivel->EditCustomAttributes = "";
			if (!$Security->CanAdmin()) { // System admin
				$usuarios->nivel->EditValue = "********";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `idnivel`, `nombrenivel` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `niveles`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$usuarios->nivel->EditValue = $arwrk;
			}

			// Edit refer script
			// username

			$usuarios->username->HrefValue = "";

			// password
			$usuarios->password->HrefValue = "";

			// email
			$usuarios->zemail->HrefValue = "";

			// empresa
			$usuarios->empresa->HrefValue = "";

			// nit_empresa
			$usuarios->nit_empresa->HrefValue = "";

			// activo
			$usuarios->activo->HrefValue = "";

			// nivel
			$usuarios->nivel->HrefValue = "";
		}
		if ($usuarios->RowType == EW_ROWTYPE_ADD ||
			$usuarios->RowType == EW_ROWTYPE_EDIT ||
			$usuarios->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$usuarios->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($usuarios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuarios->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $usuarios;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($usuarios->username->FormValue) && $usuarios->username->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuarios->username->FldCaption());
		}
		if (!is_null($usuarios->password->FormValue) && $usuarios->password->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuarios->password->FldCaption());
		}
		if (!is_null($usuarios->zemail->FormValue) && $usuarios->zemail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuarios->zemail->FldCaption());
		}
		if (!is_null($usuarios->empresa->FormValue) && $usuarios->empresa->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuarios->empresa->FldCaption());
		}
		if (!is_null($usuarios->nit_empresa->FormValue) && $usuarios->nit_empresa->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuarios->nit_empresa->FldCaption());
		}
		if (!ew_CheckInteger($usuarios->nit_empresa->FormValue)) {
			ew_AddMessage($gsFormError, $usuarios->nit_empresa->FldErrMsg());
		}
		if ($usuarios->activo->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuarios->activo->FldCaption());
		}
		if (!is_null($usuarios->nivel->FormValue) && $usuarios->nivel->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $usuarios->nivel->FldCaption());
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $usuarios;
		$rsnew = array();

		// username
		$usuarios->username->SetDbValueDef($rsnew, $usuarios->username->CurrentValue, "", FALSE);

		// password
		$usuarios->password->SetDbValueDef($rsnew, $usuarios->password->CurrentValue, "", FALSE);

		// email
		$usuarios->zemail->SetDbValueDef($rsnew, $usuarios->zemail->CurrentValue, "", FALSE);

		// empresa
		$usuarios->empresa->SetDbValueDef($rsnew, $usuarios->empresa->CurrentValue, "", FALSE);

		// nit_empresa
		$usuarios->nit_empresa->SetDbValueDef($rsnew, $usuarios->nit_empresa->CurrentValue, 0, FALSE);

		// activo
		$usuarios->activo->SetDbValueDef($rsnew, $usuarios->activo->CurrentValue, 0, strval($usuarios->activo->CurrentValue) == "");

		// nivel
		if ($Security->CanAdmin()) { // System admin
		$usuarios->nivel->SetDbValueDef($rsnew, $usuarios->nivel->CurrentValue, 0, strval($usuarios->nivel->CurrentValue) == "");
		}

		// idusuario
		// Call Row Inserting event

		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $usuarios->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($usuarios->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($usuarios->CancelMessage <> "") {
				$this->setFailureMessage($usuarios->CancelMessage);
				$usuarios->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$usuarios->idusuario->setDbValue($conn->Insert_ID());
			$rsnew['idusuario'] = $usuarios->idusuario->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$usuarios->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
