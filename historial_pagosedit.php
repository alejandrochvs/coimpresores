<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "historial_pagosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "pagos_x_doctoinfo.php" ?>
<?php include_once "pagos_x_doctogridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$historial_pagos_edit = new chistorial_pagos_edit();
$Page =& $historial_pagos_edit;

// Page init
$historial_pagos_edit->Page_Init();

// Page main
$historial_pagos_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var historial_pagos_edit = new ew_Page("historial_pagos_edit");

// page properties
historial_pagos_edit.PageID = "edit"; // page ID
historial_pagos_edit.FormID = "fhistorial_pagosedit"; // form ID
var EW_PAGE_ID = historial_pagos_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
historial_pagos_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_usuario"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($historial_pagos->usuario->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_tipo_docto"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($historial_pagos->tipo_docto->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_consec_docto"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($historial_pagos->consec_docto->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_consec_docto"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($historial_pagos->consec_docto->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha_hora_creacion"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($historial_pagos->fecha_hora_creacion->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_monto_pago"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($historial_pagos->monto_pago->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_monto_pago"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($historial_pagos->monto_pago->FldErrMsg()) ?>");

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
historial_pagos_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
historial_pagos_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
historial_pagos_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $historial_pagos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $historial_pagos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $historial_pagos_edit->ShowPageHeader(); ?>
<?php
$historial_pagos_edit->ShowMessage();
?>
<form name="fhistorial_pagosedit" id="fhistorial_pagosedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return historial_pagos_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="historial_pagos">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($historial_pagos->idhistorial_pagos->Visible) { // idhistorial_pagos ?>
	<tr id="r_idhistorial_pagos"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->idhistorial_pagos->FldCaption() ?></td>
		<td<?php echo $historial_pagos->idhistorial_pagos->CellAttributes() ?>><span id="el_idhistorial_pagos">
<div<?php echo $historial_pagos->idhistorial_pagos->ViewAttributes() ?>><?php echo $historial_pagos->idhistorial_pagos->EditValue ?></div>
<input type="hidden" name="x_idhistorial_pagos" id="x_idhistorial_pagos" value="<?php echo ew_HtmlEncode($historial_pagos->idhistorial_pagos->CurrentValue) ?>">
</span><?php echo $historial_pagos->idhistorial_pagos->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($historial_pagos->usuario->Visible) { // usuario ?>
	<tr id="r_usuario"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->usuario->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $historial_pagos->usuario->CellAttributes() ?>><span id="el_usuario">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $historial_pagos->usuario->ViewAttributes() ?>><?php echo $historial_pagos->usuario->EditValue ?></div>
<input type="hidden" name="x_usuario" id="x_usuario" value="<?php echo ew_HtmlEncode($historial_pagos->usuario->CurrentValue) ?>">
<?php } else { ?>
<select id="x_usuario" name="x_usuario"<?php echo $historial_pagos->usuario->EditAttributes() ?>>
<?php
if (is_array($historial_pagos->usuario->EditValue)) {
	$arwrk = $historial_pagos->usuario->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($historial_pagos->usuario->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $historial_pagos->usuario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($historial_pagos->tipo_docto->Visible) { // tipo_docto ?>
	<tr id="r_tipo_docto"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->tipo_docto->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $historial_pagos->tipo_docto->CellAttributes() ?>><span id="el_tipo_docto">
<input type="text" name="x_tipo_docto" id="x_tipo_docto" size="30" maxlength="45" value="<?php echo $historial_pagos->tipo_docto->EditValue ?>"<?php echo $historial_pagos->tipo_docto->EditAttributes() ?>>
</span><?php echo $historial_pagos->tipo_docto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($historial_pagos->consec_docto->Visible) { // consec_docto ?>
	<tr id="r_consec_docto"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->consec_docto->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $historial_pagos->consec_docto->CellAttributes() ?>><span id="el_consec_docto">
<input type="text" name="x_consec_docto" id="x_consec_docto" size="30" value="<?php echo $historial_pagos->consec_docto->EditValue ?>"<?php echo $historial_pagos->consec_docto->EditAttributes() ?>>
</span><?php echo $historial_pagos->consec_docto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($historial_pagos->estado_pago->Visible) { // estado_pago ?>
	<tr id="r_estado_pago"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->estado_pago->FldCaption() ?></td>
		<td<?php echo $historial_pagos->estado_pago->CellAttributes() ?>><span id="el_estado_pago">
<input type="text" name="x_estado_pago" id="x_estado_pago" size="30" maxlength="45" value="<?php echo $historial_pagos->estado_pago->EditValue ?>"<?php echo $historial_pagos->estado_pago->EditAttributes() ?>>
</span><?php echo $historial_pagos->estado_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($historial_pagos->ref_venta->Visible) { // ref_venta ?>
	<tr id="r_ref_venta"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->ref_venta->FldCaption() ?></td>
		<td<?php echo $historial_pagos->ref_venta->CellAttributes() ?>><span id="el_ref_venta">
<input type="text" name="x_ref_venta" id="x_ref_venta" size="30" maxlength="45" value="<?php echo $historial_pagos->ref_venta->EditValue ?>"<?php echo $historial_pagos->ref_venta->EditAttributes() ?>>
</span><?php echo $historial_pagos->ref_venta->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($historial_pagos->fecha_hora_creacion->Visible) { // fecha_hora_creacion ?>
	<tr id="r_fecha_hora_creacion"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->fecha_hora_creacion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $historial_pagos->fecha_hora_creacion->CellAttributes() ?>><span id="el_fecha_hora_creacion">
<input type="text" name="x_fecha_hora_creacion" id="x_fecha_hora_creacion" value="<?php echo $historial_pagos->fecha_hora_creacion->EditValue ?>"<?php echo $historial_pagos->fecha_hora_creacion->EditAttributes() ?>>
</span><?php echo $historial_pagos->fecha_hora_creacion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($historial_pagos->riesgo->Visible) { // riesgo ?>
	<tr id="r_riesgo"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->riesgo->FldCaption() ?></td>
		<td<?php echo $historial_pagos->riesgo->CellAttributes() ?>><span id="el_riesgo">
<input type="text" name="x_riesgo" id="x_riesgo" size="30" maxlength="45" value="<?php echo $historial_pagos->riesgo->EditValue ?>"<?php echo $historial_pagos->riesgo->EditAttributes() ?>>
</span><?php echo $historial_pagos->riesgo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($historial_pagos->medio_pago->Visible) { // medio_pago ?>
	<tr id="r_medio_pago"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->medio_pago->FldCaption() ?></td>
		<td<?php echo $historial_pagos->medio_pago->CellAttributes() ?>><span id="el_medio_pago">
<input type="text" name="x_medio_pago" id="x_medio_pago" size="30" maxlength="2" value="<?php echo $historial_pagos->medio_pago->EditValue ?>"<?php echo $historial_pagos->medio_pago->EditAttributes() ?>>
</span><?php echo $historial_pagos->medio_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($historial_pagos->respuesta_pol->Visible) { // respuesta_pol ?>
	<tr id="r_respuesta_pol"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->respuesta_pol->FldCaption() ?></td>
		<td<?php echo $historial_pagos->respuesta_pol->CellAttributes() ?>><span id="el_respuesta_pol">
<input type="text" name="x_respuesta_pol" id="x_respuesta_pol" size="30" maxlength="2" value="<?php echo $historial_pagos->respuesta_pol->EditValue ?>"<?php echo $historial_pagos->respuesta_pol->EditAttributes() ?>>
</span><?php echo $historial_pagos->respuesta_pol->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($historial_pagos->monto_pago->Visible) { // monto_pago ?>
	<tr id="r_monto_pago"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->monto_pago->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $historial_pagos->monto_pago->CellAttributes() ?>><span id="el_monto_pago">
<input type="text" name="x_monto_pago" id="x_monto_pago" size="30" value="<?php echo $historial_pagos->monto_pago->EditValue ?>"<?php echo $historial_pagos->monto_pago->EditAttributes() ?>>
</span><?php echo $historial_pagos->monto_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($historial_pagos->getCurrentDetailTable() == "pagos_x_docto" && $pagos_x_docto->DetailEdit) { ?>
<br>
<?php include_once "pagos_x_doctogrid.php" ?>
<br>
<?php } ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$historial_pagos_edit->ShowPageFooter();
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
$historial_pagos_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class chistorial_pagos_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'historial_pagos';

	// Page object name
	var $PageObjName = 'historial_pagos_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $historial_pagos;
		if ($historial_pagos->UseTokenInUrl) $PageUrl .= "t=" . $historial_pagos->TableVar . "&"; // Add page token
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
		global $objForm, $historial_pagos;
		if ($historial_pagos->UseTokenInUrl) {
			if ($objForm)
				return ($historial_pagos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($historial_pagos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function chistorial_pagos_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (historial_pagos)
		if (!isset($GLOBALS["historial_pagos"])) {
			$GLOBALS["historial_pagos"] = new chistorial_pagos();
			$GLOBALS["Table"] =& $GLOBALS["historial_pagos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Table object (pagos_x_docto)
		if (!isset($GLOBALS['pagos_x_docto'])) $GLOBALS['pagos_x_docto'] = new cpagos_x_docto();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'historial_pagos', TRUE);

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
		global $historial_pagos;

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
			$this->Page_Terminate("historial_pagoslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("historial_pagoslist.php");
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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $historial_pagos;

		// Load key from QueryString
		if (@$_GET["idhistorial_pagos"] <> "")
			$historial_pagos->idhistorial_pagos->setQueryStringValue($_GET["idhistorial_pagos"]);
		if (@$_POST["a_edit"] <> "") {
			$historial_pagos->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$historial_pagos->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$historial_pagos->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$historial_pagos->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($historial_pagos->idhistorial_pagos->CurrentValue == "")
			$this->Page_Terminate("historial_pagoslist.php"); // Invalid key, return to list

		// Set up detail parameters
		$this->SetUpDetailParms();
		switch ($historial_pagos->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("historial_pagoslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$historial_pagos->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					if ($historial_pagos->getCurrentDetailTable() <> "") // Master/detail edit
						$sReturnUrl = $historial_pagos->getDetailUrl();
					else
						$sReturnUrl = $historial_pagos->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$historial_pagos->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$historial_pagos->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$historial_pagos->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $historial_pagos;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $historial_pagos;
		if (!$historial_pagos->idhistorial_pagos->FldIsDetailKey)
			$historial_pagos->idhistorial_pagos->setFormValue($objForm->GetValue("x_idhistorial_pagos"));
		if (!$historial_pagos->usuario->FldIsDetailKey) {
			$historial_pagos->usuario->setFormValue($objForm->GetValue("x_usuario"));
		}
		if (!$historial_pagos->tipo_docto->FldIsDetailKey) {
			$historial_pagos->tipo_docto->setFormValue($objForm->GetValue("x_tipo_docto"));
		}
		if (!$historial_pagos->consec_docto->FldIsDetailKey) {
			$historial_pagos->consec_docto->setFormValue($objForm->GetValue("x_consec_docto"));
		}
		if (!$historial_pagos->estado_pago->FldIsDetailKey) {
			$historial_pagos->estado_pago->setFormValue($objForm->GetValue("x_estado_pago"));
		}
		if (!$historial_pagos->ref_venta->FldIsDetailKey) {
			$historial_pagos->ref_venta->setFormValue($objForm->GetValue("x_ref_venta"));
		}
		if (!$historial_pagos->fecha_hora_creacion->FldIsDetailKey) {
			$historial_pagos->fecha_hora_creacion->setFormValue($objForm->GetValue("x_fecha_hora_creacion"));
			$historial_pagos->fecha_hora_creacion->CurrentValue = ew_UnFormatDateTime($historial_pagos->fecha_hora_creacion->CurrentValue, 0);
		}
		if (!$historial_pagos->riesgo->FldIsDetailKey) {
			$historial_pagos->riesgo->setFormValue($objForm->GetValue("x_riesgo"));
		}
		if (!$historial_pagos->medio_pago->FldIsDetailKey) {
			$historial_pagos->medio_pago->setFormValue($objForm->GetValue("x_medio_pago"));
		}
		if (!$historial_pagos->respuesta_pol->FldIsDetailKey) {
			$historial_pagos->respuesta_pol->setFormValue($objForm->GetValue("x_respuesta_pol"));
		}
		if (!$historial_pagos->monto_pago->FldIsDetailKey) {
			$historial_pagos->monto_pago->setFormValue($objForm->GetValue("x_monto_pago"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $historial_pagos;
		$this->LoadRow();
		$historial_pagos->idhistorial_pagos->CurrentValue = $historial_pagos->idhistorial_pagos->FormValue;
		$historial_pagos->usuario->CurrentValue = $historial_pagos->usuario->FormValue;
		$historial_pagos->tipo_docto->CurrentValue = $historial_pagos->tipo_docto->FormValue;
		$historial_pagos->consec_docto->CurrentValue = $historial_pagos->consec_docto->FormValue;
		$historial_pagos->estado_pago->CurrentValue = $historial_pagos->estado_pago->FormValue;
		$historial_pagos->ref_venta->CurrentValue = $historial_pagos->ref_venta->FormValue;
		$historial_pagos->fecha_hora_creacion->CurrentValue = $historial_pagos->fecha_hora_creacion->FormValue;
		$historial_pagos->fecha_hora_creacion->CurrentValue = ew_UnFormatDateTime($historial_pagos->fecha_hora_creacion->CurrentValue, 0);
		$historial_pagos->riesgo->CurrentValue = $historial_pagos->riesgo->FormValue;
		$historial_pagos->medio_pago->CurrentValue = $historial_pagos->medio_pago->FormValue;
		$historial_pagos->respuesta_pol->CurrentValue = $historial_pagos->respuesta_pol->FormValue;
		$historial_pagos->monto_pago->CurrentValue = $historial_pagos->monto_pago->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $historial_pagos;
		$sFilter = $historial_pagos->KeyFilter();

		// Call Row Selecting event
		$historial_pagos->Row_Selecting($sFilter);

		// Load SQL based on filter
		$historial_pagos->CurrentFilter = $sFilter;
		$sSql = $historial_pagos->SQL();
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
		global $conn, $historial_pagos;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$historial_pagos->Row_Selected($row);
		$historial_pagos->idhistorial_pagos->setDbValue($rs->fields('idhistorial_pagos'));
		$historial_pagos->usuario->setDbValue($rs->fields('usuario'));
		$historial_pagos->tipo_docto->setDbValue($rs->fields('tipo_docto'));
		$historial_pagos->consec_docto->setDbValue($rs->fields('consec_docto'));
		$historial_pagos->estado_pago->setDbValue($rs->fields('estado_pago'));
		$historial_pagos->ref_venta->setDbValue($rs->fields('ref_venta'));
		$historial_pagos->fecha_hora_creacion->setDbValue($rs->fields('fecha_hora_creacion'));
		$historial_pagos->riesgo->setDbValue($rs->fields('riesgo'));
		$historial_pagos->medio_pago->setDbValue($rs->fields('medio_pago'));
		$historial_pagos->respuesta_pol->setDbValue($rs->fields('respuesta_pol'));
		$historial_pagos->monto_pago->setDbValue($rs->fields('monto_pago'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $historial_pagos;

		// Initialize URLs
		// Call Row_Rendering event

		$historial_pagos->Row_Rendering();

		// Common render codes for all row types
		// idhistorial_pagos
		// usuario
		// tipo_docto
		// consec_docto
		// estado_pago
		// ref_venta
		// fecha_hora_creacion
		// riesgo
		// medio_pago
		// respuesta_pol
		// monto_pago

		if ($historial_pagos->RowType == EW_ROWTYPE_VIEW) { // View row

			// idhistorial_pagos
			$historial_pagos->idhistorial_pagos->ViewValue = $historial_pagos->idhistorial_pagos->CurrentValue;
			$historial_pagos->idhistorial_pagos->ViewCustomAttributes = "";

			// usuario
			if (strval($historial_pagos->usuario->CurrentValue) <> "") {
				$sFilterWrk = "`idusuario` = " . ew_AdjustSql($historial_pagos->usuario->CurrentValue) . "";
			$sSqlWrk = "SELECT `empresa` FROM `usuarios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `empresa` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$historial_pagos->usuario->ViewValue = $rswrk->fields('empresa');
					$rswrk->Close();
				} else {
					$historial_pagos->usuario->ViewValue = $historial_pagos->usuario->CurrentValue;
				}
			} else {
				$historial_pagos->usuario->ViewValue = NULL;
			}
			$historial_pagos->usuario->ViewCustomAttributes = "";

			// tipo_docto
			$historial_pagos->tipo_docto->ViewValue = $historial_pagos->tipo_docto->CurrentValue;
			$historial_pagos->tipo_docto->ViewCustomAttributes = "";

			// consec_docto
			$historial_pagos->consec_docto->ViewValue = $historial_pagos->consec_docto->CurrentValue;
			$historial_pagos->consec_docto->ViewCustomAttributes = "";

			// estado_pago
			$historial_pagos->estado_pago->ViewValue = $historial_pagos->estado_pago->CurrentValue;
			$historial_pagos->estado_pago->ViewCustomAttributes = "";

			// ref_venta
			$historial_pagos->ref_venta->ViewValue = $historial_pagos->ref_venta->CurrentValue;
			$historial_pagos->ref_venta->ViewCustomAttributes = "";

			// fecha_hora_creacion
			$historial_pagos->fecha_hora_creacion->ViewValue = $historial_pagos->fecha_hora_creacion->CurrentValue;
			$historial_pagos->fecha_hora_creacion->ViewCustomAttributes = "";

			// riesgo
			$historial_pagos->riesgo->ViewValue = $historial_pagos->riesgo->CurrentValue;
			$historial_pagos->riesgo->ViewCustomAttributes = "";

			// medio_pago
			$historial_pagos->medio_pago->ViewValue = $historial_pagos->medio_pago->CurrentValue;
			$historial_pagos->medio_pago->ViewCustomAttributes = "";

			// respuesta_pol
			$historial_pagos->respuesta_pol->ViewValue = $historial_pagos->respuesta_pol->CurrentValue;
			$historial_pagos->respuesta_pol->ViewCustomAttributes = "";

			// monto_pago
			$historial_pagos->monto_pago->ViewValue = $historial_pagos->monto_pago->CurrentValue;
			$historial_pagos->monto_pago->ViewValue = ew_FormatCurrency($historial_pagos->monto_pago->ViewValue, 0, -2, -2, -2);
			$historial_pagos->monto_pago->ViewCustomAttributes = "";

			// idhistorial_pagos
			$historial_pagos->idhistorial_pagos->LinkCustomAttributes = "";
			$historial_pagos->idhistorial_pagos->HrefValue = "";
			$historial_pagos->idhistorial_pagos->TooltipValue = "";

			// usuario
			$historial_pagos->usuario->LinkCustomAttributes = "";
			$historial_pagos->usuario->HrefValue = "";
			$historial_pagos->usuario->TooltipValue = "";

			// tipo_docto
			$historial_pagos->tipo_docto->LinkCustomAttributes = "";
			$historial_pagos->tipo_docto->HrefValue = "";
			$historial_pagos->tipo_docto->TooltipValue = "";

			// consec_docto
			$historial_pagos->consec_docto->LinkCustomAttributes = "";
			$historial_pagos->consec_docto->HrefValue = "";
			$historial_pagos->consec_docto->TooltipValue = "";

			// estado_pago
			$historial_pagos->estado_pago->LinkCustomAttributes = "";
			$historial_pagos->estado_pago->HrefValue = "";
			$historial_pagos->estado_pago->TooltipValue = "";

			// ref_venta
			$historial_pagos->ref_venta->LinkCustomAttributes = "";
			$historial_pagos->ref_venta->HrefValue = "";
			$historial_pagos->ref_venta->TooltipValue = "";

			// fecha_hora_creacion
			$historial_pagos->fecha_hora_creacion->LinkCustomAttributes = "";
			$historial_pagos->fecha_hora_creacion->HrefValue = "";
			$historial_pagos->fecha_hora_creacion->TooltipValue = "";

			// riesgo
			$historial_pagos->riesgo->LinkCustomAttributes = "";
			$historial_pagos->riesgo->HrefValue = "";
			$historial_pagos->riesgo->TooltipValue = "";

			// medio_pago
			$historial_pagos->medio_pago->LinkCustomAttributes = "";
			$historial_pagos->medio_pago->HrefValue = "";
			$historial_pagos->medio_pago->TooltipValue = "";

			// respuesta_pol
			$historial_pagos->respuesta_pol->LinkCustomAttributes = "";
			$historial_pagos->respuesta_pol->HrefValue = "";
			$historial_pagos->respuesta_pol->TooltipValue = "";

			// monto_pago
			$historial_pagos->monto_pago->LinkCustomAttributes = "";
			$historial_pagos->monto_pago->HrefValue = "";
			$historial_pagos->monto_pago->TooltipValue = "";
		} elseif ($historial_pagos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// idhistorial_pagos
			$historial_pagos->idhistorial_pagos->EditCustomAttributes = "";
			$historial_pagos->idhistorial_pagos->EditValue = $historial_pagos->idhistorial_pagos->CurrentValue;
			$historial_pagos->idhistorial_pagos->ViewCustomAttributes = "";

			// usuario
			$historial_pagos->usuario->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
				$historial_pagos->usuario->CurrentValue = CurrentUserID();
			if (strval($historial_pagos->usuario->CurrentValue) <> "") {
				$sFilterWrk = "`idusuario` = " . ew_AdjustSql($historial_pagos->usuario->CurrentValue) . "";
			$sSqlWrk = "SELECT `empresa` FROM `usuarios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `empresa` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$historial_pagos->usuario->EditValue = $rswrk->fields('empresa');
					$rswrk->Close();
				} else {
					$historial_pagos->usuario->EditValue = $historial_pagos->usuario->CurrentValue;
				}
			} else {
				$historial_pagos->usuario->EditValue = NULL;
			}
			$historial_pagos->usuario->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `idusuario`, `empresa` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `usuarios`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			$sWhereWrk = $GLOBALS["usuarios"]->AddUserIDFilter($sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `empresa` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$historial_pagos->usuario->EditValue = $arwrk;
			}

			// tipo_docto
			$historial_pagos->tipo_docto->EditCustomAttributes = "";
			$historial_pagos->tipo_docto->EditValue = ew_HtmlEncode($historial_pagos->tipo_docto->CurrentValue);

			// consec_docto
			$historial_pagos->consec_docto->EditCustomAttributes = "";
			$historial_pagos->consec_docto->EditValue = ew_HtmlEncode($historial_pagos->consec_docto->CurrentValue);

			// estado_pago
			$historial_pagos->estado_pago->EditCustomAttributes = "";
			$historial_pagos->estado_pago->EditValue = ew_HtmlEncode($historial_pagos->estado_pago->CurrentValue);

			// ref_venta
			$historial_pagos->ref_venta->EditCustomAttributes = "";
			$historial_pagos->ref_venta->EditValue = ew_HtmlEncode($historial_pagos->ref_venta->CurrentValue);

			// fecha_hora_creacion
			$historial_pagos->fecha_hora_creacion->EditCustomAttributes = "";
			$historial_pagos->fecha_hora_creacion->EditValue = ew_HtmlEncode($historial_pagos->fecha_hora_creacion->CurrentValue);

			// riesgo
			$historial_pagos->riesgo->EditCustomAttributes = "";
			$historial_pagos->riesgo->EditValue = ew_HtmlEncode($historial_pagos->riesgo->CurrentValue);

			// medio_pago
			$historial_pagos->medio_pago->EditCustomAttributes = "";
			$historial_pagos->medio_pago->EditValue = ew_HtmlEncode($historial_pagos->medio_pago->CurrentValue);

			// respuesta_pol
			$historial_pagos->respuesta_pol->EditCustomAttributes = "";
			$historial_pagos->respuesta_pol->EditValue = ew_HtmlEncode($historial_pagos->respuesta_pol->CurrentValue);

			// monto_pago
			$historial_pagos->monto_pago->EditCustomAttributes = "";
			$historial_pagos->monto_pago->EditValue = ew_HtmlEncode($historial_pagos->monto_pago->CurrentValue);

			// Edit refer script
			// idhistorial_pagos

			$historial_pagos->idhistorial_pagos->HrefValue = "";

			// usuario
			$historial_pagos->usuario->HrefValue = "";

			// tipo_docto
			$historial_pagos->tipo_docto->HrefValue = "";

			// consec_docto
			$historial_pagos->consec_docto->HrefValue = "";

			// estado_pago
			$historial_pagos->estado_pago->HrefValue = "";

			// ref_venta
			$historial_pagos->ref_venta->HrefValue = "";

			// fecha_hora_creacion
			$historial_pagos->fecha_hora_creacion->HrefValue = "";

			// riesgo
			$historial_pagos->riesgo->HrefValue = "";

			// medio_pago
			$historial_pagos->medio_pago->HrefValue = "";

			// respuesta_pol
			$historial_pagos->respuesta_pol->HrefValue = "";

			// monto_pago
			$historial_pagos->monto_pago->HrefValue = "";
		}
		if ($historial_pagos->RowType == EW_ROWTYPE_ADD ||
			$historial_pagos->RowType == EW_ROWTYPE_EDIT ||
			$historial_pagos->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$historial_pagos->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($historial_pagos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$historial_pagos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $historial_pagos;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($historial_pagos->usuario->FormValue) && $historial_pagos->usuario->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $historial_pagos->usuario->FldCaption());
		}
		if (!is_null($historial_pagos->tipo_docto->FormValue) && $historial_pagos->tipo_docto->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $historial_pagos->tipo_docto->FldCaption());
		}
		if (!is_null($historial_pagos->consec_docto->FormValue) && $historial_pagos->consec_docto->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $historial_pagos->consec_docto->FldCaption());
		}
		if (!ew_CheckInteger($historial_pagos->consec_docto->FormValue)) {
			ew_AddMessage($gsFormError, $historial_pagos->consec_docto->FldErrMsg());
		}
		if (!is_null($historial_pagos->fecha_hora_creacion->FormValue) && $historial_pagos->fecha_hora_creacion->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $historial_pagos->fecha_hora_creacion->FldCaption());
		}
		if (!is_null($historial_pagos->monto_pago->FormValue) && $historial_pagos->monto_pago->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $historial_pagos->monto_pago->FldCaption());
		}
		if (!ew_CheckInteger($historial_pagos->monto_pago->FormValue)) {
			ew_AddMessage($gsFormError, $historial_pagos->monto_pago->FldErrMsg());
		}

		// Validate detail grid
		if ($historial_pagos->getCurrentDetailTable() == "pagos_x_docto" && $GLOBALS["pagos_x_docto"]->DetailEdit) {
			$pagos_x_docto_grid = new cpagos_x_docto_grid(); // get detail page object
			$pagos_x_docto_grid->ValidateGridForm();
			$pagos_x_docto_grid = NULL;
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
		global $conn, $Security, $Language, $historial_pagos;
		$sFilter = $historial_pagos->KeyFilter();
		$historial_pagos->CurrentFilter = $sFilter;
		$sSql = $historial_pagos->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($historial_pagos->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// usuario
			$historial_pagos->usuario->SetDbValueDef($rsnew, $historial_pagos->usuario->CurrentValue, 0, $historial_pagos->usuario->ReadOnly);

			// tipo_docto
			$historial_pagos->tipo_docto->SetDbValueDef($rsnew, $historial_pagos->tipo_docto->CurrentValue, NULL, $historial_pagos->tipo_docto->ReadOnly);

			// consec_docto
			$historial_pagos->consec_docto->SetDbValueDef($rsnew, $historial_pagos->consec_docto->CurrentValue, NULL, $historial_pagos->consec_docto->ReadOnly);

			// estado_pago
			$historial_pagos->estado_pago->SetDbValueDef($rsnew, $historial_pagos->estado_pago->CurrentValue, NULL, $historial_pagos->estado_pago->ReadOnly);

			// ref_venta
			$historial_pagos->ref_venta->SetDbValueDef($rsnew, $historial_pagos->ref_venta->CurrentValue, NULL, $historial_pagos->ref_venta->ReadOnly);

			// fecha_hora_creacion
			$historial_pagos->fecha_hora_creacion->SetDbValueDef($rsnew, $historial_pagos->fecha_hora_creacion->CurrentValue, ew_CurrentDate(), $historial_pagos->fecha_hora_creacion->ReadOnly);

			// riesgo
			$historial_pagos->riesgo->SetDbValueDef($rsnew, $historial_pagos->riesgo->CurrentValue, NULL, $historial_pagos->riesgo->ReadOnly);

			// medio_pago
			$historial_pagos->medio_pago->SetDbValueDef($rsnew, $historial_pagos->medio_pago->CurrentValue, NULL, $historial_pagos->medio_pago->ReadOnly);

			// respuesta_pol
			$historial_pagos->respuesta_pol->SetDbValueDef($rsnew, $historial_pagos->respuesta_pol->CurrentValue, NULL, $historial_pagos->respuesta_pol->ReadOnly);

			// monto_pago
			$historial_pagos->monto_pago->SetDbValueDef($rsnew, $historial_pagos->monto_pago->CurrentValue, 0, $historial_pagos->monto_pago->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $historial_pagos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($historial_pagos->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';

				// Update detail records
				if ($EditRow) {
					if ($historial_pagos->getCurrentDetailTable() == "pagos_x_docto" && $GLOBALS["pagos_x_docto"]->DetailEdit) {
						$pagos_x_docto_grid = new cpagos_x_docto_grid(); // get detail page object
						$EditRow = $pagos_x_docto_grid->GridUpdate();
						$pagos_x_docto_grid = NULL;
					}
				}

				// Commit/Rollback transaction
				if ($historial_pagos->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($historial_pagos->CancelMessage <> "") {
					$this->setFailureMessage($historial_pagos->CancelMessage);
					$historial_pagos->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$historial_pagos->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $historial_pagos;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$historial_pagos->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $historial_pagos->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "pagos_x_docto") {
				if (!isset($GLOBALS["pagos_x_docto"]))
					$GLOBALS["pagos_x_docto"] = new cpagos_x_docto;
				if ($GLOBALS["pagos_x_docto"]->DetailEdit) {
					$GLOBALS["pagos_x_docto"]->CurrentMode = "edit";
					$GLOBALS["pagos_x_docto"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["pagos_x_docto"]->setCurrentMasterTable($historial_pagos->TableVar);
					$GLOBALS["pagos_x_docto"]->setStartRecordNumber(1);
					$GLOBALS["pagos_x_docto"]->historial->FldIsDetailKey = TRUE;
					$GLOBALS["pagos_x_docto"]->historial->CurrentValue = $historial_pagos->idhistorial_pagos->CurrentValue;
					$GLOBALS["pagos_x_docto"]->historial->setSessionValue($GLOBALS["pagos_x_docto"]->historial->CurrentValue);
				}
			}
		}
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
