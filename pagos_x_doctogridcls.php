<?php include_once "usuariosinfo.php" ?>
<?php

//
// Page class
//
class cpagos_x_docto_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'pagos_x_docto';

	// Page object name
	var $PageObjName = 'pagos_x_docto_grid';

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
	function cpagos_x_docto_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pagos_x_docto)
		if (!isset($GLOBALS["pagos_x_docto"])) {
			$GLOBALS["pagos_x_docto"] = new cpagos_x_docto();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["pagos_x_docto"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pagos_x_docto', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("pagos_x_doctolist.php");
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$pagos_x_docto->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

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
		global $pagos_x_docto;

//		$GLOBALS["Table"] =& $GLOBALS["MasterTable"];
		if ($url == "")
			return;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $pagos_x_docto;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

			// Hide all options
			if ($pagos_x_docto->Export <> "" ||
				$pagos_x_docto->CurrentAction == "gridadd" ||
				$pagos_x_docto->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($pagos_x_docto->AllowAddDeleteRow) {
				if ($pagos_x_docto->CurrentAction == "gridadd" ||
					$pagos_x_docto->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($pagos_x_docto->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $pagos_x_docto->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $pagos_x_docto->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $pagos_x_docto->getDetailFilter(); // Restore detail filter

		// Add master User ID filter
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			if ($pagos_x_docto->getCurrentMasterTable() == "historial_pagos")
				$this->DbMasterFilter = $pagos_x_docto->AddMasterUserIDFilter($this->DbMasterFilter, "historial_pagos"); // Add master User ID filter
		}
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($pagos_x_docto->getMasterFilter() <> "" && $pagos_x_docto->getCurrentMasterTable() == "historial_pagos") {
			global $historial_pagos;
			$rsmaster = $historial_pagos->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($pagos_x_docto->getReturnUrl()); // Return to caller
			} else {
				$historial_pagos->LoadListRowValues($rsmaster);
				$historial_pagos->RowType = EW_ROWTYPE_MASTER; // Master row
				$historial_pagos->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$pagos_x_docto->setSessionWhere($sFilter);
		$pagos_x_docto->CurrentFilter = "";
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $pagos_x_docto;
		$pagos_x_docto->LastAction = $pagos_x_docto->CurrentAction; // Save last action
		$pagos_x_docto->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError, $pagos_x_docto;
		$bGridUpdate = TRUE;

		// Get old recordset
		$pagos_x_docto->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $pagos_x_docto->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue("k_key"));
			$rowaction = strval($objForm->GetValue("k_action"));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$pagos_x_docto->CurrentFilter = $pagos_x_docto->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$pagos_x_docto->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$pagos_x_docto->EventCancelled = TRUE; // Set event cancelled
			$pagos_x_docto->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $pagos_x_docto;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $pagos_x_docto->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $pagos_x_docto;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$pagos_x_docto->iddoctocontable->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($pagos_x_docto->iddoctocontable->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $pagos_x_docto;
		$rowindex = 1;
		$bGridInsert = FALSE;

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($objForm->GetValue("k_oldkey"));
				$this->LoadOldRecord(); // Load old recordset
			}
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$pagos_x_docto->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $pagos_x_docto->iddoctocontable->CurrentValue;

					// Add filter for this record
					$sFilter = $pagos_x_docto->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->ClearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($bGridInsert) {

			// Get new recordset
			$pagos_x_docto->CurrentFilter = $sWrkFilter;
			$sSql = $pagos_x_docto->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$pagos_x_docto->EventCancelled = TRUE; // Set event cancelled
			$pagos_x_docto->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $pagos_x_docto, $objForm;
		if ($objForm->HasValue("x_tipo_docto") && $objForm->HasValue("o_tipo_docto") && $pagos_x_docto->tipo_docto->CurrentValue <> $pagos_x_docto->tipo_docto->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_consec_docto") && $objForm->HasValue("o_consec_docto") && $pagos_x_docto->consec_docto->CurrentValue <> $pagos_x_docto->consec_docto->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_valor") && $objForm->HasValue("o_valor") && $pagos_x_docto->valor->CurrentValue <> $pagos_x_docto->valor->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_cia") && $objForm->HasValue("o_cia") && $pagos_x_docto->cia->CurrentValue <> $pagos_x_docto->cia->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_nit") && $objForm->HasValue("o_nit") && $pagos_x_docto->nit->CurrentValue <> $pagos_x_docto->nit->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha") && $objForm->HasValue("o_fecha") && $pagos_x_docto->fecha->CurrentValue <> $pagos_x_docto->fecha->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_dias_vencidos") && $objForm->HasValue("o_dias_vencidos") && $pagos_x_docto->dias_vencidos->CurrentValue <> $pagos_x_docto->dias_vencidos->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado") && $objForm->HasValue("o_estado") && $pagos_x_docto->estado->CurrentValue <> $pagos_x_docto->estado->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado_pago") && $objForm->HasValue("o_estado_pago") && $pagos_x_docto->estado_pago->CurrentValue <> $pagos_x_docto->estado_pago->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_vencimiento") && $objForm->HasValue("o_fecha_vencimiento") && $pagos_x_docto->fecha_vencimiento->CurrentValue <> $pagos_x_docto->fecha_vencimiento->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_monto_pago") && $objForm->HasValue("o_monto_pago") && $pagos_x_docto->monto_pago->CurrentValue <> $pagos_x_docto->monto_pago->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $pagos_x_docto;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pagos_x_docto;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pagos_x_docto->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pagos_x_docto->CurrentOrderType = @$_GET["ordertype"];
			$pagos_x_docto->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $pagos_x_docto;
		$sOrderBy = $pagos_x_docto->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($pagos_x_docto->SqlOrderBy() <> "") {
				$sOrderBy = $pagos_x_docto->SqlOrderBy();
				$pagos_x_docto->setSessionOrderBy($sOrderBy);
				$pagos_x_docto->fecha->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $pagos_x_docto;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$pagos_x_docto->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$pagos_x_docto->historial->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$pagos_x_docto->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$pagos_x_docto->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $pagos_x_docto;

		// "griddelete"
		if ($pagos_x_docto->AllowAddDeleteRow) {
			$item =& $this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = FALSE;
			$item->Visible = FALSE; // Default hidden
		}

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $pagos_x_docto, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex)) {
			$objForm->Index = $this->RowIndex;
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_action\" id=\"k" . $this->RowIndex . "_action\" value=\"" . $this->RowAction . "\">";
			if ($objForm->HasValue("k_oldkey"))
				$this->RowOldKey = strval($objForm->GetValue("k_oldkey"));
			if ($this->RowOldKey <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_oldkey\" id=\"k" . $this->RowIndex . "_oldkey\" value=\"" . ew_HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue("k_key");
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $pagos_x_docto->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($pagos_x_docto->AllowAddDeleteRow) {
			if ($pagos_x_docto->CurrentMode == "add" || $pagos_x_docto->CurrentMode == "copy" || $pagos_x_docto->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, pagos_x_docto_grid, " . $this->RowIndex . ");\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
				}
			}
		}
		if ($pagos_x_docto->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $pagos_x_docto->iddoctocontable->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('iddoctocontable');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $pagos_x_docto;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pagos_x_docto;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$pagos_x_docto->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$pagos_x_docto->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $pagos_x_docto->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$pagos_x_docto->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$pagos_x_docto->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$pagos_x_docto->setStartRecordNumber($this->StartRec);
		}
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
		$pagos_x_docto->iddoctocontable->CurrentValue = NULL;
		$pagos_x_docto->iddoctocontable->OldValue = $pagos_x_docto->iddoctocontable->CurrentValue;
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
		$pagos_x_docto->fecha->CurrentValue = NULL;
		$pagos_x_docto->fecha->OldValue = $pagos_x_docto->fecha->CurrentValue;
		$pagos_x_docto->dias_vencidos->CurrentValue = NULL;
		$pagos_x_docto->dias_vencidos->OldValue = $pagos_x_docto->dias_vencidos->CurrentValue;
		$pagos_x_docto->estado->CurrentValue = NULL;
		$pagos_x_docto->estado->OldValue = $pagos_x_docto->estado->CurrentValue;
		$pagos_x_docto->estado_pago->CurrentValue = NULL;
		$pagos_x_docto->estado_pago->OldValue = $pagos_x_docto->estado_pago->CurrentValue;
		$pagos_x_docto->fecha_vencimiento->CurrentValue = NULL;
		$pagos_x_docto->fecha_vencimiento->OldValue = $pagos_x_docto->fecha_vencimiento->CurrentValue;
		$pagos_x_docto->monto_pago->CurrentValue = NULL;
		$pagos_x_docto->monto_pago->OldValue = $pagos_x_docto->monto_pago->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pagos_x_docto;
		if (!$pagos_x_docto->iddoctocontable->FldIsDetailKey && $pagos_x_docto->CurrentAction <> "gridadd" && $pagos_x_docto->CurrentAction <> "add")
			$pagos_x_docto->iddoctocontable->setFormValue($objForm->GetValue("x_iddoctocontable"));
		if (!$pagos_x_docto->tipo_docto->FldIsDetailKey) {
			$pagos_x_docto->tipo_docto->setFormValue($objForm->GetValue("x_tipo_docto"));
		}
		$pagos_x_docto->tipo_docto->setOldValue($objForm->GetValue("o_tipo_docto"));
		if (!$pagos_x_docto->consec_docto->FldIsDetailKey) {
			$pagos_x_docto->consec_docto->setFormValue($objForm->GetValue("x_consec_docto"));
		}
		$pagos_x_docto->consec_docto->setOldValue($objForm->GetValue("o_consec_docto"));
		if (!$pagos_x_docto->valor->FldIsDetailKey) {
			$pagos_x_docto->valor->setFormValue($objForm->GetValue("x_valor"));
		}
		$pagos_x_docto->valor->setOldValue($objForm->GetValue("o_valor"));
		if (!$pagos_x_docto->cia->FldIsDetailKey) {
			$pagos_x_docto->cia->setFormValue($objForm->GetValue("x_cia"));
		}
		$pagos_x_docto->cia->setOldValue($objForm->GetValue("o_cia"));
		if (!$pagos_x_docto->nit->FldIsDetailKey) {
			$pagos_x_docto->nit->setFormValue($objForm->GetValue("x_nit"));
		}
		$pagos_x_docto->nit->setOldValue($objForm->GetValue("o_nit"));
		if (!$pagos_x_docto->fecha->FldIsDetailKey) {
			$pagos_x_docto->fecha->setFormValue($objForm->GetValue("x_fecha"));
			$pagos_x_docto->fecha->CurrentValue = ew_UnFormatDateTime($pagos_x_docto->fecha->CurrentValue, 0);
		}
		$pagos_x_docto->fecha->setOldValue($objForm->GetValue("o_fecha"));
		if (!$pagos_x_docto->dias_vencidos->FldIsDetailKey) {
			$pagos_x_docto->dias_vencidos->setFormValue($objForm->GetValue("x_dias_vencidos"));
		}
		$pagos_x_docto->dias_vencidos->setOldValue($objForm->GetValue("o_dias_vencidos"));
		if (!$pagos_x_docto->estado->FldIsDetailKey) {
			$pagos_x_docto->estado->setFormValue($objForm->GetValue("x_estado"));
		}
		$pagos_x_docto->estado->setOldValue($objForm->GetValue("o_estado"));
		if (!$pagos_x_docto->estado_pago->FldIsDetailKey) {
			$pagos_x_docto->estado_pago->setFormValue($objForm->GetValue("x_estado_pago"));
		}
		$pagos_x_docto->estado_pago->setOldValue($objForm->GetValue("o_estado_pago"));
		if (!$pagos_x_docto->fecha_vencimiento->FldIsDetailKey) {
			$pagos_x_docto->fecha_vencimiento->setFormValue($objForm->GetValue("x_fecha_vencimiento"));
			$pagos_x_docto->fecha_vencimiento->CurrentValue = ew_UnFormatDateTime($pagos_x_docto->fecha_vencimiento->CurrentValue, 0);
		}
		$pagos_x_docto->fecha_vencimiento->setOldValue($objForm->GetValue("o_fecha_vencimiento"));
		if (!$pagos_x_docto->monto_pago->FldIsDetailKey) {
			$pagos_x_docto->monto_pago->setFormValue($objForm->GetValue("x_monto_pago"));
		}
		$pagos_x_docto->monto_pago->setOldValue($objForm->GetValue("o_monto_pago"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pagos_x_docto;
		if ($pagos_x_docto->CurrentAction <> "gridadd" && $pagos_x_docto->CurrentAction <> "add")
			$pagos_x_docto->iddoctocontable->CurrentValue = $pagos_x_docto->iddoctocontable->FormValue;
		$pagos_x_docto->tipo_docto->CurrentValue = $pagos_x_docto->tipo_docto->FormValue;
		$pagos_x_docto->consec_docto->CurrentValue = $pagos_x_docto->consec_docto->FormValue;
		$pagos_x_docto->valor->CurrentValue = $pagos_x_docto->valor->FormValue;
		$pagos_x_docto->cia->CurrentValue = $pagos_x_docto->cia->FormValue;
		$pagos_x_docto->nit->CurrentValue = $pagos_x_docto->nit->FormValue;
		$pagos_x_docto->fecha->CurrentValue = $pagos_x_docto->fecha->FormValue;
		$pagos_x_docto->fecha->CurrentValue = ew_UnFormatDateTime($pagos_x_docto->fecha->CurrentValue, 0);
		$pagos_x_docto->dias_vencidos->CurrentValue = $pagos_x_docto->dias_vencidos->FormValue;
		$pagos_x_docto->estado->CurrentValue = $pagos_x_docto->estado->FormValue;
		$pagos_x_docto->estado_pago->CurrentValue = $pagos_x_docto->estado_pago->FormValue;
		$pagos_x_docto->fecha_vencimiento->CurrentValue = $pagos_x_docto->fecha_vencimiento->FormValue;
		$pagos_x_docto->fecha_vencimiento->CurrentValue = ew_UnFormatDateTime($pagos_x_docto->fecha_vencimiento->CurrentValue, 0);
		$pagos_x_docto->monto_pago->CurrentValue = $pagos_x_docto->monto_pago->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pagos_x_docto;

		// Call Recordset Selecting event
		$pagos_x_docto->Recordset_Selecting($pagos_x_docto->CurrentFilter);

		// Load List page SQL
		$sSql = $pagos_x_docto->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pagos_x_docto->Recordset_Selected($rs);
		return $rs;
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
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$pagos_x_docto->iddoctocontable->CurrentValue = strval($arKeys[0]); // iddoctocontable
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

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
			$pagos_x_docto->valor->ViewValue = ew_FormatCurrency($pagos_x_docto->valor->ViewValue, 0, -2, -2, -2);
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

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->ViewValue = $pagos_x_docto->fecha_vencimiento->CurrentValue;
			$pagos_x_docto->fecha_vencimiento->ViewCustomAttributes = "";

			// monto_pago
			$pagos_x_docto->monto_pago->ViewValue = $pagos_x_docto->monto_pago->CurrentValue;
			$pagos_x_docto->monto_pago->ViewValue = ew_FormatCurrency($pagos_x_docto->monto_pago->ViewValue, 0, -2, -2, -2);
			$pagos_x_docto->monto_pago->ViewCustomAttributes = "";

			// iddoctocontable
			$pagos_x_docto->iddoctocontable->LinkCustomAttributes = "";
			$pagos_x_docto->iddoctocontable->HrefValue = "";
			$pagos_x_docto->iddoctocontable->TooltipValue = "";

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

			// estado_pago
			$pagos_x_docto->estado_pago->LinkCustomAttributes = "";
			$pagos_x_docto->estado_pago->HrefValue = "";
			$pagos_x_docto->estado_pago->TooltipValue = "";

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->LinkCustomAttributes = "";
			$pagos_x_docto->fecha_vencimiento->HrefValue = "";
			$pagos_x_docto->fecha_vencimiento->TooltipValue = "";

			// monto_pago
			$pagos_x_docto->monto_pago->LinkCustomAttributes = "";
			$pagos_x_docto->monto_pago->HrefValue = "";
			$pagos_x_docto->monto_pago->TooltipValue = "";
		} elseif ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add row

			// iddoctocontable
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

			// fecha
			$pagos_x_docto->fecha->EditCustomAttributes = "";
			$pagos_x_docto->fecha->EditValue = ew_HtmlEncode($pagos_x_docto->fecha->CurrentValue);

			// dias_vencidos
			$pagos_x_docto->dias_vencidos->EditCustomAttributes = "";
			$pagos_x_docto->dias_vencidos->EditValue = ew_HtmlEncode($pagos_x_docto->dias_vencidos->CurrentValue);

			// estado
			$pagos_x_docto->estado->EditCustomAttributes = "";
			$pagos_x_docto->estado->EditValue = ew_HtmlEncode($pagos_x_docto->estado->CurrentValue);

			// estado_pago
			$pagos_x_docto->estado_pago->EditCustomAttributes = "";
			$pagos_x_docto->estado_pago->EditValue = ew_HtmlEncode($pagos_x_docto->estado_pago->CurrentValue);

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->EditCustomAttributes = "";
			$pagos_x_docto->fecha_vencimiento->EditValue = ew_HtmlEncode($pagos_x_docto->fecha_vencimiento->CurrentValue);

			// monto_pago
			$pagos_x_docto->monto_pago->EditCustomAttributes = "";
			$pagos_x_docto->monto_pago->EditValue = ew_HtmlEncode($pagos_x_docto->monto_pago->CurrentValue);

			// Edit refer script
			// iddoctocontable

			$pagos_x_docto->iddoctocontable->HrefValue = "";

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

			// fecha
			$pagos_x_docto->fecha->HrefValue = "";

			// dias_vencidos
			$pagos_x_docto->dias_vencidos->HrefValue = "";

			// estado
			$pagos_x_docto->estado->HrefValue = "";

			// estado_pago
			$pagos_x_docto->estado_pago->HrefValue = "";

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->HrefValue = "";

			// monto_pago
			$pagos_x_docto->monto_pago->HrefValue = "";
		} elseif ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// iddoctocontable
			$pagos_x_docto->iddoctocontable->EditCustomAttributes = "";
			$pagos_x_docto->iddoctocontable->EditValue = $pagos_x_docto->iddoctocontable->CurrentValue;
			$pagos_x_docto->iddoctocontable->ViewCustomAttributes = "";

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

			// fecha
			$pagos_x_docto->fecha->EditCustomAttributes = "";
			$pagos_x_docto->fecha->EditValue = ew_HtmlEncode($pagos_x_docto->fecha->CurrentValue);

			// dias_vencidos
			$pagos_x_docto->dias_vencidos->EditCustomAttributes = "";
			$pagos_x_docto->dias_vencidos->EditValue = ew_HtmlEncode($pagos_x_docto->dias_vencidos->CurrentValue);

			// estado
			$pagos_x_docto->estado->EditCustomAttributes = "";
			$pagos_x_docto->estado->EditValue = ew_HtmlEncode($pagos_x_docto->estado->CurrentValue);

			// estado_pago
			$pagos_x_docto->estado_pago->EditCustomAttributes = "";
			$pagos_x_docto->estado_pago->EditValue = ew_HtmlEncode($pagos_x_docto->estado_pago->CurrentValue);

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->EditCustomAttributes = "";
			$pagos_x_docto->fecha_vencimiento->EditValue = ew_HtmlEncode($pagos_x_docto->fecha_vencimiento->CurrentValue);

			// monto_pago
			$pagos_x_docto->monto_pago->EditCustomAttributes = "";
			$pagos_x_docto->monto_pago->EditValue = ew_HtmlEncode($pagos_x_docto->monto_pago->CurrentValue);

			// Edit refer script
			// iddoctocontable

			$pagos_x_docto->iddoctocontable->HrefValue = "";

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

			// fecha
			$pagos_x_docto->fecha->HrefValue = "";

			// dias_vencidos
			$pagos_x_docto->dias_vencidos->HrefValue = "";

			// estado
			$pagos_x_docto->estado->HrefValue = "";

			// estado_pago
			$pagos_x_docto->estado_pago->HrefValue = "";

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

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $pagos_x_docto;
		$DeleteRows = TRUE;
		$sSql = $pagos_x_docto->SQL();
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

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $pagos_x_docto->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($pagos_x_docto->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($pagos_x_docto->CancelMessage <> "") {
				$this->setFailureMessage($pagos_x_docto->CancelMessage);
				$pagos_x_docto->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$pagos_x_docto->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $pagos_x_docto;
		$sFilter = $pagos_x_docto->KeyFilter();
		$pagos_x_docto->CurrentFilter = $sFilter;
		$sSql = $pagos_x_docto->SQL();
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

			// tipo_docto
			$pagos_x_docto->tipo_docto->SetDbValueDef($rsnew, $pagos_x_docto->tipo_docto->CurrentValue, "", $pagos_x_docto->tipo_docto->ReadOnly);

			// consec_docto
			$pagos_x_docto->consec_docto->SetDbValueDef($rsnew, $pagos_x_docto->consec_docto->CurrentValue, 0, $pagos_x_docto->consec_docto->ReadOnly);

			// valor
			$pagos_x_docto->valor->SetDbValueDef($rsnew, $pagos_x_docto->valor->CurrentValue, 0, $pagos_x_docto->valor->ReadOnly);

			// cia
			$pagos_x_docto->cia->SetDbValueDef($rsnew, $pagos_x_docto->cia->CurrentValue, 0, $pagos_x_docto->cia->ReadOnly);

			// nit
			$pagos_x_docto->nit->SetDbValueDef($rsnew, $pagos_x_docto->nit->CurrentValue, NULL, $pagos_x_docto->nit->ReadOnly);

			// fecha
			$pagos_x_docto->fecha->SetDbValueDef($rsnew, $pagos_x_docto->fecha->CurrentValue, ew_CurrentDate(), $pagos_x_docto->fecha->ReadOnly);

			// dias_vencidos
			$pagos_x_docto->dias_vencidos->SetDbValueDef($rsnew, $pagos_x_docto->dias_vencidos->CurrentValue, NULL, $pagos_x_docto->dias_vencidos->ReadOnly);

			// estado
			$pagos_x_docto->estado->SetDbValueDef($rsnew, $pagos_x_docto->estado->CurrentValue, "", $pagos_x_docto->estado->ReadOnly);

			// estado_pago
			$pagos_x_docto->estado_pago->SetDbValueDef($rsnew, $pagos_x_docto->estado_pago->CurrentValue, 0, $pagos_x_docto->estado_pago->ReadOnly);

			// fecha_vencimiento
			$pagos_x_docto->fecha_vencimiento->SetDbValueDef($rsnew, $pagos_x_docto->fecha_vencimiento->CurrentValue, NULL, $pagos_x_docto->fecha_vencimiento->ReadOnly);

			// monto_pago
			$pagos_x_docto->monto_pago->SetDbValueDef($rsnew, $pagos_x_docto->monto_pago->CurrentValue, NULL, $pagos_x_docto->monto_pago->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $pagos_x_docto->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($pagos_x_docto->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($pagos_x_docto->CancelMessage <> "") {
					$this->setFailureMessage($pagos_x_docto->CancelMessage);
					$pagos_x_docto->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$pagos_x_docto->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $pagos_x_docto;

		// Check if valid key values for master user
		if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$sFilter = $pagos_x_docto->SqlMasterFilter_historial_pagos();
			if (strval($pagos_x_docto->historial->CurrentValue) <> "" &&
				$pagos_x_docto->getCurrentMasterTable() == "historial_pagos") {
				$sFilter = str_replace("@idhistorial_pagos@", ew_AdjustSql($pagos_x_docto->historial->CurrentValue), $sFilter);
			} else {
				$sFilter = "";
			}
			if ($sFilter <> "") {
				$rsmaster = $GLOBALS["historial_pagos"]->LoadRs($sFilter);
				$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
				if (!$this->MasterRecordExists) {
					$sMasterUserIdMsg = str_replace("%c", CurrentUserID(), $Language->Phrase("UnAuthorizedMasterUserID"));
					$sMasterUserIdMsg = str_replace("%f", $sFilter, $sMasterUserIdMsg);
					$this->setFailureMessage($sMasterUserIdMsg);
					return FALSE;
				} else {
					$rsmaster->Close();
				}
			}
		}

		// Set up foreign key field value from Session
			if ($pagos_x_docto->getCurrentMasterTable() == "historial_pagos") {
				$pagos_x_docto->historial->CurrentValue = $pagos_x_docto->historial->getSessionValue();
			}
		$rsnew = array();

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

		// fecha
		$pagos_x_docto->fecha->SetDbValueDef($rsnew, $pagos_x_docto->fecha->CurrentValue, ew_CurrentDate(), FALSE);

		// dias_vencidos
		$pagos_x_docto->dias_vencidos->SetDbValueDef($rsnew, $pagos_x_docto->dias_vencidos->CurrentValue, NULL, FALSE);

		// estado
		$pagos_x_docto->estado->SetDbValueDef($rsnew, $pagos_x_docto->estado->CurrentValue, "", FALSE);

		// estado_pago
		$pagos_x_docto->estado_pago->SetDbValueDef($rsnew, $pagos_x_docto->estado_pago->CurrentValue, 0, FALSE);

		// fecha_vencimiento
		$pagos_x_docto->fecha_vencimiento->SetDbValueDef($rsnew, $pagos_x_docto->fecha_vencimiento->CurrentValue, NULL, FALSE);

		// monto_pago
		$pagos_x_docto->monto_pago->SetDbValueDef($rsnew, $pagos_x_docto->monto_pago->CurrentValue, NULL, FALSE);

		// historial
		if ($pagos_x_docto->historial->getSessionValue() <> "") {
			$rsnew['historial'] = $pagos_x_docto->historial->getSessionValue();
		}

		// usuario
		if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$rsnew['usuario'] = CurrentUserID();
		}

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

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $pagos_x_docto;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($pagos_x_docto->usuario->CurrentValue);
			}
		}
		return TRUE;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $pagos_x_docto;

		// Hide foreign keys
		$sMasterTblVar = $pagos_x_docto->getCurrentMasterTable();
		if ($sMasterTblVar == "historial_pagos") {
			$pagos_x_docto->historial->Visible = FALSE;
			if ($GLOBALS["historial_pagos"]->EventCancelled) $pagos_x_docto->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $pagos_x_docto->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $pagos_x_docto->getDetailFilter(); // Get detail filter
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("", "");
		$dompdf->render();
		ob_end_clean();
		ew_DeleteTmpImages();
		$dompdf->stream($gsExportFile . ".pdf", array("Attachment" => 1)); // 0 to open in browser, 1 to download

//		exit();
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
