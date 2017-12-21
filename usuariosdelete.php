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
$usuarios_delete = new cusuarios_delete();
$Page =& $usuarios_delete;

// Page init
$usuarios_delete->Page_Init();

// Page main
$usuarios_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_delete = new ew_Page("usuarios_delete");

// page properties
usuarios_delete.PageID = "delete"; // page ID
usuarios_delete.FormID = "fusuariosdelete"; // form ID
var EW_PAGE_ID = usuarios_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuarios_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_delete.ValidateRequired = false; // no JavaScript validation
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
if ($usuarios_delete->Recordset = $usuarios_delete->LoadRecordset())
	$usuarios_deleteTotalRecs = $usuarios_delete->Recordset->RecordCount(); // Get record count
if ($usuarios_deleteTotalRecs <= 0) { // No record found, exit
	if ($usuarios_delete->Recordset)
		$usuarios_delete->Recordset->Close();
	$usuarios_delete->Page_Terminate("usuarioslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $usuarios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $usuarios_delete->ShowPageHeader(); ?>
<?php
$usuarios_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="usuarios">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($usuarios_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $usuarios->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $usuarios->idusuario->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->username->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->zemail->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->empresa->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->nit_empresa->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->fecha_creacion->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->activo->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->nivel->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$usuarios_delete->RecCnt = 0;
$i = 0;
while (!$usuarios_delete->Recordset->EOF) {
	$usuarios_delete->RecCnt++;

	// Set row properties
	$usuarios->ResetAttrs();
	$usuarios->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$usuarios_delete->LoadRowValues($usuarios_delete->Recordset);

	// Render row
	$usuarios_delete->RenderRow();
?>
	<tr<?php echo $usuarios->RowAttributes() ?>>
		<td<?php echo $usuarios->idusuario->CellAttributes() ?>>
<div<?php echo $usuarios->idusuario->ViewAttributes() ?>><?php echo $usuarios->idusuario->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->username->CellAttributes() ?>>
<div<?php echo $usuarios->username->ViewAttributes() ?>><?php echo $usuarios->username->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->zemail->CellAttributes() ?>>
<div<?php echo $usuarios->zemail->ViewAttributes() ?>><?php echo $usuarios->zemail->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->empresa->CellAttributes() ?>>
<div<?php echo $usuarios->empresa->ViewAttributes() ?>><?php echo $usuarios->empresa->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->nit_empresa->CellAttributes() ?>>
<div<?php echo $usuarios->nit_empresa->ViewAttributes() ?>><?php echo $usuarios->nit_empresa->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->fecha_creacion->CellAttributes() ?>>
<div<?php echo $usuarios->fecha_creacion->ViewAttributes() ?>><?php echo $usuarios->fecha_creacion->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->activo->CellAttributes() ?>>
<div<?php echo $usuarios->activo->ViewAttributes() ?>><?php echo $usuarios->activo->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->nivel->CellAttributes() ?>>
<div<?php echo $usuarios->nivel->ViewAttributes() ?>><?php echo $usuarios->nivel->ListViewValue() ?></div></td>
	</tr>
<?php
	$usuarios_delete->Recordset->MoveNext();
}
$usuarios_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$usuarios_delete->ShowPageFooter();
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
$usuarios_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarios_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'usuarios';

	// Page object name
	var $PageObjName = 'usuarios_delete';

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
	function cusuarios_delete() {
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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
		global $Language, $usuarios;

		// Load key parameters
		$this->RecKeys = $usuarios->GetRecordKeys(); // Load record keys
		$sFilter = $usuarios->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("usuarioslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in usuarios class, usuariosinfo.php

		$usuarios->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$usuarios->CurrentAction = $_POST["a_delete"];
		} else {
			$usuarios->CurrentAction = "I"; // Display record
		}
		switch ($usuarios->CurrentAction) {
			case "D": // Delete
				$usuarios->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($usuarios->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $usuarios;
		$DeleteRows = TRUE;
		$sSql = $usuarios->SQL();
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
				$DeleteRows = $usuarios->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['idusuario'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($usuarios->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($usuarios->CancelMessage <> "") {
				$this->setFailureMessage($usuarios->CancelMessage);
				$usuarios->CancelMessage = "";
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
				$usuarios->Row_Deleted($row);
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
