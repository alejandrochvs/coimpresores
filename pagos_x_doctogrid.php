<?php include_once "usuariosinfo.php" ?>
<?php

// Create page object
$pagos_x_docto_grid = new cpagos_x_docto_grid();
$MasterPage =& $Page;
$Page =& $pagos_x_docto_grid;

// Page init
$pagos_x_docto_grid->Page_Init();

// Page main
$pagos_x_docto_grid->Page_Main();
?>
<?php if ($pagos_x_docto->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pagos_x_docto_grid = new ew_Page("pagos_x_docto_grid");

// page properties
pagos_x_docto_grid.PageID = "grid"; // page ID
pagos_x_docto_grid.FormID = "fpagos_x_doctogrid"; // form ID
var EW_PAGE_ID = pagos_x_docto_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
pagos_x_docto_grid.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	var addcnt = 0;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		var chkthisrow = true;
		if (fobj.a_list && fobj.a_list.value == "gridinsert")
			chkthisrow = !(this.EmptyRow(fobj, infix));
		else
			chkthisrow = true;
		if (chkthisrow) {
			addcnt += 1;
		elm = fobj.elements["x" + infix + "_tipo_docto"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->tipo_docto->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_consec_docto"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->consec_docto->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_consec_docto"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->consec_docto->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_valor"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->valor->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_valor"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->valor->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_cia"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->cia->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_cia"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->cia->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fecha"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->fecha->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estado"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->estado->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estado_pago"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pagos_x_docto->estado_pago->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_estado_pago"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->estado_pago->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_monto_pago"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pagos_x_docto->monto_pago->FldErrMsg()) ?>");

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
		} // End Grid Add checking
	}
	return true;
}

// Extend page with empty row check
pagos_x_docto_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "tipo_docto", false)) return false;
	if (ew_ValueChanged(fobj, infix, "consec_docto", false)) return false;
	if (ew_ValueChanged(fobj, infix, "valor", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cia", false)) return false;
	if (ew_ValueChanged(fobj, infix, "nit", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha", false)) return false;
	if (ew_ValueChanged(fobj, infix, "dias_vencidos", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado_pago", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_vencimiento", false)) return false;
	if (ew_ValueChanged(fobj, infix, "monto_pago", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
pagos_x_docto_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pagos_x_docto_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pagos_x_docto_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($pagos_x_docto->CurrentAction == "gridadd") {
	if ($pagos_x_docto->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$pagos_x_docto_grid->TotalRecs = $pagos_x_docto->SelectRecordCount();
			$pagos_x_docto_grid->Recordset = $pagos_x_docto_grid->LoadRecordset($pagos_x_docto_grid->StartRec-1, $pagos_x_docto_grid->DisplayRecs);
		} else {
			if ($pagos_x_docto_grid->Recordset = $pagos_x_docto_grid->LoadRecordset())
				$pagos_x_docto_grid->TotalRecs = $pagos_x_docto_grid->Recordset->RecordCount();
		}
		$pagos_x_docto_grid->StartRec = 1;
		$pagos_x_docto_grid->DisplayRecs = $pagos_x_docto_grid->TotalRecs;
	} else {
		$pagos_x_docto->CurrentFilter = "0=1";
		$pagos_x_docto_grid->StartRec = 1;
		$pagos_x_docto_grid->DisplayRecs = $pagos_x_docto->GridAddRowCount;
	}
	$pagos_x_docto_grid->TotalRecs = $pagos_x_docto_grid->DisplayRecs;
	$pagos_x_docto_grid->StopRec = $pagos_x_docto_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pagos_x_docto_grid->TotalRecs = $pagos_x_docto->SelectRecordCount();
	} else {
		if ($pagos_x_docto_grid->Recordset = $pagos_x_docto_grid->LoadRecordset())
			$pagos_x_docto_grid->TotalRecs = $pagos_x_docto_grid->Recordset->RecordCount();
	}
	$pagos_x_docto_grid->StartRec = 1;
	$pagos_x_docto_grid->DisplayRecs = $pagos_x_docto_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$pagos_x_docto_grid->Recordset = $pagos_x_docto_grid->LoadRecordset($pagos_x_docto_grid->StartRec-1, $pagos_x_docto_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($pagos_x_docto->CurrentMode == "add" || $pagos_x_docto->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($pagos_x_docto->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pagos_x_docto->TableCaption() ?></p>
</p>
<?php $pagos_x_docto_grid->ShowPageHeader(); ?>
<?php
$pagos_x_docto_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="gmp_pagos_x_docto" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pagos_x_docto->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pagos_x_docto_grid->RenderListOptions();

// Render list options (header, left)
$pagos_x_docto_grid->ListOptions->Render("header", "left");
?>
<?php if ($pagos_x_docto->iddoctocontable->Visible) { // iddoctocontable ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->iddoctocontable) == "") { ?>
		<td><?php echo $pagos_x_docto->iddoctocontable->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->iddoctocontable->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->iddoctocontable->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->iddoctocontable->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->tipo_docto->Visible) { // tipo_docto ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->tipo_docto) == "") { ?>
		<td><?php echo $pagos_x_docto->tipo_docto->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->tipo_docto->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->tipo_docto->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->tipo_docto->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->consec_docto->Visible) { // consec_docto ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->consec_docto) == "") { ?>
		<td><?php echo $pagos_x_docto->consec_docto->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->consec_docto->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->consec_docto->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->consec_docto->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->valor->Visible) { // valor ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->valor) == "") { ?>
		<td><?php echo $pagos_x_docto->valor->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->valor->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->valor->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->valor->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->cia->Visible) { // cia ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->cia) == "") { ?>
		<td><?php echo $pagos_x_docto->cia->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->cia->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->cia->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->cia->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->nit->Visible) { // nit ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->nit) == "") { ?>
		<td><?php echo $pagos_x_docto->nit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->nit->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->nit->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->nit->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->fecha->Visible) { // fecha ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->fecha) == "") { ?>
		<td><?php echo $pagos_x_docto->fecha->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->fecha->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->fecha->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->fecha->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->dias_vencidos->Visible) { // dias_vencidos ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->dias_vencidos) == "") { ?>
		<td><?php echo $pagos_x_docto->dias_vencidos->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->dias_vencidos->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->dias_vencidos->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->dias_vencidos->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->estado->Visible) { // estado ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->estado) == "") { ?>
		<td><?php echo $pagos_x_docto->estado->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->estado->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->estado->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->estado->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->estado_pago->Visible) { // estado_pago ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->estado_pago) == "") { ?>
		<td><?php echo $pagos_x_docto->estado_pago->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->estado_pago->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->estado_pago->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->estado_pago->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->fecha_vencimiento) == "") { ?>
		<td><?php echo $pagos_x_docto->fecha_vencimiento->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->fecha_vencimiento->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->fecha_vencimiento->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->fecha_vencimiento->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pagos_x_docto->monto_pago->Visible) { // monto_pago ?>
	<?php if ($pagos_x_docto->SortUrl($pagos_x_docto->monto_pago) == "") { ?>
		<td><?php echo $pagos_x_docto->monto_pago->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pagos_x_docto->monto_pago->FldCaption() ?></td><td style="width: 10px;"><?php if ($pagos_x_docto->monto_pago->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pagos_x_docto->monto_pago->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pagos_x_docto_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$pagos_x_docto_grid->StartRec = 1;
$pagos_x_docto_grid->StopRec = $pagos_x_docto_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($pagos_x_docto->CurrentAction == "gridadd" || $pagos_x_docto->CurrentAction == "gridedit" || $pagos_x_docto->CurrentAction == "F")) {
		$pagos_x_docto_grid->KeyCount = $objForm->GetValue("key_count");
		$pagos_x_docto_grid->StopRec = $pagos_x_docto_grid->KeyCount;
	}
}
$pagos_x_docto_grid->RecCnt = $pagos_x_docto_grid->StartRec - 1;
if ($pagos_x_docto_grid->Recordset && !$pagos_x_docto_grid->Recordset->EOF) {
	$pagos_x_docto_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $pagos_x_docto_grid->StartRec > 1)
		$pagos_x_docto_grid->Recordset->Move($pagos_x_docto_grid->StartRec - 1);
} elseif (!$pagos_x_docto->AllowAddDeleteRow && $pagos_x_docto_grid->StopRec == 0) {
	$pagos_x_docto_grid->StopRec = $pagos_x_docto->GridAddRowCount;
}

// Initialize aggregate
$pagos_x_docto->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pagos_x_docto->ResetAttrs();
$pagos_x_docto_grid->RenderRow();
$pagos_x_docto_grid->RowCnt = 0;
if ($pagos_x_docto->CurrentAction == "gridadd")
	$pagos_x_docto_grid->RowIndex = 0;
if ($pagos_x_docto->CurrentAction == "gridedit")
	$pagos_x_docto_grid->RowIndex = 0;
while ($pagos_x_docto_grid->RecCnt < $pagos_x_docto_grid->StopRec) {
	$pagos_x_docto_grid->RecCnt++;
	if (intval($pagos_x_docto_grid->RecCnt) >= intval($pagos_x_docto_grid->StartRec)) {
		$pagos_x_docto_grid->RowCnt++;
		if ($pagos_x_docto->CurrentAction == "gridadd" || $pagos_x_docto->CurrentAction == "gridedit" || $pagos_x_docto->CurrentAction == "F") {
			$pagos_x_docto_grid->RowIndex++;
			$objForm->Index = $pagos_x_docto_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$pagos_x_docto_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($pagos_x_docto->CurrentAction == "gridadd")
				$pagos_x_docto_grid->RowAction = "insert";
			else
				$pagos_x_docto_grid->RowAction = "";
		}

		// Set up key count
		$pagos_x_docto_grid->KeyCount = $pagos_x_docto_grid->RowIndex;

		// Init row class and style
		$pagos_x_docto->ResetAttrs();
		$pagos_x_docto->CssClass = "";
		if ($pagos_x_docto->CurrentAction == "gridadd") {
			if ($pagos_x_docto->CurrentMode == "copy") {
				$pagos_x_docto_grid->LoadRowValues($pagos_x_docto_grid->Recordset); // Load row values
				$pagos_x_docto_grid->SetRecordKey($pagos_x_docto_grid->RowOldKey, $pagos_x_docto_grid->Recordset); // Set old record key
			} else {
				$pagos_x_docto_grid->LoadDefaultValues(); // Load default values
				$pagos_x_docto_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($pagos_x_docto->CurrentAction == "gridedit") {
			$pagos_x_docto_grid->LoadRowValues($pagos_x_docto_grid->Recordset); // Load row values
		}
		$pagos_x_docto->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($pagos_x_docto->CurrentAction == "gridadd") // Grid add
			$pagos_x_docto->RowType = EW_ROWTYPE_ADD; // Render add
		if ($pagos_x_docto->CurrentAction == "gridadd" && $pagos_x_docto->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$pagos_x_docto_grid->RestoreCurrentRowFormValues($pagos_x_docto_grid->RowIndex); // Restore form values
		if ($pagos_x_docto->CurrentAction == "gridedit") { // Grid edit
			if ($pagos_x_docto->EventCancelled) {
				$pagos_x_docto_grid->RestoreCurrentRowFormValues($pagos_x_docto_grid->RowIndex); // Restore form values
			}
			if ($pagos_x_docto_grid->RowAction == "insert")
				$pagos_x_docto->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$pagos_x_docto->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($pagos_x_docto->CurrentAction == "gridedit" && ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT || $pagos_x_docto->RowType == EW_ROWTYPE_ADD) && $pagos_x_docto->EventCancelled) // Update failed
			$pagos_x_docto_grid->RestoreCurrentRowFormValues($pagos_x_docto_grid->RowIndex); // Restore form values
		if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) // Edit row
			$pagos_x_docto_grid->EditRowCnt++;
		if ($pagos_x_docto->CurrentAction == "F") // Confirm row
			$pagos_x_docto_grid->RestoreCurrentRowFormValues($pagos_x_docto_grid->RowIndex); // Restore form values
		if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD || $pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($pagos_x_docto->CurrentAction == "edit") {
				$pagos_x_docto->RowAttrs = array();
				$pagos_x_docto->CssClass = "ewTableEditRow";
			} else {
				$pagos_x_docto->RowAttrs = array();
			}
			if (!empty($pagos_x_docto_grid->RowIndex))
				$pagos_x_docto->RowAttrs = array_merge($pagos_x_docto->RowAttrs, array('data-rowindex'=>$pagos_x_docto_grid->RowIndex, 'id'=>'r' . $pagos_x_docto_grid->RowIndex . '_pagos_x_docto'));
		} else {
			$pagos_x_docto->RowAttrs = array();
		}

		// Render row
		$pagos_x_docto_grid->RenderRow();

		// Render list options
		$pagos_x_docto_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($pagos_x_docto_grid->RowAction <> "delete" && $pagos_x_docto_grid->RowAction <> "insertdelete" && !($pagos_x_docto_grid->RowAction == "insert" && $pagos_x_docto->CurrentAction == "F" && $pagos_x_docto_grid->EmptyRow())) {
?>
	<tr<?php echo $pagos_x_docto->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pagos_x_docto_grid->ListOptions->Render("body", "left");
?>
	<?php if ($pagos_x_docto->iddoctocontable->Visible) { // iddoctocontable ?>
		<td<?php echo $pagos_x_docto->iddoctocontable->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_iddoctocontable" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_iddoctocontable" value="<?php echo ew_HtmlEncode($pagos_x_docto->iddoctocontable->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $pagos_x_docto->iddoctocontable->ViewAttributes() ?>><?php echo $pagos_x_docto->iddoctocontable->EditValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_iddoctocontable" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_iddoctocontable" value="<?php echo ew_HtmlEncode($pagos_x_docto->iddoctocontable->CurrentValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->iddoctocontable->ViewAttributes() ?>><?php echo $pagos_x_docto->iddoctocontable->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_iddoctocontable" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_iddoctocontable" value="<?php echo ew_HtmlEncode($pagos_x_docto->iddoctocontable->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_iddoctocontable" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_iddoctocontable" value="<?php echo ew_HtmlEncode($pagos_x_docto->iddoctocontable->OldValue) ?>">
<?php } ?>
<a name="<?php echo $pagos_x_docto_grid->PageObjName . "_row_" . $pagos_x_docto_grid->RowCnt ?>" id="<?php echo $pagos_x_docto_grid->PageObjName . "_row_" . $pagos_x_docto_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($pagos_x_docto->tipo_docto->Visible) { // tipo_docto ?>
		<td<?php echo $pagos_x_docto->tipo_docto->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" size="30" maxlength="45" value="<?php echo $pagos_x_docto->tipo_docto->EditValue ?>"<?php echo $pagos_x_docto->tipo_docto->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" value="<?php echo ew_HtmlEncode($pagos_x_docto->tipo_docto->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" size="30" maxlength="45" value="<?php echo $pagos_x_docto->tipo_docto->EditValue ?>"<?php echo $pagos_x_docto->tipo_docto->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->tipo_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->tipo_docto->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" value="<?php echo ew_HtmlEncode($pagos_x_docto->tipo_docto->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" value="<?php echo ew_HtmlEncode($pagos_x_docto->tipo_docto->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->consec_docto->Visible) { // consec_docto ?>
		<td<?php echo $pagos_x_docto->consec_docto->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" size="30" value="<?php echo $pagos_x_docto->consec_docto->EditValue ?>"<?php echo $pagos_x_docto->consec_docto->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" value="<?php echo ew_HtmlEncode($pagos_x_docto->consec_docto->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" size="30" value="<?php echo $pagos_x_docto->consec_docto->EditValue ?>"<?php echo $pagos_x_docto->consec_docto->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->consec_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->consec_docto->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" value="<?php echo ew_HtmlEncode($pagos_x_docto->consec_docto->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" value="<?php echo ew_HtmlEncode($pagos_x_docto->consec_docto->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->valor->Visible) { // valor ?>
		<td<?php echo $pagos_x_docto->valor->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" size="30" value="<?php echo $pagos_x_docto->valor->EditValue ?>"<?php echo $pagos_x_docto->valor->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" value="<?php echo ew_HtmlEncode($pagos_x_docto->valor->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" size="30" value="<?php echo $pagos_x_docto->valor->EditValue ?>"<?php echo $pagos_x_docto->valor->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->valor->ViewAttributes() ?>><?php echo $pagos_x_docto->valor->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" value="<?php echo ew_HtmlEncode($pagos_x_docto->valor->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" value="<?php echo ew_HtmlEncode($pagos_x_docto->valor->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->cia->Visible) { // cia ?>
		<td<?php echo $pagos_x_docto->cia->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" size="30" value="<?php echo $pagos_x_docto->cia->EditValue ?>"<?php echo $pagos_x_docto->cia->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" value="<?php echo ew_HtmlEncode($pagos_x_docto->cia->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" size="30" value="<?php echo $pagos_x_docto->cia->EditValue ?>"<?php echo $pagos_x_docto->cia->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->cia->ViewAttributes() ?>><?php echo $pagos_x_docto->cia->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" value="<?php echo ew_HtmlEncode($pagos_x_docto->cia->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" value="<?php echo ew_HtmlEncode($pagos_x_docto->cia->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->nit->Visible) { // nit ?>
		<td<?php echo $pagos_x_docto->nit->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" size="30" maxlength="45" value="<?php echo $pagos_x_docto->nit->EditValue ?>"<?php echo $pagos_x_docto->nit->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" value="<?php echo ew_HtmlEncode($pagos_x_docto->nit->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" size="30" maxlength="45" value="<?php echo $pagos_x_docto->nit->EditValue ?>"<?php echo $pagos_x_docto->nit->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->nit->ViewAttributes() ?>><?php echo $pagos_x_docto->nit->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" value="<?php echo ew_HtmlEncode($pagos_x_docto->nit->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" value="<?php echo ew_HtmlEncode($pagos_x_docto->nit->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->fecha->Visible) { // fecha ?>
		<td<?php echo $pagos_x_docto->fecha->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" value="<?php echo $pagos_x_docto->fecha->EditValue ?>"<?php echo $pagos_x_docto->fecha->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($pagos_x_docto->fecha->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" value="<?php echo $pagos_x_docto->fecha->EditValue ?>"<?php echo $pagos_x_docto->fecha->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->fecha->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($pagos_x_docto->fecha->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($pagos_x_docto->fecha->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->dias_vencidos->Visible) { // dias_vencidos ?>
		<td<?php echo $pagos_x_docto->dias_vencidos->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" size="30" maxlength="45" value="<?php echo $pagos_x_docto->dias_vencidos->EditValue ?>"<?php echo $pagos_x_docto->dias_vencidos->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" value="<?php echo ew_HtmlEncode($pagos_x_docto->dias_vencidos->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" size="30" maxlength="45" value="<?php echo $pagos_x_docto->dias_vencidos->EditValue ?>"<?php echo $pagos_x_docto->dias_vencidos->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->dias_vencidos->ViewAttributes() ?>><?php echo $pagos_x_docto->dias_vencidos->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" value="<?php echo ew_HtmlEncode($pagos_x_docto->dias_vencidos->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" value="<?php echo ew_HtmlEncode($pagos_x_docto->dias_vencidos->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->estado->Visible) { // estado ?>
		<td<?php echo $pagos_x_docto->estado->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" size="30" maxlength="45" value="<?php echo $pagos_x_docto->estado->EditValue ?>"<?php echo $pagos_x_docto->estado->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($pagos_x_docto->estado->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" size="30" maxlength="45" value="<?php echo $pagos_x_docto->estado->EditValue ?>"<?php echo $pagos_x_docto->estado->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->estado->ViewAttributes() ?>><?php echo $pagos_x_docto->estado->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($pagos_x_docto->estado->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($pagos_x_docto->estado->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->estado_pago->Visible) { // estado_pago ?>
		<td<?php echo $pagos_x_docto->estado_pago->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" size="30" maxlength="45" value="<?php echo $pagos_x_docto->estado_pago->EditValue ?>"<?php echo $pagos_x_docto->estado_pago->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" value="<?php echo ew_HtmlEncode($pagos_x_docto->estado_pago->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" size="30" maxlength="45" value="<?php echo $pagos_x_docto->estado_pago->EditValue ?>"<?php echo $pagos_x_docto->estado_pago->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->estado_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->estado_pago->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" value="<?php echo ew_HtmlEncode($pagos_x_docto->estado_pago->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" value="<?php echo ew_HtmlEncode($pagos_x_docto->estado_pago->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
		<td<?php echo $pagos_x_docto->fecha_vencimiento->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" value="<?php echo $pagos_x_docto->fecha_vencimiento->EditValue ?>"<?php echo $pagos_x_docto->fecha_vencimiento->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" value="<?php echo ew_HtmlEncode($pagos_x_docto->fecha_vencimiento->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" value="<?php echo $pagos_x_docto->fecha_vencimiento->EditValue ?>"<?php echo $pagos_x_docto->fecha_vencimiento->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->fecha_vencimiento->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha_vencimiento->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" value="<?php echo ew_HtmlEncode($pagos_x_docto->fecha_vencimiento->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" value="<?php echo ew_HtmlEncode($pagos_x_docto->fecha_vencimiento->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->monto_pago->Visible) { // monto_pago ?>
		<td<?php echo $pagos_x_docto->monto_pago->CellAttributes() ?>>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" size="30" value="<?php echo $pagos_x_docto->monto_pago->EditValue ?>"<?php echo $pagos_x_docto->monto_pago->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($pagos_x_docto->monto_pago->OldValue) ?>">
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" size="30" value="<?php echo $pagos_x_docto->monto_pago->EditValue ?>"<?php echo $pagos_x_docto->monto_pago->EditAttributes() ?>>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $pagos_x_docto->monto_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->monto_pago->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($pagos_x_docto->monto_pago->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($pagos_x_docto->monto_pago->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pagos_x_docto_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($pagos_x_docto->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($pagos_x_docto->CurrentAction <> "gridadd" || $pagos_x_docto->CurrentMode == "copy")
		if (!$pagos_x_docto_grid->Recordset->EOF) $pagos_x_docto_grid->Recordset->MoveNext();
}
?>
<?php
	if ($pagos_x_docto->CurrentMode == "add" || $pagos_x_docto->CurrentMode == "copy" || $pagos_x_docto->CurrentMode == "edit") {
		$pagos_x_docto_grid->RowIndex = '$rowindex$';
		$pagos_x_docto_grid->LoadDefaultValues();

		// Set row properties
		$pagos_x_docto->ResetAttrs();
		$pagos_x_docto->RowAttrs = array();
		if (!empty($pagos_x_docto_grid->RowIndex))
			$pagos_x_docto->RowAttrs = array_merge($pagos_x_docto->RowAttrs, array('data-rowindex'=>$pagos_x_docto_grid->RowIndex, 'id'=>'r' . $pagos_x_docto_grid->RowIndex . '_pagos_x_docto'));
		$pagos_x_docto->RowType = EW_ROWTYPE_ADD;

		// Render row
		$pagos_x_docto_grid->RenderRow();

		// Render list options
		$pagos_x_docto_grid->RenderListOptions();

		// Add id and class to the template row
		$pagos_x_docto->RowAttrs["id"] = "r0_pagos_x_docto";
		ew_AppendClass($pagos_x_docto->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $pagos_x_docto->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pagos_x_docto_grid->ListOptions->Render("body", "left");
?>
	<?php if ($pagos_x_docto->iddoctocontable->Visible) { // iddoctocontable ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($pagos_x_docto->tipo_docto->Visible) { // tipo_docto ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" size="30" maxlength="45" value="<?php echo $pagos_x_docto->tipo_docto->EditValue ?>"<?php echo $pagos_x_docto->tipo_docto->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->tipo_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->tipo_docto->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" value="<?php echo ew_HtmlEncode($pagos_x_docto->tipo_docto->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_tipo_docto" value="<?php echo ew_HtmlEncode($pagos_x_docto->tipo_docto->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->consec_docto->Visible) { // consec_docto ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" size="30" value="<?php echo $pagos_x_docto->consec_docto->EditValue ?>"<?php echo $pagos_x_docto->consec_docto->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->consec_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->consec_docto->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" value="<?php echo ew_HtmlEncode($pagos_x_docto->consec_docto->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_consec_docto" value="<?php echo ew_HtmlEncode($pagos_x_docto->consec_docto->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->valor->Visible) { // valor ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" size="30" value="<?php echo $pagos_x_docto->valor->EditValue ?>"<?php echo $pagos_x_docto->valor->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->valor->ViewAttributes() ?>><?php echo $pagos_x_docto->valor->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" value="<?php echo ew_HtmlEncode($pagos_x_docto->valor->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_valor" value="<?php echo ew_HtmlEncode($pagos_x_docto->valor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->cia->Visible) { // cia ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" size="30" value="<?php echo $pagos_x_docto->cia->EditValue ?>"<?php echo $pagos_x_docto->cia->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->cia->ViewAttributes() ?>><?php echo $pagos_x_docto->cia->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" value="<?php echo ew_HtmlEncode($pagos_x_docto->cia->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_cia" value="<?php echo ew_HtmlEncode($pagos_x_docto->cia->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->nit->Visible) { // nit ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" size="30" maxlength="45" value="<?php echo $pagos_x_docto->nit->EditValue ?>"<?php echo $pagos_x_docto->nit->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->nit->ViewAttributes() ?>><?php echo $pagos_x_docto->nit->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" value="<?php echo ew_HtmlEncode($pagos_x_docto->nit->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_nit" value="<?php echo ew_HtmlEncode($pagos_x_docto->nit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->fecha->Visible) { // fecha ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" value="<?php echo $pagos_x_docto->fecha->EditValue ?>"<?php echo $pagos_x_docto->fecha->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->fecha->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($pagos_x_docto->fecha->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha" value="<?php echo ew_HtmlEncode($pagos_x_docto->fecha->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->dias_vencidos->Visible) { // dias_vencidos ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" size="30" maxlength="45" value="<?php echo $pagos_x_docto->dias_vencidos->EditValue ?>"<?php echo $pagos_x_docto->dias_vencidos->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->dias_vencidos->ViewAttributes() ?>><?php echo $pagos_x_docto->dias_vencidos->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" value="<?php echo ew_HtmlEncode($pagos_x_docto->dias_vencidos->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_dias_vencidos" value="<?php echo ew_HtmlEncode($pagos_x_docto->dias_vencidos->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->estado->Visible) { // estado ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" size="30" maxlength="45" value="<?php echo $pagos_x_docto->estado->EditValue ?>"<?php echo $pagos_x_docto->estado->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->estado->ViewAttributes() ?>><?php echo $pagos_x_docto->estado->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($pagos_x_docto->estado->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($pagos_x_docto->estado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->estado_pago->Visible) { // estado_pago ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" size="30" maxlength="45" value="<?php echo $pagos_x_docto->estado_pago->EditValue ?>"<?php echo $pagos_x_docto->estado_pago->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->estado_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->estado_pago->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" value="<?php echo ew_HtmlEncode($pagos_x_docto->estado_pago->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_estado_pago" value="<?php echo ew_HtmlEncode($pagos_x_docto->estado_pago->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" value="<?php echo $pagos_x_docto->fecha_vencimiento->EditValue ?>"<?php echo $pagos_x_docto->fecha_vencimiento->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->fecha_vencimiento->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha_vencimiento->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" value="<?php echo ew_HtmlEncode($pagos_x_docto->fecha_vencimiento->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_fecha_vencimiento" value="<?php echo ew_HtmlEncode($pagos_x_docto->fecha_vencimiento->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pagos_x_docto->monto_pago->Visible) { // monto_pago ?>
		<td>
<?php if ($pagos_x_docto->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" size="30" value="<?php echo $pagos_x_docto->monto_pago->EditValue ?>"<?php echo $pagos_x_docto->monto_pago->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $pagos_x_docto->monto_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->monto_pago->ViewValue ?></div>
<input type="hidden" name="x<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" id="x<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($pagos_x_docto->monto_pago->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" id="o<?php echo $pagos_x_docto_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($pagos_x_docto->monto_pago->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pagos_x_docto_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($pagos_x_docto->CurrentMode == "add" || $pagos_x_docto->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $pagos_x_docto_grid->KeyCount ?>">
<?php echo $pagos_x_docto_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($pagos_x_docto->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $pagos_x_docto_grid->KeyCount ?>">
<?php echo $pagos_x_docto_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="pagos_x_docto_grid">
</div>
<?php

// Close recordset
if ($pagos_x_docto_grid->Recordset)
	$pagos_x_docto_grid->Recordset->Close();
?>
<?php if (($pagos_x_docto->CurrentMode == "add" || $pagos_x_docto->CurrentMode == "copy" || $pagos_x_docto->CurrentMode == "edit") && $pagos_x_docto->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
</div>
<?php } ?>
</td></tr></table>
<?php if ($pagos_x_docto->Export == "" && $pagos_x_docto->CurrentAction == "") { ?>
<?php } ?>
<?php
$pagos_x_docto_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$pagos_x_docto_grid->Page_Terminate();
$Page =& $MasterPage;
?>
