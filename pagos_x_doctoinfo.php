<?php

// Global variable for table object
$pagos_x_docto = NULL;

//
// Table class for pagos_x_docto
//
class cpagos_x_docto {
	var $TableVar = 'pagos_x_docto';
	var $TableName = 'pagos_x_docto';
	var $TableType = 'TABLE';
	var $iddoctocontable;
	var $historial;
	var $tipo_docto;
	var $consec_docto;
	var $valor;
	var $cia;
	var $nit;
	var $tercero;
	var $fecha;
	var $dias_vencidos;
	var $estado;
	var $usuario;
	var $estado_pago;
	var $descripcion;
	var $fecha_vencimiento;
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
	function cpagos_x_docto() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// iddoctocontable
		$this->iddoctocontable = new cField('pagos_x_docto', 'pagos_x_docto', 'x_iddoctocontable', 'iddoctocontable', '`iddoctocontable`', 19, -1, FALSE, '`iddoctocontable`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->iddoctocontable->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['iddoctocontable'] =& $this->iddoctocontable;

		// historial
		$this->historial = new cField('pagos_x_docto', 'pagos_x_docto', 'x_historial', 'historial', '`historial`', 19, -1, FALSE, '`historial`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->historial->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['historial'] =& $this->historial;

		// tipo_docto
		$this->tipo_docto = new cField('pagos_x_docto', 'pagos_x_docto', 'x_tipo_docto', 'tipo_docto', '`tipo_docto`', 200, -1, FALSE, '`tipo_docto`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['tipo_docto'] =& $this->tipo_docto;

		// consec_docto
		$this->consec_docto = new cField('pagos_x_docto', 'pagos_x_docto', 'x_consec_docto', 'consec_docto', '`consec_docto`', 3, -1, FALSE, '`consec_docto`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->consec_docto->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['consec_docto'] =& $this->consec_docto;

		// valor
		$this->valor = new cField('pagos_x_docto', 'pagos_x_docto', 'x_valor', 'valor', '`valor`', 3, -1, FALSE, '`valor`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->valor->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['valor'] =& $this->valor;

		// cia
		$this->cia = new cField('pagos_x_docto', 'pagos_x_docto', 'x_cia', 'cia', '`cia`', 3, -1, FALSE, '`cia`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->cia->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cia'] =& $this->cia;

		// nit
		$this->nit = new cField('pagos_x_docto', 'pagos_x_docto', 'x_nit', 'nit', '`nit`', 200, -1, FALSE, '`nit`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nit'] =& $this->nit;

		// tercero
		$this->tercero = new cField('pagos_x_docto', 'pagos_x_docto', 'x_tercero', 'tercero', '`tercero`', 200, -1, FALSE, '`tercero`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['tercero'] =& $this->tercero;

		// fecha
		$this->fecha = new cField('pagos_x_docto', 'pagos_x_docto', 'x_fecha', 'fecha', '`fecha`', 133, -1, FALSE, '`fecha`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['fecha'] =& $this->fecha;

		// dias_vencidos
		$this->dias_vencidos = new cField('pagos_x_docto', 'pagos_x_docto', 'x_dias_vencidos', 'dias_vencidos', '`dias_vencidos`', 200, -1, FALSE, '`dias_vencidos`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['dias_vencidos'] =& $this->dias_vencidos;

		// estado
		$this->estado = new cField('pagos_x_docto', 'pagos_x_docto', 'x_estado', 'estado', '`estado`', 200, -1, FALSE, '`estado`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['estado'] =& $this->estado;

		// usuario
		$this->usuario = new cField('pagos_x_docto', 'pagos_x_docto', 'x_usuario', 'usuario', '`usuario`', 19, -1, FALSE, '`usuario`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->usuario->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['usuario'] =& $this->usuario;

		// estado_pago
		$this->estado_pago = new cField('pagos_x_docto', 'pagos_x_docto', 'x_estado_pago', 'estado_pago', '`estado_pago`', 3, -1, FALSE, '`estado_pago`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->estado_pago->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['estado_pago'] =& $this->estado_pago;

		// descripcion
		$this->descripcion = new cField('pagos_x_docto', 'pagos_x_docto', 'x_descripcion', 'descripcion', '`descripcion`', 201, -1, FALSE, '`descripcion`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['descripcion'] =& $this->descripcion;

		// fecha_vencimiento
		$this->fecha_vencimiento = new cField('pagos_x_docto', 'pagos_x_docto', 'x_fecha_vencimiento', 'fecha_vencimiento', '`fecha_vencimiento`', 133, -1, FALSE, '`fecha_vencimiento`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['fecha_vencimiento'] =& $this->fecha_vencimiento;

		// monto_pago
		$this->monto_pago = new cField('pagos_x_docto', 'pagos_x_docto', 'x_monto_pago', 'monto_pago', '`monto_pago`', 3, -1, FALSE, '`monto_pago`', FALSE, FALSE, 'FORMATTED TEXT');
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
		return "pagos_x_docto_Highlight";
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

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function getMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "historial_pagos") {
			if ($this->historial->getSessionValue() <> "")
				$sMasterFilter .= "`idhistorial_pagos`=" . ew_QuotedValue($this->historial->getSessionValue(), EW_DATATYPE_NUMBER);
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function getDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "historial_pagos") {
			if ($this->historial->getSessionValue() <> "")
				$sDetailFilter .= "`historial`=" . ew_QuotedValue($this->historial->getSessionValue(), EW_DATATYPE_NUMBER);
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_historial_pagos() {
		return "`idhistorial_pagos`=@idhistorial_pagos@";
	}

	// Detail filter
	function SqlDetailFilter_historial_pagos() {
		return "`historial`=@historial@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`pagos_x_docto`";
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
		return "`fecha` ASC";
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
		return "INSERT INTO `pagos_x_docto` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `pagos_x_docto` SET ";
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
		$SQL = "DELETE FROM `pagos_x_docto` WHERE ";
		$SQL .= ew_QuotedName('iddoctocontable') . '=' . ew_QuotedValue($rs['iddoctocontable'], $this->iddoctocontable->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`iddoctocontable` = @iddoctocontable@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->iddoctocontable->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@iddoctocontable@", ew_AdjustSql($this->iddoctocontable->CurrentValue), $sKeyFilter); // Replace key value
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
			return "pagos_x_doctolist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "pagos_x_doctolist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("pagos_x_doctoview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "pagos_x_doctoadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("pagos_x_doctoedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("pagos_x_doctoadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("pagos_x_doctodelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->iddoctocontable->CurrentValue)) {
			$sUrl .= "iddoctocontable=" . urlencode($this->iddoctocontable->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=pagos_x_docto" : "";
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
			$arKeys[] = @$_GET["iddoctocontable"]; // iddoctocontable

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
			$this->iddoctocontable->CurrentValue = $key;
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
		$this->iddoctocontable->setDbValue($rs->fields('iddoctocontable'));
		$this->historial->setDbValue($rs->fields('historial'));
		$this->tipo_docto->setDbValue($rs->fields('tipo_docto'));
		$this->consec_docto->setDbValue($rs->fields('consec_docto'));
		$this->valor->setDbValue($rs->fields('valor'));
		$this->cia->setDbValue($rs->fields('cia'));
		$this->nit->setDbValue($rs->fields('nit'));
		$this->tercero->setDbValue($rs->fields('tercero'));
		$this->fecha->setDbValue($rs->fields('fecha'));
		$this->dias_vencidos->setDbValue($rs->fields('dias_vencidos'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->usuario->setDbValue($rs->fields('usuario'));
		$this->estado_pago->setDbValue($rs->fields('estado_pago'));
		$this->descripcion->setDbValue($rs->fields('descripcion'));
		$this->fecha_vencimiento->setDbValue($rs->fields('fecha_vencimiento'));
		$this->monto_pago->setDbValue($rs->fields('monto_pago'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
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
		// iddoctocontable

		$this->iddoctocontable->ViewValue = $this->iddoctocontable->CurrentValue;
		$this->iddoctocontable->ViewCustomAttributes = "";

		// historial
		$this->historial->ViewValue = $this->historial->CurrentValue;
		$this->historial->ViewCustomAttributes = "";

		// tipo_docto
		$this->tipo_docto->ViewValue = $this->tipo_docto->CurrentValue;
		$this->tipo_docto->ViewCustomAttributes = "";

		// consec_docto
		$this->consec_docto->ViewValue = $this->consec_docto->CurrentValue;
		$this->consec_docto->ViewCustomAttributes = "";

		// valor
		$this->valor->ViewValue = $this->valor->CurrentValue;
		$this->valor->ViewValue = ew_FormatCurrency($this->valor->ViewValue, 0, -2, -2, -2);
		$this->valor->ViewCustomAttributes = "";

		// cia
		$this->cia->ViewValue = $this->cia->CurrentValue;
		$this->cia->ViewCustomAttributes = "";

		// nit
		$this->nit->ViewValue = $this->nit->CurrentValue;
		$this->nit->ViewCustomAttributes = "";

		// tercero
		$this->tercero->ViewValue = $this->tercero->CurrentValue;
		$this->tercero->ViewCustomAttributes = "";

		// fecha
		$this->fecha->ViewValue = $this->fecha->CurrentValue;
		$this->fecha->ViewCustomAttributes = "";

		// dias_vencidos
		$this->dias_vencidos->ViewValue = $this->dias_vencidos->CurrentValue;
		$this->dias_vencidos->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// usuario
		$this->usuario->ViewValue = $this->usuario->CurrentValue;
		$this->usuario->ViewCustomAttributes = "";

		// estado_pago
		$this->estado_pago->ViewValue = $this->estado_pago->CurrentValue;
		$this->estado_pago->ViewCustomAttributes = "";

		// descripcion
		$this->descripcion->ViewValue = $this->descripcion->CurrentValue;
		$this->descripcion->ViewCustomAttributes = "";

		// fecha_vencimiento
		$this->fecha_vencimiento->ViewValue = $this->fecha_vencimiento->CurrentValue;
		$this->fecha_vencimiento->ViewCustomAttributes = "";

		// monto_pago
		$this->monto_pago->ViewValue = $this->monto_pago->CurrentValue;
		$this->monto_pago->ViewValue = ew_FormatCurrency($this->monto_pago->ViewValue, 0, -2, -2, -2);
		$this->monto_pago->ViewCustomAttributes = "";

		// iddoctocontable
		$this->iddoctocontable->LinkCustomAttributes = "";
		$this->iddoctocontable->HrefValue = "";
		$this->iddoctocontable->TooltipValue = "";

		// historial
		$this->historial->LinkCustomAttributes = "";
		$this->historial->HrefValue = "";
		$this->historial->TooltipValue = "";

		// tipo_docto
		$this->tipo_docto->LinkCustomAttributes = "";
		$this->tipo_docto->HrefValue = "";
		$this->tipo_docto->TooltipValue = "";

		// consec_docto
		$this->consec_docto->LinkCustomAttributes = "";
		$this->consec_docto->HrefValue = "";
		$this->consec_docto->TooltipValue = "";

		// valor
		$this->valor->LinkCustomAttributes = "";
		$this->valor->HrefValue = "";
		$this->valor->TooltipValue = "";

		// cia
		$this->cia->LinkCustomAttributes = "";
		$this->cia->HrefValue = "";
		$this->cia->TooltipValue = "";

		// nit
		$this->nit->LinkCustomAttributes = "";
		$this->nit->HrefValue = "";
		$this->nit->TooltipValue = "";

		// tercero
		$this->tercero->LinkCustomAttributes = "";
		$this->tercero->HrefValue = "";
		$this->tercero->TooltipValue = "";

		// fecha
		$this->fecha->LinkCustomAttributes = "";
		$this->fecha->HrefValue = "";
		$this->fecha->TooltipValue = "";

		// dias_vencidos
		$this->dias_vencidos->LinkCustomAttributes = "";
		$this->dias_vencidos->HrefValue = "";
		$this->dias_vencidos->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// usuario
		$this->usuario->LinkCustomAttributes = "";
		$this->usuario->HrefValue = "";
		$this->usuario->TooltipValue = "";

		// estado_pago
		$this->estado_pago->LinkCustomAttributes = "";
		$this->estado_pago->HrefValue = "";
		$this->estado_pago->TooltipValue = "";

		// descripcion
		$this->descripcion->LinkCustomAttributes = "";
		$this->descripcion->HrefValue = "";
		$this->descripcion->TooltipValue = "";

		// fecha_vencimiento
		$this->fecha_vencimiento->LinkCustomAttributes = "";
		$this->fecha_vencimiento->HrefValue = "";
		$this->fecha_vencimiento->TooltipValue = "";

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
					$XmlDoc->AddField('iddoctocontable', $this->iddoctocontable->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('historial', $this->historial->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tipo_docto', $this->tipo_docto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('consec_docto', $this->consec_docto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('valor', $this->valor->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('cia', $this->cia->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nit', $this->nit->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tercero', $this->tercero->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fecha', $this->fecha->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('dias_vencidos', $this->dias_vencidos->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('estado', $this->estado->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('usuario', $this->usuario->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('estado_pago', $this->estado_pago->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('descripcion', $this->descripcion->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fecha_vencimiento', $this->fecha_vencimiento->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('monto_pago', $this->monto_pago->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('iddoctocontable', $this->iddoctocontable->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('historial', $this->historial->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tipo_docto', $this->tipo_docto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('consec_docto', $this->consec_docto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('valor', $this->valor->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('cia', $this->cia->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nit', $this->nit->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('tercero', $this->tercero->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fecha', $this->fecha->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('dias_vencidos', $this->dias_vencidos->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('estado', $this->estado->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('usuario', $this->usuario->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('estado_pago', $this->estado_pago->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fecha_vencimiento', $this->fecha_vencimiento->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->iddoctocontable);
				$Doc->ExportCaption($this->historial);
				$Doc->ExportCaption($this->tipo_docto);
				$Doc->ExportCaption($this->consec_docto);
				$Doc->ExportCaption($this->valor);
				$Doc->ExportCaption($this->cia);
				$Doc->ExportCaption($this->nit);
				$Doc->ExportCaption($this->tercero);
				$Doc->ExportCaption($this->fecha);
				$Doc->ExportCaption($this->dias_vencidos);
				$Doc->ExportCaption($this->estado);
				$Doc->ExportCaption($this->usuario);
				$Doc->ExportCaption($this->estado_pago);
				$Doc->ExportCaption($this->descripcion);
				$Doc->ExportCaption($this->fecha_vencimiento);
				$Doc->ExportCaption($this->monto_pago);
			} else {
				$Doc->ExportCaption($this->iddoctocontable);
				$Doc->ExportCaption($this->historial);
				$Doc->ExportCaption($this->tipo_docto);
				$Doc->ExportCaption($this->consec_docto);
				$Doc->ExportCaption($this->valor);
				$Doc->ExportCaption($this->cia);
				$Doc->ExportCaption($this->nit);
				$Doc->ExportCaption($this->tercero);
				$Doc->ExportCaption($this->fecha);
				$Doc->ExportCaption($this->dias_vencidos);
				$Doc->ExportCaption($this->estado);
				$Doc->ExportCaption($this->usuario);
				$Doc->ExportCaption($this->estado_pago);
				$Doc->ExportCaption($this->fecha_vencimiento);
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
					$Doc->ExportField($this->iddoctocontable);
					$Doc->ExportField($this->historial);
					$Doc->ExportField($this->tipo_docto);
					$Doc->ExportField($this->consec_docto);
					$Doc->ExportField($this->valor);
					$Doc->ExportField($this->cia);
					$Doc->ExportField($this->nit);
					$Doc->ExportField($this->tercero);
					$Doc->ExportField($this->fecha);
					$Doc->ExportField($this->dias_vencidos);
					$Doc->ExportField($this->estado);
					$Doc->ExportField($this->usuario);
					$Doc->ExportField($this->estado_pago);
					$Doc->ExportField($this->descripcion);
					$Doc->ExportField($this->fecha_vencimiento);
					$Doc->ExportField($this->monto_pago);
				} else {
					$Doc->ExportField($this->iddoctocontable);
					$Doc->ExportField($this->historial);
					$Doc->ExportField($this->tipo_docto);
					$Doc->ExportField($this->consec_docto);
					$Doc->ExportField($this->valor);
					$Doc->ExportField($this->cia);
					$Doc->ExportField($this->nit);
					$Doc->ExportField($this->tercero);
					$Doc->ExportField($this->fecha);
					$Doc->ExportField($this->dias_vencidos);
					$Doc->ExportField($this->estado);
					$Doc->ExportField($this->usuario);
					$Doc->ExportField($this->estado_pago);
					$Doc->ExportField($this->fecha_vencimiento);
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
		$sSql = "SELECT " . $masterfld->FldExpression . " FROM `pagos_x_docto` WHERE " . $this->AddUserIDFilter("");

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

	// Add master User ID filter
	function AddMasterUserIDFilter($sFilter, $sCurrentMasterTable) {
		$sFilterWrk = $sFilter;
		if ($sCurrentMasterTable == "historial_pagos") {
			$sFilterWrk = $GLOBALS["historial_pagos"]->AddUserIDFilter($sFilterWrk);
		}
		return $sFilterWrk;
	}

	// Add detail User ID filter
	function AddDetailUserIDFilter($sFilter, $sCurrentMasterTable) {
		$sFilterWrk = $sFilter;
		if ($sCurrentMasterTable == "historial_pagos") {
			$sSubqueryWrk = $GLOBALS["historial_pagos"]->GetUserIDSubquery($this->historial, $GLOBALS["historial_pagos"]->idhistorial_pagos);
			if ($sSubqueryWrk <> "") {
				if ($sFilterWrk <> "") {
					$sFilterWrk = "($sFilterWrk) AND ($sSubqueryWrk)";
				} else {
					$sFilterWrk = $sSubqueryWrk;
				}
			}
		}
		return $sFilterWrk;
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
