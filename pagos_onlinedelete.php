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
$pagos_online_delete = new cpagos_online_delete();
$Page =& $pagos_online_delete;

// Page init
$pagos_online_delete->Page_Init();

// Page main
$pagos_online_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pagos_online_delete = new ew_Page("pagos_online_delete");

// page properties
pagos_online_delete.PageID = "delete"; // page ID
pagos_online_delete.FormID = "fpagos_onlinedelete"; // form ID
var EW_PAGE_ID = pagos_online_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pagos_online_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pagos_online_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pagos_online_delete.ValidateRequired = false; // no JavaScript validation
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
if ($pagos_online_delete->Recordset = $pagos_online_delete->LoadRecordset())
	$pagos_online_deleteTotalRecs = $pagos_online_delete->Recordset->RecordCount(); // Get record count
if ($pagos_online_deleteTotalRecs <= 0) { // No record found, exit
	if ($pagos_online_delete->Recordset)
		$pagos_online_delete->Recordset->Close();
	$pagos_online_delete->Page_Terminate("pagos_onlinelist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pagos_online->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $pagos_online->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $pagos_online_delete->ShowPageHeader(); ?>
<?php
$pagos_online_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="pagos_online">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($pagos_online_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $pagos_online->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $pagos_online->idpagosonline->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_online->usuarioid->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_online->llave_encripcion->FldCaption() ?></td>
		<td valign="top"><?php echo $pagos_online->url->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$pagos_online_delete->RecCnt = 0;
$i = 0;
while (!$pagos_online_delete->Recordset->EOF) {
	$pagos_online_delete->RecCnt++;

	// Set row properties
	$pagos_online->ResetAttrs();
	$pagos_online->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$pagos_online_delete->LoadRowValues($pagos_online_delete->Recordset);

	// Render row
	$pagos_online_delete->RenderRow();
?>
	<tr<?php echo $pagos_online->RowAttributes() ?>>
		<td<?php echo $pagos_online->idpagosonline->CellAttributes() ?>>
<div<?php echo $pagos_online->idpagosonline->ViewAttributes() ?>><?php echo $pagos_online->idpagosonline->ListViewValue() ?></div></td>
		<td<?php echo $pagos_online->usuarioid->CellAttributes() ?>>
<div<?php echo $pagos_online->usuarioid->ViewAttributes() ?>><?php echo $pagos_online->usuarioid->ListViewValue() ?></div></td>
		<td<?php echo $pagos_online->llave_encripcion->CellAttributes() ?>>
<div<?php echo $pagos_online->llave_encripcion->ViewAttributes() ?>><?php echo $pagos_online->llave_encripcion->ListViewValue() ?></div></td>
		<td<?php echo $pagos_online->url->CellAttributes() ?>>
<div<?php echo $pagos_online->url->ViewAttributes() ?>><?php echo $pagos_online->url->ListViewValue() ?></div></td>
	</tr>
<?php
	$pagos_online_delete->Recordset->MoveNext();
}
$pagos_online_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$pagos_online_delete->ShowPageFooter();
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
$pagos_online_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpagos_online_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'pagos_online';

	// Page object name
	var $PageObjName = 'pagos_online_delete';

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
	function cpagos_online_delete() {
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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("pagos_onlinelist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
		global $Language, $pagos_online;

		// Load key parameters
		$this->RecKeys = $pagos_online->GetRecordKeys(); // Load record keys
		$sFilter = $pagos_online->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("pagos_onlinelist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in pagos_online class, pagos_onlineinfo.php

		$pagos_online->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$pagos_online->CurrentAction = $_POST["a_delete"];
		} else {
			$pagos_online->CurrentAction = "I"; // Display record
		}
		switch ($pagos_online->CurrentAction) {
			case "D": // Delete
				$pagos_online->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($pagos_online->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pagos_online;

		// Call Recordset Selecting event
		$pagos_online->Recordset_Selecting($pagos_online->CurrentFilter);

		// Load List page SQL
		$sSql = $pagos_online->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pagos_online->Recordset_Selected($rs);
		return $rs;
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
		}

		// Call Row Rendered event
		if ($pagos_online->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pagos_online->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $pagos_online;
		$DeleteRows = TRUE;
		$sSql = $pagos_online->SQL();
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
				$DeleteRows = $pagos_online->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['idpagosonline'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($pagos_online->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($pagos_online->CancelMessage <> "") {
				$this->setFailureMessage($pagos_online->CancelMessage);
				$pagos_online->CancelMessage = "";
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
				$pagos_online->Row_Deleted($row);
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
