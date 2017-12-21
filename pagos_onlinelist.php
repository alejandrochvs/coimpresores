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
$pagos_online_list = new cpagos_online_list();
$Page =& $pagos_online_list;

// Page init
$pagos_online_list->Page_Init();

// Page main
$pagos_online_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($pagos_online->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pagos_online_list = new ew_Page("pagos_online_list");

// page properties
pagos_online_list.PageID = "list"; // page ID
pagos_online_list.FormID = "fpagos_onlinelist"; // form ID
var EW_PAGE_ID = pagos_online_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pagos_online_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pagos_online_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pagos_online_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<style type="text/css">

/* main table preview row color */
.ewTablePreviewRow {
	background-color: inherit; /* preview row */
}
</style>
<script language="JavaScript" type="text/javascript">
<!--

// PreviewRow extension
var ew_AjaxDetailsTimer = null;
var EW_PREVIEW_SINGLE_ROW = false;
var EW_PREVIEW_IMAGE_CLASSNAME = "ewPreviewRowImage";
var EW_PREVIEW_SHOW_IMAGE = "phpimages/expand.gif";
var EW_PREVIEW_HIDE_IMAGE = "phpimages/collapse.gif";
var EW_PREVIEW_LOADING_IMAGE = "phpimages/loading.gif";
var EW_PREVIEW_LOADING_TEXT = ewLanguage.Phrase("Loading"); // lang phrase for loading

// add row
function ew_AddRowToTable(r) {
	var row, cell;
	var tb = ewDom.getAncestorByTagName(r, "TBODY");
	if (EW_PREVIEW_SINGLE_ROW) {
		row = ewDom.getElementBy(function(node) { return ewDom.hasClass(node, EW_TABLE_PREVIEW_ROW_CLASSNAME)}, "TR", tb);
		ew_RemoveRowFromTable(row);
	}
	var sr = ewDom.getNextSiblingBy(r, function(node) { return node.tagName == "TR"});
	if (sr && ewDom.hasClass(sr, EW_TABLE_PREVIEW_ROW_CLASSNAME)) {
		row = sr; // existing sibling row
		if (row && row.cells && row.cells[0])
			cell = row.cells[0];
	} else {
		row = tb.insertRow(r.rowIndex); // new row
		if (row) {
			row.className = EW_TABLE_PREVIEW_ROW_CLASSNAME;
			var cell = row.insertCell(0);
			cell.style.borderRight = "0";
			var colcnt = r.cells.length;
			if (r.cells) {
				var spancnt = 0;
				for (var i = 0; i < colcnt; i++)
					spancnt += r.cells[i].colSpan;
				if (spancnt > 0)
					cell.colSpan = spancnt;
			}
			var pt = ewDom.getAncestorByTagName(row, "TABLE");
			if (pt) ew_SetupTable(pt);
		}
	}
	if (cell)
		cell.innerHTML = "<img src=\"" + EW_PREVIEW_LOADING_IMAGE + "\" style=\"border: 0; vertical-align: middle;\"> " + EW_PREVIEW_LOADING_TEXT;
	return row;
}

// remove row
function ew_RemoveRowFromTable(r) {
	if (r && r.parentNode)
		r.parentNode.removeChild(r);
}

// show results in new table row
var ew_AjaxHandleSuccess2 = function(o) {
	if (o.responseText !== undefined) {
		var row = o.argument.row;
		if (!row || !row.cells || !row.cells[0]) return;
		row.cells[0].innerHTML = o.responseText;
		var ct = ewDom.getElementBy(function(node) { return ewDom.hasClass(node, EW_TABLE_CLASS)}, "TABLE", row);
		if (ct) ew_SetupTable(ct);

		//clearTimeout(ew_AjaxDetailsTimer);
		//setTimeout("alert(ew_AjaxDetailsTimer);", 500);

	}
}

// show error in new table row
var ew_AjaxHandleFailure2 = function(o) {
	var row = o.argument.row;
	if (!row || !row.cells || !row.cells[0]) return;
	row.cells[0].innerHTML = o.responseText;
}

// show detail preview by table row expansion
function ew_AjaxShowDetails2(ev, link, url) {
	var img = ewDom.getElementBy(function(node) { return true; }, "IMG", link);
	var r = ewDom.getAncestorByTagName(link, "TR");
	if (!img || !r)
		return;
	var show = (img.src.substr(img.src.length - EW_PREVIEW_SHOW_IMAGE.length) == EW_PREVIEW_SHOW_IMAGE);
	if (show) {
		if (ew_AjaxDetailsTimer)
			clearTimeout(ew_AjaxDetailsTimer);		
		var row = ew_AddRowToTable(r);
		ew_AjaxDetailsTimer = setTimeout(function() { ewConnect.asyncRequest('GET', url, {success: ew_AjaxHandleSuccess2, failure: ew_AjaxHandleFailure2, argument:{id: link, row: row}}) }, 200);
		ewDom.getElementsByClassName(EW_PREVIEW_IMAGE_CLASSNAME, "IMG", r, function(node) {node.src = EW_PREVIEW_SHOW_IMAGE});
		img.src = EW_PREVIEW_HIDE_IMAGE;
	} else {	 
		var sr = ewDom.getNextSiblingBy(r, function(node) { return node.tagName == "TR"});
		if (sr && ewDom.hasClass(sr, EW_TABLE_PREVIEW_ROW_CLASSNAME))
			ew_RemoveRowFromTable(sr);
		img.src = EW_PREVIEW_SHOW_IMAGE;
	}
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($pagos_online->Export == "") || (EW_EXPORT_MASTER_RECORD && $pagos_online->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pagos_online_list->TotalRecs = $pagos_online->SelectRecordCount();
	} else {
		if ($pagos_online_list->Recordset = $pagos_online_list->LoadRecordset())
			$pagos_online_list->TotalRecs = $pagos_online_list->Recordset->RecordCount();
	}
	$pagos_online_list->StartRec = 1;
	if ($pagos_online_list->DisplayRecs <= 0 || ($pagos_online->Export <> "" && $pagos_online->ExportAll)) // Display all records
		$pagos_online_list->DisplayRecs = $pagos_online_list->TotalRecs;
	if (!($pagos_online->Export <> "" && $pagos_online->ExportAll))
		$pagos_online_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pagos_online_list->Recordset = $pagos_online_list->LoadRecordset($pagos_online_list->StartRec-1, $pagos_online_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pagos_online->TableCaption() ?>
&nbsp;&nbsp;<?php $pagos_online_list->ExportOptions->Render("body"); ?>
</p>
<?php $pagos_online_list->ShowPageHeader(); ?>
<?php
$pagos_online_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fpagos_onlinelist" id="fpagos_onlinelist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="pagos_online">
<div id="gmp_pagos_online" class="ewGridMiddlePanel">
<?php if ($pagos_online_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pagos_online->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pagos_online_list->RenderListOptions();

// Render list options (header, left)
$pagos_online_list->ListOptions->Render("header", "left");
?>
<?php if ($pagos_online->usuarioid->Visible) { // usuarioid ?>
	<?php if ($pagos_online->SortUrl($pagos_online->usuarioid) == "") { ?>
		<td><?php echo $pagos_online->usuarioid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_online->SortUrl($pagos_online->usuarioid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_online->usuarioid->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_online->usuarioid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_online->usuarioid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_online->llave_encripcion->Visible) { // llave_encripcion ?>
	<?php if ($pagos_online->SortUrl($pagos_online->llave_encripcion) == "") { ?>
		<td><?php echo $pagos_online->llave_encripcion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_online->SortUrl($pagos_online->llave_encripcion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_online->llave_encripcion->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_online->llave_encripcion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_online->llave_encripcion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_online->url->Visible) { // url ?>
	<?php if ($pagos_online->SortUrl($pagos_online->url) == "") { ?>
		<td><?php echo $pagos_online->url->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_online->SortUrl($pagos_online->url) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_online->url->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_online->url->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_online->url->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pagos_online_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($pagos_online->ExportAll && $pagos_online->Export <> "") {
	$pagos_online_list->StopRec = $pagos_online_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pagos_online_list->TotalRecs > $pagos_online_list->StartRec + $pagos_online_list->DisplayRecs - 1)
		$pagos_online_list->StopRec = $pagos_online_list->StartRec + $pagos_online_list->DisplayRecs - 1;
	else
		$pagos_online_list->StopRec = $pagos_online_list->TotalRecs;
}
$pagos_online_list->RecCnt = $pagos_online_list->StartRec - 1;
if ($pagos_online_list->Recordset && !$pagos_online_list->Recordset->EOF) {
	$pagos_online_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $pagos_online_list->StartRec > 1)
		$pagos_online_list->Recordset->Move($pagos_online_list->StartRec - 1);
} elseif (!$pagos_online->AllowAddDeleteRow && $pagos_online_list->StopRec == 0) {
	$pagos_online_list->StopRec = $pagos_online->GridAddRowCount;
}

// Initialize aggregate
$pagos_online->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pagos_online->ResetAttrs();
$pagos_online_list->RenderRow();
$pagos_online_list->RowCnt = 0;
while ($pagos_online_list->RecCnt < $pagos_online_list->StopRec) {
	$pagos_online_list->RecCnt++;
	if (intval($pagos_online_list->RecCnt) >= intval($pagos_online_list->StartRec)) {
		$pagos_online_list->RowCnt++;

		// Set up key count
		$pagos_online_list->KeyCount = $pagos_online_list->RowIndex;

		// Init row class and style
		$pagos_online->ResetAttrs();
		$pagos_online->CssClass = "";
		if ($pagos_online->CurrentAction == "gridadd") {
		} else {
			$pagos_online_list->LoadRowValues($pagos_online_list->Recordset); // Load row values
		}
		$pagos_online->RowType = EW_ROWTYPE_VIEW; // Render view
		$pagos_online->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$pagos_online_list->RenderRow();

		// Render list options
		$pagos_online_list->RenderListOptions();
?>
	<tr<?php echo $pagos_online->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pagos_online_list->ListOptions->Render("body", "left");
?>
	<?php if ($pagos_online->usuarioid->Visible) { // usuarioid ?>
		<td<?php echo $pagos_online->usuarioid->CellAttributes() ?>>
<div<?php echo $pagos_online->usuarioid->ViewAttributes() ?>><?php echo $pagos_online->usuarioid->ListViewValue() ?></div>
<a name="<?php echo $pagos_online_list->PageObjName . "_row_" . $pagos_online_list->RowCnt ?>" id="<?php echo $pagos_online_list->PageObjName . "_row_" . $pagos_online_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($pagos_online->llave_encripcion->Visible) { // llave_encripcion ?>
		<td<?php echo $pagos_online->llave_encripcion->CellAttributes() ?>>
<div<?php echo $pagos_online->llave_encripcion->ViewAttributes() ?>><?php echo $pagos_online->llave_encripcion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_online->url->Visible) { // url ?>
		<td<?php echo $pagos_online->url->CellAttributes() ?>>
<div<?php echo $pagos_online->url->ViewAttributes() ?>><?php echo $pagos_online->url->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pagos_online_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($pagos_online->CurrentAction <> "gridadd")
		$pagos_online_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pagos_online_list->Recordset)
	$pagos_online_list->Recordset->Close();
?>
<?php if ($pagos_online->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($pagos_online->CurrentAction <> "gridadd" && $pagos_online->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($pagos_online_list->Pager)) $pagos_online_list->Pager = new cNumericPager($pagos_online_list->StartRec, $pagos_online_list->DisplayRecs, $pagos_online_list->TotalRecs, $pagos_online_list->RecRange) ?>
<?php if ($pagos_online_list->Pager->RecordCount > 0) { ?>
	<?php if ($pagos_online_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $pagos_online_list->PageUrl() ?>start=<?php echo $pagos_online_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pagos_online_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $pagos_online_list->PageUrl() ?>start=<?php echo $pagos_online_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($pagos_online_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $pagos_online_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($pagos_online_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $pagos_online_list->PageUrl() ?>start=<?php echo $pagos_online_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pagos_online_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $pagos_online_list->PageUrl() ?>start=<?php echo $pagos_online_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pagos_online_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pagos_online_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pagos_online_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pagos_online_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($pagos_online_list->SearchWhere == "0=101") { ?>
	<?php echo $Language->Phrase("EnterSearchCriteria") ?>
	<?php } else { ?>
	<?php echo $Language->Phrase("NoRecord") ?>
	<?php } ?>
	<?php } else { ?>
	<?php echo $Language->Phrase("NoPermission") ?>
	<?php } ?>
<?php } ?>
</span>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($pagos_online->Export == "" && $pagos_online->CurrentAction == "") { ?>
<?php } ?>
<?php
$pagos_online_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pagos_online->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pagos_online_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpagos_online_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'pagos_online';

	// Page object name
	var $PageObjName = 'pagos_online_list';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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
	function cpagos_online_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pagos_online)
		if (!isset($GLOBALS["pagos_online"])) {
			$GLOBALS["pagos_online"] = new cpagos_online();
			$GLOBALS["Table"] =& $GLOBALS["pagos_online"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "pagos_onlineadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pagos_onlinedelete.php";
		$this->MultiUpdateUrl = "pagos_onlineupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pagos_online', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$pagos_online->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$pagos_online->Export = $_POST["exporttype"];
		} else {
			$pagos_online->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $pagos_online->Export; // Get export parameter, used in header
		$gsExportFile = $pagos_online->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($pagos_online->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($pagos_online->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}
		if ($pagos_online->Export == "xml") {
			header('Content-Type: text/xml' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($pagos_online->Export == "csv") {
			header('Content-Type: application/csv' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$pagos_online->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $pagos_online;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($pagos_online->Export <> "" ||
				$pagos_online->CurrentAction == "gridadd" ||
				$pagos_online->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($pagos_online->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $pagos_online->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$pagos_online->setSessionWhere($sFilter);
		$pagos_online->CurrentFilter = "";

		// Export data only
		if (in_array($pagos_online->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($pagos_online->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pagos_online;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pagos_online->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pagos_online->CurrentOrderType = @$_GET["ordertype"];
			$pagos_online->UpdateSort($pagos_online->usuarioid); // usuarioid
			$pagos_online->UpdateSort($pagos_online->llave_encripcion); // llave_encripcion
			$pagos_online->UpdateSort($pagos_online->url); // url
			$pagos_online->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $pagos_online;
		$sOrderBy = $pagos_online->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($pagos_online->SqlOrderBy() <> "") {
				$sOrderBy = $pagos_online->SqlOrderBy();
				$pagos_online->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $pagos_online;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$pagos_online->setSessionOrderBy($sOrderBy);
				$pagos_online->usuarioid->setSort("");
				$pagos_online->llave_encripcion->setSort("");
				$pagos_online->url->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$pagos_online->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $pagos_online;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $pagos_online, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . "<img src=\"phpimages/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $pagos_online;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pagos_online;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$pagos_online->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$pagos_online->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $pagos_online->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$pagos_online->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$pagos_online->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$pagos_online->setStartRecordNumber($this->StartRec);
		}
	}

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

	// Load old record
	function LoadOldRecord() {
		global $pagos_online;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($pagos_online->getKey("idpagosonline")) <> "")
			$pagos_online->idpagosonline->CurrentValue = $pagos_online->getKey("idpagosonline"); // idpagosonline
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$pagos_online->CurrentFilter = $pagos_online->KeyFilter();
			$sSql = $pagos_online->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pagos_online;

		// Initialize URLs
		$this->ViewUrl = $pagos_online->ViewUrl();
		$this->EditUrl = $pagos_online->EditUrl();
		$this->InlineEditUrl = $pagos_online->InlineEditUrl();
		$this->CopyUrl = $pagos_online->CopyUrl();
		$this->InlineCopyUrl = $pagos_online->InlineCopyUrl();
		$this->DeleteUrl = $pagos_online->DeleteUrl();

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

	// Set up export options
	function SetupExportOptions() {
		global $Language, $pagos_online;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\">" . "<img src=\"phpimages/print.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendly")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\">" . "<img src=\"phpimages/exportxls.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcel")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\">" . "<img src=\"phpimages/exportdoc.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWord")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\">" . "<img src=\"phpimages/exporthtml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\">" . "<img src=\"phpimages/exportxml.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXml")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\">" . "<img src=\"phpimages/exportcsv.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsv")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\">" . "<img src=\"phpimages/exportpdf.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPdf")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_pagos_online\" id=\"emf_pagos_online\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_pagos_online',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fpagos_onlinelist,sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Hide options for export/action
		if ($pagos_online->Export <> "" ||
			$pagos_online->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $pagos_online;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $pagos_online->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($pagos_online->ExportAll) {
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs < 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($pagos_online->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($pagos_online, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($pagos_online->Export == "xml") {
			$pagos_online->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$pagos_online->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($pagos_online->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($pagos_online->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($pagos_online->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($pagos_online->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($pagos_online->ExportReturnUrl());
		} elseif ($pagos_online->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $Language, $pagos_online;
		$sSender = @$_GET["sender"];
		$sRecipient = @$_GET["recipient"];
		$sCc = @$_GET["cc"];
		$sBcc = @$_GET["bcc"];
		$sContentType = @$_GET["contenttype"];

		// Subject
		$sSubject = ew_StripSlashes(@$_GET["subject"]);
		$sEmailSubject = $sSubject;

		// Message
		$sContent = ew_StripSlashes(@$_GET["message"]);
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			$this->setFailureMessage($Language->Phrase("EnterSenderEmail"));
			return;
		}
		if (!ew_CheckEmail($sSender)) {
			$this->setFailureMessage($Language->Phrase("EnterProperSenderEmail"));
			return;
		}

		// Check recipient
		if (!ew_CheckEmailList($sRecipient, EW_MAX_EMAIL_RECIPIENT)) {
			$this->setFailureMessage($Language->Phrase("EnterProperRecipientEmail"));
			return;
		}

		// Check cc
		if (!ew_CheckEmailList($sCc, EW_MAX_EMAIL_RECIPIENT)) {
			$this->setFailureMessage($Language->Phrase("EnterProperCcEmail"));
			return;
		}

		// Check bcc
		if (!ew_CheckEmailList($sBcc, EW_MAX_EMAIL_RECIPIENT)) {
			$this->setFailureMessage($Language->Phrase("EnterProperBccEmail"));
			return;
		}

		// Check email sent count
		if (!isset($_SESSION[EW_EXPORT_EMAIL_COUNTER]))
			$_SESSION[EW_EXPORT_EMAIL_COUNTER] = 0;
		if (intval($_SESSION[EW_EXPORT_EMAIL_COUNTER]) > EW_MAX_EMAIL_SENT_COUNT) {
			$this->setFailureMessage($Language->Phrase("ExceedMaxEmailExport"));
			return;
		}
		if ($sEmailMessage <> "") {
			$sEmailMessage = ew_RemoveXSS($sEmailMessage);
			$sEmailMessage .= ($sContentType == "url") ? "\r\n\r\n" : "<br><br>";
		}
		if ($sContentType == "url") {
			$sUrl = ew_ConvertFullUrl(ew_CurrentPage() . "?" . $this->ExportQueryString());
			$sEmailMessage .= $sUrl; // send URL only
		} else {
			$sEmailMessage .= $EmailContent; // send HTML
		}

		// Send email
		$Email = new cEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Content = $sEmailMessage; // Content
		$Email->Format = ($sContentType == "url") ? "text" : "html";
		$Email->Charset = EW_EMAIL_CHARSET;
		$EventArgs = array();
		$bEmailSent = FALSE;
		if ($pagos_online->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count
			$_SESSION[EW_EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			$this->setSuccessMessage($Language->Phrase("SendEmailSuccess"));
		} else {

			// Sent email failure
			$this->setFailureMessage($Email->SendErrDescription);
		}
	}

	// Export QueryString
	function ExportQueryString() {
		global $pagos_online;

		// Initialize
		$sQry = "export=html";

		// Build QueryString for search
		// Build QueryString for pager

		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . $pagos_online->getRecordsPerPage() . "&" . EW_TABLE_START_REC . "=" . $pagos_online->getStartRecordNumber();
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		global $pagos_online;
		$FldParm = substr($Fld->FldVar, 2);
		$FldSearchValue = $pagos_online->getAdvancedSearch("x_" . $FldParm);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . FldSearchValue .
				"&z_" . $FldParm . "=" . $pagos_online->getAdvancedSearch("z_" . $FldParm);
		}
		$FldSearchValue2 = $pagos_online->getAdvancedSearch("y_" . $FldParm);
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . $pagos_online->getAdvancedSearch("v_" . $FldParm) .
				"&y_" . $FldParm . "=" . $FldSearchValue2 .
				"&w_" . $FldParm . "=" . $pagos_online->getAdvancedSearch("w_" . $FldParm);
		}
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
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
