<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "historial_pagosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$historial_pagos_search = new chistorial_pagos_search();
$Page =& $historial_pagos_search;

// Page init
$historial_pagos_search->Page_Init();

// Page main
$historial_pagos_search->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var historial_pagos_search = new ew_Page("historial_pagos_search");

// page properties
historial_pagos_search.PageID = "search"; // page ID
historial_pagos_search.FormID = "fhistorial_pagossearch"; // form ID
var EW_PAGE_ID = historial_pagos_search.PageID; // for backward compatibility

// extend page with validate function for search
historial_pagos_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_idhistorial_pagos"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($historial_pagos->idhistorial_pagos->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_consec_docto"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($historial_pagos->consec_docto->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_monto_pago"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($historial_pagos->monto_pago->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
historial_pagos_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
historial_pagos_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
historial_pagos_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $historial_pagos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $historial_pagos->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></p>
<?php $historial_pagos_search->ShowPageHeader(); ?>
<?php
$historial_pagos_search->ShowMessage();
?>
<form name="fhistorial_pagossearch" id="fhistorial_pagossearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return historial_pagos_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="historial_pagos">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr id="r_idhistorial_pagos"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->idhistorial_pagos->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_idhistorial_pagos" id="z_idhistorial_pagos" value="="></td>
		<td<?php echo $historial_pagos->idhistorial_pagos->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_idhistorial_pagos" id="x_idhistorial_pagos" value="<?php echo $historial_pagos->idhistorial_pagos->EditValue ?>"<?php echo $historial_pagos->idhistorial_pagos->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_usuario"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->usuario->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_usuario" id="z_usuario" value="="></td>
		<td<?php echo $historial_pagos->usuario->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $historial_pagos->usuario->ViewAttributes() ?>><?php echo $historial_pagos->usuario->EditValue ?></div>
<input type="hidden" name="x_usuario" id="x_usuario" value="<?php echo ew_HtmlEncode($historial_pagos->usuario->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<select id="x_usuario" name="x_usuario"<?php echo $historial_pagos->usuario->EditAttributes() ?>>
<?php
if (is_array($historial_pagos->usuario->EditValue)) {
	$arwrk = $historial_pagos->usuario->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($historial_pagos->usuario->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr id="r_tipo_docto"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->tipo_docto->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_tipo_docto" id="z_tipo_docto" value="LIKE"></td>
		<td<?php echo $historial_pagos->tipo_docto->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_tipo_docto" id="x_tipo_docto" size="30" maxlength="45" value="<?php echo $historial_pagos->tipo_docto->EditValue ?>"<?php echo $historial_pagos->tipo_docto->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_consec_docto"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->consec_docto->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_consec_docto" id="z_consec_docto" value="="></td>
		<td<?php echo $historial_pagos->consec_docto->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_consec_docto" id="x_consec_docto" size="30" value="<?php echo $historial_pagos->consec_docto->EditValue ?>"<?php echo $historial_pagos->consec_docto->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_estado_pago"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->estado_pago->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_estado_pago" id="z_estado_pago" value="LIKE"></td>
		<td<?php echo $historial_pagos->estado_pago->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_estado_pago" id="x_estado_pago" size="30" maxlength="45" value="<?php echo $historial_pagos->estado_pago->EditValue ?>"<?php echo $historial_pagos->estado_pago->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_ref_venta"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->ref_venta->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ref_venta" id="z_ref_venta" value="LIKE"></td>
		<td<?php echo $historial_pagos->ref_venta->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_ref_venta" id="x_ref_venta" size="30" maxlength="45" value="<?php echo $historial_pagos->ref_venta->EditValue ?>"<?php echo $historial_pagos->ref_venta->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_fecha_hora_creacion"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->fecha_hora_creacion->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_fecha_hora_creacion" id="z_fecha_hora_creacion" value="="></td>
		<td<?php echo $historial_pagos->fecha_hora_creacion->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_fecha_hora_creacion" id="x_fecha_hora_creacion" value="<?php echo $historial_pagos->fecha_hora_creacion->EditValue ?>"<?php echo $historial_pagos->fecha_hora_creacion->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_riesgo"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->riesgo->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_riesgo" id="z_riesgo" value="LIKE"></td>
		<td<?php echo $historial_pagos->riesgo->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_riesgo" id="x_riesgo" size="30" maxlength="45" value="<?php echo $historial_pagos->riesgo->EditValue ?>"<?php echo $historial_pagos->riesgo->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_medio_pago"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->medio_pago->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_medio_pago" id="z_medio_pago" value="LIKE"></td>
		<td<?php echo $historial_pagos->medio_pago->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_medio_pago" id="x_medio_pago" size="30" maxlength="2" value="<?php echo $historial_pagos->medio_pago->EditValue ?>"<?php echo $historial_pagos->medio_pago->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_respuesta_pol"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->respuesta_pol->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_respuesta_pol" id="z_respuesta_pol" value="LIKE"></td>
		<td<?php echo $historial_pagos->respuesta_pol->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_respuesta_pol" id="x_respuesta_pol" size="30" maxlength="2" value="<?php echo $historial_pagos->respuesta_pol->EditValue ?>"<?php echo $historial_pagos->respuesta_pol->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr id="r_monto_pago"<?php echo $historial_pagos->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $historial_pagos->monto_pago->FldCaption() ?></td>
		<td class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_monto_pago" id="z_monto_pago" value="="></td>
		<td<?php echo $historial_pagos->monto_pago->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker">
<input type="text" name="x_monto_pago" id="x_monto_pago" size="30" value="<?php echo $historial_pagos->monto_pago->EditValue ?>"<?php echo $historial_pagos->monto_pago->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<?php
$historial_pagos_search->ShowPageFooter();
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
$historial_pagos_search->Page_Terminate();
?>
<?php

//
// Page class
//
class chistorial_pagos_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'historial_pagos';

	// Page object name
	var $PageObjName = 'historial_pagos_search';

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
	function chistorial_pagos_search() {
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

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $historial_pagos;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$historial_pagos->CurrentAction = $objForm->GetValue("a_search");
			switch ($historial_pagos->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setFailureMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $historial_pagos->UrlParm($sSrchStr);
						$this->Page_Terminate("historial_pagoslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$historial_pagos->RowType = EW_ROWTYPE_SEARCH;
		$historial_pagos->ResetAttrs();
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $historial_pagos;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->idhistorial_pagos); // idhistorial_pagos
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->usuario); // usuario
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->tipo_docto); // tipo_docto
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->consec_docto); // consec_docto
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->estado_pago); // estado_pago
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->ref_venta); // ref_venta
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->fecha_hora_creacion); // fecha_hora_creacion
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->riesgo); // riesgo
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->medio_pago); // medio_pago
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->respuesta_pol); // respuesta_pol
	$this->BuildSearchUrl($sSrchUrl, $historial_pagos->monto_pago); // monto_pago
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $historial_pagos;

		// Load search values
		// idhistorial_pagos

		$historial_pagos->idhistorial_pagos->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_idhistorial_pagos"));
		$historial_pagos->idhistorial_pagos->AdvancedSearch->SearchOperator = $objForm->GetValue("z_idhistorial_pagos");

		// usuario
		$historial_pagos->usuario->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_usuario"));
		$historial_pagos->usuario->AdvancedSearch->SearchOperator = $objForm->GetValue("z_usuario");

		// tipo_docto
		$historial_pagos->tipo_docto->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_tipo_docto"));
		$historial_pagos->tipo_docto->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tipo_docto");

		// consec_docto
		$historial_pagos->consec_docto->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_consec_docto"));
		$historial_pagos->consec_docto->AdvancedSearch->SearchOperator = $objForm->GetValue("z_consec_docto");

		// estado_pago
		$historial_pagos->estado_pago->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_estado_pago"));
		$historial_pagos->estado_pago->AdvancedSearch->SearchOperator = $objForm->GetValue("z_estado_pago");

		// ref_venta
		$historial_pagos->ref_venta->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ref_venta"));
		$historial_pagos->ref_venta->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ref_venta");

		// fecha_hora_creacion
		$historial_pagos->fecha_hora_creacion->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_fecha_hora_creacion"));
		$historial_pagos->fecha_hora_creacion->AdvancedSearch->SearchOperator = $objForm->GetValue("z_fecha_hora_creacion");

		// riesgo
		$historial_pagos->riesgo->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_riesgo"));
		$historial_pagos->riesgo->AdvancedSearch->SearchOperator = $objForm->GetValue("z_riesgo");

		// medio_pago
		$historial_pagos->medio_pago->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_medio_pago"));
		$historial_pagos->medio_pago->AdvancedSearch->SearchOperator = $objForm->GetValue("z_medio_pago");

		// respuesta_pol
		$historial_pagos->respuesta_pol->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_respuesta_pol"));
		$historial_pagos->respuesta_pol->AdvancedSearch->SearchOperator = $objForm->GetValue("z_respuesta_pol");

		// monto_pago
		$historial_pagos->monto_pago->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_monto_pago"));
		$historial_pagos->monto_pago->AdvancedSearch->SearchOperator = $objForm->GetValue("z_monto_pago");
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
		} elseif ($historial_pagos->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// idhistorial_pagos
			$historial_pagos->idhistorial_pagos->EditCustomAttributes = "";
			$historial_pagos->idhistorial_pagos->EditValue = ew_HtmlEncode($historial_pagos->idhistorial_pagos->AdvancedSearch->SearchValue);

			// usuario
			$historial_pagos->usuario->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
				$historial_pagos->usuario->AdvancedSearch->SearchValue = CurrentUserID();
			if (strval($historial_pagos->usuario->AdvancedSearch->SearchValue) <> "") {
				$sFilterWrk = "`idusuario` = " . ew_AdjustSql($historial_pagos->usuario->AdvancedSearch->SearchValue) . "";
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
					$historial_pagos->usuario->EditValue = $historial_pagos->usuario->AdvancedSearch->SearchValue;
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
			$historial_pagos->tipo_docto->EditValue = ew_HtmlEncode($historial_pagos->tipo_docto->AdvancedSearch->SearchValue);

			// consec_docto
			$historial_pagos->consec_docto->EditCustomAttributes = "";
			$historial_pagos->consec_docto->EditValue = ew_HtmlEncode($historial_pagos->consec_docto->AdvancedSearch->SearchValue);

			// estado_pago
			$historial_pagos->estado_pago->EditCustomAttributes = "";
			$historial_pagos->estado_pago->EditValue = ew_HtmlEncode($historial_pagos->estado_pago->AdvancedSearch->SearchValue);

			// ref_venta
			$historial_pagos->ref_venta->EditCustomAttributes = "";
			$historial_pagos->ref_venta->EditValue = ew_HtmlEncode($historial_pagos->ref_venta->AdvancedSearch->SearchValue);

			// fecha_hora_creacion
			$historial_pagos->fecha_hora_creacion->EditCustomAttributes = "";
			$historial_pagos->fecha_hora_creacion->EditValue = ew_HtmlEncode(ew_UnFormatDateTime($historial_pagos->fecha_hora_creacion->AdvancedSearch->SearchValue, 0));

			// riesgo
			$historial_pagos->riesgo->EditCustomAttributes = "";
			$historial_pagos->riesgo->EditValue = ew_HtmlEncode($historial_pagos->riesgo->AdvancedSearch->SearchValue);

			// medio_pago
			$historial_pagos->medio_pago->EditCustomAttributes = "";
			$historial_pagos->medio_pago->EditValue = ew_HtmlEncode($historial_pagos->medio_pago->AdvancedSearch->SearchValue);

			// respuesta_pol
			$historial_pagos->respuesta_pol->EditCustomAttributes = "";
			$historial_pagos->respuesta_pol->EditValue = ew_HtmlEncode($historial_pagos->respuesta_pol->AdvancedSearch->SearchValue);

			// monto_pago
			$historial_pagos->monto_pago->EditCustomAttributes = "";
			$historial_pagos->monto_pago->EditValue = ew_HtmlEncode($historial_pagos->monto_pago->AdvancedSearch->SearchValue);
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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $historial_pagos;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($historial_pagos->idhistorial_pagos->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $historial_pagos->idhistorial_pagos->FldErrMsg());
		}
		if (!ew_CheckInteger($historial_pagos->consec_docto->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $historial_pagos->consec_docto->FldErrMsg());
		}
		if (!ew_CheckInteger($historial_pagos->monto_pago->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $historial_pagos->monto_pago->FldErrMsg());
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $historial_pagos;
		$historial_pagos->idhistorial_pagos->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_idhistorial_pagos");
		$historial_pagos->usuario->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_usuario");
		$historial_pagos->tipo_docto->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_tipo_docto");
		$historial_pagos->consec_docto->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_consec_docto");
		$historial_pagos->estado_pago->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_estado_pago");
		$historial_pagos->ref_venta->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_ref_venta");
		$historial_pagos->fecha_hora_creacion->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_fecha_hora_creacion");
		$historial_pagos->riesgo->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_riesgo");
		$historial_pagos->medio_pago->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_medio_pago");
		$historial_pagos->respuesta_pol->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_respuesta_pol");
		$historial_pagos->monto_pago->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_monto_pago");
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
