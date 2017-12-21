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
$documento_contable_delete = new cdocumento_contable_delete();
$Page =& $documento_contable_delete;

// Page init
$documento_contable_delete->Page_Init();

// Page main
$documento_contable_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var documento_contable_delete = new ew_Page("documento_contable_delete");

// page properties
documento_contable_delete.PageID = "delete"; // page ID
documento_contable_delete.FormID = "fdocumento_contabledelete"; // form ID
var EW_PAGE_ID = documento_contable_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
documento_contable_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
documento_contable_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
documento_contable_delete.ValidateRequired = false; // no JavaScript validation
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
if ($documento_contable_delete->Recordset = $documento_contable_delete->LoadRecordset())
	$documento_contable_deleteTotalRecs = $documento_contable_delete->Recordset->RecordCount(); // Get record count
if ($documento_contable_deleteTotalRecs <= 0) { // No record found, exit
	if ($documento_contable_delete->Recordset)
		$documento_contable_delete->Recordset->Close();
	$documento_contable_delete->Page_Terminate("documento_contablelist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documento_contable->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $documento_contable->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $documento_contable_delete->ShowPageHeader(); ?>
<?php
$documento_contable_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="documento_contable">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($documento_contable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $documento_contable->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $documento_contable->iddoctocontable->FldCaption() ?></td>
		<td valign="top"><?php echo $documento_contable->tipo_docto->FldCaption() ?></td>
		<td valign="top"><?php echo $documento_contable->consec_docto->FldCaption() ?></td>
		<td valign="top"><?php echo $documento_contable->valor->FldCaption() ?></td>
		<td valign="top"><?php echo $documento_contable->cia->FldCaption() ?></td>
		<td valign="top"><?php echo $documento_contable->tercero->FldCaption() ?></td>
		<td valign="top"><?php echo $documento_contable->fecha->FldCaption() ?></td>
		<td valign="top"><?php echo $documento_contable->estado->FldCaption() ?></td>
		<td valign="top"><?php echo $documento_contable->estado_pago->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$documento_contable_delete->RecCnt = 0;
$i = 0;
while (!$documento_contable_delete->Recordset->EOF) {
	$documento_contable_delete->RecCnt++;

	// Set row properties
	$documento_contable->ResetAttrs();
	$documento_contable->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$documento_contable_delete->LoadRowValues($documento_contable_delete->Recordset);

	// Render row
	$documento_contable_delete->RenderRow();
?>
	<tr<?php echo $documento_contable->RowAttributes() ?>>
		<td<?php echo $documento_contable->iddoctocontable->CellAttributes() ?>>
<div<?php echo $documento_contable->iddoctocontable->ViewAttributes() ?>><?php echo $documento_contable->iddoctocontable->ListViewValue() ?></div></td>
		<td<?php echo $documento_contable->tipo_docto->CellAttributes() ?>>
<div<?php echo $documento_contable->tipo_docto->ViewAttributes() ?>><?php echo $documento_contable->tipo_docto->ListViewValue() ?></div></td>
		<td<?php echo $documento_contable->consec_docto->CellAttributes() ?>>
<div<?php echo $documento_contable->consec_docto->ViewAttributes() ?>><?php echo $documento_contable->consec_docto->ListViewValue() ?></div></td>
		<td<?php echo $documento_contable->valor->CellAttributes() ?>>
<div<?php echo $documento_contable->valor->ViewAttributes() ?>><?php echo $documento_contable->valor->ListViewValue() ?></div></td>
		<td<?php echo $documento_contable->cia->CellAttributes() ?>>
<div<?php echo $documento_contable->cia->ViewAttributes() ?>><?php echo $documento_contable->cia->ListViewValue() ?></div></td>
		<td<?php echo $documento_contable->tercero->CellAttributes() ?>>
<div<?php echo $documento_contable->tercero->ViewAttributes() ?>><?php echo $documento_contable->tercero->ListViewValue() ?></div></td>
		<td<?php echo $documento_contable->fecha->CellAttributes() ?>>
<div<?php echo $documento_contable->fecha->ViewAttributes() ?>><?php echo $documento_contable->fecha->ListViewValue() ?></div></td>
		<td<?php echo $documento_contable->estado->CellAttributes() ?>>
<div<?php echo $documento_contable->estado->ViewAttributes() ?>><?php echo $documento_contable->estado->ListViewValue() ?></div></td>
		<td<?php echo $documento_contable->estado_pago->CellAttributes() ?>>
<div<?php echo $documento_contable->estado_pago->ViewAttributes() ?>><?php echo $documento_contable->estado_pago->ListViewValue() ?></div></td>
	</tr>
<?php
	$documento_contable_delete->Recordset->MoveNext();
}
$documento_contable_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$documento_contable_delete->ShowPageFooter();
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
$documento_contable_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumento_contable_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'documento_contable';

	// Page object name
	var $PageObjName = 'documento_contable_delete';

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
	function cdocumento_contable_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (documento_contable)
		if (!isset($GLOBALS["documento_contable"])) {
			$GLOBALS["documento_contable"] = new cdocumento_contable();
			$GLOBALS["Table"] =& $GLOBALS["documento_contable"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'documento_contable', TRUE);

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
		if (!$Security->CanDelete()) {
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
		global $Language, $documento_contable;

		// Load key parameters
		$this->RecKeys = $documento_contable->GetRecordKeys(); // Load record keys
		$sFilter = $documento_contable->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("documento_contablelist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in documento_contable class, documento_contableinfo.php

		$documento_contable->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$documento_contable->CurrentAction = $_POST["a_delete"];
		} else {
			$documento_contable->CurrentAction = "I"; // Display record
		}
		switch ($documento_contable->CurrentAction) {
			case "D": // Delete
				$documento_contable->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($documento_contable->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
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
		$documento_contable->estado->setDbValue($rs->fields('estado'));
		$documento_contable->usuario->setDbValue($rs->fields('usuario'));
		$documento_contable->estado_pago->setDbValue($rs->fields('estado_pago'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $documento_contable;

		// Initialize URLs
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
		// estado
		// usuario
		// estado_pago

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
			$documento_contable->fecha->ViewValue = ew_FormatDateTime($documento_contable->fecha->ViewValue, 11);
			$documento_contable->fecha->ViewCustomAttributes = "";

			// estado
			$documento_contable->estado->ViewValue = $documento_contable->estado->CurrentValue;
			$documento_contable->estado->ViewCustomAttributes = "";

			// usuario
			$documento_contable->usuario->ViewValue = $documento_contable->usuario->CurrentValue;
			$documento_contable->usuario->ViewCustomAttributes = "";

			// estado_pago
			$documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->CurrentValue;
			$documento_contable->estado_pago->ViewCustomAttributes = "";

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

			// estado
			$documento_contable->estado->LinkCustomAttributes = "";
			$documento_contable->estado->HrefValue = "";
			$documento_contable->estado->TooltipValue = "";

			// estado_pago
			$documento_contable->estado_pago->LinkCustomAttributes = "";
			$documento_contable->estado_pago->HrefValue = "";
			$documento_contable->estado_pago->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($documento_contable->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$documento_contable->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $documento_contable;
		$DeleteRows = TRUE;
		$sSql = $documento_contable->SQL();
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
				$DeleteRows = $documento_contable->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($documento_contable->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($documento_contable->CancelMessage <> "") {
				$this->setFailureMessage($documento_contable->CancelMessage);
				$documento_contable->CancelMessage = "";
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
				$documento_contable->Row_Deleted($row);
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
