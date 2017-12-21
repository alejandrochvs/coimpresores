<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "nivelesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$niveles_delete = new cniveles_delete();
$Page =& $niveles_delete;

// Page init
$niveles_delete->Page_Init();

// Page main
$niveles_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var niveles_delete = new ew_Page("niveles_delete");

// page properties
niveles_delete.PageID = "delete"; // page ID
niveles_delete.FormID = "fnivelesdelete"; // form ID
var EW_PAGE_ID = niveles_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
niveles_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
niveles_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
niveles_delete.ValidateRequired = false; // no JavaScript validation
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
if ($niveles_delete->Recordset = $niveles_delete->LoadRecordset())
	$niveles_deleteTotalRecs = $niveles_delete->Recordset->RecordCount(); // Get record count
if ($niveles_deleteTotalRecs <= 0) { // No record found, exit
	if ($niveles_delete->Recordset)
		$niveles_delete->Recordset->Close();
	$niveles_delete->Page_Terminate("niveleslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $niveles->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $niveles->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $niveles_delete->ShowPageHeader(); ?>
<?php
$niveles_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="niveles">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($niveles_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $niveles->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $niveles->idnivel->FldCaption() ?></td>
		<td valign="top"><?php echo $niveles->nombrenivel->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$niveles_delete->RecCnt = 0;
$i = 0;
while (!$niveles_delete->Recordset->EOF) {
	$niveles_delete->RecCnt++;

	// Set row properties
	$niveles->ResetAttrs();
	$niveles->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$niveles_delete->LoadRowValues($niveles_delete->Recordset);

	// Render row
	$niveles_delete->RenderRow();
?>
	<tr<?php echo $niveles->RowAttributes() ?>>
		<td<?php echo $niveles->idnivel->CellAttributes() ?>>
<div<?php echo $niveles->idnivel->ViewAttributes() ?>><?php echo $niveles->idnivel->ListViewValue() ?></div></td>
		<td<?php echo $niveles->nombrenivel->CellAttributes() ?>>
<div<?php echo $niveles->nombrenivel->ViewAttributes() ?>><?php echo $niveles->nombrenivel->ListViewValue() ?></div></td>
	</tr>
<?php
	$niveles_delete->Recordset->MoveNext();
}
$niveles_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$niveles_delete->ShowPageFooter();
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
$niveles_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cniveles_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'niveles';

	// Page object name
	var $PageObjName = 'niveles_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $niveles;
		if ($niveles->UseTokenInUrl) $PageUrl .= "t=" . $niveles->TableVar . "&"; // Add page token
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
		global $objForm, $niveles;
		if ($niveles->UseTokenInUrl) {
			if ($objForm)
				return ($niveles->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($niveles->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cniveles_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (niveles)
		if (!isset($GLOBALS["niveles"])) {
			$GLOBALS["niveles"] = new cniveles();
			$GLOBALS["Table"] =& $GLOBALS["niveles"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'niveles', TRUE);

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
		global $niveles;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $Language, $niveles;

		// Load key parameters
		$this->RecKeys = $niveles->GetRecordKeys(); // Load record keys
		$sFilter = $niveles->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("niveleslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in niveles class, nivelesinfo.php

		$niveles->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$niveles->CurrentAction = $_POST["a_delete"];
		} else {
			$niveles->CurrentAction = "I"; // Display record
		}
		switch ($niveles->CurrentAction) {
			case "D": // Delete
				$niveles->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($niveles->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $niveles;

		// Call Recordset Selecting event
		$niveles->Recordset_Selecting($niveles->CurrentFilter);

		// Load List page SQL
		$sSql = $niveles->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$niveles->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $niveles;
		$sFilter = $niveles->KeyFilter();

		// Call Row Selecting event
		$niveles->Row_Selecting($sFilter);

		// Load SQL based on filter
		$niveles->CurrentFilter = $sFilter;
		$sSql = $niveles->SQL();
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
		global $conn, $niveles;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$niveles->Row_Selected($row);
		$niveles->idnivel->setDbValue($rs->fields('idnivel'));
		if (is_null($niveles->idnivel->CurrentValue)) {
			$niveles->idnivel->CurrentValue = 0;
		} else {
			$niveles->idnivel->CurrentValue = intval($niveles->idnivel->CurrentValue);
		}
		$niveles->nombrenivel->setDbValue($rs->fields('nombrenivel'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $niveles;

		// Initialize URLs
		// Call Row_Rendering event

		$niveles->Row_Rendering();

		// Common render codes for all row types
		// idnivel
		// nombrenivel

		if ($niveles->RowType == EW_ROWTYPE_VIEW) { // View row

			// idnivel
			$niveles->idnivel->ViewValue = $niveles->idnivel->CurrentValue;
			$niveles->idnivel->ViewCustomAttributes = "";

			// nombrenivel
			$niveles->nombrenivel->ViewValue = $niveles->nombrenivel->CurrentValue;
			$niveles->nombrenivel->ViewCustomAttributes = "";

			// idnivel
			$niveles->idnivel->LinkCustomAttributes = "";
			$niveles->idnivel->HrefValue = "";
			$niveles->idnivel->TooltipValue = "";

			// nombrenivel
			$niveles->nombrenivel->LinkCustomAttributes = "";
			$niveles->nombrenivel->HrefValue = "";
			$niveles->nombrenivel->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($niveles->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$niveles->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $niveles;
		$DeleteRows = TRUE;
		$sSql = $niveles->SQL();
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
				$DeleteRows = $niveles->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['idnivel'];
				$x_idnivel = $row['idnivel']; // Get User Level id
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($niveles->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
				if (!is_null($x_idnivel)) {
					$conn->Execute("DELETE FROM " . EW_USER_LEVEL_PRIV_TABLE . " WHERE " . EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD . " = " . $x_idnivel); // Delete user rights as well
				}
			}
		} else {

			// Set up error message
			if ($niveles->CancelMessage <> "") {
				$this->setFailureMessage($niveles->CancelMessage);
				$niveles->CancelMessage = "";
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
				$niveles->Row_Deleted($row);
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
