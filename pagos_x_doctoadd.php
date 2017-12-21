<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pagos_x_doctoinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pagos_x_docto_add = new cpagos_x_docto_add();
$Page =& $pagos_x_docto_add;

// Page init
$pagos_x_docto_add->Page_Init();

// Page main
$pagos_x_docto_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pagos_x_docto_add = new ew_Page("pagos_x_docto_add");

// page properties
pagos_x_docto_add.PageID = "add"; // page ID
pagos_x_docto_add.FormID = "fpagos_x_doctoadd"; // form ID
var EW_PAGE_ID = pagos_x_docto_add.PageID; // for backward compatibility

// extend page with ValidateForm function
pagos_x_docto_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_historial"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->historial->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_historial"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->historial->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tipo_docto"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->tipo_docto->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_consec_docto"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->consec_docto->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_consec_docto"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->consec_docto->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_valor"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->valor->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_valor"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->valor->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_cia"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->cia->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_cia"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->cia->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->fecha->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estado"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->estado->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_usuario"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->usuario->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_usuario"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->usuario->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_estado_pago"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->estado_pago->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estado_pago"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->estado_pago->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_monto_pago"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->monto_pago->FldErrMsg()) ?>");

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
pagos_x_docto_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pagos_x_docto_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pagos_x_docto_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pagos_x_docto->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $pagos_x_docto->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $pagos_x_docto_add->ShowPageHeader(); ?>
<?php
$pagos_x_docto_add->ShowMessage();
?>
<form name="fpagos_x_doctoadd" id="fpagos_x_doctoadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return pagos_x_docto_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="pagos_x_docto">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pagos_x_docto->historial->Visible) { // historial ?>
	<tr id="r_historial"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->historial->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_x_docto->historial->CellAttributes() ?>><span id="el_historial">
<input type="text" name="x_historial" id="x_historial" size="30" value="<?php echo $pagos_x_docto->historial->EditValue ?>"<?php echo $pagos_x_docto->historial->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->historial->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->tipo_docto->Visible) { // tipo_docto ?>
	<tr id="r_tipo_docto"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->tipo_docto->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_x_docto->tipo_docto->CellAttributes() ?>><span id="el_tipo_docto">
<input type="text" name="x_tipo_docto" id="x_tipo_docto" size="30" maxlength="45" value="<?php echo $pagos_x_docto->tipo_docto->EditValue ?>"<?php echo $pagos_x_docto->tipo_docto->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->tipo_docto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->consec_docto->Visible) { // consec_docto ?>
	<tr id="r_consec_docto"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->consec_docto->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_x_docto->consec_docto->CellAttributes() ?>><span id="el_consec_docto">
<input type="text" name="x_consec_docto" id="x_consec_docto" size="30" value="<?php echo $pagos_x_docto->consec_docto->EditValue ?>"<?php echo $pagos_x_docto->consec_docto->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->consec_docto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->valor->Visible) { // valor ?>
	<tr id="r_valor"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->valor->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_x_docto->valor->CellAttributes() ?>><span id="el_valor">
<input type="text" name="x_valor" id="x_valor" size="30" value="<?php echo $pagos_x_docto->valor->EditValue ?>"<?php echo $pagos_x_docto->valor->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->valor->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->cia->Visible) { // cia ?>
	<tr id="r_cia"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->cia->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_x_docto->cia->CellAttributes() ?>><span id="el_cia">
<input type="text" name="x_cia" id="x_cia" size="30" value="<?php echo $pagos_x_docto->cia->EditValue ?>"<?php echo $pagos_x_docto->cia->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->cia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->nit->Visible) { // nit ?>
	<tr id="r_nit"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->nit->FldCaption() ?></td>
		<td<?php echo $pagos_x_docto->nit->CellAttributes() ?>><span id="el_nit">
<input type="text" name="x_nit" id="x_nit" size="30" maxlength="45" value="<?php echo $pagos_x_docto->nit->EditValue ?>"<?php echo $pagos_x_docto->nit->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->nit->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->tercero->Visible) { // tercero ?>
	<tr id="r_tercero"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->tercero->FldCaption() ?></td>
		<td<?php echo $pagos_x_docto->tercero->CellAttributes() ?>><span id="el_tercero">
<input type="text" name="x_tercero" id="x_tercero" size="30" maxlength="45" value="<?php echo $pagos_x_docto->tercero->EditValue ?>"<?php echo $pagos_x_docto->tercero->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->tercero->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->fecha->Visible) { // fecha ?>
	<tr id="r_fecha"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->fecha->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_x_docto->fecha->CellAttributes() ?>><span id="el_fecha">
<input type="text" name="x_fecha" id="x_fecha" value="<?php echo $pagos_x_docto->fecha->EditValue ?>"<?php echo $pagos_x_docto->fecha->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->fecha->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->dias_vencidos->Visible) { // dias_vencidos ?>
	<tr id="r_dias_vencidos"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->dias_vencidos->FldCaption() ?></td>
		<td<?php echo $pagos_x_docto->dias_vencidos->CellAttributes() ?>><span id="el_dias_vencidos">
<input type="text" name="x_dias_vencidos" id="x_dias_vencidos" size="30" maxlength="45" value="<?php echo $pagos_x_docto->dias_vencidos->EditValue ?>"<?php echo $pagos_x_docto->dias_vencidos->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->dias_vencidos->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->estado->Visible) { // estado ?>
	<tr id="r_estado"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->estado->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_x_docto->estado->CellAttributes() ?>><span id="el_estado">
<input type="text" name="x_estado" id="x_estado" size="30" maxlength="45" value="<?php echo $pagos_x_docto->estado->EditValue ?>"<?php echo $pagos_x_docto->estado->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->estado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->usuario->Visible) { // usuario ?>
	<tr id="r_usuario"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->usuario->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_x_docto->usuario->CellAttributes() ?>><span id="el_usuario">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $pagos_x_docto->usuario->ViewAttributes() ?>><?php echo $pagos_x_docto->usuario->EditValue ?></div>
<input type="hidden" name="x_usuario" id="x_usuario" value="<?php echo ew_HtmlEncode($pagos_x_docto->usuario->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_usuario" id="x_usuario" size="30" value="<?php echo $pagos_x_docto->usuario->EditValue ?>"<?php echo $pagos_x_docto->usuario->EditAttributes() ?>>
<?php } ?>
</span><?php echo $pagos_x_docto->usuario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->estado_pago->Visible) { // estado_pago ?>
	<tr id="r_estado_pago"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->estado_pago->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pagos_x_docto->estado_pago->CellAttributes() ?>><span id="el_estado_pago">
<input type="text" name="x_estado_pago" id="x_estado_pago" size="30" maxlength="45" value="<?php echo $pagos_x_docto->estado_pago->EditValue ?>"<?php echo $pagos_x_docto->estado_pago->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->estado_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->descripcion->FldCaption() ?></td>
		<td<?php echo $pagos_x_docto->descripcion->CellAttributes() ?>><span id="el_descripcion">
<textarea name="x_descripcion" id="x_descripcion" cols="35" rows="4"<?php echo $pagos_x_docto->descripcion->EditAttributes() ?>><?php echo $pagos_x_docto->descripcion->EditValue ?></textarea>
</span><?php echo $pagos_x_docto->descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
	<tr id="r_fecha_vencimiento"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->fecha_vencimiento->FldCaption() ?></td>
		<td<?php echo $pagos_x_docto->fecha_vencimiento->CellAttributes() ?>><span id="el_fecha_vencimiento">
<input type="text" name="x_fecha_vencimiento" id="x_fecha_vencimiento" value="<?php echo $pagos_x_docto->fecha_vencimiento->EditValue ?>"<?php echo $pagos_x_docto->fecha_vencimiento->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->fecha_vencimiento->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pagos_x_docto->monto_pago->Visible) { // monto_pago ?>
	<tr id="r_monto_pago"<?php echo $pagos_x_docto->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pagos_x_docto->monto_pago->FldCaption() ?></td>
		<td<?php echo $pagos_x_docto->monto_pago->CellAttributes() ?>><span id="el_monto_pago">
<input type="text" name="x_monto_pago" id="x_monto_pago" size="30" value="<?php echo $pagos_x_docto->monto_pago->EditValue ?>"<?php echo $pagos_x_docto->monto_pago->EditAttributes() ?>>
</span><?php echo $pagos_x_docto->monto_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$pagos_x_docto_add->ShowPageFooter();
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
$pagos_x_docto_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpagos_x_docto_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'pagos_x_docto';

	// Page object name
	var $PageObjName = 'pagos_x_docto_add';

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
	function cpagos_x_docto_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pagos_x_docto)
		if (!isset($GLOBALS["pagos_x_docto"])) {
			$GLOBALS["pagos_x_docto"] = new cpagos_x_docto();
			$GLOBALS["Table"] =& $GLOBALS["pagos_x_docto"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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
		global $objForm, $Language, $gsFormError, $pagos_x_docto;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$pagos_x_docto->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$pagos_x_docto->CurrentAction = "I"; // Form error, reset action
				$pagos_x_docto->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["iddoctocontable"] != "") {
				$pagos_x_docto->iddoctocontable->setQueryStringValue($_GET["iddoctocontable"]);
				$pagos_x_docto->setKey("iddoctocontable", $pagos_x_docto->iddoctocontable->CurrentValue); // Set up key
			} else {
				$pagos_x_docto->setKey("iddoctocontable", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$pagos_x_docto->CurrentAction = "C"; // Copy record
			} else {
				$pagos_x_docto->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($pagos_x_docto->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("pagos_x_doctolist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$pagos_x_docto->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $pagos_x_docto->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "pagos_x_doctoview.php")
						$sReturnUrl = $pagos_x_docto->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$pagos_x_docto->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$pagos_x_docto->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$pagos_x_docto->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $pagos_x_docto;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $pagos_x_docto;
		$pagos_x_docto->historial->CurrentValue = NULL;
		$pagos_x_docto->historial->OldValue = $pagos_x_docto->historial->CurrentValue;
		$pagos_x_docto->tipo_docto->CurrentValue = NULL;
		$pagos_x_docto->tipo_docto->OldValue = $pagos_x_docto->tipo_docto->CurrentValue;
		$pagos_x_docto->consec_docto->CurrentValue = NULL;
		$pagos_x_docto->consec_docto->OldValue = $pagos_x_docto->consec_docto->CurrentValue;
		$pagos_x_docto->valor->CurrentValue = NULL;
		$pagos_x_docto->valor->OldValue = $pagos_x_docto->valor->CurrentValue;
		$pagos_x_docto->cia->CurrentValue = NULL;
		$pagos_x_docto->cia->OldValue = $pagos_x_docto->cia->CurrentValue;
		$pagos_x_docto->nit->CurrentValue = NULL;
		$pagos_x_docto->nit->OldValue = $pagos_x_docto->nit->CurrentValue;
		$pagos_x_docto->tercero->CurrentValue = NULL;
		$pagos_x_docto->tercero->OldValue = $pagos_x_docto->tercero->CurrentValue;
		$pagos_x_docto->fecha->CurrentValue = NULL;
		$pagos_x_docto->fecha->OldValue = $pagos_x_docto->fecha->CurrentValue;
		$pagos_x_docto->dias_vencidos->CurrentValue = NULL;
		$pagos_x_docto->dias_vencidos->OldValue = $pagos_x_docto->dias_vencidos->CurrentValue;
		$pagos_x_docto->estado->CurrentValue = NULL;
		$pagos_x_docto->estado->OldValue = $pagos_x_docto->estado->CurrentValue;
		$pagos_x_docto->usuario->CurrentValue = CurrentUserID();
		$pagos_x_docto->estado_pago->CurrentValue = NULL;
		$pagos_x_docto->estado_pago->OldValue = $pagos_x_docto->estado_pago->CurrentValue;
		$pagos_x_docto->descripcion->CurrentValue = NULL;
		$pagos_x_docto->descripcion->OldValue = $pagos_x_docto->descripcion->CurrentValue;
		$pagos_x_docto->fecha_vencimiento->CurrentValue = NULL;
		$pagos_x_docto->fecha_vencimiento->OldValue = $pagos_x_docto->fecha_vencimiento->CurrentValue;
		$pagos_x_docto->monto_pago->CurrentValue = NULL;
		$pagos_x_docto->monto_pago->OldValue = $pagos_x_docto->monto_pago->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pagos_x_docto;
		if (!$pagos_x_docto->historial->FldIsDetailKey) {
			$pagos_x_docto->historial->setFormValue($objForm->GetValue("x_historial"));
		}
		if (!$pagos_x_docto->tipo_docto->FldIsDetailKey) {
			$pagos_x_docto->tipo_docto->setFormValue($objForm->GetValue("x_tipo_docto"));
		}
		if (!$pagos_x_docto->consec_docto->FldIsDetailKey) {
			$pagos_x_docto->consec_docto->setFormValue($objForm->GetValue("x_consec_docto"));
		}
		if (!$pagos_x_docto->valor->FldIsDetailKey) {
			$pagos_x_docto->valor->setFormValue($objForm->GetValue("x_valor"));
		}
		if (!$pagos_x_docto->cia->FldIsDetailKey) {
			$pagos_x_docto->cia->setFormValue($objForm->GetValue("x_cia"));
		}
		if (!$pagos_x_docto->nit->FldIsDetailKey) {
			$pagos_x_docto->nit->setFormValue($objForm->GetValue("x_nit"));
		}
		if (!$pagos_x_docto->tercero->FldIsDetailKey) {
			$pagos_x_docto->tercero->setFormValue($objForm->GetValue("x_tercero"));
		}
		if (!$pagos_x_docto->fecha->FldIsDetailKey) {
			$pagos_x_docto->fecha->setFormValue($objForm->GetValue("x_fecha"));
			$pagos_x_docto->fecha->CurrentValue = ew_UnFormatDateTime($pagos_x_docto->fecha->CurrentValue, 0);
		}
		if (!$pagos_x_docto->dias_vencidos->FldIsDetailKey) {
			$pagos_x_docto->dias_vencidos->setFormValue($objForm->GetValue("x_dias_vencidos"));
		}
		if (!$pagos_x_docto->estado->FldIsDetailKey) {
			$pagos_x_docto->estado->setFormValue($objForm->GetValue("x_estado"));
		}
		if (!$pagos_x_docto->usuario->FldIsDetailKey) {
			$pagos_x_docto->usuario->setFormValue($objForm->GetValue("x_usuario"));
		}
		if (!$pagos_x_docto->estado_pago->FldIsDetailKey) {
			$pagos_x_docto->estado_pago->setFormValue($objForm->GetValue("x_estado_pago"));
		}
		if (!$pagos_x_docto->descripcion->FldIsDetailKey) {
			$pagos_x_docto->descripcion->setFormValue($objForm->GetValue("x_descripcion"));
		}
		if (!$pagos_x_docto->fecha_vencimiento->FldIsDetailKey) {
			$pagos_x_docto->fecha_vencimiento->setFormValue($objForm->GetValue("x_fecha_vencimiento"));
			$pagos_x_docto->fecha_vencimiento->CurrentValue = ew_UnFormatDateTime($pagos_x_docto->fecha_vencimiento->CurrentValue, 0);
		}
		if (!$pagos_x_docto->monto_pago->FldIsDetailKey) {
			$pagos_x_docto->monto_pago->setFormValue($objForm->GetValue("x_monto_pago"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pagos_x_docto;
		$this->LoadOldRecord();
		$pagos_x_docto->historial->CurrentValue = $pagos_x_docto->historial->FormValue;
		$pagos_x_docto->tipo_docto->CurrentValue = $pagos_x_docto->tipo_docto->FormValue;
		$pagos_x_docto->consec_docto->CurrentValue = $pagos_x_docto->consec_docto->FormValue;
		$pagos_x_docto->valor->CurrentValue = $pagos_x_docto->valor->FormValue;
		$pagos_x_docto->cia->CurrentValue = $pagos_x_docto->cia->FormValue;
		$pagos_x_docto->nit->CurrentValue = $pagos_x_docto->nit->FormValue;
		$pagos_x_docto->tercero->CurrentValue = $pagos_x_docto->tercero->FormValue;
		$pagos_x_docto->fecha->CurrentValue = $pagos_x_docto->fecha->FormValue;
		$pagos_x_docto->fecha->CurrentValue = ew_UnFormatDateTime($pagos_x_docto->fecha->CurrentValue, 0);
		$pagos_x_docto->dias_vencidos->CurrentValue = $pagos_x_docto->dias_vencidos->FormValue;
		$pagos_x_docto->estado->CurrentValue = $pagos_x_docto->estado->FormValue;
		$pagos_x_docto->usuario->CurrentValue = $pagos_x_docto->usuario->FormValue;
		$pagos_x_docto->estado_pago->CurrentValue = $pagos_x_docto->estado_pago->FormValue;
		$pagos_x_docto->descripcion->CurrentValue = $pagos_x_docto->descripcion->FormValue;
		$pagos_x_docto->fecha_vencimiento->CurrentValue = $pagos_x_docto->fecha_vencimiento->FormValue;
		$pagos_x_docto->fecha_vencimiento->CurrentValue = ew_UnFormatDateTime($pagos_x_docto->fecha_vencimiento->CurrentValue, 0);
		$pagos_x_docto->monto_pago->CurrentValue = $pagos_x_docto->monto_pago->FormValue;
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

	// Load old record
	function LoadOldRecord() {
		global $pagos_x_docto;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pagos_x_docto->getKey("iddoctocontable")) <> "")
			$pagos_x_docto->iddoctocontable->CurrentValue = $pagos_x_docto->getKey("iddoctocontable"); // iddoctocontable
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pagos_x_docto->CurrentFilter = $pagos_x_docto->KeyFilter();
			$sSql = $pagos_x_docto->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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

			// descripcion
			$pagos_x_docto->descripcion->ViewValue = $pagos_x_docto->descripcion->CurrentValue;
			$pagos_x_docto->descripcion->ViewCustomAttributes = "";

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->ViewValue = $pagos_x_docto->fecha_vencimiento->CurrentValue;
			$pagos_x_docto->fecha_vencimiento->ViewCustomAttributes = "";

			// monto_pago
			$pagos_x_docto->monto_pago->ViewValue = $pagos_x_docto->monto_pago->CurrentValue;
			$pagos_x_docto->monto_pago->ViewCustomAttributes = "";

			// historial
			$pagos_x_docto->historial->LinkCustomAttributes = "";
			$pagos_x_docto->historial->HrefValue = "";
			$pagos_x_docto->historial->TooltipValue = "";

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

			// tercero
			$pagos_x_docto->tercero->LinkCustomAttributes = "";
			$pagos_x_docto->tercero->HrefValue = "";
			$pagos_x_docto->tercero->TooltipValue = "";

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

			// usuario
			$pagos_x_docto->usuario->LinkCustomAttributes = "";
			$pagos_x_docto->usuario->HrefValue = "";
			$pagos_x_docto->usuario->TooltipValue = "";

			// estado_pago
			$pagos_x_docto->estado_pago->LinkCustomAttributes = "";
			$pagos_x_docto->estado_pago->HrefValue = "";
			$pagos_x_docto->estado_pago->TooltipValue = "";

			// descripcion
			$pagos_x_docto->descripcion->LinkCustomAttributes = "";
			$pagos_x_docto->descripcion->HrefValue = "";
			$pagos_x_docto->descripcion->TooltipValue = "";

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->LinkCustomAttributes = "";
			$pagos_x_docto->fecha_vencimiento->HrefValue = "";
			$pagos_x_docto->fecha_vencimiento->TooltipValue = "";

			// monto_pago
			$pagos_x_docto->monto_pago->LinkCustomAttributes = "";
			$pagos_x_docto->monto_pago->HrefValue = "";
			$pagos_x_docto->monto_pago->TooltipValue = "";
		} elseif ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add row

			// historial
			$pagos_x_docto->historial->EditCustomAttributes = "";
			$pagos_x_docto->historial->EditValue = ew_HtmlEncode($pagos_x_docto->historial->CurrentValue);

			// tipo_docto
			$pagos_x_docto->tipo_docto->EditCustomAttributes = "";
			$pagos_x_docto->tipo_docto->EditValue = ew_HtmlEncode($pagos_x_docto->tipo_docto->CurrentValue);

			// consec_docto
			$pagos_x_docto->consec_docto->EditCustomAttributes = "";
			$pagos_x_docto->consec_docto->EditValue = ew_HtmlEncode($pagos_x_docto->consec_docto->CurrentValue);

			// valor
			$pagos_x_docto->valor->EditCustomAttributes = "";
			$pagos_x_docto->valor->EditValue = ew_HtmlEncode($pagos_x_docto->valor->CurrentValue);

			// cia
			$pagos_x_docto->cia->EditCustomAttributes = "";
			$pagos_x_docto->cia->EditValue = ew_HtmlEncode($pagos_x_docto->cia->CurrentValue);

			// nit
			$pagos_x_docto->nit->EditCustomAttributes = "";
			$pagos_x_docto->nit->EditValue = ew_HtmlEncode($pagos_x_docto->nit->CurrentValue);

			// tercero
			$pagos_x_docto->tercero->EditCustomAttributes = "";
			$pagos_x_docto->tercero->EditValue = ew_HtmlEncode($pagos_x_docto->tercero->CurrentValue);

			// fecha
			$pagos_x_docto->fecha->EditCustomAttributes = "";
			$pagos_x_docto->fecha->EditValue = ew_HtmlEncode($pagos_x_docto->fecha->CurrentValue);

			// dias_vencidos
			$pagos_x_docto->dias_vencidos->EditCustomAttributes = "";
			$pagos_x_docto->dias_vencidos->EditValue = ew_HtmlEncode($pagos_x_docto->dias_vencidos->CurrentValue);

			// estado
			$pagos_x_docto->estado->EditCustomAttributes = "";
			$pagos_x_docto->estado->EditValue = ew_HtmlEncode($pagos_x_docto->estado->CurrentValue);

			// usuario
			$pagos_x_docto->usuario->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
				$pagos_x_docto->usuario->CurrentValue = CurrentUserID();
			$pagos_x_docto->usuario->EditValue = $pagos_x_docto->usuario->CurrentValue;
			$pagos_x_docto->usuario->ViewCustomAttributes = "";
			} else {
			$pagos_x_docto->usuario->EditValue = ew_HtmlEncode($pagos_x_docto->usuario->CurrentValue);
			}

			// estado_pago
			$pagos_x_docto->estado_pago->EditCustomAttributes = "";
			$pagos_x_docto->estado_pago->EditValue = ew_HtmlEncode($pagos_x_docto->estado_pago->CurrentValue);

			// descripcion
			$pagos_x_docto->descripcion->EditCustomAttributes = "";
			$pagos_x_docto->descripcion->EditValue = ew_HtmlEncode($pagos_x_docto->descripcion->CurrentValue);

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->EditCustomAttributes = "";
			$pagos_x_docto->fecha_vencimiento->EditValue = ew_HtmlEncode($pagos_x_docto->fecha_vencimiento->CurrentValue);

			// monto_pago
			$pagos_x_docto->monto_pago->EditCustomAttributes = "";
			$pagos_x_docto->monto_pago->EditValue = ew_HtmlEncode($pagos_x_docto->monto_pago->CurrentValue);

			// Edit refer script
			// historial

			$pagos_x_docto->historial->HrefValue = "";

			// tipo_docto
			$pagos_x_docto->tipo_docto->HrefValue = "";

			// consec_docto
			$pagos_x_docto->consec_docto->HrefValue = "";

			// valor
			$pagos_x_docto->valor->HrefValue = "";

			// cia
			$pagos_x_docto->cia->HrefValue = "";

			// nit
			$pagos_x_docto->nit->HrefValue = "";

			// tercero
			$pagos_x_docto->tercero->HrefValue = "";

			// fecha
			$pagos_x_docto->fecha->HrefValue = "";

			// dias_vencidos
			$pagos_x_docto->dias_vencidos->HrefValue = "";

			// estado
			$pagos_x_docto->estado->HrefValue = "";

			// usuario
			$pagos_x_docto->usuario->HrefValue = "";

			// estado_pago
			$pagos_x_docto->estado_pago->HrefValue = "";

			// descripcion
			$pagos_x_docto->descripcion->HrefValue = "";

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->HrefValue = "";

			// monto_pago
			$pagos_x_docto->monto_pago->HrefValue = "";
		}
		if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD ||
			$pagos_x_docto->RowType == EW_ROWTYPE_EDIT ||
			$pagos_x_docto->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$pagos_x_docto->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($pagos_x_docto->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pagos_x_docto->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $pagos_x_docto;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($pagos_x_docto->historial->FormValue) && $pagos_x_docto->historial->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_x_docto->historial->FldCaption());
		}
		if (!ew_CheckInteger($pagos_x_docto->historial->FormValue)) {
			ew_AddMessage($gsFormError, $pagos_x_docto->historial->FldErrMsg());
		}
		if (!is_null($pagos_x_docto->tipo_docto->FormValue) && $pagos_x_docto->tipo_docto->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_x_docto->tipo_docto->FldCaption());
		}
		if (!is_null($pagos_x_docto->consec_docto->FormValue) && $pagos_x_docto->consec_docto->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_x_docto->consec_docto->FldCaption());
		}
		if (!ew_CheckInteger($pagos_x_docto->consec_docto->FormValue)) {
			ew_AddMessage($gsFormError, $pagos_x_docto->consec_docto->FldErrMsg());
		}
		if (!is_null($pagos_x_docto->valor->FormValue) && $pagos_x_docto->valor->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_x_docto->valor->FldCaption());
		}
		if (!ew_CheckInteger($pagos_x_docto->valor->FormValue)) {
			ew_AddMessage($gsFormError, $pagos_x_docto->valor->FldErrMsg());
		}
		if (!is_null($pagos_x_docto->cia->FormValue) && $pagos_x_docto->cia->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_x_docto->cia->FldCaption());
		}
		if (!ew_CheckInteger($pagos_x_docto->cia->FormValue)) {
			ew_AddMessage($gsFormError, $pagos_x_docto->cia->FldErrMsg());
		}
		if (!is_null($pagos_x_docto->fecha->FormValue) && $pagos_x_docto->fecha->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_x_docto->fecha->FldCaption());
		}
		if (!is_null($pagos_x_docto->estado->FormValue) && $pagos_x_docto->estado->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_x_docto->estado->FldCaption());
		}
		if (!is_null($pagos_x_docto->usuario->FormValue) && $pagos_x_docto->usuario->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_x_docto->usuario->FldCaption());
		}
		if (!ew_CheckInteger($pagos_x_docto->usuario->FormValue)) {
			ew_AddMessage($gsFormError, $pagos_x_docto->usuario->FldErrMsg());
		}
		if (!is_null($pagos_x_docto->estado_pago->FormValue) && $pagos_x_docto->estado_pago->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $pagos_x_docto->estado_pago->FldCaption());
		}
		if (!ew_CheckInteger($pagos_x_docto->estado_pago->FormValue)) {
			ew_AddMessage($gsFormError, $pagos_x_docto->estado_pago->FldErrMsg());
		}
		if (!ew_CheckInteger($pagos_x_docto->monto_pago->FormValue)) {
			ew_AddMessage($gsFormError, $pagos_x_docto->monto_pago->FldErrMsg());
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
		global $conn, $Language, $Security, $pagos_x_docto;

		// Check if valid User ID
		$bValidUser = FALSE;
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$bValidUser = $Security->IsValidUserID($pagos_x_docto->usuario->CurrentValue);
			if (!$bValidUser) {
				$sUserIdMsg = str_replace("%c", CurrentUserID(), $Language->Phrase("UnAuthorizedUserID"));
				$sUserIdMsg = str_replace("%u", $pagos_x_docto->usuario->CurrentValue, $sUserIdMsg);
				$this->setFailureMessage($sUserIdMsg);
				return FALSE;
			}
		}
		$rsnew = array();

		// historial
		$pagos_x_docto->historial->SetDbValueDef($rsnew, $pagos_x_docto->historial->CurrentValue, 0, FALSE);

		// tipo_docto
		$pagos_x_docto->tipo_docto->SetDbValueDef($rsnew, $pagos_x_docto->tipo_docto->CurrentValue, "", FALSE);

		// consec_docto
		$pagos_x_docto->consec_docto->SetDbValueDef($rsnew, $pagos_x_docto->consec_docto->CurrentValue, 0, FALSE);

		// valor
		$pagos_x_docto->valor->SetDbValueDef($rsnew, $pagos_x_docto->valor->CurrentValue, 0, FALSE);

		// cia
		$pagos_x_docto->cia->SetDbValueDef($rsnew, $pagos_x_docto->cia->CurrentValue, 0, FALSE);

		// nit
		$pagos_x_docto->nit->SetDbValueDef($rsnew, $pagos_x_docto->nit->CurrentValue, NULL, FALSE);

		// tercero
		$pagos_x_docto->tercero->SetDbValueDef($rsnew, $pagos_x_docto->tercero->CurrentValue, NULL, FALSE);

		// fecha
		$pagos_x_docto->fecha->SetDbValueDef($rsnew, $pagos_x_docto->fecha->CurrentValue, ew_CurrentDate(), FALSE);

		// dias_vencidos
		$pagos_x_docto->dias_vencidos->SetDbValueDef($rsnew, $pagos_x_docto->dias_vencidos->CurrentValue, NULL, FALSE);

		// estado
		$pagos_x_docto->estado->SetDbValueDef($rsnew, $pagos_x_docto->estado->CurrentValue, "", FALSE);

		// usuario
		$pagos_x_docto->usuario->SetDbValueDef($rsnew, $pagos_x_docto->usuario->CurrentValue, 0, FALSE);

		// estado_pago
		$pagos_x_docto->estado_pago->SetDbValueDef($rsnew, $pagos_x_docto->estado_pago->CurrentValue, 0, FALSE);

		// descripcion
		$pagos_x_docto->descripcion->SetDbValueDef($rsnew, $pagos_x_docto->descripcion->CurrentValue, NULL, FALSE);

		// fecha_vencimiento
		$pagos_x_docto->fecha_vencimiento->SetDbValueDef($rsnew, $pagos_x_docto->fecha_vencimiento->CurrentValue, NULL, FALSE);

		// monto_pago
		$pagos_x_docto->monto_pago->SetDbValueDef($rsnew, $pagos_x_docto->monto_pago->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $pagos_x_docto->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($pagos_x_docto->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($pagos_x_docto->CancelMessage <> "") {
				$this->setFailureMessage($pagos_x_docto->CancelMessage);
				$pagos_x_docto->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$pagos_x_docto->iddoctocontable->setDbValue($conn->Insert_ID());
			$rsnew['iddoctocontable'] = $pagos_x_docto->iddoctocontable->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$pagos_x_docto->Row_Inserted($rs, $rsnew);
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
