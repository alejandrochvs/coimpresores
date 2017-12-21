<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "documento_contableinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$documento_contable_list = new cdocumento_contable_list();
$Page =& $documento_contable_list;

// Page init
$documento_contable_list->Page_Init();

// Page main
$documento_contable_list->Page_Main();
?>
<?php include_once "header.php" ?>
<link rel="stylesheet" href="modules/documento_contablelist/css/documento_contablelist.css" type="text/css"/>
<?php if ($documento_contable->Export == "") { ?>
    <script type="text/javascript">
        <!--

        // Create page object
        var documento_contable_list = new ew_Page("documento_contable_list");

        // page properties
        documento_contable_list.PageID = "list"; // page ID
        documento_contable_list.FormID = "fdocumento_contablelist"; // form ID
        var EW_PAGE_ID = documento_contable_list.PageID; // for backward compatibility

        // extend page with Form_CustomValidate function
        documento_contable_list.Form_CustomValidate =
            function (fobj) { // DO NOT CHANGE THIS LINE!

                // Your custom validation code here, return false if invalid.
                return true;
            }
        <?php if (EW_CLIENT_VALIDATE) { ?>
        documento_contable_list.ValidateRequired = true; // uses JavaScript validation
        <?php } else { ?>
        documento_contable_list.ValidateRequired = false; // no JavaScript validation
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
                row = ewDom.getElementBy(function (node) {
                    return ewDom.hasClass(node, EW_TABLE_PREVIEW_ROW_CLASSNAME)
                }, "TR", tb);
                ew_RemoveRowFromTable(row);
            }
            var sr = ewDom.getNextSiblingBy(r, function (node) {
                return node.tagName == "TR"
            });
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
        var ew_AjaxHandleSuccess2 = function (o) {
            if (o.responseText !== undefined) {
                var row = o.argument.row;
                if (!row || !row.cells || !row.cells[0]) return;
                row.cells[0].innerHTML = o.responseText;
                var ct = ewDom.getElementBy(function (node) {
                    return ewDom.hasClass(node, EW_TABLE_CLASS)
                }, "TABLE", row);
                if (ct) ew_SetupTable(ct);

                //clearTimeout(ew_AjaxDetailsTimer);
                //setTimeout("alert(ew_AjaxDetailsTimer);", 500);

            }
        }

        // show error in new table row
        var ew_AjaxHandleFailure2 = function (o) {
            var row = o.argument.row;
            if (!row || !row.cells || !row.cells[0]) return;
            row.cells[0].innerHTML = o.responseText;
        }

        // show detail preview by table row expansion
        function ew_AjaxShowDetails2(ev, link, url) {
            var img = ewDom.getElementBy(function (node) {
                return true;
            }, "IMG", link);
            var r = ewDom.getAncestorByTagName(link, "TR");
            if (!img || !r)
                return;
            var show = (img.src.substr(img.src.length - EW_PREVIEW_SHOW_IMAGE.length) == EW_PREVIEW_SHOW_IMAGE);
            if (show) {
                if (ew_AjaxDetailsTimer)
                    clearTimeout(ew_AjaxDetailsTimer);
                var row = ew_AddRowToTable(r);
                ew_AjaxDetailsTimer = setTimeout(function () {
                    ewConnect.asyncRequest('GET', url, {
                        success: ew_AjaxHandleSuccess2,
                        failure: ew_AjaxHandleFailure2,
                        argument: {id: link, row: row}
                    })
                }, 200);
                ewDom.getElementsByClassName(EW_PREVIEW_IMAGE_CLASSNAME, "IMG", r, function (node) {
                    node.src = EW_PREVIEW_SHOW_IMAGE
                });
                img.src = EW_PREVIEW_HIDE_IMAGE;
            } else {
                var sr = ewDom.getNextSiblingBy(r, function (node) {
                    return node.tagName == "TR"
                });
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
<?php if (($documento_contable->Export == "") || (EW_EXPORT_MASTER_RECORD && $documento_contable->Export == "print")) { ?>
<?php } ?>
<?php if (EW_EXPORT_MASTER_RECORD && $documento_contable->Export == "print") { ?>
    <script language="JavaScript" type="text/javascript">
        window.onload = window.print();
    </script>
    <style media="print">
        #invisibleprint {
            display: none;
        }
    </style>
    <div id="invisibleprint" onclick="history.back()" style=" cursor:pointer;">&#8249; Volver</div>
<?php } ?>
<?php
$bSelectLimit = EW_SELECT_LIMIT;
if ($bSelectLimit) {
    $documento_contable_list->TotalRecs = $documento_contable->SelectRecordCount();
} else {
    if ($documento_contable_list->Recordset = $documento_contable_list->LoadRecordset())
        $documento_contable_list->TotalRecs = $documento_contable_list->Recordset->RecordCount();
}
$documento_contable_list->StartRec = 1;
if ($documento_contable_list->DisplayRecs <= 0 || ($documento_contable->Export <> "" && $documento_contable->ExportAll)) // Display all records
    $documento_contable_list->DisplayRecs = $documento_contable_list->TotalRecs;
if (!($documento_contable->Export <> "" && $documento_contable->ExportAll))
    $documento_contable_list->SetUpStartRec(); // Set up start record position
if ($bSelectLimit)
    $documento_contable_list->Recordset = $documento_contable_list->LoadRecordset($documento_contable_list->StartRec - 1, $documento_contable_list->DisplayRecs);
?>
<p class="phpmaker ewTitle"
   style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documento_contable->TableCaption() ?>
    &nbsp;&nbsp;<?php $documento_contable_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
    <?php if ($documento_contable->Export == "" && $documento_contable->CurrentAction == "") { ?>
        <div class="searchPanel">
            <a href="javascript:ew_ToggleSearchPanel(documento_contable_list);" style="text-decoration: none;">
                <img id="documento_contable_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9"
                     border="0">
            </a>
            <span class="phpmaker">
            <?php echo $Language->Phrase("Search") ?>
        </span>
            <div id="documento_contable_list_SearchPanel">
                <form name="fdocumento_contablelistsrch" id="fdocumento_contablelistsrch" class="ewForm"
                      action="<?php echo ew_CurrentPage() ?>">
                    <input type="hidden" id="t" name="t" value="documento_contable">
                    <div class="ewBasicSearch">
                        <div id="xsr_1" class="ewCssTableRow">
                            <input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>"
                                   id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20"
                                   value="<?php echo ew_HtmlEncode($documento_contable->getSessionBasicSearchKeyword()) ?>">
                            <input type="Submit" name="Submit" id="Submit"
                                   value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
                            <a href="<?php echo $documento_contable_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
                        </div>
                        <div id="xsr_2" class="ewCssTableRow">
                            <label>
                                <input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                          id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                          value=""<?php if ($documento_contable->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?>
                            </label><label><input type="radio"
                                                              name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                                              id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                                              value="AND"<?php if ($documento_contable->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?>
                            </label><label><input type="radio"
                                                              name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                                              id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                                              value="OR"<?php if ($documento_contable->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<?php $documento_contable_list->ShowPageHeader(); ?>
<?php
$documento_contable_list->ShowMessage();
?>
<table cellspacing="0" class="ewGrid">
    <tr>
        <td class="ewGridContent">
            <form name="fdocumento_contablelist" id="fdocumento_contablelist" class="ewForm" action="" method="post">
                <input type="hidden" name="t" id="t" value="documento_contable">
                <div id="gmp_documento_contable" class="ewGridMiddlePanel">
                    <?php if ($documento_contable_list->TotalRecs > 0) { ?>
                        <table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow"
                               data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow"
                               class="ewTable ewTableSeparate">
                            <?php echo $documento_contable->TableCustomInnerHtml ?>
                            <thead><!-- Table header -->
                            <tr class="ewTableHeader">
                                <?php

                                // Render list options
                                $documento_contable_list->RenderListOptions();

                                // Render list options (header, left)
                                $documento_contable_list->ListOptions->Render("header", "left");
                                ?>
                                <?php if ($documento_contable->iddoctocontable->Visible) { // iddoctocontable ?>
                                    <?php if ($documento_contable->SortUrl($documento_contable->iddoctocontable) == "") { ?>
                                        <td><?php echo $documento_contable->iddoctocontable->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $documento_contable->SortUrl($documento_contable->iddoctocontable) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $documento_contable->iddoctocontable->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($documento_contable->iddoctocontable->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($documento_contable->iddoctocontable->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($documento_contable->tipo_docto->Visible) { // tipo_docto ?>
                                    <?php if ($documento_contable->SortUrl($documento_contable->tipo_docto) == "") { ?>
                                        <td><?php echo $documento_contable->tipo_docto->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $documento_contable->SortUrl($documento_contable->tipo_docto) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $documento_contable->tipo_docto->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td>
                                                        <td style="width: 10px;"><?php if ($documento_contable->tipo_docto->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($documento_contable->tipo_docto->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($documento_contable->consec_docto->Visible) { // consec_docto ?>
                                    <?php if ($documento_contable->SortUrl($documento_contable->consec_docto) == "") { ?>
                                        <td><?php echo $documento_contable->consec_docto->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $documento_contable->SortUrl($documento_contable->consec_docto) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $documento_contable->consec_docto->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td>
                                                        <td style="width: 10px;"><?php if ($documento_contable->consec_docto->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($documento_contable->consec_docto->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($documento_contable->valor->Visible) { // valor ?>
                                    <?php if ($documento_contable->SortUrl($documento_contable->valor) == "") { ?>
                                        <td><?php echo $documento_contable->valor->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $documento_contable->SortUrl($documento_contable->valor) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $documento_contable->valor->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($documento_contable->valor->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($documento_contable->valor->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($documento_contable->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
                                    <?php if ($documento_contable->SortUrl($documento_contable->fecha_vencimiento) == "") { ?>
                                        <td><?php echo $documento_contable->fecha_vencimiento->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $documento_contable->SortUrl($documento_contable->fecha_vencimiento) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $documento_contable->fecha_vencimiento->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($documento_contable->fecha_vencimiento->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($documento_contable->fecha_vencimiento->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($documento_contable->estado->Visible) { // estado ?>
                                    <?php if ($documento_contable->SortUrl($documento_contable->estado) == "") { ?>
                                        <td><?php echo $documento_contable->estado->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $documento_contable->SortUrl($documento_contable->estado) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $documento_contable->estado->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td>
                                                        <td style="width: 10px;"><?php if ($documento_contable->estado->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($documento_contable->estado->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($documento_contable->dias_vencidos->Visible) { // dias_vencidos ?>
                                    <?php if ($documento_contable->SortUrl($documento_contable->dias_vencidos) == "") { ?>
                                        <td><?php echo $documento_contable->dias_vencidos->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $documento_contable->SortUrl($documento_contable->dias_vencidos) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $documento_contable->dias_vencidos->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($documento_contable->dias_vencidos->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($documento_contable->dias_vencidos->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php

                                // Render list options (header, right)
                                $documento_contable_list->ListOptions->Render("header", "right");
                                ?>
                            </tr>
                            </thead>
                            <?php
                            if ($documento_contable->ExportAll && $documento_contable->Export <> "") {
                                $documento_contable_list->StopRec = $documento_contable_list->TotalRecs;
                            } else {

                                // Set the last record to display
                                if ($documento_contable_list->TotalRecs > $documento_contable_list->StartRec + $documento_contable_list->DisplayRecs - 1)
                                    $documento_contable_list->StopRec = $documento_contable_list->StartRec + $documento_contable_list->DisplayRecs - 1;
                                else
                                    $documento_contable_list->StopRec = $documento_contable_list->TotalRecs;
                            }
                            $documento_contable_list->RecCnt = $documento_contable_list->StartRec - 1;
                            if ($documento_contable_list->Recordset && !$documento_contable_list->Recordset->EOF) {
                                $documento_contable_list->Recordset->MoveFirst();
                                if (!$bSelectLimit && $documento_contable_list->StartRec > 1)
                                    $documento_contable_list->Recordset->Move($documento_contable_list->StartRec - 1);
                            } elseif (!$documento_contable->AllowAddDeleteRow && $documento_contable_list->StopRec == 0) {
                                $documento_contable_list->StopRec = $documento_contable->GridAddRowCount;
                            }

                            // Initialize aggregate
                            $documento_contable->RowType = EW_ROWTYPE_AGGREGATEINIT;
                            $documento_contable->ResetAttrs();
                            $documento_contable_list->RenderRow();
                            $documento_contable_list->RowCnt = 0;
                            while ($documento_contable_list->RecCnt < $documento_contable_list->StopRec) {
                                $documento_contable_list->RecCnt++;
                                if (intval($documento_contable_list->RecCnt) >= intval($documento_contable_list->StartRec)) {
                                    $documento_contable_list->RowCnt++;

                                    // Set up key count
                                    $documento_contable_list->KeyCount = $documento_contable_list->RowIndex;

                                    // Init row class and style
                                    $documento_contable->ResetAttrs();
                                    $documento_contable->CssClass = "";
                                    if ($documento_contable->CurrentAction == "gridadd") {
                                    } else {
                                        $documento_contable_list->LoadRowValues($documento_contable_list->Recordset); // Load row values
                                    }
                                    $documento_contable->RowType = EW_ROWTYPE_VIEW; // Render view
                                    $documento_contable->RowAttrs = array('onmouseover' => 'ew_MouseOver(event, this);', 'onmouseout' => 'ew_MouseOut(event, this);', 'onclick' => 'ew_Click(event, this);');

                                    // Render row
                                    $documento_contable_list->RenderRow();

                                    // Render list options
                                    $documento_contable_list->RenderListOptions();
                                    ?>
                                    <tr<?php echo $documento_contable->RowAttributes() ?>>
                                        <?php

                                        // Render list options (body, left)
                                        $documento_contable_list->ListOptions->Render("body", "left");
                                        ?>
                                        <?php if ($documento_contable->iddoctocontable->Visible) { // iddoctocontable ?>
                                            <td<?php echo $documento_contable->iddoctocontable->CellAttributes() ?>>
                                                <div<?php echo $documento_contable->iddoctocontable->ViewAttributes() ?>><?php echo $documento_contable->iddoctocontable->ListViewValue() ?></div>
                                                <a name="<?php echo $documento_contable_list->PageObjName . "_row_" . $documento_contable_list->RowCnt ?>"
                                                   id="<?php echo $documento_contable_list->PageObjName . "_row_" . $documento_contable_list->RowCnt ?>"></a>
                                            </td>
                                        <?php } ?>
                                        <?php if ($documento_contable->tipo_docto->Visible) { // tipo_docto ?>
                                            <td<?php echo $documento_contable->tipo_docto->CellAttributes() ?>>
                                                <div<?php echo $documento_contable->tipo_docto->ViewAttributes() ?>><?php echo $documento_contable->tipo_docto->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($documento_contable->consec_docto->Visible) { // consec_docto ?>
                                            <td<?php echo $documento_contable->consec_docto->CellAttributes() ?>>
                                                <div<?php echo $documento_contable->consec_docto->ViewAttributes() ?>><?php echo $documento_contable->consec_docto->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($documento_contable->valor->Visible) { // valor ?>
                                            <td<?php echo $documento_contable->valor->CellAttributes() ?>>
                                                <div<?php echo $documento_contable->valor->ViewAttributes() ?>><?php echo $documento_contable->valor->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($documento_contable->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
                                            <td<?php echo $documento_contable->fecha_vencimiento->CellAttributes() ?>>
                                                <div<?php echo $documento_contable->fecha_vencimiento->ViewAttributes() ?>><?php echo $documento_contable->fecha_vencimiento->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($documento_contable->estado->Visible) { // estado ?>
                                            <td<?php echo $documento_contable->estado->CellAttributes() ?>>
                                                <div<?php echo $documento_contable->estado->ViewAttributes() ?>><?php echo $documento_contable->estado->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($documento_contable->dias_vencidos->Visible) { // dias_vencidos ?>
                                            <td<?php echo $documento_contable->dias_vencidos->CellAttributes() ?>>
                                                <div<?php echo $documento_contable->dias_vencidos->ViewAttributes() ?>><?php echo $documento_contable->dias_vencidos->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php

                                        // Render list options (body, right)
                                        $documento_contable_list->ListOptions->Render("body", "right");
                                        ?>
                                    </tr>
                                    <?php
                                }
                                if ($documento_contable->CurrentAction <> "gridadd")
                                    $documento_contable_list->Recordset->MoveNext();
                            }
                            ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </form>
            <?php

            // Close recordset
            if ($documento_contable_list->Recordset)
                $documento_contable_list->Recordset->Close();
            ?>
            <?php if ($documento_contable->Export == "") { ?>
                <div class="ewGridLowerPanel">
                    <?php if ($documento_contable->CurrentAction <> "gridadd" && $documento_contable->CurrentAction <> "gridedit") { ?>
                        <form name="ewpagerform" id="ewpagerform" class="ewForm"
                              action="<?php echo ew_CurrentPage() ?>">
                            <table border="0" cellspacing="0" cellpadding="0" class="ewPager">
                                <tr>
                                    <td nowrap>
                                        <span class="phpmaker pager">
                                            <span class="row">
                                            <?php if (!isset($documento_contable_list->Pager)) $documento_contable_list->Pager = new cNumericPager($documento_contable_list->StartRec, $documento_contable_list->DisplayRecs, $documento_contable_list->TotalRecs, $documento_contable_list->RecRange) ?>
                                                <?php if ($documento_contable_list->Pager->RecordCount > 0) { ?>
                                                <?php if ($documento_contable_list->Pager->FirstButton->Enabled) { ?>
                                                    <a href="<?php echo $documento_contable_list->PageUrl() ?>start=<?php echo $documento_contable_list->Pager->FirstButton->Start ?>"><i
                                                                class="fa fa-angle-double-left"></i></a>&nbsp;
                                                <?php } ?>
                                                <?php if ($documento_contable_list->Pager->PrevButton->Enabled) { ?>
                                                    <a href="<?php echo $documento_contable_list->PageUrl() ?>start=<?php echo $documento_contable_list->Pager->PrevButton->Start ?>"><i
                                                                class="fa fa-angle-left"></i></a>&nbsp;
                                                <?php } ?>
                                                <?php foreach ($documento_contable_list->Pager->Items as $PagerItem) { ?>
                                                    <?php if ($PagerItem->Enabled) { ?><a href="<?php echo $documento_contable_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?>
                                                    <b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
                                                <?php } ?>
                                                <?php if ($documento_contable_list->Pager->NextButton->Enabled) { ?>
                                                    <a href="<?php echo $documento_contable_list->PageUrl() ?>start=<?php echo $documento_contable_list->Pager->NextButton->Start ?>"><i
                                                                class="fa fa-angle-right"></i></a>&nbsp;
                                                <?php } ?>
                                                <?php if ($documento_contable_list->Pager->LastButton->Enabled) { ?>
                                                    <a href="<?php echo $documento_contable_list->PageUrl() ?>start=<?php echo $documento_contable_list->Pager->LastButton->Start ?>"><i
                                                                class="fa fa-angle-double-right"></i></a>&nbsp;
                                                <?php } ?>
                                            </span>
                                            <span class="row">
                                                <?php if ($documento_contable_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
                                                <?php echo $Language->Phrase("Record") ?>
                                                &nbsp;<?php echo $documento_contable_list->Pager->FromIndex ?>
                                                &nbsp;<?php echo $Language->Phrase("To") ?>
                                                &nbsp;<?php echo $documento_contable_list->Pager->ToIndex ?>
                                                &nbsp;<?php echo $Language->Phrase("Of") ?>
                                                &nbsp;<?php echo $documento_contable_list->Pager->RecordCount ?>
                                                <?php } else { ?>
                                                    <?php if ($Security->CanList()) { ?>
                                                        <?php if ($documento_contable_list->SearchWhere == "0=101") { ?>
                                                            <?php echo $Language->Phrase("EnterSearchCriteria") ?>
                                                        <?php } else { ?>
                                                            <?php echo $Language->Phrase("NoRecord") ?>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php echo $Language->Phrase("NoPermission") ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </span>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    <?php } ?>
                    <span class="phpmaker"></span>
                </div>
            <?php } ?>
        </td>
    </tr>
</table>
<?php if ($documento_contable->Export == "" && $documento_contable->CurrentAction == "") { ?>
<?php } ?>
<?php
$documento_contable_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
    echo ew_DebugMsg();
?>
<?php if ($documento_contable->Export == "") { ?>
    <script language="JavaScript" type="text/javascript">
        <!--
        $(function () {
            loadPagosBox();
            initCookies();
            loadButtons();
        });
        //-->
    </script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$documento_contable_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumento_contable_list
{

    // Page ID
    var $PageID = 'list';

    // Table name
    var $TableName = 'documento_contable';

    // Page object name
    var $PageObjName = 'documento_contable_list';

    // Page name
    function PageName()
    {
        return ew_CurrentPage();
    }

    // Page URL
    function PageUrl()
    {
        $PageUrl = ew_CurrentPage() . "?";
        global $documento_contable;
        if ($documento_contable->UseTokenInUrl) $PageUrl .= "t=" . $documento_contable->TableVar . "&"; // Add page token
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
    function getMessage()
    {
        return @$_SESSION[EW_SESSION_MESSAGE];
    }

    function setMessage($v)
    {
        ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
    }

    function getFailureMessage()
    {
        return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
    }

    function setFailureMessage($v)
    {
        ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
    }

    function getSuccessMessage()
    {
        return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
    }

    function setSuccessMessage($v)
    {
        ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
    }

    // Show message
    function ShowMessage()
    {
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
    function ShowPageHeader()
    {
        $sHeader = $this->PageHeader;
        $this->Page_DataRendering($sHeader);
        if ($sHeader <> "") { // Header exists, display
            echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
        }
    }

    // Show Page Footer
    function ShowPageFooter()
    {
        $sFooter = $this->PageFooter;
        $this->Page_DataRendered($sFooter);
        if ($sFooter <> "") { // Fotoer exists, display
            echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
        }
    }

    // Validate page request
    function IsPageRequest()
    {
        global $objForm, $documento_contable;
        if ($documento_contable->UseTokenInUrl) {
            if ($objForm)
                return ($documento_contable->TableVar == $objForm->GetValue("t"));
            if (@$_GET["t"] <> "")
                return ($documento_contable->TableVar == $_GET["t"]);
        } else {
            return TRUE;
        }
    }

    //
    // Page class constructor
    //
    function cdocumento_contable_list()
    {
        global $conn, $Language;

        // Language object
        if (!isset($Language)) $Language = new cLanguage();

        // Table object (documento_contable)
        if (!isset($GLOBALS["documento_contable"])) {
            $GLOBALS["documento_contable"] = new cdocumento_contable();
            $GLOBALS["Table"] =& $GLOBALS["documento_contable"];
        }

        // Initialize URLs
        $this->ExportPrintUrl = $this->PageUrl() . "export=print";
        $this->ExportExcelUrl = $this->PageUrl() . "export=excel";
        $this->ExportWordUrl = $this->PageUrl() . "export=word";
        $this->ExportHtmlUrl = $this->PageUrl() . "export=html";
        $this->ExportXmlUrl = $this->PageUrl() . "export=xml";
        $this->ExportCsvUrl = $this->PageUrl() . "export=csv";
        $this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
        $this->AddUrl = "documento_contableadd.php";
        $this->InlineAddUrl = $this->PageUrl() . "a=add";
        $this->GridAddUrl = $this->PageUrl() . "a=gridadd";
        $this->GridEditUrl = $this->PageUrl() . "a=gridedit";
        $this->MultiDeleteUrl = "documento_contabledelete.php";
        $this->MultiUpdateUrl = "documento_contableupdate.php";

        // Table object (usuarios)
        if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

        // Page ID
        if (!defined("EW_PAGE_ID"))
            define("EW_PAGE_ID", 'list', TRUE);

        // Table name (for backward compatibility)
        if (!defined("EW_TABLE_NAME"))
            define("EW_TABLE_NAME", 'documento_contable', TRUE);

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
    function Page_Init()
    {
        global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
        global $documento_contable;

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
            $documento_contable->Export = $_GET["export"];
        } elseif (ew_IsHttpPost()) {
            if (@$_POST["exporttype"] <> "")
                $documento_contable->Export = $_POST["exporttype"];
        } else {
            $documento_contable->setExportReturnUrl(ew_CurrentUrl());
        }
        $gsExport = $documento_contable->Export; // Get export parameter, used in header
        $gsExportFile = $documento_contable->TableVar; // Get export file, used in header
        $Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
        if ($documento_contable->Export == "excel") {
            header('Content-Type: application/vnd.ms-excel' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xls');
        }
        if ($documento_contable->Export == "word") {
            header('Content-Type: application/vnd.ms-word' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
        }
        if ($documento_contable->Export == "xml") {
            header('Content-Type: text/xml' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xml');
        }
        if ($documento_contable->Export == "csv") {
            header('Content-Type: application/csv' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.csv');
        }

        // Get grid add count
        $gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
            $documento_contable->GridAddRowCount = $gridaddcnt;

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
    function Page_Terminate($url = "")
    {
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
    function Page_Main()
    {
        global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $documento_contable;

        // Search filters
        $sSrchAdvanced = ""; // Advanced search filter
        $sSrchBasic = ""; // Basic search filter
        $sFilter = "";
        if ($this->IsPageRequest()) { // Validate request

            // Handle reset command
            $this->ResetCmd();

            // Hide all options
            if ($documento_contable->Export <> "" ||
                $documento_contable->CurrentAction == "gridadd" ||
                $documento_contable->CurrentAction == "gridedit") {
                $this->ListOptions->HideAllOptions();
                $this->ExportOptions->HideAllOptions();
            }

            // Get basic search values
            $this->LoadBasicSearchValues();

            // Restore search parms from Session
            $this->RestoreSearchParms();

            // Call Recordset SearchValidated event
            $documento_contable->Recordset_SearchValidated();

            // Set up sorting order
            $this->SetUpSortOrder();

            // Get basic search criteria
            if ($gsSearchError == "")
                $sSrchBasic = $this->BasicSearchWhere();
        }

        // Restore display records
        if ($documento_contable->getRecordsPerPage() <> "") {
            $this->DisplayRecs = $documento_contable->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecs = 20; // Load default
        }

        // Load Sorting Order
        $this->LoadSortOrder();

        // Build search criteria
        ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
        ew_AddFilter($this->SearchWhere, $sSrchBasic);

        // Call Recordset_Searching event
        $documento_contable->Recordset_Searching($this->SearchWhere);

        // Save search criteria
        if ($this->SearchWhere <> "") {
            if ($sSrchBasic == "")
                $this->ResetBasicSearchParms();
            $documento_contable->setSearchWhere($this->SearchWhere); // Save to Session
            if (!$this->RestoreSearch) {
                $this->StartRec = 1; // Reset start record counter
                $documento_contable->setStartRecordNumber($this->StartRec);
            }
        } else {
            $this->SearchWhere = $documento_contable->getSearchWhere();
        }

        // Build filter
        $sFilter = "";
        if (!$Security->CanList())
            $sFilter = "(0=1)"; // Filter all records
        ew_AddFilter($sFilter, $this->DbDetailFilter);
        ew_AddFilter($sFilter, $this->SearchWhere);

        // Set up filter in session
        $documento_contable->setSessionWhere($sFilter);
        $documento_contable->CurrentFilter = "";

        // Export data only
        if (in_array($documento_contable->Export, array("html", "word", "excel", "xml", "csv", "email", "pdf"))) {
            $this->ExportData();
            if ($documento_contable->Export <> "email")
                $this->Page_Terminate(); // Terminate response
            exit();
        }
    }

    // Return basic search SQL
    function BasicSearchSQL($Keyword)
    {
        global $documento_contable;
        $sKeyword = ew_AdjustSql($Keyword);
        $sWhere = "";
        $this->BuildBasicSearchSQL($sWhere, $documento_contable->tipo_docto, $Keyword);
        if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $documento_contable->consec_docto, $Keyword);
        $this->BuildBasicSearchSQL($sWhere, $documento_contable->tercero, $Keyword);
        $this->BuildBasicSearchSQL($sWhere, $documento_contable->estado, $Keyword);
        $this->BuildBasicSearchSQL($sWhere, $documento_contable->descripcion, $Keyword);
        $this->BuildBasicSearchSQL($sWhere, $documento_contable->nit, $Keyword);
        return $sWhere;
    }

    // Build basic search SQL
    function BuildBasicSearchSql(&$Where, &$Fld, $Keyword)
    {
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
    function BasicSearchWhere()
    {
        global $Security, $documento_contable;
        $sSearchStr = "";
        if (!$Security->CanSearch()) return "";
        $sSearchKeyword = $documento_contable->BasicSearchKeyword;
        $sSearchType = $documento_contable->BasicSearchType;
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
            $documento_contable->setSessionBasicSearchKeyword($sSearchKeyword);
            $documento_contable->setSessionBasicSearchType($sSearchType);
        }
        return $sSearchStr;
    }

    // Clear all search parameters
    function ResetSearchParms()
    {
        global $documento_contable;

        // Clear search WHERE clause
        $this->SearchWhere = "";
        $documento_contable->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->ResetBasicSearchParms();
    }

    // Clear all basic search parameters
    function ResetBasicSearchParms()
    {
        global $documento_contable;
        $documento_contable->setSessionBasicSearchKeyword("");
        $documento_contable->setSessionBasicSearchType("");
    }

    // Restore all search parameters
    function RestoreSearchParms()
    {
        global $documento_contable;
        $bRestore = TRUE;
        if ($documento_contable->BasicSearchKeyword <> "") $bRestore = FALSE;
        $this->RestoreSearch = $bRestore;
        if ($bRestore) {

            // Restore basic search values
            $documento_contable->BasicSearchKeyword = $documento_contable->getSessionBasicSearchKeyword();
            $documento_contable->BasicSearchType = $documento_contable->getSessionBasicSearchType();
        }
    }

    // Set up sort parameters
    function SetUpSortOrder()
    {
        global $documento_contable;

        // Check for "order" parameter
        if (@$_GET["order"] <> "") {
            $documento_contable->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
            $documento_contable->CurrentOrderType = @$_GET["ordertype"];
            $documento_contable->UpdateSort($documento_contable->iddoctocontable); // iddoctocontable
            $documento_contable->UpdateSort($documento_contable->tipo_docto); // tipo_docto
            $documento_contable->UpdateSort($documento_contable->consec_docto); // consec_docto
            $documento_contable->UpdateSort($documento_contable->valor); // valor
            $documento_contable->UpdateSort($documento_contable->fecha_vencimiento); // fecha_vencimiento
            $documento_contable->UpdateSort($documento_contable->estado); // estado
            $documento_contable->UpdateSort($documento_contable->dias_vencidos); // dias_vencidos
            $documento_contable->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    function LoadSortOrder()
    {
        global $documento_contable;
        $sOrderBy = $documento_contable->getSessionOrderBy(); // Get ORDER BY from Session
        if ($sOrderBy == "") {
            if ($documento_contable->SqlOrderBy() <> "") {
                $sOrderBy = $documento_contable->SqlOrderBy();
                $documento_contable->setSessionOrderBy($sOrderBy);
            }
        }
    }

    // Reset command
    // cmd=reset (Reset search parameters)
    // cmd=resetall (Reset search and master/detail parameters)
    // cmd=resetsort (Reset sort parameters)
    function ResetCmd()
    {
        global $documento_contable;

        // Get reset command
        if (@$_GET["cmd"] <> "") {
            $sCmd = $_GET["cmd"];

            // Reset search criteria
            if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
                $this->ResetSearchParms();

            // Reset sorting order
            if (strtolower($sCmd) == "resetsort") {
                $sOrderBy = "";
                $documento_contable->setSessionOrderBy($sOrderBy);
                $documento_contable->iddoctocontable->setSort("");
                $documento_contable->tipo_docto->setSort("");
                $documento_contable->consec_docto->setSort("");
                $documento_contable->valor->setSort("");
                $documento_contable->fecha_vencimiento->setSort("");
                $documento_contable->estado->setSort("");
                $documento_contable->dias_vencidos->setSort("");
            }

            // Reset start position
            $this->StartRec = 1;
            $documento_contable->setStartRecordNumber($this->StartRec);
        }
    }

    // Set up list options
    function SetupListOptions()
    {
        global $Security, $Language, $documento_contable;

        // "view"
        $item =& $this->ListOptions->Add("view");
        $item->CssStyle = "white-space: nowrap;";
        $item->Visible = $Security->CanView();
        $item->OnLeft = FALSE;

        // Call ListOptions_Load event
        $this->ListOptions_Load();
    }

    // Render list options
    function RenderListOptions()
    {
        global $Security, $Language, $documento_contable, $objForm;
        $this->ListOptions->LoadDefault();

        // "view"
        $oListOpt =& $this->ListOptions->Items["view"];
        if ($Security->CanView() && $this->ShowOptionLink() && $oListOpt->Visible)
            $oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . "<i class='fa fa-eye'></i>" . "</a>";
        $this->RenderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->ListOptions_Rendered();
    }

    function RenderListOptionsExt()
    {
        global $Security, $Language, $documento_contable;
    }

    // Set up starting record parameters
    function SetUpStartRec()
    {
        global $documento_contable;
        if ($this->DisplayRecs == 0)
            return;
        if ($this->IsPageRequest()) { // Validate request
            if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
                $this->StartRec = $_GET[EW_TABLE_START_REC];
                $documento_contable->setStartRecordNumber($this->StartRec);
            } elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
                $PageNo = $_GET[EW_TABLE_PAGE_NO];
                if (is_numeric($PageNo)) {
                    $this->StartRec = ($PageNo - 1) * $this->DisplayRecs + 1;
                    if ($this->StartRec <= 0) {
                        $this->StartRec = 1;
                    } elseif ($this->StartRec >= intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1) {
                        $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1;
                    }
                    $documento_contable->setStartRecordNumber($this->StartRec);
                }
            }
        }
        $this->StartRec = $documento_contable->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
            $this->StartRec = 1; // Reset start record counter
            $documento_contable->setStartRecordNumber($this->StartRec);
        } elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
            $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
            $documento_contable->setStartRecordNumber($this->StartRec);
        } elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
            $this->StartRec = intval(($this->StartRec - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
            $documento_contable->setStartRecordNumber($this->StartRec);
        }
    }

    // Load basic search values
    function LoadBasicSearchValues()
    {
        global $documento_contable;
        $documento_contable->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
        $documento_contable->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
    }

    // Load recordset
    function LoadRecordset($offset = -1, $rowcnt = -1)
    {
        global $conn, $documento_contable;

        // Call Recordset Selecting event
        $documento_contable->Recordset_Selecting($documento_contable->CurrentFilter);

        // Load List page SQL
        $sSql = $documento_contable->SelectSQL();
        if ($offset > -1 && $rowcnt > -1)
            $sSql .= " LIMIT $rowcnt OFFSET $offset";

        // Load recordset
        $rs = ew_LoadRecordset($sSql);

        // Call Recordset Selected event
        $documento_contable->Recordset_Selected($rs);
        return $rs;
    }

    // Load row based on key values
    function LoadRow()
    {
        global $conn, $Security, $documento_contable;
        $sFilter = $documento_contable->KeyFilter();

        // Call Row Selecting event
        $documento_contable->Row_Selecting($sFilter);

        // Load SQL based on filter
        $documento_contable->CurrentFilter = $sFilter;
        $sSql = $documento_contable->SQL();
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
    function LoadRowValues(&$rs)
    {
        global $conn, $documento_contable;
        if (!$rs || $rs->EOF) return;

        // Call Row Selected event
        $row =& $rs->fields;
        $documento_contable->Row_Selected($row);
        $documento_contable->iddoctocontable->setDbValue($rs->fields('iddoctocontable'));
        $documento_contable->tipo_docto->setDbValue($rs->fields('tipo_docto'));
        $documento_contable->consec_docto->setDbValue($rs->fields('consec_docto'));
        $documento_contable->valor->setDbValue($rs->fields('valor'));
        $documento_contable->cia->setDbValue($rs->fields('cia'));
        $documento_contable->tercero->setDbValue($rs->fields('tercero'));
        $documento_contable->fecha->setDbValue($rs->fields('fecha'));
        $documento_contable->fecha_vencimiento->setDbValue($rs->fields('fecha_vencimiento'));
        $documento_contable->estado->setDbValue($rs->fields('estado'));
        $documento_contable->dias_vencidos->setDbValue($rs->fields('dias_vencidos'));
        $documento_contable->usuario->setDbValue($rs->fields('usuario'));
        $documento_contable->estado_pago->setDbValue($rs->fields('estado_pago'));
        $documento_contable->descripcion->setDbValue($rs->fields('descripcion'));
        $documento_contable->nit->setDbValue($rs->fields('nit'));
        $documento_contable->fecha_actualizacion->setDbValue($rs->fields('fecha_actualizacion'));
    }

    // Load old record
    function LoadOldRecord()
    {
        global $documento_contable;

        // Load key values from Session
        $bValidKey = TRUE;
        if (strval($documento_contable->getKey("iddoctocontable")) <> "")
            $documento_contable->iddoctocontable->CurrentValue = $documento_contable->getKey("iddoctocontable"); // iddoctocontable
        else
            $bValidKey = FALSE;

        // Load old recordset
        if ($bValidKey) {
            $documento_contable->CurrentFilter = $documento_contable->KeyFilter();
            $sSql = $documento_contable->SQL();
            $this->OldRecordset = ew_LoadRecordset($sSql);
            $this->LoadRowValues($this->OldRecordset); // Load row values
        } else {
            $this->OldRecordset = NULL;
        }
        return $bValidKey;
    }

    // Render row values based on field settings
    function RenderRow()
    {
        global $conn, $Security, $Language, $documento_contable;

        // Initialize URLs
        $this->ViewUrl = $documento_contable->ViewUrl();
        $this->EditUrl = $documento_contable->EditUrl();
        $this->InlineEditUrl = $documento_contable->InlineEditUrl();
        $this->CopyUrl = $documento_contable->CopyUrl();
        $this->InlineCopyUrl = $documento_contable->InlineCopyUrl();
        $this->DeleteUrl = $documento_contable->DeleteUrl();

        // Call Row_Rendering event
        $documento_contable->Row_Rendering();

        // Common render codes for all row types
        // iddoctocontable
        // tipo_docto
        // consec_docto
        // valor
        // cia
        // tercero
        // fecha
        // fecha_vencimiento
        // estado
        // dias_vencidos
        // usuario
        // estado_pago
        // descripcion
        // nit
        // fecha_actualizacion

        if ($documento_contable->RowType == EW_ROWTYPE_VIEW) { // View row

            // iddoctocontable
            $documento_contable->iddoctocontable->ViewValue = $documento_contable->iddoctocontable->CurrentValue;
            $documento_contable->iddoctocontable->ViewCustomAttributes = "";

            // tipo_docto
            $documento_contable->tipo_docto->ViewValue = $documento_contable->tipo_docto->CurrentValue;
            $documento_contable->tipo_docto->ViewCustomAttributes = "";

            // consec_docto
            $documento_contable->consec_docto->ViewValue = $documento_contable->consec_docto->CurrentValue;
            $documento_contable->consec_docto->ViewCustomAttributes = "";

            // valor
            $documento_contable->valor->ViewValue = $documento_contable->valor->CurrentValue;
            $documento_contable->valor->ViewValue = ew_FormatCurrency($documento_contable->valor->ViewValue, 0, -2, -2, -2);
            $documento_contable->valor->ViewCustomAttributes = "";

            // cia
            $documento_contable->cia->ViewValue = $documento_contable->cia->CurrentValue;
            $documento_contable->cia->ViewCustomAttributes = "";

            // tercero
            $documento_contable->tercero->ViewValue = $documento_contable->tercero->CurrentValue;
            $documento_contable->tercero->ViewCustomAttributes = "";

            // fecha
            $documento_contable->fecha->ViewValue = $documento_contable->fecha->CurrentValue;
            $documento_contable->fecha->ViewValue = ew_FormatDateTime($documento_contable->fecha->ViewValue, 7);
            $documento_contable->fecha->ViewCustomAttributes = "";

            // fecha_vencimiento
            $documento_contable->fecha_vencimiento->ViewValue = $documento_contable->fecha_vencimiento->CurrentValue;
            $documento_contable->fecha_vencimiento->ViewCustomAttributes = "";

            // estado
            $documento_contable->estado->ViewValue = $documento_contable->estado->CurrentValue;
            $documento_contable->estado->ViewCustomAttributes = "";

            // dias_vencidos
            $documento_contable->dias_vencidos->ViewValue = $documento_contable->dias_vencidos->CurrentValue;
            $documento_contable->dias_vencidos->ViewCustomAttributes = "";

            // usuario
            if (strval($documento_contable->usuario->CurrentValue) <> "") {
                $sFilterWrk = "`idusuario` = " . ew_AdjustSql($documento_contable->usuario->CurrentValue) . "";
                $sSqlWrk = "SELECT `nit_empresa`, `username` FROM `usuarios`";
                $sWhereWrk = "";
                if ($sFilterWrk <> "") {
                    if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
                    $sWhereWrk .= "(" . $sFilterWrk . ")";
                }
                if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
                $sSqlWrk .= " ORDER BY `nit_empresa` Asc";
                $rswrk = $conn->Execute($sSqlWrk);
                if ($rswrk && !$rswrk->EOF) { // Lookup values found
                    $documento_contable->usuario->ViewValue = $rswrk->fields('nit_empresa');
                    $documento_contable->usuario->ViewValue .= ew_ValueSeparator(0, 1, $documento_contable->usuario) . $rswrk->fields('username');
                    $rswrk->Close();
                } else {
                    $documento_contable->usuario->ViewValue = $documento_contable->usuario->CurrentValue;
                }
            } else {
                $documento_contable->usuario->ViewValue = NULL;
            }
            $documento_contable->usuario->ViewCustomAttributes = "";

            // estado_pago
            if (strval($documento_contable->estado_pago->CurrentValue) <> "") {
                switch ($documento_contable->estado_pago->CurrentValue) {
                    case "0":
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(1) <> "" ? $documento_contable->estado_pago->FldTagCaption(1) : $documento_contable->estado_pago->CurrentValue;
                        break;
                    case "1":
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(2) <> "" ? $documento_contable->estado_pago->FldTagCaption(2) : $documento_contable->estado_pago->CurrentValue;
                        break;
                    case "2":
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(3) <> "" ? $documento_contable->estado_pago->FldTagCaption(3) : $documento_contable->estado_pago->CurrentValue;
                        break;
                    case "4":
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(4) <> "" ? $documento_contable->estado_pago->FldTagCaption(4) : $documento_contable->estado_pago->CurrentValue;
                        break;
                    case "5":
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(5) <> "" ? $documento_contable->estado_pago->FldTagCaption(5) : $documento_contable->estado_pago->CurrentValue;
                        break;
                    case "6":
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(6) <> "" ? $documento_contable->estado_pago->FldTagCaption(6) : $documento_contable->estado_pago->CurrentValue;
                        break;
                    case "7":
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(7) <> "" ? $documento_contable->estado_pago->FldTagCaption(7) : $documento_contable->estado_pago->CurrentValue;
                        break;
                    case "8":
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(8) <> "" ? $documento_contable->estado_pago->FldTagCaption(8) : $documento_contable->estado_pago->CurrentValue;
                        break;
                    case "9":
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(9) <> "" ? $documento_contable->estado_pago->FldTagCaption(9) : $documento_contable->estado_pago->CurrentValue;
                        break;
                    case "10":
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->FldTagCaption(10) <> "" ? $documento_contable->estado_pago->FldTagCaption(10) : $documento_contable->estado_pago->CurrentValue;
                        break;
                    default:
                        $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->CurrentValue;
                }
            } else {
                $documento_contable->estado_pago->ViewValue = NULL;
            }
            $documento_contable->estado_pago->ViewCustomAttributes = "";

            // nit
            $documento_contable->nit->ViewValue = $documento_contable->nit->CurrentValue;
            $documento_contable->nit->ViewCustomAttributes = "";

            // fecha_actualizacion
            $documento_contable->fecha_actualizacion->ViewValue = $documento_contable->fecha_actualizacion->CurrentValue;
            $documento_contable->fecha_actualizacion->ViewCustomAttributes = "";

            // iddoctocontable
            $documento_contable->iddoctocontable->LinkCustomAttributes = "";
            $documento_contable->iddoctocontable->HrefValue = "";
            $documento_contable->iddoctocontable->TooltipValue = "";

            // tipo_docto
            $documento_contable->tipo_docto->LinkCustomAttributes = "";
            $documento_contable->tipo_docto->HrefValue = "";
            $documento_contable->tipo_docto->TooltipValue = "";

            // consec_docto
            $documento_contable->consec_docto->LinkCustomAttributes = "";
            $documento_contable->consec_docto->HrefValue = "";
            $documento_contable->consec_docto->TooltipValue = "";

            // valor
            $documento_contable->valor->LinkCustomAttributes = "";
            $documento_contable->valor->HrefValue = "";
            $documento_contable->valor->TooltipValue = "";

            // fecha_vencimiento
            $documento_contable->fecha_vencimiento->LinkCustomAttributes = "";
            $documento_contable->fecha_vencimiento->HrefValue = "";
            $documento_contable->fecha_vencimiento->TooltipValue = "";

            // estado
            $documento_contable->estado->LinkCustomAttributes = "";
            $documento_contable->estado->HrefValue = "";
            $documento_contable->estado->TooltipValue = "";

            // dias_vencidos
            $documento_contable->dias_vencidos->LinkCustomAttributes = "";
            $documento_contable->dias_vencidos->HrefValue = "";
            $documento_contable->dias_vencidos->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($documento_contable->RowType <> EW_ROWTYPE_AGGREGATEINIT)
            $documento_contable->Row_Rendered();
    }

    // Set up export options
    function SetupExportOptions()
    {
        global $Language, $documento_contable;

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
        $item->Body = "<a name=\"emf_documento_contable\" id=\"emf_documento_contable\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_documento_contable',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fdocumento_contablelist,sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
        $item->Visible = TRUE;

        // Hide options for export/action
        if ($documento_contable->Export <> "" ||
            $documento_contable->CurrentAction <> "")
            $this->ExportOptions->HideAllOptions();
    }

    // Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
    function ExportData()
    {
        global $documento_contable;
        $utf8 = (strtolower(EW_CHARSET) == "utf-8");
        $bSelectLimit = EW_SELECT_LIMIT;

        // Load recordset
        if ($bSelectLimit) {
            $this->TotalRecs = $documento_contable->SelectRecordCount();
        } else {
            if ($rs = $this->LoadRecordset())
                $this->TotalRecs = $rs->RecordCount();
        }
        $this->StartRec = 1;

        // Export all
        if ($documento_contable->ExportAll) {
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
            $rs = $this->LoadRecordset($this->StartRec - 1, $this->DisplayRecs);
        if (!$rs) {
            header("Content-Type:"); // Remove header
            header("Content-Disposition:");
            $this->ShowMessage();
            return;
        }
        if ($documento_contable->Export == "xml") {
            $XmlDoc = new cXMLDocument(EW_XML_ENCODING);
        } else {
            $ExportDoc = new cExportDocument($documento_contable, "h");
        }
        $ParentTable = "";
        if ($bSelectLimit) {
            $StartRec = 1;
            $StopRec = $this->DisplayRecs;
        } else {
            $StartRec = $this->StartRec;
            $StopRec = $this->StopRec;
        }
        if ($documento_contable->Export == "xml") {
            $documento_contable->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
        } else {
            $sHeader = $this->PageHeader;
            $this->Page_DataRendering($sHeader);
            $ExportDoc->Text .= $sHeader;
            $documento_contable->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
            $sFooter = $this->PageFooter;
            $this->Page_DataRendered($sFooter);
            $ExportDoc->Text .= $sFooter;
        }

        // Close recordset
        $rs->Close();

        // Export header and footer
        if ($documento_contable->Export <> "xml") {
            $ExportDoc->ExportHeaderAndFooter();
        }

        // Clean output buffer
        if (!EW_DEBUG_ENABLED && ob_get_length())
            ob_end_clean();

        // Write BOM if utf-8
        if ($utf8 && !in_array($documento_contable->Export, array("email", "xml")))
            echo "\xEF\xBB\xBF";

        // Write debug message if enabled
        if (EW_DEBUG_ENABLED)
            echo ew_DebugMsg();

        // Output data
        if ($documento_contable->Export == "xml") {
            header("Content-Type: text/xml");
            echo $XmlDoc->XML();
        } elseif ($documento_contable->Export == "email") {
            $this->ExportEmail($ExportDoc->Text);
            $this->Page_Terminate($documento_contable->ExportReturnUrl());
        } elseif ($documento_contable->Export == "pdf") {
            $this->ExportPDF($ExportDoc->Text);
        } else {
            echo $ExportDoc->Text;
        }
    }

    // Export email
    function ExportEmail($EmailContent)
    {
        global $Language, $documento_contable;
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
        if ($documento_contable->Email_Sending($Email, $EventArgs))
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
    function ExportQueryString()
    {
        global $documento_contable;

        // Initialize
        $sQry = "export=html";

        // Build QueryString for search
        if ($documento_contable->getSessionBasicSearchKeyword() <> "") {
            $sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . $documento_contable->getSessionBasicSearchKeyword() . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . $documento_contable->getSessionBasicSearchType();
        }

        // Build QueryString for pager
        $sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . $documento_contable->getRecordsPerPage() . "&" . EW_TABLE_START_REC . "=" . $documento_contable->getStartRecordNumber();
        return $sQry;
    }

    // Add search QueryString
    function AddSearchQueryString(&$Qry, &$Fld)
    {
        global $documento_contable;
        $FldParm = substr($Fld->FldVar, 2);
        $FldSearchValue = $documento_contable->getAdvancedSearch("x_" . $FldParm);
        if (strval($FldSearchValue) <> "") {
            $Qry .= "&x_" . $FldParm . "=" . FldSearchValue .
                "&z_" . $FldParm . "=" . $documento_contable->getAdvancedSearch("z_" . $FldParm);
        }
        $FldSearchValue2 = $documento_contable->getAdvancedSearch("y_" . $FldParm);
        if (strval($FldSearchValue2) <> "") {
            $Qry .= "&v_" . $FldParm . "=" . $documento_contable->getAdvancedSearch("v_" . $FldParm) .
                "&y_" . $FldParm . "=" . $FldSearchValue2 .
                "&w_" . $FldParm . "=" . $documento_contable->getAdvancedSearch("w_" . $FldParm);
        }
    }

    // Show link optionally based on User ID
    function ShowOptionLink()
    {
        global $Security, $documento_contable;
        if ($Security->IsLoggedIn()) {
            if (!$Security->IsAdmin()) {
                return $Security->IsValidUserID($documento_contable->usuario->CurrentValue);
            }
        }
        return TRUE;
    }

    // Export PDF
    function ExportPDF($html)
    {
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
    function Page_Load()
    {

        //echo "Page Load";
    }

    // Page Unload event
    function Page_Unload()
    {

        //echo "Page Unload";
    }

    // Page Redirecting event
    function Page_Redirecting(&$url)
    {

        // Example:
        //$url = "your URL";

    }

    // Message Showing event
    // $type = ''|'success'|'failure'
    function Message_Showing(&$msg, $type)
    {

        // Example:
        //if ($type == 'success') $msg = "your success message";

    }

    // Page Data Rendering event
    function Page_DataRendering(&$header)
    {

        // Example:
        //$header = "your header";

    }

    // Page Data Rendered event
    function Page_DataRendered(&$footer)
    {

        // Example:
        //$footer = "your footer";

    }

    // Form Custom Validate event
    function Form_CustomValidate(&$CustomError)
    {

        // Return error message in CustomError
        return TRUE;
    }

    // ListOptions Load event
    function ListOptions_Load()
    {

        // Example:
        //$opt =& $this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = TRUE; // Link on left
        //$opt->MoveTo(0); // Move to first column

    }

    // ListOptions Rendered event
    function ListOptions_Rendered()
    {

        // Example:
        //$this->ListOptions->Items["new"]->Body = "xxx";

    }
}

?>
