<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "pagos_x_doctoinfo.php" ?>
<?php include_once "historial_pagosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$pagos_x_docto_list = new cpagos_x_docto_list();
$Page =& $pagos_x_docto_list;

// Page init
$pagos_x_docto_list->Page_Init();

// Page main
$pagos_x_docto_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($pagos_x_docto->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pagos_x_docto_list = new ew_Page("pagos_x_docto_list");

// page properties
pagos_x_docto_list.PageID = "list"; // page ID
pagos_x_docto_list.FormID = "fpagos_x_doctolist"; // form ID
var EW_PAGE_ID = pagos_x_docto_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pagos_x_docto_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pagos_x_docto_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pagos_x_docto_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($pagos_x_docto->Export == "") || (EW_EXPORT_MASTER_RECORD && $pagos_x_docto->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "historial_pagoslist.php";
if ($pagos_x_docto_list->DbMasterFilter <> "" && $pagos_x_docto->getCurrentMasterTable() == "historial_pagos") {
	if ($pagos_x_docto_list->MasterRecordExists) {
		if ($pagos_x_docto->getCurrentMasterTable() == $pagos_x_docto->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $historial_pagos->TableCaption() ?>
&nbsp;&nbsp;<?php $pagos_x_docto_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($pagos_x_docto->Export == "") { ?>
<p class="phpmaker"><a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></p>
<?php } ?>
<?php include_once "historial_pagosmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pagos_x_docto_list->TotalRecs = $pagos_x_docto->SelectRecordCount();
	} else {
		if ($pagos_x_docto_list->Recordset = $pagos_x_docto_list->LoadRecordset())
			$pagos_x_docto_list->TotalRecs = $pagos_x_docto_list->Recordset->RecordCount();
	}
	$pagos_x_docto_list->StartRec = 1;
	if ($pagos_x_docto_list->DisplayRecs <= 0 || ($pagos_x_docto->Export <> "" && $pagos_x_docto->ExportAll)) // Display all records
		$pagos_x_docto_list->DisplayRecs = $pagos_x_docto_list->TotalRecs;
	if (!($pagos_x_docto->Export <> "" && $pagos_x_docto->ExportAll))
		$pagos_x_docto_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pagos_x_docto_list->Recordset = $pagos_x_docto_list->LoadRecordset($pagos_x_docto_list->StartRec-1, $pagos_x_docto_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pagos_x_docto->TableCaption() ?>
<?php if ($pagos_x_docto->getCurrentMasterTable() == "") { ?>
&nbsp;&nbsp;<?php $pagos_x_docto_list->ExportOptions->Render("body"); ?>
<?php } ?>
</p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($pagos_x_docto->Export == "" && $pagos_x_docto->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(pagos_x_docto_list);" style="text-decoration: none;"><img id="pagos_x_docto_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="pagos_x_docto_list_SearchPanel">
<form name="fpagos_x_doctolistsrch" id="fpagos_x_doctolistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="pagos_x_docto">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($pagos_x_docto->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $pagos_x_docto_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($pagos_x_docto->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($pagos_x_docto->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($pagos_x_docto->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $pagos_x_docto_list->ShowPageHeader(); ?>
<?php
$pagos_x_docto_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fpagos_x_doctolist" id="fpagos_x_doctolist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="pagos_x_docto">
<div id="gmp_pagos_x_docto" class="ewGridMiddlePanel">
<?php if ($pagos_x_docto_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pagos_x_docto->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pagos_x_docto_list->RenderListOptions();

// Render list options (header, left)
$pagos_x_docto_list->ListOptions->Render("header", "left");
?>
<?php if ($pagos_x_docto->iddoctocontable->Visible) { // iddoctocontable ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->iddoctocontable) == "") { ?>
		<td><?php echo $pagos_x_docto->iddoctocontable->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->iddoctocontable) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->iddoctocontable->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->iddoctocontable->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->iddoctocontable->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->tipo_docto->Visible) { // tipo_docto ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->tipo_docto) == "") { ?>
		<td><?php echo $pagos_x_docto->tipo_docto->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->tipo_docto) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->tipo_docto->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->tipo_docto->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->tipo_docto->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->consec_docto->Visible) { // consec_docto ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->consec_docto) == "") { ?>
		<td><?php echo $pagos_x_docto->consec_docto->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->consec_docto) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->consec_docto->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->consec_docto->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->consec_docto->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->valor->Visible) { // valor ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->valor) == "") { ?>
		<td><?php echo $pagos_x_docto->valor->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->valor) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->valor->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->valor->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->valor->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->cia->Visible) { // cia ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->cia) == "") { ?>
		<td><?php echo $pagos_x_docto->cia->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->cia) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->cia->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->cia->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->cia->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->nit->Visible) { // nit ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->nit) == "") { ?>
		<td><?php echo $pagos_x_docto->nit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->nit) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->nit->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->nit->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->nit->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->fecha->Visible) { // fecha ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->fecha) == "") { ?>
		<td><?php echo $pagos_x_docto->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->fecha) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->fecha->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->fecha->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->dias_vencidos->Visible) { // dias_vencidos ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->dias_vencidos) == "") { ?>
		<td><?php echo $pagos_x_docto->dias_vencidos->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->dias_vencidos) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->dias_vencidos->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->dias_vencidos->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->dias_vencidos->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->estado->Visible) { // estado ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->estado) == "") { ?>
		<td><?php echo $pagos_x_docto->estado->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->estado) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->estado->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->estado->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->estado->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->estado_pago->Visible) { // estado_pago ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->estado_pago) == "") { ?>
		<td><?php echo $pagos_x_docto->estado_pago->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->estado_pago) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->estado_pago->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->estado_pago->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->estado_pago->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->fecha_vencimiento) == "") { ?>
		<td><?php echo $pagos_x_docto->fecha_vencimiento->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->fecha_vencimiento) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->fecha_vencimiento->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->fecha_vencimiento->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->fecha_vencimiento->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->monto_pago->Visible) { // monto_pago ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->monto_pago) == "") { ?>
		<td><?php echo $pagos_x_docto->monto_pago->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pagos_x_docto->SortUrl($pagos_x_docto->monto_pago) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->monto_pago->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->monto_pago->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->monto_pago->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pagos_x_docto_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($pagos_x_docto->ExportAll && $pagos_x_docto->Export <> "") {
	$pagos_x_docto_list->StopRec = $pagos_x_docto_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pagos_x_docto_list->TotalRecs > $pagos_x_docto_list->StartRec + $pagos_x_docto_list->DisplayRecs - 1)
		$pagos_x_docto_list->StopRec = $pagos_x_docto_list->StartRec + $pagos_x_docto_list->DisplayRecs - 1;
	else
		$pagos_x_docto_list->StopRec = $pagos_x_docto_list->TotalRecs;
}
$pagos_x_docto_list->RecCnt = $pagos_x_docto_list->StartRec - 1;
if ($pagos_x_docto_list->Recordset && !$pagos_x_docto_list->Recordset->EOF) {
	$pagos_x_docto_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $pagos_x_docto_list->StartRec > 1)
		$pagos_x_docto_list->Recordset->Move($pagos_x_docto_list->StartRec - 1);
} elseif (!$pagos_x_docto->AllowAddDeleteRow && $pagos_x_docto_list->StopRec == 0) {
	$pagos_x_docto_list->StopRec = $pagos_x_docto->GridAddRowCount;
}

// Initialize aggregate
$pagos_x_docto->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pagos_x_docto->ResetAttrs();
$pagos_x_docto_list->RenderRow();
$pagos_x_docto_list->RowCnt = 0;
while ($pagos_x_docto_list->RecCnt < $pagos_x_docto_list->StopRec) {
	$pagos_x_docto_list->RecCnt++;
	if (intval($pagos_x_docto_list->RecCnt) >= intval($pagos_x_docto_list->StartRec)) {
		$pagos_x_docto_list->RowCnt++;

		// Set up key count
		$pagos_x_docto_list->KeyCount = $pagos_x_docto_list->RowIndex;

		// Init row class and style
		$pagos_x_docto->ResetAttrs();
		$pagos_x_docto->CssClass = "";
		if ($pagos_x_docto->CurrentAction == "gridadd") {
		} else {
			$pagos_x_docto_list->LoadRowValues($pagos_x_docto_list->Recordset); // Load row values
		}
		$pagos_x_docto->RowType = EW_ROWTYPE_VIEW; // Render view
		$pagos_x_docto->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$pagos_x_docto_list->RenderRow();

		// Render list options
		$pagos_x_docto_list->RenderListOptions();
?>
	<tr<?php echo $pagos_x_docto->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pagos_x_docto_list->ListOptions->Render("body", "left");
?>
	<?php if ($pagos_x_docto->iddoctocontable->Visible) { // iddoctocontable ?>
		<td<?php echo $pagos_x_docto->iddoctocontable->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->iddoctocontable->ViewAttributes() ?>><?php echo $pagos_x_docto->iddoctocontable->ListViewValue() ?></div>
<a name="<?php echo $pagos_x_docto_list->PageObjName . "_row_" . $pagos_x_docto_list->RowCnt ?>" id="<?php echo $pagos_x_docto_list->PageObjName . "_row_" . $pagos_x_docto_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($pagos_x_docto->tipo_docto->Visible) { // tipo_docto ?>
		<td<?php echo $pagos_x_docto->tipo_docto->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->tipo_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->tipo_docto->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->consec_docto->Visible) { // consec_docto ?>
		<td<?php echo $pagos_x_docto->consec_docto->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->consec_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->consec_docto->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->valor->Visible) { // valor ?>
		<td<?php echo $pagos_x_docto->valor->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->valor->ViewAttributes() ?>><?php echo $pagos_x_docto->valor->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->cia->Visible) { // cia ?>
		<td<?php echo $pagos_x_docto->cia->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->cia->ViewAttributes() ?>><?php echo $pagos_x_docto->cia->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->nit->Visible) { // nit ?>
		<td<?php echo $pagos_x_docto->nit->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->nit->ViewAttributes() ?>><?php echo $pagos_x_docto->nit->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->fecha->Visible) { // fecha ?>
		<td<?php echo $pagos_x_docto->fecha->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->fecha->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->dias_vencidos->Visible) { // dias_vencidos ?>
		<td<?php echo $pagos_x_docto->dias_vencidos->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->dias_vencidos->ViewAttributes() ?>><?php echo $pagos_x_docto->dias_vencidos->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->estado->Visible) { // estado ?>
		<td<?php echo $pagos_x_docto->estado->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->estado->ViewAttributes() ?>><?php echo $pagos_x_docto->estado->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->estado_pago->Visible) { // estado_pago ?>
		<td<?php echo $pagos_x_docto->estado_pago->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->estado_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->estado_pago->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
		<td<?php echo $pagos_x_docto->fecha_vencimiento->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->fecha_vencimiento->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha_vencimiento->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->monto_pago->Visible) { // monto_pago ?>
		<td<?php echo $pagos_x_docto->monto_pago->CellAttributes() ?>>
<div<?php echo $pagos_x_docto->monto_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->monto_pago->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pagos_x_docto_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($pagos_x_docto->CurrentAction <> "gridadd")
		$pagos_x_docto_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pagos_x_docto_list->Recordset)
	$pagos_x_docto_list->Recordset->Close();
?>
<?php if ($pagos_x_docto->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($pagos_x_docto->CurrentAction <> "gridadd" && $pagos_x_docto->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($pagos_x_docto_list->Pager)) $pagos_x_docto_list->Pager = new cNumericPager($pagos_x_docto_list->StartRec, $pagos_x_docto_list->DisplayRecs, $pagos_x_docto_list->TotalRecs, $pagos_x_docto_list->RecRange) ?>
<?php if ($pagos_x_docto_list->Pager->RecordCount > 0) { ?>
	<?php if ($pagos_x_docto_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $pagos_x_docto_list->PageUrl() ?>start=<?php echo $pagos_x_docto_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pagos_x_docto_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $pagos_x_docto_list->PageUrl() ?>start=<?php echo $pagos_x_docto_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($pagos_x_docto_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $pagos_x_docto_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($pagos_x_docto_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $pagos_x_docto_list->PageUrl() ?>start=<?php echo $pagos_x_docto_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pagos_x_docto_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $pagos_x_docto_list->PageUrl() ?>start=<?php echo $pagos_x_docto_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($pagos_x_docto_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pagos_x_docto_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pagos_x_docto_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pagos_x_docto_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($Security->CanList()) { ?>
	<?php if ($pagos_x_docto_list->SearchWhere == "0=101") { ?>
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
<?php if ($pagos_x_docto->Export == "" && $pagos_x_docto->CurrentAction == "") { ?>
<?php } ?>
<?php
$pagos_x_docto_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pagos_x_docto->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pagos_x_docto_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpagos_x_docto_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'pagos_x_docto';

	// Page object name
	var $PageObjName = 'pagos_x_docto_list';

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
	function cpagos_x_docto_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (pagos_x_docto)
		if (!isset($GLOBALS["pagos_x_docto"])) {
			$GLOBALS["pagos_x_docto"] = new cpagos_x_docto();
			$GLOBALS["Table"] =& $GLOBALS["pagos_x_docto"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "pagos_x_doctoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pagos_x_doctodelete.php";
		$this->MultiUpdateUrl = "pagos_x_doctoupdate.php";

		// Table object (historial_pagos)
		if (!isset($GLOBALS['historial_pagos'])) $GLOBALS['historial_pagos'] = new chistorial_pagos();

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pagos_x_docto', TRUE);

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
			$this->Page_Terminate();
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$pagos_x_docto->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$pagos_x_docto->Export = $_POST["exporttype"];
		} else {
			$pagos_x_docto->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $pagos_x_docto->Export; // Get export parameter, used in header
		$gsExportFile = $pagos_x_docto->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($pagos_x_docto->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($pagos_x_docto->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}
		if ($pagos_x_docto->Export == "xml") {
			header('Content-Type: text/xml' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($pagos_x_docto->Export == "csv") {
			header('Content-Type: application/csv' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$pagos_x_docto->GridAddRowCount = $gridaddcnt;

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
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$pagos_x_docto->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($pagos_x_docto->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $pagos_x_docto->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$pagos_x_docto->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$pagos_x_docto->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$pagos_x_docto->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $pagos_x_docto->getSearchWhere();
		}

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

		// Export data only
		if (in_array($pagos_x_docto->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($pagos_x_docto->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $pagos_x_docto;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $pagos_x_docto->tipo_docto, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pagos_x_docto->nit, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pagos_x_docto->tercero, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pagos_x_docto->dias_vencidos, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pagos_x_docto->estado, $Keyword);
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $pagos_x_docto->estado_pago, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pagos_x_docto->descripcion, $Keyword);
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
		global $Security, $pagos_x_docto;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $pagos_x_docto->BasicSearchKeyword;
		$sSearchType = $pagos_x_docto->BasicSearchType;
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
			$pagos_x_docto->setSessionBasicSearchKeyword($sSearchKeyword);
			$pagos_x_docto->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $pagos_x_docto;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$pagos_x_docto->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $pagos_x_docto;
		$pagos_x_docto->setSessionBasicSearchKeyword("");
		$pagos_x_docto->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $pagos_x_docto;
		$bRestore = TRUE;
		if ($pagos_x_docto->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$pagos_x_docto->BasicSearchKeyword = $pagos_x_docto->getSessionBasicSearchKeyword();
			$pagos_x_docto->BasicSearchType = $pagos_x_docto->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pagos_x_docto;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pagos_x_docto->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pagos_x_docto->CurrentOrderType = @$_GET["ordertype"];
			$pagos_x_docto->UpdateSort($pagos_x_docto->iddoctocontable); // iddoctocontable
			$pagos_x_docto->UpdateSort($pagos_x_docto->tipo_docto); // tipo_docto
			$pagos_x_docto->UpdateSort($pagos_x_docto->consec_docto); // consec_docto
			$pagos_x_docto->UpdateSort($pagos_x_docto->valor); // valor
			$pagos_x_docto->UpdateSort($pagos_x_docto->cia); // cia
			$pagos_x_docto->UpdateSort($pagos_x_docto->nit); // nit
			$pagos_x_docto->UpdateSort($pagos_x_docto->fecha); // fecha
			$pagos_x_docto->UpdateSort($pagos_x_docto->dias_vencidos); // dias_vencidos
			$pagos_x_docto->UpdateSort($pagos_x_docto->estado); // estado
			$pagos_x_docto->UpdateSort($pagos_x_docto->estado_pago); // estado_pago
			$pagos_x_docto->UpdateSort($pagos_x_docto->fecha_vencimiento); // fecha_vencimiento
			$pagos_x_docto->UpdateSort($pagos_x_docto->monto_pago); // monto_pago
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

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

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
				$pagos_x_docto->iddoctocontable->setSort("");
				$pagos_x_docto->tipo_docto->setSort("");
				$pagos_x_docto->consec_docto->setSort("");
				$pagos_x_docto->valor->setSort("");
				$pagos_x_docto->cia->setSort("");
				$pagos_x_docto->nit->setSort("");
				$pagos_x_docto->fecha->setSort("");
				$pagos_x_docto->dias_vencidos->setSort("");
				$pagos_x_docto->estado->setSort("");
				$pagos_x_docto->estado_pago->setSort("");
				$pagos_x_docto->fecha_vencimiento->setSort("");
				$pagos_x_docto->monto_pago->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$pagos_x_docto->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $pagos_x_docto;

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

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $pagos_x_docto, $objForm;
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
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
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

	// Load basic search values
	function LoadBasicSearchValues() {
		global $pagos_x_docto;
		$pagos_x_docto->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$pagos_x_docto->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		if (strval($pagos_x_docto->getKey("iddoctocontable")) <> "")
			$pagos_x_docto->iddoctocontable->CurrentValue = $pagos_x_docto->getKey("iddoctocontable"); // iddoctocontable
		else
			$bValidKey = FALSE;

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
		$this->ViewUrl = $pagos_x_docto->ViewUrl();
		$this->EditUrl = $pagos_x_docto->EditUrl();
		$this->InlineEditUrl = $pagos_x_docto->InlineEditUrl();
		$this->CopyUrl = $pagos_x_docto->CopyUrl();
		$this->InlineCopyUrl = $pagos_x_docto->InlineCopyUrl();
		$this->DeleteUrl = $pagos_x_docto->DeleteUrl();

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
		}

		// Call Row Rendered event
		if ($pagos_x_docto->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pagos_x_docto->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $pagos_x_docto;

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
		$item->Body = "<a name=\"emf_pagos_x_docto\" id=\"emf_pagos_x_docto\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_pagos_x_docto',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fpagos_x_doctolist,sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$item->Visible = TRUE;

		// Hide options for export/action
		if ($pagos_x_docto->Export <> "" ||
			$pagos_x_docto->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $pagos_x_docto;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $pagos_x_docto->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($pagos_x_docto->ExportAll) {
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
		if ($pagos_x_docto->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($pagos_x_docto, "h");
		}
		$ParentTable = "";

		// Export master record
		if (EW_EXPORT_MASTER_RECORD && $pagos_x_docto->getMasterFilter() <> "" && $pagos_x_docto->getCurrentMasterTable() == "historial_pagos") {
			global $historial_pagos;
			$rsmaster = $historial_pagos->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				if ($pagos_x_docto->Export == "xml") {
					$ParentTable = "historial_pagos";
					$historial_pagos->ExportXmlDocument($XmlDoc, '', $rsmaster, 1, 1);
				} else {
					$ExportStyle = $ExportDoc->Style;
					$ExportDoc->ChangeStyle("v"); // Change to vertical
					if ($pagos_x_docto->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
						$historial_pagos->ExportDocument($ExportDoc, $rsmaster, 1, 1);
						$ExportDoc->ExportEmptyLine();
					}
					$ExportDoc->ChangeStyle($ExportStyle); // Restore
				}
				$rsmaster->Close();
			}
		}
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($pagos_x_docto->Export == "xml") {
			$pagos_x_docto->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$pagos_x_docto->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($pagos_x_docto->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($pagos_x_docto->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($pagos_x_docto->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($pagos_x_docto->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($pagos_x_docto->ExportReturnUrl());
		} elseif ($pagos_x_docto->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $Language, $pagos_x_docto;
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
		if ($pagos_x_docto->Email_Sending($Email, $EventArgs))
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
		global $pagos_x_docto;

		// Initialize
		$sQry = "export=html";

		// Build QueryString for search
		if ($pagos_x_docto->getSessionBasicSearchKeyword() <> "") {
			$sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . $pagos_x_docto->getSessionBasicSearchKeyword() . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . $pagos_x_docto->getSessionBasicSearchType();
		}

		// Build QueryString for pager
		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . $pagos_x_docto->getRecordsPerPage() . "&" . EW_TABLE_START_REC . "=" . $pagos_x_docto->getStartRecordNumber();
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		global $pagos_x_docto;
		$FldParm = substr($Fld->FldVar, 2);
		$FldSearchValue = $pagos_x_docto->getAdvancedSearch("x_" . $FldParm);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . FldSearchValue .
				"&z_" . $FldParm . "=" . $pagos_x_docto->getAdvancedSearch("z_" . $FldParm);
		}
		$FldSearchValue2 = $pagos_x_docto->getAdvancedSearch("y_" . $FldParm);
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . $pagos_x_docto->getAdvancedSearch("v_" . $FldParm) .
				"&y_" . $FldParm . "=" . $FldSearchValue2 .
				"&w_" . $FldParm . "=" . $pagos_x_docto->getAdvancedSearch("w_" . $FldParm);
		}
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
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "historial_pagos") {
				$bValidMaster = TRUE;
				if (@$_GET["idhistorial_pagos"] <> "") {
					$GLOBALS["historial_pagos"]->idhistorial_pagos->setQueryStringValue($_GET["idhistorial_pagos"]);
					$pagos_x_docto->historial->setQueryStringValue($GLOBALS["historial_pagos"]->idhistorial_pagos->QueryStringValue);
					$pagos_x_docto->historial->setSessionValue($pagos_x_docto->historial->QueryStringValue);
					if (!is_numeric($GLOBALS["historial_pagos"]->idhistorial_pagos->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$pagos_x_docto->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$pagos_x_docto->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "historial_pagos") {
				if ($pagos_x_docto->historial->QueryStringValue == "") $pagos_x_docto->historial->setSessionValue("");
			}
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
