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
$historial_pagos_delete = new chistorial_pagos_delete();
$Page =& $historial_pagos_delete;

// Page init
$historial_pagos_delete->Page_Init();

// Page main
$historial_pagos_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var historial_pagos_delete = new ew_Page("historial_pagos_delete");

// page properties
historial_pagos_delete.PageID = "delete"; // page ID
historial_pagos_delete.FormID = "fhistorial_pagosdelete"; // form ID
var EW_PAGE_ID = historial_pagos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
historial_pagos_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
historial_pagos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
historial_pagos_delete.ValidateRequired = false; // no JavaScript validation
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
if ($historial_pagos_delete->Recordset = $historial_pagos_delete->LoadRecordset())
	$historial_pagos_deleteTotalRecs = $historial_pagos_delete->Recordset->RecordCount(); // Get record count
if ($historial_pagos_deleteTotalRecs <= 0) { // No record found, exit
	if ($historial_pagos_delete->Recordset)
		$historial_pagos_delete->Recordset->Close();
	$historial_pagos_delete->Page_Terminate("historial_pagoslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $historial_pagos->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $historial_pagos->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $historial_pagos_delete->ShowPageHeader(); ?>
<?php
$historial_pagos_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="historial_pagos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($historial_pagos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $historial_pagos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $historial_pagos->idhistorial_pagos->FldCaption() ?></td>
		<td valign="top"><?php echo $historial_pagos->usuario->FldCaption() ?></td>
		<td valign="top"><?php echo $historial_pagos->estado_pago->FldCaption() ?></td>
		<td valign="top"><?php echo $historial_pagos->ref_venta->FldCaption() ?></td>
		<td valign="top"><?php echo $historial_pagos->fecha_hora_creacion->FldCaption() ?></td>
		<td valign="top"><?php echo $historial_pagos->riesgo->FldCaption() ?></td>
		<td valign="top"><?php echo $historial_pagos->monto_pago->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$historial_pagos_delete->RecCnt = 0;
$i = 0;
while (!$historial_pagos_delete->Recordset->EOF) {
	$historial_pagos_delete->RecCnt++;

	// Set row properties
	$historial_pagos->ResetAttrs();
	$historial_pagos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$historial_pagos_delete->LoadRowValues($historial_pagos_delete->Recordset);

	// Render row
	$historial_pagos_delete->RenderRow();
?>
	<tr<?php echo $historial_pagos->RowAttributes() ?>>
		<td<?php echo $historial_pagos->idhistorial_pagos->CellAttributes() ?>>
<div<?php echo $historial_pagos->idhistorial_pagos->ViewAttributes() ?>><?php echo $historial_pagos->idhistorial_pagos->ListViewValue() ?></div></td>
		<td<?php echo $historial_pagos->usuario->CellAttributes() ?>>
<div<?php echo $historial_pagos->usuario->ViewAttributes() ?>><?php echo $historial_pagos->usuario->ListViewValue() ?></div></td>
		<td<?php echo $historial_pagos->estado_pago->CellAttributes() ?>>
<div<?php echo $historial_pagos->estado_pago->ViewAttributes() ?>><?php echo $historial_pagos->estado_pago->ListViewValue() ?></div></td>
		<td<?php echo $historial_pagos->ref_venta->CellAttributes() ?>>
<div<?php echo $historial_pagos->ref_venta->ViewAttributes() ?>><?php echo $historial_pagos->ref_venta->ListViewValue() ?></div></td>
		<td<?php echo $historial_pagos->fecha_hora_creacion->CellAttributes() ?>>
<div<?php echo $historial_pagos->fecha_hora_creacion->ViewAttributes() ?>><?php echo $historial_pagos->fecha_hora_creacion->ListViewValue() ?></div></td>
		<td<?php echo $historial_pagos->riesgo->CellAttributes() ?>>
<div<?php echo $historial_pagos->riesgo->ViewAttributes() ?>><?php echo $historial_pagos->riesgo->ListViewValue() ?></div></td>
		<td<?php echo $historial_pagos->monto_pago->CellAttributes() ?>>
<div<?php echo $historial_pagos->monto_pago->ViewAttributes() ?>><?php echo $historial_pagos->monto_pago->ListViewValue() ?></div></td>
	</tr>
<?php
	$historial_pagos_delete->Recordset->MoveNext();
}
$historial_pagos_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$historial_pagos_delete->ShowPageFooter();
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
$historial_pagos_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class chistorial_pagos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'historial_pagos';

	// Page object name
	var $PageObjName = 'historial_pagos_delete';

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
	function chistorial_pagos_delete() {
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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
		global $Language, $historial_pagos;

		// Load key parameters
		$this->RecKeys = $historial_pagos->GetRecordKeys(); // Load record keys
		$sFilter = $historial_pagos->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("historial_pagoslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in historial_pagos class, historial_pagosinfo.php

		$historial_pagos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$historial_pagos->CurrentAction = $_POST["a_delete"];
		} else {
			$historial_pagos->CurrentAction = "I"; // Display record
		}
		switch ($historial_pagos->CurrentAction) {
			case "D": // Delete
				$historial_pagos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($historial_pagos->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $historial_pagos;

		// Call Recordset Selecting event
		$historial_pagos->Recordset_Selecting($historial_pagos->CurrentFilter);

		// Load List page SQL
		$sSql = $historial_pagos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$historial_pagos->Recordset_Selected($rs);
		return $rs;
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

			// monto_pago
			$historial_pagos->monto_pago->LinkCustomAttributes = "";
			$historial_pagos->monto_pago->HrefValue = "";
			$historial_pagos->monto_pago->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($historial_pagos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$historial_pagos->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $historial_pagos;
		$DeleteRows = TRUE;
		$sSql = $historial_pagos->SQL();
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
				$DeleteRows = $historial_pagos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['idhistorial_pagos'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($historial_pagos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($historial_pagos->CancelMessage <> "") {
				$this->setFailureMessage($historial_pagos->CancelMessage);
				$historial_pagos->CancelMessage = "";
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
				$historial_pagos->Row_Deleted($row);
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
