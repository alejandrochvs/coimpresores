<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "historial_pagosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "pagos_x_doctoinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$historial_pagos_list = new chistorial_pagos_list();
$Page =& $historial_pagos_list;

// Page init
$historial_pagos_list->Page_Init();

// Page main
$historial_pagos_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($historial_pagos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var historial_pagos_list = new ew_Page("historial_pagos_list");

// page properties
historial_pagos_list.PageID = "list"; // page ID
historial_pagos_list.FormID = "fhistorial_pagoslist"; // form ID
var EW_PAGE_ID = historial_pagos_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
historial_pagos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
historial_pagos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
historial_pagos_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($historial_pagos->Export == "") || (EW_EXPORT_MASTER_RECORD && $historial_pagos->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$historial_pagos_list->TotalRecs = $historial_pagos->SelectRecordCount();
	} else {
		if ($historial_pagos_list->Recordset = $historial_pagos_list->LoadRecordset())
			$historial_pagos_list->TotalRecs = $historial_pagos_list->Recordset->RecordCount();
	}
	$historial_pagos_list->StartRec = 1;
	if ($historial_pagos_list->DisplayRecs <= 0 || ($historial_pagos->Export <> "" && $historial_pagos->ExportAll)) // Display all records
		$historial_pagos_list->DisplayRecs = $historial_pagos_list->TotalRecs;
	if (!($historial_pagos->Export <> "" && $historial_pagos->ExportAll))
		$historial_pagos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$historial_pagos_list->Recordset = $historial_pagos_list->LoadRecordset($historial_pagos_list->StartRec-1, $historial_pagos_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $historial_pagos->TableCaption() ?>
&nbsp;&nbsp;<?php $historial_pagos_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($historial_pagos->Export == "" && $historial_pagos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(historial_pagos_list);" style="text-decoration: none;"><img id="historial_pagos_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="historial_pagos_list_SearchPanel">
<form name="fhistorial_pagoslistsrch" id="fhistorial_pagoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="historial_pagos">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($historial_pagos->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $historial_pagos_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
	<a href="historial_pagossrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($historial_pagos->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($historial_pagos->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($historial_pagos->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $historial_pagos_list->ShowPageHeader(); ?>
<?php
$historial_pagos_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fhistorial_pagoslist" id="fhistorial_pagoslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="historial_pagos">
<div id="gmp_historial_pagos" class="ewGridMiddlePanel">
<?php if ($historial_pagos_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $historial_pagos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$historial_pagos_list->RenderListOptions();

// Render list options (header, left)
$historial_pagos_list->ListOptions->Render("header", "left");
?>
<?php if ($historial_pagos->idhistorial_pagos->Visible) { // idhistorial_pagos ?>
	<?php if ($historial_pagos->SortUrl($historial_pagos->idhistorial_pagos) == "") { ?>
		<td><?php echo $historial_pagos->idhistorial_pagos->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $historial_pagos->SortUrl($historial_pagos->idhistorial_pagos) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $historial_pagos->idhistorial_pagos->FldCaption() ?></td><td style="width: 10px;"><?php if ($historial_pagos->idhistorial_pagos->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($historial_pagos->idhistorial_pagos->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($historial_pagos->usuario->Visible) { // usuario ?>
	<?php if ($historial_pagos->SortUrl($historial_pagos->usuario) == "") { ?>
		<td><?php echo $historial_pagos->usuario->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $historial_pagos->SortUrl($historial_pagos->usuario) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $historial_pagos->usuario->FldCaption() ?></td><td style="width: 10px;"><?php if ($historial_pagos->usuario->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($historial_pagos->usuario->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($historial_pagos->estado_pago->Visible) { // estado_pago ?>
	<?php if ($historial_pagos->SortUrl($historial_pagos->estado_pago) == "") { ?>
		<td><?php echo $historial_pagos->estado_pago->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $historial_pagos->SortUrl($historial_pagos->estado_pago) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $historial_pagos->estado_pago->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($historial_pagos->estado_pago->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($historial_pagos->estado_pago->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($historial_pagos->ref_venta->Visible) { // ref_venta ?>
	<?php if ($historial_pagos->SortUrl($historial_pagos->ref_venta) == "") { ?>
		<td><?php echo $historial_pagos->ref_venta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $historial_pagos->SortUrl($historial_pagos->ref_venta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $historial_pagos->ref_venta->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($historial_pagos->ref_venta->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($historial_pagos->ref_venta->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($historial_pagos->fecha_hora_creacion->Visible) { // fecha_hora_creacion ?>
	<?php if ($historial_pagos->SortUrl($historial_pagos->fecha_hora_creacion) == "") { ?>
		<td><?php echo $historial_pagos->fecha_hora_creacion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $historial_pagos->SortUrl($historial_pagos->fecha_hora_creacion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $historial_pagos->fecha_hora_creacion->FldCaption() ?></td><td style="width: 10px;"><?php if ($historial_pagos->fecha_hora_creacion->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($historial_pagos->fecha_hora_creacion->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($historial_pagos->riesgo->Visible) { // riesgo ?>
	<?php if ($historial_pagos->SortUrl($historial_pagos->riesgo) == "") { ?>
		<td><?php echo $historial_pagos->riesgo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $historial_pagos->SortUrl($historial_pagos->riesgo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $historial_pagos->riesgo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($historial_pagos->riesgo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($historial_pagos->riesgo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($historial_pagos->monto_pago->Visible) { // monto_pago ?>
	<?php if ($historial_pagos->SortUrl($historial_pagos->monto_pago) == "") { ?>
		<td><?php echo $historial_pagos->monto_pago->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $historial_pagos->SortUrl($historial_pagos->monto_pago) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $historial_pagos->monto_pago->FldCaption() ?></td><td style="width: 10px;"><?php if ($historial_pagos->monto_pago->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($historial_pagos->monto_pago->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$historial_pagos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($historial_pagos->ExportAll && $historial_pagos->Export <> "") {
	$historial_pagos_list->StopRec = $historial_pagos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($historial_pagos_list->TotalRecs > $historial_pagos_list->StartRec + $historial_pagos_list->DisplayRecs - 1)
		$historial_pagos_list->StopRec = $historial_pagos_list->StartRec + $historial_pagos_list->DisplayRecs - 1;
	else
		$historial_pagos_list->StopRec = $historial_pagos_list->TotalRecs;
}
$historial_pagos_list->RecCnt = $historial_pagos_list->StartRec - 1;
if ($historial_pagos_list->Recordset && !$historial_pagos_list->Recordset->EOF) {
	$historial_pagos_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $historial_pagos_list->StartRec > 1)
		$historial_pagos_list->Recordset->Move($historial_pagos_list->StartRec - 1);
} elseif (!$historial_pagos->AllowAddDeleteRow && $historial_pagos_list->StopRec == 0) {
	$historial_pagos_list->StopRec = $historial_pagos->GridAddRowCount;
}

// Initialize aggregate
$historial_pagos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$historial_pagos->ResetAttrs();
$historial_pagos_list->RenderRow();
$historial_pagos_list->RowCnt = 0;
while ($historial_pagos_list->RecCnt < $historial_pagos_list->StopRec) {
	$historial_pagos_list->RecCnt++;
	if (intval($historial_pagos_list->RecCnt) >= intval($historial_pagos_list->StartRec)) {
		$historial_pagos_list->RowCnt++;

		// Set up key count
		$historial_pagos_list->KeyCount = $historial_pagos_list->RowIndex;

		// Init row class and style
		$historial_pagos->ResetAttrs();
		$historial_pagos->CssClass = "";
		if ($historial_pagos->CurrentAction == "gridadd") {
		} else {
			$historial_pagos_list->LoadRowValues($historial_pagos_list->Recordset); // Load row values
		}
		$historial_pagos->RowType = EW_ROWTYPE_VIEW; // Render view
		$historial_pagos->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$historial_pagos_list->RenderRow();

		// Render list options
		$historial_pagos_list->RenderListOptions();
?>
	<tr<?php echo $historial_pagos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$historial_pagos_list->ListOptions->Render("body", "left");
?>
	<?php if ($historial_pagos->idhistorial_pagos->Visible) { // idhistorial_pagos ?>
		<td<?php echo $historial_pagos->idhistorial_pagos->CellAttributes() ?>>
<div<?php echo $historial_pagos->idhistorial_pagos->ViewAttributes() ?>><?php echo $historial_pagos->idhistorial_pagos->ListViewValue() ?></div>
<a name="<?php echo $historial_pagos_list->PageObjName . "_row_" . $historial_pagos_list->RowCnt ?>" id="<?php echo $historial_pagos_list->PageObjName . "_row_" . $historial_pagos_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($historial_pagos->usuario->Visible) { // usuario ?>
		<td<?php echo $historial_pagos->usuario->CellAttributes() ?>>
<div<?php echo $historial_pagos->usuario->ViewAttributes() ?>><?php echo $historial_pagos->usuario->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($historial_pagos->estado_pago->Visible) { // estado_pago ?>
		<td<?php echo $historial_pagos->estado_pago->CellAttributes() ?>>
<div<?php echo $historial_pagos->estado_pago->ViewAttributes() ?>><?php echo $historial_pagos->estado_pago->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($historial_pagos->ref_venta->Visible) { // ref_venta ?>
		<td<?php echo $historial_pagos->ref_venta->CellAttributes() ?>>
<div<?php echo $historial_pagos->ref_venta->ViewAttributes() ?>><?php echo $historial_pagos->ref_venta->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($historial_pagos->fecha_hora_creacion->Visible) { // fecha_hora_creacion ?>
		<td<?php echo $historial_pagos->fecha_hora_creacion->CellAttributes() ?>>
<div<?php echo $historial_pagos->fecha_hora_creacion->ViewAttributes() ?>><?php echo $historial_pagos->fecha_hora_creacion->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($historial_pagos->riesgo->Visible) { // riesgo ?>
		<td<?php echo $historial_pagos->riesgo->CellAttributes() ?>>
<div<?php echo $historial_pagos->riesgo->ViewAttributes() ?>><?php echo $historial_pagos->riesgo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($historial_pagos->monto_pago->Visible) { // monto_pago ?>
		<td<?php echo $historial_pagos->monto_pago->CellAttributes() ?>>
<div<?php echo $historial_pagos->monto_pago->ViewAttributes() ?>><?php echo $historial_pagos->monto_pago->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$historial_pagos_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($historial_pagos->CurrentAction <> "gridadd")
		$historial_pagos_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($historial_pagos_list->Recordset)
	$historial_pagos_list->Recordset->Close();
?>
<?php if ($historial_pagos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($historial_pagos->CurrentAction <> "gridadd" && $historial_pagos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($historial_pagos_list->Pager)) $historial_pagos_list->Pager = new cNumericPager($historial_pagos_list->StartRec, $historial_pagos_list->DisplayRecs, $historial_pagos_list->TotalRecs, $historial_pagos_list->RecRange) ?>
<?php if ($historial_pagos_list->Pager->RecordCount > 0) { ?>
	<?php if ($historial_pagos_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $historial_pagos_list->PageUrl() ?>start=<?php echo $historial_pagos_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($historial_pagos_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $historial_pagos_list->PageUrl() ?>start=<?php echo $historial_pagos_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($historial_pagos_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $historial_pagos_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($historial_pagos_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $historial_pagos_list->PageUrl() ?>start=<?php echo $historial_pagos_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($historial_pagos_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $historial_pagos_list->PageUrl() ?>start=<?php echo $historial_pagos_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($historial_pagos_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $historial_pagos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $historial_pagos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $historial_pagos_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($historial_pagos_list->SearchWhere == "0=101") { ?>
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
<?php if ($Security->CanAdd()) { ?>
<a class="ewGridLink" href="<?php echo $historial_pagos_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($pagos_x_docto->DetailAdd && $Security->AllowAdd('pagos_x_docto')) { ?>
<a class="ewGridLink" href="<?php echo $historial_pagos->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=pagos_x_docto" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $historial_pagos->TableCaption() ?>/<?php echo $pagos_x_docto->TableCaption() ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($historial_pagos->Export == "" && $historial_pagos->CurrentAction == "") { ?>
<?php } ?>
<?php
$historial_pagos_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($historial_pagos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$historial_pagos_list->Page_Terminate();
?>
<?php

//
// Page class
//
class chistorial_pagos_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'historial_pagos';

	// Page object name
	var $PageObjName = 'historial_pagos_list';

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
	function chistorial_pagos_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (historial_pagos)
		if (!isset($GLOBALS["historial_pagos"])) {
			$GLOBALS["historial_pagos"] = new chistorial_pagos();
			$GLOBALS["Table"] =& $GLOBALS["historial_pagos"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "historial_pagosadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "historial_pagosdelete.php";
		$this->MultiUpdateUrl = "historial_pagosupdate.php";

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Table object (pagos_x_docto)
		if (!isset($GLOBALS['pagos_x_docto'])) $GLOBALS['pagos_x_docto'] = new cpagos_x_docto();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'historial_pagos', TRUE);

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate();
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$historial_pagos->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$historial_pagos->Export = $_POST["exporttype"];
		} else {
			$historial_pagos->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $historial_pagos->Export; // Get export parameter, used in header
		$gsExportFile = $historial_pagos->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($historial_pagos->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($historial_pagos->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}
		if ($historial_pagos->Export == "xml") {
			header('Content-Type: text/xml' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($historial_pagos->Export == "csv") {
			header('Content-Type: application/csv' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$historial_pagos->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $historial_pagos;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($historial_pagos->Export <> "" ||
				$historial_pagos->CurrentAction == "gridadd" ||
				$historial_pagos->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$historial_pagos->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($historial_pagos->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $historial_pagos->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$historial_pagos->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$historial_pagos->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$historial_pagos->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $historial_pagos->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$historial_pagos->setSessionWhere($sFilter);
		$historial_pagos->CurrentFilter = "";

		// Export data only
		if (in_array($historial_pagos->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($historial_pagos->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $historial_pagos;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $historial_pagos->idhistorial_pagos, FALSE); // idhistorial_pagos
		$this->BuildSearchSql($sWhere, $historial_pagos->usuario, FALSE); // usuario
		$this->BuildSearchSql($sWhere, $historial_pagos->tipo_docto, FALSE); // tipo_docto
		$this->BuildSearchSql($sWhere, $historial_pagos->consec_docto, FALSE); // consec_docto
		$this->BuildSearchSql($sWhere, $historial_pagos->estado_pago, FALSE); // estado_pago
		$this->BuildSearchSql($sWhere, $historial_pagos->ref_venta, FALSE); // ref_venta
		$this->BuildSearchSql($sWhere, $historial_pagos->fecha_hora_creacion, FALSE); // fecha_hora_creacion
		$this->BuildSearchSql($sWhere, $historial_pagos->riesgo, FALSE); // riesgo
		$this->BuildSearchSql($sWhere, $historial_pagos->medio_pago, FALSE); // medio_pago
		$this->BuildSearchSql($sWhere, $historial_pagos->respuesta_pol, FALSE); // respuesta_pol
		$this->BuildSearchSql($sWhere, $historial_pagos->monto_pago, FALSE); // monto_pago

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($historial_pagos->idhistorial_pagos); // idhistorial_pagos
			$this->SetSearchParm($historial_pagos->usuario); // usuario
			$this->SetSearchParm($historial_pagos->tipo_docto); // tipo_docto
			$this->SetSearchParm($historial_pagos->consec_docto); // consec_docto
			$this->SetSearchParm($historial_pagos->estado_pago); // estado_pago
			$this->SetSearchParm($historial_pagos->ref_venta); // ref_venta
			$this->SetSearchParm($historial_pagos->fecha_hora_creacion); // fecha_hora_creacion
			$this->SetSearchParm($historial_pagos->riesgo); // riesgo
			$this->SetSearchParm($historial_pagos->medio_pago); // medio_pago
			$this->SetSearchParm($historial_pagos->respuesta_pol); // respuesta_pol
			$this->SetSearchParm($historial_pagos->monto_pago); // monto_pago
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $historial_pagos;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$historial_pagos->setAdvancedSearch("x_$FldParm", $FldVal);
		$historial_pagos->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$historial_pagos->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$historial_pagos->setAdvancedSearch("y_$FldParm", $FldVal2);
		$historial_pagos->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $historial_pagos;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $historial_pagos->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $historial_pagos->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $historial_pagos->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $historial_pagos->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $historial_pagos->getAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $historial_pagos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $historial_pagos->tipo_docto, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $historial_pagos->estado_pago, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $historial_pagos->ref_venta, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $historial_pagos->riesgo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $historial_pagos->medio_pago, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $historial_pagos->respuesta_pol, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", $lFldDataType));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $historial_pagos;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $historial_pagos->BasicSearchKeyword;
		$sSearchType = $historial_pagos->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$historial_pagos->setSessionBasicSearchKeyword($sSearchKeyword);
			$historial_pagos->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $historial_pagos;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$historial_pagos->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $historial_pagos;
		$historial_pagos->setSessionBasicSearchKeyword("");
		$historial_pagos->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $historial_pagos;
		$historial_pagos->setAdvancedSearch("x_idhistorial_pagos", "");
		$historial_pagos->setAdvancedSearch("x_usuario", "");
		$historial_pagos->setAdvancedSearch("x_tipo_docto", "");
		$historial_pagos->setAdvancedSearch("x_consec_docto", "");
		$historial_pagos->setAdvancedSearch("x_estado_pago", "");
		$historial_pagos->setAdvancedSearch("x_ref_venta", "");
		$historial_pagos->setAdvancedSearch("x_fecha_hora_creacion", "");
		$historial_pagos->setAdvancedSearch("x_riesgo", "");
		$historial_pagos->setAdvancedSearch("x_medio_pago", "");
		$historial_pagos->setAdvancedSearch("x_respuesta_pol", "");
		$historial_pagos->setAdvancedSearch("x_monto_pago", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $historial_pagos;
		$bRestore = TRUE;
		if ($historial_pagos->BasicSearchKeyword <> "") $bRestore = FALSE;
		if ($historial_pagos->idhistorial_pagos->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($historial_pagos->usuario->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($historial_pagos->tipo_docto->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($historial_pagos->consec_docto->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($historial_pagos->estado_pago->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($historial_pagos->ref_venta->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($historial_pagos->fecha_hora_creacion->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($historial_pagos->riesgo->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($historial_pagos->medio_pago->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($historial_pagos->respuesta_pol->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($historial_pagos->monto_pago->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$historial_pagos->BasicSearchKeyword = $historial_pagos->getSessionBasicSearchKeyword();
			$historial_pagos->BasicSearchType = $historial_pagos->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($historial_pagos->idhistorial_pagos);
			$this->GetSearchParm($historial_pagos->usuario);
			$this->GetSearchParm($historial_pagos->tipo_docto);
			$this->GetSearchParm($historial_pagos->consec_docto);
			$this->GetSearchParm($historial_pagos->estado_pago);
			$this->GetSearchParm($historial_pagos->ref_venta);
			$this->GetSearchParm($historial_pagos->fecha_hora_creacion);
			$this->GetSearchParm($historial_pagos->riesgo);
			$this->GetSearchParm($historial_pagos->medio_pago);
			$this->GetSearchParm($historial_pagos->respuesta_pol);
			$this->GetSearchParm($historial_pagos->monto_pago);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $historial_pagos;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$historial_pagos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$historial_pagos->CurrentOrderType = @$_GET["ordertype"];
			$historial_pagos->UpdateSort($historial_pagos->idhistorial_pagos); // idhistorial_pagos
			$historial_pagos->UpdateSort($historial_pagos->usuario); // usuario
			$historial_pagos->UpdateSort($historial_pagos->estado_pago); // estado_pago
			$historial_pagos->UpdateSort($historial_pagos->ref_venta); // ref_venta
			$historial_pagos->UpdateSort($historial_pagos->fecha_hora_creacion); // fecha_hora_creacion
			$historial_pagos->UpdateSort($historial_pagos->riesgo); // riesgo
			$historial_pagos->UpdateSort($historial_pagos->monto_pago); // monto_pago
			$historial_pagos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $historial_pagos;
		$sOrderBy = $historial_pagos->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($historial_pagos->SqlOrderBy() <> "") {
				$sOrderBy = $historial_pagos->SqlOrderBy();
				$historial_pagos->setSessionOrderBy($sOrderBy);
				$historial_pagos->idhistorial_pagos->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $historial_pagos;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$historial_pagos->setSessionOrderBy($sOrderBy);
				$historial_pagos->idhistorial_pagos->setSort("");
				$historial_pagos->usuario->setSort("");
				$historial_pagos->estado_pago->setSort("");
				$historial_pagos->ref_venta->setSort("");
				$historial_pagos->fecha_hora_creacion->setSort("");
				$historial_pagos->riesgo->setSort("");
				$historial_pagos->monto_pago->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$historial_pagos->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $historial_pagos;

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

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// "detail_pagos_x_docto"
		$item =& $this->ListOptions->Add("detail_pagos_x_docto");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('pagos_x_docto');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $historial_pagos, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . "<img src=\"phpimages/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $this->ShowOptionLink() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $this->ShowOptionLink() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<img src=\"phpimages/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "detail_pagos_x_docto"
		$oListOpt =& $this->ListOptions->Items["detail_pagos_x_docto"];
		if ($Security->AllowList('pagos_x_docto') && $this->ShowOptionLink()) {
			$oListOpt->Body = "<img src=\"phpimages/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("pagos_x_docto", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"pagos_x_doctolist.php?" . EW_TABLE_SHOW_MASTER . "=historial_pagos&idhistorial_pagos=" . urlencode(strval($historial_pagos->idhistorial_pagos->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($GLOBALS["pagos_x_docto"]->DetailEdit && $Security->CanEdit() && $this->ShowOptionLink() && $Security->AllowEdit('pagos_x_docto'))
				$links .= "<a class=\"ewRowLink\" href=\"" . $historial_pagos->EditUrl(EW_TABLE_SHOW_DETAIL . "=pagos_x_docto") . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>&nbsp;";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $historial_pagos;
		$sSqlWrk = "`historial`=" . ew_AdjustSql($historial_pagos->idhistorial_pagos->CurrentValue) . "";
		$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
		$sSqlWrk = str_replace("'", "\'", $sSqlWrk);
		$sHyperLinkParm = " href=\"pagos_x_doctolist.php?" . EW_TABLE_SHOW_MASTER . "=historial_pagos&idhistorial_pagos=" . urlencode(strval($historial_pagos->idhistorial_pagos->CurrentValue)) . "\"";
		$oListOpt =& $this->ListOptions->Items["detail_pagos_x_docto"];
		$oListOpt->Body = $Language->TablePhrase("pagos_x_docto", "TblCaption");
		$oListOpt->Body = "<a class=\"ewRowLink\"" . $sHyperLinkParm . ">" . $oListOpt->Body . "</a>";
		$sHyperLinkParm = " href=\"javascript:void(0);\" name=\"dl%i_historial_pagos_pagos_x_docto\" id=\"dl%i_historial_pagos_pagos_x_docto\" onclick=\"ew_AjaxShowDetails2(event, this, 'pagos_x_doctopreview.php?f=%s')\"";		
		$sHyperLinkParm = str_replace("%i", $this->RowCnt, $sHyperLinkParm);
		$sHyperLinkParm = str_replace("%s", $sSqlWrk, $sHyperLinkParm);
		$oListOpt->Body = "<a" . $sHyperLinkParm . "><img class=\"ewPreviewRowImage\" src=\"phpimages/expand.gif\" width=\"9\" height=\"9\" border=\"0\"></a>&nbsp;" . $oListOpt->Body;
		$links = "";
		if ($GLOBALS["pagos_x_docto"]->DetailEdit && $Security->CanEdit() && $this->ShowOptionLink() && $Security->AllowEdit('pagos_x_docto'))
			$links .= "<a class=\"ewRowLink\" href=\"" . $historial_pagos->EditUrl(EW_TABLE_SHOW_DETAIL . "=pagos_x_docto") . "\">" . "<img src=\"phpimages/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>&nbsp;";
		if ($links <> "") $oListOpt->Body .= "<br>" . $links;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $historial_pagos;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$historial_pagos->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$historial_pagos->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $historial_pagos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$historial_pagos->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$historial_pagos->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$historial_pagos->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $historial_pagos;
		$historial_pagos->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$historial_pagos->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $historial_pagos;

		// Load search values
		// idhistorial_pagos

		$historial_pagos->idhistorial_pagos->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_idhistorial_pagos"]);
		$historial_pagos->idhistorial_pagos->AdvancedSearch->SearchOperator = @$_GET["z_idhistorial_pagos"];

		// usuario
		$historial_pagos->usuario->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_usuario"]);
		$historial_pagos->usuario->AdvancedSearch->SearchOperator = @$_GET["z_usuario"];

		// tipo_docto
		$historial_pagos->tipo_docto->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_tipo_docto"]);
		$historial_pagos->tipo_docto->AdvancedSearch->SearchOperator = @$_GET["z_tipo_docto"];

		// consec_docto
		$historial_pagos->consec_docto->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_consec_docto"]);
		$historial_pagos->consec_docto->AdvancedSearch->SearchOperator = @$_GET["z_consec_docto"];

		// estado_pago
		$historial_pagos->estado_pago->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_estado_pago"]);
		$historial_pagos->estado_pago->AdvancedSearch->SearchOperator = @$_GET["z_estado_pago"];

		// ref_venta
		$historial_pagos->ref_venta->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ref_venta"]);
		$historial_pagos->ref_venta->AdvancedSearch->SearchOperator = @$_GET["z_ref_venta"];

		// fecha_hora_creacion
		$historial_pagos->fecha_hora_creacion->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_fecha_hora_creacion"]);
		$historial_pagos->fecha_hora_creacion->AdvancedSearch->SearchOperator = @$_GET["z_fecha_hora_creacion"];

		// riesgo
		$historial_pagos->riesgo->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_riesgo"]);
		$historial_pagos->riesgo->AdvancedSearch->SearchOperator = @$_GET["z_riesgo"];

		// medio_pago
		$historial_pagos->medio_pago->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_medio_pago"]);
		$historial_pagos->medio_pago->AdvancedSearch->SearchOperator = @$_GET["z_medio_pago"];

		// respuesta_pol
		$historial_pagos->respuesta_pol->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_respuesta_pol"]);
		$historial_pagos->respuesta_pol->AdvancedSearch->SearchOperator = @$_GET["z_respuesta_pol"];

		// monto_pago
		$historial_pagos->monto_pago->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_monto_pago"]);
		$historial_pagos->monto_pago->AdvancedSearch->SearchOperator = @$_GET["z_monto_pago"];
	}

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

	// Load old record
	function LoadOldRecord() {
		global $historial_pagos;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($historial_pagos->getKey("idhistorial_pagos")) <> "")
			$historial_pagos->idhistorial_pagos->CurrentValue = $historial_pagos->getKey("idhistorial_pagos"); // idhistorial_pagos
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$historial_pagos->CurrentFilter = $historial_pagos->KeyFilter();
			$sSql = $historial_pagos->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $historial_pagos;

		// Initialize URLs
		$this->ViewUrl = $historial_pagos->ViewUrl();
		$this->EditUrl = $historial_pagos->EditUrl();
		$this->InlineEditUrl = $historial_pagos->InlineEditUrl();
		$this->CopyUrl = $historial_pagos->CopyUrl();
		$this->InlineCopyUrl = $historial_pagos->InlineCopyUrl();
		$this->DeleteUrl = $historial_pagos->DeleteUrl();

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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $historial_pagos;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

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

	// Set up export options
	function SetupExportOptions() {
		global $Language, $historial_pagos;

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
		$item->Body = "<a name=\"emf_historial_pagos\" id=\"emf_historial_pagos\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_historial_pagos',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fhistorial_pagoslist,sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Hide options for export/action
		if ($historial_pagos->Export <> "" ||
			$historial_pagos->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $historial_pagos;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $historial_pagos->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($historial_pagos->ExportAll) {
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
		if ($historial_pagos->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($historial_pagos, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($historial_pagos->Export == "xml") {
			$historial_pagos->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$historial_pagos->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($historial_pagos->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($historial_pagos->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($historial_pagos->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($historial_pagos->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($historial_pagos->ExportReturnUrl());
		} elseif ($historial_pagos->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $Language, $historial_pagos;
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
		if ($historial_pagos->Email_Sending($Email, $EventArgs))
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
		global $historial_pagos;

		// Initialize
		$sQry = "export=html";

		// Build QueryString for search
		if ($historial_pagos->getSessionBasicSearchKeyword() <> "") {
			$sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . $historial_pagos->getSessionBasicSearchKeyword() . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . $historial_pagos->getSessionBasicSearchType();
		}
		$this->AddSearchQueryString($sQry, $historial_pagos->idhistorial_pagos); // idhistorial_pagos
		$this->AddSearchQueryString($sQry, $historial_pagos->usuario); // usuario
		$this->AddSearchQueryString($sQry, $historial_pagos->tipo_docto); // tipo_docto
		$this->AddSearchQueryString($sQry, $historial_pagos->consec_docto); // consec_docto
		$this->AddSearchQueryString($sQry, $historial_pagos->estado_pago); // estado_pago
		$this->AddSearchQueryString($sQry, $historial_pagos->ref_venta); // ref_venta
		$this->AddSearchQueryString($sQry, $historial_pagos->fecha_hora_creacion); // fecha_hora_creacion
		$this->AddSearchQueryString($sQry, $historial_pagos->riesgo); // riesgo
		$this->AddSearchQueryString($sQry, $historial_pagos->medio_pago); // medio_pago
		$this->AddSearchQueryString($sQry, $historial_pagos->respuesta_pol); // respuesta_pol
		$this->AddSearchQueryString($sQry, $historial_pagos->monto_pago); // monto_pago

		// Build QueryString for pager
		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . $historial_pagos->getRecordsPerPage() . "&" . EW_TABLE_START_REC . "=" . $historial_pagos->getStartRecordNumber();
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		global $historial_pagos;
		$FldParm = substr($Fld->FldVar, 2);
		$FldSearchValue = $historial_pagos->getAdvancedSearch("x_" . $FldParm);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . FldSearchValue .
				"&z_" . $FldParm . "=" . $historial_pagos->getAdvancedSearch("z_" . $FldParm);
		}
		$FldSearchValue2 = $historial_pagos->getAdvancedSearch("y_" . $FldParm);
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . $historial_pagos->getAdvancedSearch("v_" . $FldParm) .
				"&y_" . $FldParm . "=" . $FldSearchValue2 .
				"&w_" . $FldParm . "=" . $historial_pagos->getAdvancedSearch("w_" . $FldParm);
		}
	}

	// Show link optionally based on User ID
	function ShowOptionLink() {
		global $Security, $historial_pagos;
		if ($Security->IsLoggedIn()) {
			if (!$Security->IsAdmin()) {
				return $Security->IsValidUserID($historial_pagos->usuario->CurrentValue);
			}
		}
		return TRUE;
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
