<?php

// Global variable for table object
$historial_pagos = NULL;

//
// Table class for historial_pagos
//
class chistorial_pagos {
	var $TableVar = 'historial_pagos';
	var $TableName = 'historial_pagos';
	var $TableType = 'TABLE';
	var $idhistorial_pagos;
	var $usuario;
	var $tipo_docto;
	var $consec_docto;
	var $estado_pago;
	var $ref_venta;
	var $fecha_hora_creacion;
	var $riesgo;
	var $medio_pago;
	var $respuesta_pol;
	var $monto_pago;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $ExportPageBreakCount = 0; // Page break per every n record (PDF only)
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes

	// Reset attributes for table object
	function ResetAttrs() {
		$this->CssClass = "";
		$this->CssStyle = "";
    	$this->RowAttrs = array();
		foreach ($this->fields as $fld) {
			$fld->ResetAttrs();
		}
	}

	// Setup field titles
	function SetupFieldTitles() {
		foreach ($this->fields as &$fld) {
			if (strval($fld->FldTitle()) <> "") {
				$fld->EditAttrs["onmouseover"] = "ew_ShowTitle(this, '" . ew_JsEncode3($fld->FldTitle()) . "');";
				$fld->EditAttrs["onmouseout"] = "ew_HideTooltip();";
			}
		}
	}
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $LastAction; // Last action
	var $CurrentMode = ""; // Current mode
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $AllowAddDeleteRow = TRUE; // Allow add/delete row
	var $DetailAdd = FALSE; // Allow detail add
	var $DetailEdit = FALSE; // Allow detail edit
	var $GridAddRowCount = 5;

	// Check current action
	// - Add
	function IsAdd() {
		return $this->CurrentAction == "add";
	}

	// - Copy
	function IsCopy() {
		return $this->CurrentAction == "copy" || $this->CurrentAction == "C";
	}

	// - Edit
	function IsEdit() {
		return $this->CurrentAction == "edit";
	}

	// - Delete
	function IsDelete() {
		return $this->CurrentAction == "D";
	}

	// - Confirm
	function IsConfirm() {
		return $this->CurrentAction == "F";
	}

	// - Overwrite
	function IsOverwrite() {
		return $this->CurrentAction == "overwrite";
	}

	// - Cancel
	function IsCancel() {
		return $this->CurrentAction == "cancel";
	}

	// - Grid add
	function IsGridAdd() {
		return $this->CurrentAction == "gridadd";
	}

	// - Grid edit
	function IsGridEdit() {
		return $this->CurrentAction == "gridedit";
	}

	// - Insert
	function IsInsert() {
		return $this->CurrentAction == "insert" || $this->CurrentAction == "A";
	}

	// - Update
	function IsUpdate() {
		return $this->CurrentAction == "update" || $this->CurrentAction == "U";
	}

	// - Grid update
	function IsGridUpdate() {
		return $this->CurrentAction == "gridupdate";
	}

	// - Grid insert
	function IsGridInsert() {
		return $this->CurrentAction == "gridinsert";
	}

	// - Grid overwrite
	function IsGridOverwrite() {
		return $this->CurrentAction == "gridoverwrite";
	}

	// Check last action
	// - Cancelled
	function IsCanceled() {
		return $this->LastAction == "cancel" && $this->CurrentAction == "";
	}

	// - Inline inserted
	function IsInlineInserted() {
		return $this->LastAction == "insert" && $this->CurrentAction == "";
	}

	// - Inline updated
	function IsInlineUpdated() {
		return $this->LastAction == "update" && $this->CurrentAction == "";
	}

	// - Grid updated
	function IsGridUpdated() {
		return $this->LastAction == "gridupdate" && $this->CurrentAction == "";
	}

	// - Grid inserted
	function IsGridInserted() {
		return $this->LastAction == "gridinsert" && $this->CurrentAction == "";
	}

	//
	// Table class constructor
	//
	function chistorial_pagos() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// idhistorial_pagos
		$this->idhistorial_pagos = new cField('historial_pagos', 'historial_pagos', 'x_idhistorial_pagos', 'idhistorial_pagos', '`idhistorial_pagos`', 19, -1, FALSE, '`idhistorial_pagos`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->idhistorial_pagos->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idhistorial_pagos'] =& $this->idhistorial_pagos;

		// usuario
		$this->usuario = new cField('historial_pagos', 'historial_pagos', 'x_usuario', 'usuario', '`usuario`', 19, -1, FALSE, '`usuario`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->usuario->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['usuario'] =& $this->usuario;

		// tipo_docto
		$this->tipo_docto = new cField('historial_pagos', 'historial_pagos', 'x_tipo_docto', 'tipo_docto', '`tipo_docto`', 200, -1, FALSE, '`tipo_docto`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['tipo_docto'] =& $this->tipo_docto;

		// consec_docto
		$this->consec_docto = new cField('historial_pagos', 'historial_pagos', 'x_consec_docto', 'consec_docto', '`consec_docto`', 3, -1, FALSE, '`consec_docto`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->consec_docto->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['consec_docto'] =& $this->consec_docto;

		// estado_pago
		$this->estado_pago = new cField('historial_pagos', 'historial_pagos', 'x_estado_pago', 'estado_pago', '`estado_pago`', 200, -1, FALSE, '`estado_pago`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['estado_pago'] =& $this->estado_pago;

		// ref_venta
		$this->ref_venta = new cField('historial_pagos', 'historial_pagos', 'x_ref_venta', 'ref_venta', '`ref_venta`', 200, -1, FALSE, '`ref_venta`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['ref_venta'] =& $this->ref_venta;

		// fecha_hora_creacion
		$this->fecha_hora_creacion = new cField('historial_pagos', 'historial_pagos', 'x_fecha_hora_creacion', 'fecha_hora_creacion', '`fecha_hora_creacion`', 135, -1, FALSE, '`fecha_hora_creacion`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['fecha_hora_creacion'] =& $this->fecha_hora_creacion;

		// riesgo
		$this->riesgo = new cField('historial_pagos', 'historial_pagos', 'x_riesgo', 'riesgo', '`riesgo`', 200, -1, FALSE, '`riesgo`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['riesgo'] =& $this->riesgo;

		// medio_pago
		$this->medio_pago = new cField('historial_pagos', 'historial_pagos', 'x_medio_pago', 'medio_pago', '`medio_pago`', 200, -1, FALSE, '`medio_pago`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['medio_pago'] =& $this->medio_pago;

		// respuesta_pol
		$this->respuesta_pol = new cField('historial_pagos', 'historial_pagos', 'x_respuesta_pol', 'respuesta_pol', '`respuesta_pol`', 200, -1, FALSE, '`respuesta_pol`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['respuesta_pol'] =& $this->respuesta_pol;

		// monto_pago
		$this->monto_pago = new cField('historial_pagos', 'historial_pagos', 'x_monto_pago', 'monto_pago', '`monto_pago`', 3, -1, FALSE, '`monto_pago`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->monto_pago->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['monto_pago'] =& $this->monto_pago;
	}

	// Get field values
	function GetFieldValues($propertyname) {
		$values = array();
		foreach ($this->fields as $fldname => $fld)
			$values[$fldname] =& $fld->$propertyname;
		return $values;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "historial_pagos_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Current detail table name
	function getCurrentDetailTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE];
	}

	function setCurrentDetailTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	function getDetailUrl() {

		// Detail url
		$sDetailUrl = "";
		if ($this->getCurrentDetailTable() == "pagos_x_docto") {
			$sDetailUrl = $GLOBALS["pagos_x_docto"]->ListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&historial=" . $this->idhistorial_pagos->CurrentValue;
		}
		return $sDetailUrl;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`historial_pagos`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "`idhistorial_pagos` DESC";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		global $Security;

		// Add User ID filter
		if (!$this->AllowAnonymousUser() && $Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$sFilter = $this->AddUserIDFilter($sFilter);
		}
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `historial_pagos` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `historial_pagos` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `historial_pagos` WHERE ";
		$SQL .= ew_QuotedName('idhistorial_pagos') . '=' . ew_QuotedValue($rs['idhistorial_pagos'], $this->idhistorial_pagos->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`idhistorial_pagos` = @idhistorial_pagos@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->idhistorial_pagos->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@idhistorial_pagos@", ew_AdjustSql($this->idhistorial_pagos->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "historial_pagoslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "historial_pagoslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("historial_pagosview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "historial_pagosadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("historial_pagosedit.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("historial_pagosedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("historial_pagosadd.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("historial_pagosadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("historial_pagosdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->idhistorial_pagos->CurrentValue)) {
			$sUrl .= "idhistorial_pagos=" . urlencode($this->idhistorial_pagos->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=historial_pagos" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["idhistorial_pagos"]; // idhistorial_pagos

			//return $arKeys; // do not return yet, so the values will also be checked by the following code
		}

		// check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_numeric($key))
				continue;
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->idhistorial_pagos->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->idhistorial_pagos->setDbValue($rs->fields('idhistorial_pagos'));
		$this->usuario->setDbValue($rs->fields('usuario'));
		$this->tipo_docto->setDbValue($rs->fields('tipo_docto'));
		$this->consec_docto->setDbValue($rs->fields('consec_docto'));
		$this->estado_pago->setDbValue($rs->fields('estado_pago'));
		$this->ref_venta->setDbValue($rs->fields('ref_venta'));
		$this->fecha_hora_creacion->setDbValue($rs->fields('fecha_hora_creacion'));
		$this->riesgo->setDbValue($rs->fields('riesgo'));
		$this->medio_pago->setDbValue($rs->fields('medio_pago'));
		$this->respuesta_pol->setDbValue($rs->fields('respuesta_pol'));
		$this->monto_pago->setDbValue($rs->fields('monto_pago'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
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
		// idhistorial_pagos

		$this->idhistorial_pagos->ViewValue = $this->idhistorial_pagos->CurrentValue;
		$this->idhistorial_pagos->ViewCustomAttributes = "";

		// usuario
		if (strval($this->usuario->CurrentValue) <> "") {
			$sFilterWrk = "`idusuario` = " . ew_AdjustSql($this->usuario->CurrentValue) . "";
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
				$this->usuario->ViewValue = $rswrk->fields('empresa');
				$rswrk->Close();
			} else {
				$this->usuario->ViewValue = $this->usuario->CurrentValue;
			}
		} else {
			$this->usuario->ViewValue = NULL;
		}
		$this->usuario->ViewCustomAttributes = "";

		// tipo_docto
		$this->tipo_docto->ViewValue = $this->tipo_docto->CurrentValue;
		$this->tipo_docto->ViewCustomAttributes = "";

		// consec_docto
		$this->consec_docto->ViewValue = $this->consec_docto->CurrentValue;
		$this->consec_docto->ViewCustomAttributes = "";

		// estado_pago
		$this->estado_pago->ViewValue = $this->estado_pago->CurrentValue;
		$this->estado_pago->ViewCustomAttributes = "";

		// ref_venta
		$this->ref_venta->ViewValue = $this->ref_venta->CurrentValue;
		$this->ref_venta->ViewCustomAttributes = "";

		// fecha_hora_creacion
		$this->fecha_hora_creacion->ViewValue = $this->fecha_hora_creacion->CurrentValue;
		$this->fecha_hora_creacion->ViewCustomAttributes = "";

		// riesgo
		$this->riesgo->ViewValue = $this->riesgo->CurrentValue;
		$this->riesgo->ViewCustomAttributes = "";

		// medio_pago
		$this->medio_pago->ViewValue = $this->medio_pago->CurrentValue;
		$this->medio_pago->ViewCustomAttributes = "";

		// respuesta_pol
		$this->respuesta_pol->ViewValue = $this->respuesta_pol->CurrentValue;
		$this->respuesta_pol->ViewCustomAttributes = "";

		// monto_pago
		$this->monto_pago->ViewValue = $this->monto_pago->CurrentValue;
		$this->monto_pago->ViewValue = ew_FormatCurrency($this->monto_pago->ViewValue, 0, -2, -2, -2);
		$this->monto_pago->ViewCustomAttributes = "";

		// idhistorial_pagos
		$this->idhistorial_pagos->LinkCustomAttributes = "";
		$this->idhistorial_pagos->HrefValue = "";
		$this->idhistorial_pagos->TooltipValue = "";

		// usuario
		$this->usuario->LinkCustomAttributes = "";
		$this->usuario->HrefValue = "";
		$this->usuario->TooltipValue = "";

		// tipo_docto
		$this->tipo_docto->LinkCustomAttributes = "";
		$this->tipo_docto->HrefValue = "";
		$this->tipo_docto->TooltipValue = "";

		// consec_docto
		$this->consec_docto->LinkCustomAttributes = "";
		$this->consec_docto->HrefValue = "";
		$this->consec_docto->TooltipValue = "";

		// estado_pago
		$this->estado_pago->LinkCustomAttributes = "";
		$this->estado_pago->HrefValue = "";
		$this->estado_pago->TooltipValue = "";

		// ref_venta
		$this->ref_venta->LinkCustomAttributes = "";
		$this->ref_venta->HrefValue = "";
		$this->ref_venta->TooltipValue = "";

		// fecha_hora_creacion
		$this->fecha_hora_creacion->LinkCustomAttributes = "";
		$this->fecha_hora_creacion->HrefValue = "";
		$this->fecha_hora_creacion->TooltipValue = "";

		// riesgo
		$this->riesgo->LinkCustomAttributes = "";
		$this->riesgo->HrefValue = "";
		$this->riesgo->TooltipValue = "";

		// medio_pago
		$this->medio_pago->LinkCustomAttributes = "";
		$this->medio_pago->HrefValue = "";
		$this->medio_pago->TooltipValue = "";

		// respuesta_pol
		$this->respuesta_pol->LinkCustomAttributes = "";
		$this->respuesta_pol->HrefValue = "";
		$this->respuesta_pol->TooltipValue = "";

		// monto_pago
		$this->monto_pago->LinkCustomAttributes = "";
		$this->monto_pago->HrefValue = "";
		$this->monto_pago->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Export data in Xml Format
	function ExportXmlDocument(&$XmlDoc, $HasParent, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$XmlDoc)
			return;
		if (!$HasParent)
			$XmlDoc->AddRoot($this->TableVar);

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if ($HasParent)
					$XmlDoc->AddRow($this->TableVar);
				else
					$XmlDoc->AddRow();
				if ($ExportPageType == "view") {
					$XmlDoc->AddField('idhistorial_pagos', $this->idhistorial_pagos->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('usuario', $this->usuario->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('estado_pago', $this->estado_pago->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('ref_venta', $this->ref_venta->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fecha_hora_creacion', $this->fecha_hora_creacion->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('riesgo', $this->riesgo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('respuesta_pol', $this->respuesta_pol->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('monto_pago', $this->monto_pago->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('idhistorial_pagos', $this->idhistorial_pagos->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('usuario', $this->usuario->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tipo_docto', $this->tipo_docto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('consec_docto', $this->consec_docto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('estado_pago', $this->estado_pago->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('ref_venta', $this->ref_venta->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fecha_hora_creacion', $this->fecha_hora_creacion->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('riesgo', $this->riesgo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('medio_pago', $this->medio_pago->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('respuesta_pol', $this->respuesta_pol->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('monto_pago', $this->monto_pago->ExportValue($this->Export, $this->ExportOriginalValue));
				}
			}
			$Recordset->MoveNext();
		}
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;

		// Write header
		$Doc->ExportTableHeader();
		if ($Doc->Horizontal) { // Horizontal format, write header
			$Doc->BeginExportRow();
			if ($ExportPageType == "view") {
				$Doc->ExportCaption($this->idhistorial_pagos);
				$Doc->ExportCaption($this->usuario);
				$Doc->ExportCaption($this->estado_pago);
				$Doc->ExportCaption($this->ref_venta);
				$Doc->ExportCaption($this->fecha_hora_creacion);
				$Doc->ExportCaption($this->riesgo);
				$Doc->ExportCaption($this->respuesta_pol);
				$Doc->ExportCaption($this->monto_pago);
			} else {
				$Doc->ExportCaption($this->idhistorial_pagos);
				$Doc->ExportCaption($this->usuario);
				$Doc->ExportCaption($this->tipo_docto);
				$Doc->ExportCaption($this->consec_docto);
				$Doc->ExportCaption($this->estado_pago);
				$Doc->ExportCaption($this->ref_venta);
				$Doc->ExportCaption($this->fecha_hora_creacion);
				$Doc->ExportCaption($this->riesgo);
				$Doc->ExportCaption($this->medio_pago);
				$Doc->ExportCaption($this->respuesta_pol);
				$Doc->ExportCaption($this->monto_pago);
			}
			if ($this->Export == "pdf") {
				$Doc->EndExportRow(TRUE);
			} else {
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break for PDF
				if ($this->Export == "pdf" && $this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
					$Doc->ExportField($this->idhistorial_pagos);
					$Doc->ExportField($this->usuario);
					$Doc->ExportField($this->estado_pago);
					$Doc->ExportField($this->ref_venta);
					$Doc->ExportField($this->fecha_hora_creacion);
					$Doc->ExportField($this->riesgo);
					$Doc->ExportField($this->respuesta_pol);
					$Doc->ExportField($this->monto_pago);
				} else {
					$Doc->ExportField($this->idhistorial_pagos);
					$Doc->ExportField($this->usuario);
					$Doc->ExportField($this->tipo_docto);
					$Doc->ExportField($this->consec_docto);
					$Doc->ExportField($this->estado_pago);
					$Doc->ExportField($this->ref_venta);
					$Doc->ExportField($this->fecha_hora_creacion);
					$Doc->ExportField($this->riesgo);
					$Doc->ExportField($this->medio_pago);
					$Doc->ExportField($this->respuesta_pol);
					$Doc->ExportField($this->monto_pago);
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}
		$Doc->ExportTableFooter();
	}

	// Add User ID filter
	function AddUserIDFilter($sFilter) {
		global $Security;
		if (!$Security->IsAdmin()) {
			$sFilterWrk = $Security->UserIDList();
			if ($sFilterWrk <> "")
				$sFilterWrk = '`usuario` IN (' . $sFilterWrk . ')';
			ew_AddFilter($sFilterWrk, $sFilter);
			return $sFilterWrk;
		} else {
			return $sFilter;
		}
	}

	// User ID subquery
	function GetUserIDSubquery(&$fld, &$masterfld) {
		global $conn;
		$sWrk = "";
		$sSql = "SELECT " . $masterfld->FldExpression . " FROM `historial_pagos` WHERE " . $this->AddUserIDFilter("");

		// List all values
		if ($rs = $conn->Execute($sSql)) {
			while (!$rs->EOF) {
				if ($sWrk <> "") $sWrk .= ",";
				$sWrk .= ew_QuotedValue($rs->fields[0], $masterfld->FldDataType);
				$rs->MoveNext();
			}
			$rs->Close();
		}
		if ($sWrk <> "") {
			$sWrk = $fld->FldExpression . " IN (" . $sWrk . ")";
		}
		return $sWrk;
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}
}
?>
