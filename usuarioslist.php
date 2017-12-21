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
$usuarios_list = new cusuarios_list();
$Page =& $usuarios_list;

// Page init
$usuarios_list->Page_Init();

// Page main
$usuarios_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuarios->Export == "") { ?>
    <script type="text/javascript">
        <!--

        // Create page object
        var usuarios_list = new ew_Page("usuarios_list");

        // page properties
        usuarios_list.PageID = "list"; // page ID
        usuarios_list.FormID = "fusuarioslist"; // form ID
        var EW_PAGE_ID = usuarios_list.PageID; // for backward compatibility

        // extend page with Form_CustomValidate function
        usuarios_list.Form_CustomValidate =
            function (fobj) { // DO NOT CHANGE THIS LINE!

                // Your custom validation code here, return false if invalid.
                return true;
            }
        <?php if (EW_CLIENT_VALIDATE) { ?>
        usuarios_list.ValidateRequired = true; // uses JavaScript validation
        <?php } else { ?>
        usuarios_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($usuarios->Export == "") || (EW_EXPORT_MASTER_RECORD && $usuarios->Export == "print")) { ?>
<?php } ?>
<?php
$bSelectLimit = EW_SELECT_LIMIT;
if ($bSelectLimit) {
    $usuarios_list->TotalRecs = $usuarios->SelectRecordCount();
} else {
    if ($usuarios_list->Recordset = $usuarios_list->LoadRecordset())
        $usuarios_list->TotalRecs = $usuarios_list->Recordset->RecordCount();
}
$usuarios_list->StartRec = 1;
if ($usuarios_list->DisplayRecs <= 0 || ($usuarios->Export <> "" && $usuarios->ExportAll)) // Display all records
    $usuarios_list->DisplayRecs = $usuarios_list->TotalRecs;
if (!($usuarios->Export <> "" && $usuarios->ExportAll))
    $usuarios_list->SetUpStartRec(); // Set up start record position
if ($bSelectLimit)
    $usuarios_list->Recordset = $usuarios_list->LoadRecordset($usuarios_list->StartRec - 1, $usuarios_list->DisplayRecs);
?>
<p class="phpmaker ewTitle"
   style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarios->TableCaption() ?>
        <?php $usuarios_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->CanSearch()) { ?>
    <?php if ($usuarios->Export == "" && $usuarios->CurrentAction == "") { ?>
        <a href="javascript:ew_ToggleSearchPanel(usuarios_list);" style="text-decoration: none;"><img
                    id="usuarios_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a>
        <span class="phpmaker">  <?php echo $Language->Phrase("Search") ?></span><br>
        <div id="usuarios_list_SearchPanel">
            <form name="fusuarioslistsrch" id="fusuarioslistsrch" class="ewForm"
                  action="<?php echo ew_CurrentPage() ?>">
                <input type="hidden" id="t" name="t" value="usuarios">
                <div class="ewBasicSearch">
                    <div id="xsr_1" class="ewCssTableRow">
                        <input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>"
                               id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20"
                               value="<?php echo ew_HtmlEncode($usuarios->getSessionBasicSearchKeyword()) ?>">
                        <input type="Submit" name="Submit" id="Submit"
                               value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">  
                        <a href="<?php echo $usuarios_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>  
                    </div>
                    <div id="xsr_2" class="ewCssTableRow">
                        <label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                      id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                      value=""<?php if ($usuarios->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?>
                        </label>    <label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                                          id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                                          value="AND"<?php if ($usuarios->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?>
                        </label>    <label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                                          id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>"
                                                          value="OR"<?php if ($usuarios->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>
<?php } ?>
<?php $usuarios_list->ShowPageHeader(); ?>
<?php
$usuarios_list->ShowMessage();
?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
    <a class="ewGridLink"
       href="<?php echo $usuarios_list->AddUrl ?>"><i class="fa fa-plus"></i> <?php echo $Language->Phrase("AddLink") ?></a>
<?php } ?>
</span>
<br>
<table cellspacing="0" class="ewGrid">
    <tr>
        <td class="ewGridContent">
            <form name="fusuarioslist" id="fusuarioslist" class="ewForm" action="" method="post">
                <input type="hidden" name="t" id="t" value="usuarios">
                <div id="gmp_usuarios" class="ewGridMiddlePanel">
                    <?php if ($usuarios_list->TotalRecs > 0) { ?>
                        <table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow"
                               data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow"
                               class="ewTable ewTableSeparate">
                            <?php echo $usuarios->TableCustomInnerHtml ?>
                            <thead><!-- Table header -->
                            <tr class="ewTableHeader">
                                <?php

                                // Render list options
                                $usuarios_list->RenderListOptions();

                                // Render list options (header, left)
                                $usuarios_list->ListOptions->Render("header", "left");
                                ?>
                                <?php if ($usuarios->idusuario->Visible) { // idusuario ?>
                                    <?php if ($usuarios->SortUrl($usuarios->idusuario) == "") { ?>
                                        <td><?php echo $usuarios->idusuario->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->idusuario) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $usuarios->idusuario->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($usuarios->idusuario->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($usuarios->idusuario->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($usuarios->username->Visible) { // username ?>
                                    <?php if ($usuarios->SortUrl($usuarios->username) == "") { ?>
                                        <td><?php echo $usuarios->username->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->username) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $usuarios->username->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td>
                                                        <td style="width: 10px;"><?php if ($usuarios->username->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($usuarios->username->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($usuarios->zemail->Visible) { // email ?>
                                    <?php if ($usuarios->SortUrl($usuarios->zemail) == "") { ?>
                                        <td><?php echo $usuarios->zemail->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->zemail) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $usuarios->zemail->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td>
                                                        <td style="width: 10px;"><?php if ($usuarios->zemail->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($usuarios->zemail->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($usuarios->empresa->Visible) { // empresa ?>
                                    <?php if ($usuarios->SortUrl($usuarios->empresa) == "") { ?>
                                        <td><?php echo $usuarios->empresa->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->empresa) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $usuarios->empresa->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td>
                                                        <td style="width: 10px;"><?php if ($usuarios->empresa->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($usuarios->empresa->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($usuarios->nit_empresa->Visible) { // nit_empresa ?>
                                    <?php if ($usuarios->SortUrl($usuarios->nit_empresa) == "") { ?>
                                        <td><?php echo $usuarios->nit_empresa->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->nit_empresa) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $usuarios->nit_empresa->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($usuarios->nit_empresa->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($usuarios->nit_empresa->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($usuarios->fecha_creacion->Visible) { // fecha_creacion ?>
                                    <?php if ($usuarios->SortUrl($usuarios->fecha_creacion) == "") { ?>
                                        <td><?php echo $usuarios->fecha_creacion->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->fecha_creacion) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $usuarios->fecha_creacion->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($usuarios->fecha_creacion->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($usuarios->fecha_creacion->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($usuarios->activo->Visible) { // activo ?>
                                    <?php if ($usuarios->SortUrl($usuarios->activo) == "") { ?>
                                        <td><?php echo $usuarios->activo->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->activo) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $usuarios->activo->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($usuarios->activo->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($usuarios->activo->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($usuarios->nivel->Visible) { // nivel ?>
                                    <?php if ($usuarios->SortUrl($usuarios->nivel) == "") { ?>
                                        <td><?php echo $usuarios->nivel->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->nivel) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $usuarios->nivel->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($usuarios->nivel->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($usuarios->nivel->getSort() == "DESC") { ?>
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
                                $usuarios_list->ListOptions->Render("header", "right");
                                ?>
                            </tr>
                            </thead>
                            <?php
                            if ($usuarios->ExportAll && $usuarios->Export <> "") {
                                $usuarios_list->StopRec = $usuarios_list->TotalRecs;
                            } else {

                                // Set the last record to display
                                if ($usuarios_list->TotalRecs > $usuarios_list->StartRec + $usuarios_list->DisplayRecs - 1)
                                    $usuarios_list->StopRec = $usuarios_list->StartRec + $usuarios_list->DisplayRecs - 1;
                                else
                                    $usuarios_list->StopRec = $usuarios_list->TotalRecs;
                            }
                            $usuarios_list->RecCnt = $usuarios_list->StartRec - 1;
                            if ($usuarios_list->Recordset && !$usuarios_list->Recordset->EOF) {
                                $usuarios_list->Recordset->MoveFirst();
                                if (!$bSelectLimit && $usuarios_list->StartRec > 1)
                                    $usuarios_list->Recordset->Move($usuarios_list->StartRec - 1);
                            } elseif (!$usuarios->AllowAddDeleteRow && $usuarios_list->StopRec == 0) {
                                $usuarios_list->StopRec = $usuarios->GridAddRowCount;
                            }

                            // Initialize aggregate
                            $usuarios->RowType = EW_ROWTYPE_AGGREGATEINIT;
                            $usuarios->ResetAttrs();
                            $usuarios_list->RenderRow();
                            $usuarios_list->RowCnt = 0;
                            while ($usuarios_list->RecCnt < $usuarios_list->StopRec) {
                                $usuarios_list->RecCnt++;
                                if (intval($usuarios_list->RecCnt) >= intval($usuarios_list->StartRec)) {
                                    $usuarios_list->RowCnt++;

                                    // Set up key count
                                    $usuarios_list->KeyCount = $usuarios_list->RowIndex;

                                    // Init row class and style
                                    $usuarios->ResetAttrs();
                                    $usuarios->CssClass = "";
                                    if ($usuarios->CurrentAction == "gridadd") {
                                    } else {
                                        $usuarios_list->LoadRowValues($usuarios_list->Recordset); // Load row values
                                    }
                                    $usuarios->RowType = EW_ROWTYPE_VIEW; // Render view
                                    $usuarios->RowAttrs = array('onmouseover' => 'ew_MouseOver(event, this);', 'onmouseout' => 'ew_MouseOut(event, this);', 'onclick' => 'ew_Click(event, this);');

                                    // Render row
                                    $usuarios_list->RenderRow();

                                    // Render list options
                                    $usuarios_list->RenderListOptions();
                                    ?>
                                    <tr<?php echo $usuarios->RowAttributes() ?>>
                                        <?php

                                        // Render list options (body, left)
                                        $usuarios_list->ListOptions->Render("body", "left");
                                        ?>
                                        <?php if ($usuarios->idusuario->Visible) { // idusuario ?>
                                            <td<?php echo $usuarios->idusuario->CellAttributes() ?>>
                                                <div<?php echo $usuarios->idusuario->ViewAttributes() ?>><?php echo $usuarios->idusuario->ListViewValue() ?></div>
                                                <a name="<?php echo $usuarios_list->PageObjName . "_row_" . $usuarios_list->RowCnt ?>"
                                                   id="<?php echo $usuarios_list->PageObjName . "_row_" . $usuarios_list->RowCnt ?>"></a>
                                            </td>
                                        <?php } ?>
                                        <?php if ($usuarios->username->Visible) { // username ?>
                                            <td<?php echo $usuarios->username->CellAttributes() ?>>
                                                <div<?php echo $usuarios->username->ViewAttributes() ?>><?php echo $usuarios->username->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($usuarios->zemail->Visible) { // email ?>
                                            <td<?php echo $usuarios->zemail->CellAttributes() ?>>
                                                <div<?php echo $usuarios->zemail->ViewAttributes() ?>><?php echo $usuarios->zemail->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($usuarios->empresa->Visible) { // empresa ?>
                                            <td<?php echo $usuarios->empresa->CellAttributes() ?>>
                                                <div<?php echo $usuarios->empresa->ViewAttributes() ?>><?php echo $usuarios->empresa->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($usuarios->nit_empresa->Visible) { // nit_empresa ?>
                                            <td<?php echo $usuarios->nit_empresa->CellAttributes() ?>>
                                                <div<?php echo $usuarios->nit_empresa->ViewAttributes() ?>><?php echo $usuarios->nit_empresa->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($usuarios->fecha_creacion->Visible) { // fecha_creacion ?>
                                            <td<?php echo $usuarios->fecha_creacion->CellAttributes() ?>>
                                                <div<?php echo $usuarios->fecha_creacion->ViewAttributes() ?>><?php echo $usuarios->fecha_creacion->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($usuarios->activo->Visible) { // activo ?>
                                            <td<?php echo $usuarios->activo->CellAttributes() ?>>
                                                <div<?php echo $usuarios->activo->ViewAttributes() ?>><?php echo $usuarios->activo->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($usuarios->nivel->Visible) { // nivel ?>
                                            <td<?php echo $usuarios->nivel->CellAttributes() ?>>
                                                <div<?php echo $usuarios->nivel->ViewAttributes() ?>><?php echo $usuarios->nivel->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php

                                        // Render list options (body, right)
                                        $usuarios_list->ListOptions->Render("body", "right");
                                        ?>
                                    </tr>
                                    <?php
                                }
                                if ($usuarios->CurrentAction <> "gridadd")
                                    $usuarios_list->Recordset->MoveNext();
                            }
                            ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </form>
            <?php

            // Close recordset
            if ($usuarios_list->Recordset)
                $usuarios_list->Recordset->Close();
            ?>
            <?php if ($usuarios->Export == "") { ?>
                <div class="ewGridLowerPanel">
                    <?php if ($usuarios->CurrentAction <> "gridadd" && $usuarios->CurrentAction <> "gridedit") { ?>
                        <form name="ewpagerform" id="ewpagerform" class="ewForm"
                              action="<?php echo ew_CurrentPage() ?>">
                            <table border="0" cellspacing="0" cellpadding="0" class="ewPager">
                                <tr>
                                    <td nowrap>
                                        <span class="phpmaker pager">
                                            <span class="row">
                                                <?php if (!isset($usuarios_list->Pager)) $usuarios_list->Pager = new cNumericPager($usuarios_list->StartRec, $usuarios_list->DisplayRecs, $usuarios_list->TotalRecs, $usuarios_list->RecRange) ?>
                                                <?php if ($usuarios_list->Pager->RecordCount > 0) { ?>
                                                <?php if ($usuarios_list->Pager->FirstButton->Enabled) { ?>
                                                    <a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->FirstButton->Start ?>"><i class="fa fa-2x fa-angle-double-left"></i></a>
                                                <?php } ?>
                                                <?php if ($usuarios_list->Pager->PrevButton->Enabled) { ?>
                                                    <a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->PrevButton->Start ?>"><i class="fa fa-2x fa-angle-left"></i></a>
                                                <?php } ?>
                                                <?php foreach ($usuarios_list->Pager->Items as $PagerItem) { ?>
                                                    <?php if ($PagerItem->Enabled) { ?><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?>
                                                    <b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>  
                                                <?php } ?>
                                                <?php if ($usuarios_list->Pager->NextButton->Enabled) { ?>
                                                    <a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->NextButton->Start ?>"><i class="fa fa-2x fa-angle-right"></i></a>
                                                <?php } ?>
                                                <?php if ($usuarios_list->Pager->LastButton->Enabled) { ?>
                                                    <a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->LastButton->Start ?>"><i class="fa fa-2x fa-angle-double-right"></i></a>
                                                <?php } ?>
                                            </span>
                                            <span class="row">
                                                <?php if ($usuarios_list->Pager->ButtonCount > 0) { ?>        <?php } ?>
                                                <?php echo $Language->Phrase("Record") ?>  <?php echo $usuarios_list->Pager->FromIndex ?>  <?php echo $Language->Phrase("To") ?>  <?php echo $usuarios_list->Pager->ToIndex ?>  <?php echo $Language->Phrase("Of") ?>  <?php echo $usuarios_list->Pager->RecordCount ?>
                                                <?php } else { ?>
                                                    <?php if ($Security->CanList()) { ?>
                                                        <?php if ($usuarios_list->SearchWhere == "0=101") { ?>
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
                </div>
            <?php } ?>
        </td>
    </tr>
</table>
<?php if ($usuarios->Export == "" && $usuarios->CurrentAction == "") { ?>
<?php } ?>
<?php
$usuarios_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
    echo ew_DebugMsg();
?>
<?php if ($usuarios->Export == "") { ?>
    <script language="JavaScript" type="text/javascript">
        <!--

        // Write your table-specific startup script here
        // document.write("page loaded");
        //-->

    </script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuarios_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarios_list
{

    // Page ID
    var $PageID = 'list';

    // Table name
    var $TableName = 'usuarios';

    // Page object name
    var $PageObjName = 'usuarios_list';

    // Page name
    function PageName()
    {
        return ew_CurrentPage();
    }

    // Page URL
    function PageUrl()
    {
        $PageUrl = ew_CurrentPage() . "?";
        global $usuarios;
        if ($usuarios->UseTokenInUrl) $PageUrl .= "t=" . $usuarios->TableVar . "&"; // Add page token
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
    function cusuarios_list()
    {
        global $conn, $Language;

        // Language object
        if (!isset($Language)) $Language = new cLanguage();

        // Table object (usuarios)
        if (!isset($GLOBALS["usuarios"])) {
            $GLOBALS["usuarios"] = new cusuarios();
            $GLOBALS["Table"] =& $GLOBALS["usuarios"];
        }

        // Initialize URLs
        $this->ExportPrintUrl = $this->PageUrl() . "export=print";
        $this->ExportExcelUrl = $this->PageUrl() . "export=excel";
        $this->ExportWordUrl = $this->PageUrl() . "export=word";
        $this->ExportHtmlUrl = $this->PageUrl() . "export=html";
        $this->ExportXmlUrl = $this->PageUrl() . "export=xml";
        $this->ExportCsvUrl = $this->PageUrl() . "export=csv";
        $this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
        $this->AddUrl = "usuariosadd.php";
        $this->InlineAddUrl = $this->PageUrl() . "a=add";
        $this->GridAddUrl = $this->PageUrl() . "a=gridadd";
        $this->GridEditUrl = $this->PageUrl() . "a=gridedit";
        $this->MultiDeleteUrl = "usuariosdelete.php";
        $this->MultiUpdateUrl = "usuariosupdate.php";

        // Page ID
        if (!defined("EW_PAGE_ID"))
            define("EW_PAGE_ID", 'list', TRUE);

        // Table name (for backward compatibility)
        if (!defined("EW_TABLE_NAME"))
            define("EW_TABLE_NAME", 'usuarios', TRUE);

        // Start timer
        if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

        // Open connection
        if (!isset($conn)) $conn = ew_Connect();

        // List options
        $this->ListOptions = new cListOptions();

        // Export options
        $this->ExportOptions = new cListOptions();
        $this->ExportOptions->Tag = "span";
        $this->ExportOptions->Separator = "    ";
    }

    //
    //  Page_Init
    //
    function Page_Init()
    {
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
            $usuarios->Export = $_GET["export"];
        } elseif (ew_IsHttpPost()) {
            if (@$_POST["exporttype"] <> "")
                $usuarios->Export = $_POST["exporttype"];
        } else {
            $usuarios->setExportReturnUrl(ew_CurrentUrl());
        }
        $gsExport = $usuarios->Export; // Get export parameter, used in header
        $gsExportFile = $usuarios->TableVar; // Get export file, used in header
        $Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
        if ($usuarios->Export == "excel") {
            header('Content-Type: application/vnd.ms-excel' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xls');
        }
        if ($usuarios->Export == "word") {
            header('Content-Type: application/vnd.ms-word' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
        }
        if ($usuarios->Export == "xml") {
            header('Content-Type: text/xml' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xml');
        }
        if ($usuarios->Export == "csv") {
            header('Content-Type: application/csv' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.csv');
        }

        // Get grid add count
        $gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
            $usuarios->GridAddRowCount = $gridaddcnt;

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
        global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $usuarios;

        // Search filters
        $sSrchAdvanced = ""; // Advanced search filter
        $sSrchBasic = ""; // Basic search filter
        $sFilter = "";
        if ($this->IsPageRequest()) { // Validate request

            // Handle reset command
            $this->ResetCmd();

            // Hide all options
            if ($usuarios->Export <> "" ||
                $usuarios->CurrentAction == "gridadd" ||
                $usuarios->CurrentAction == "gridedit") {
                $this->ListOptions->HideAllOptions();
                $this->ExportOptions->HideAllOptions();
            }

            // Get basic search values
            $this->LoadBasicSearchValues();

            // Restore search parms from Session
            $this->RestoreSearchParms();

            // Call Recordset SearchValidated event
            $usuarios->Recordset_SearchValidated();

            // Set up sorting order
            $this->SetUpSortOrder();

            // Get basic search criteria
            if ($gsSearchError == "")
                $sSrchBasic = $this->BasicSearchWhere();
        }

        // Restore display records
        if ($usuarios->getRecordsPerPage() <> "") {
            $this->DisplayRecs = $usuarios->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecs = 20; // Load default
        }

        // Load Sorting Order
        $this->LoadSortOrder();

        // Build search criteria
        ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
        ew_AddFilter($this->SearchWhere, $sSrchBasic);

        // Call Recordset_Searching event
        $usuarios->Recordset_Searching($this->SearchWhere);

        // Save search criteria
        if ($this->SearchWhere <> "") {
            if ($sSrchBasic == "")
                $this->ResetBasicSearchParms();
            $usuarios->setSearchWhere($this->SearchWhere); // Save to Session
            if (!$this->RestoreSearch) {
                $this->StartRec = 1; // Reset start record counter
                $usuarios->setStartRecordNumber($this->StartRec);
            }
        } else {
            $this->SearchWhere = $usuarios->getSearchWhere();
        }

        // Build filter
        $sFilter = "";
        if (!$Security->CanList())
            $sFilter = "(0=1)"; // Filter all records
        ew_AddFilter($sFilter, $this->DbDetailFilter);
        ew_AddFilter($sFilter, $this->SearchWhere);

        // Set up filter in session
        $usuarios->setSessionWhere($sFilter);
        $usuarios->CurrentFilter = "";

        // Export data only
        if (in_array($usuarios->Export, array("html", "word", "excel", "xml", "csv", "email", "pdf"))) {
            $this->ExportData();
            if ($usuarios->Export <> "email")
                $this->Page_Terminate(); // Terminate response
            exit();
        }
    }

    // Return basic search SQL
    function BasicSearchSQL($Keyword)
    {
        global $usuarios;
        $sKeyword = ew_AdjustSql($Keyword);
        $sWhere = "";
        $this->BuildBasicSearchSQL($sWhere, $usuarios->username, $Keyword);
        $this->BuildBasicSearchSQL($sWhere, $usuarios->password, $Keyword);
        $this->BuildBasicSearchSQL($sWhere, $usuarios->zemail, $Keyword);
        $this->BuildBasicSearchSQL($sWhere, $usuarios->empresa, $Keyword);
        $this->BuildBasicSearchSQL($sWhere, $usuarios->perfil, $Keyword);
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
        global $Security, $usuarios;
        $sSearchStr = "";
        if (!$Security->CanSearch()) return "";
        $sSearchKeyword = $usuarios->BasicSearchKeyword;
        $sSearchType = $usuarios->BasicSearchType;
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
            $usuarios->setSessionBasicSearchKeyword($sSearchKeyword);
            $usuarios->setSessionBasicSearchType($sSearchType);
        }
        return $sSearchStr;
    }

    // Clear all search parameters
    function ResetSearchParms()
    {
        global $usuarios;

        // Clear search WHERE clause
        $this->SearchWhere = "";
        $usuarios->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->ResetBasicSearchParms();
    }

    // Clear all basic search parameters
    function ResetBasicSearchParms()
    {
        global $usuarios;
        $usuarios->setSessionBasicSearchKeyword("");
        $usuarios->setSessionBasicSearchType("");
    }

    // Restore all search parameters
    function RestoreSearchParms()
    {
        global $usuarios;
        $bRestore = TRUE;
        if ($usuarios->BasicSearchKeyword <> "") $bRestore = FALSE;
        $this->RestoreSearch = $bRestore;
        if ($bRestore) {

            // Restore basic search values
            $usuarios->BasicSearchKeyword = $usuarios->getSessionBasicSearchKeyword();
            $usuarios->BasicSearchType = $usuarios->getSessionBasicSearchType();
        }
    }

    // Set up sort parameters
    function SetUpSortOrder()
    {
        global $usuarios;

        // Check for "order" parameter
        if (@$_GET["order"] <> "") {
            $usuarios->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
            $usuarios->CurrentOrderType = @$_GET["ordertype"];
            $usuarios->UpdateSort($usuarios->idusuario); // idusuario
            $usuarios->UpdateSort($usuarios->username); // username
            $usuarios->UpdateSort($usuarios->zemail); // email
            $usuarios->UpdateSort($usuarios->empresa); // empresa
            $usuarios->UpdateSort($usuarios->nit_empresa); // nit_empresa
            $usuarios->UpdateSort($usuarios->fecha_creacion); // fecha_creacion
            $usuarios->UpdateSort($usuarios->activo); // activo
            $usuarios->UpdateSort($usuarios->nivel); // nivel
            $usuarios->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    function LoadSortOrder()
    {
        global $usuarios;
        $sOrderBy = $usuarios->getSessionOrderBy(); // Get ORDER BY from Session
        if ($sOrderBy == "") {
            if ($usuarios->SqlOrderBy() <> "") {
                $sOrderBy = $usuarios->SqlOrderBy();
                $usuarios->setSessionOrderBy($sOrderBy);
                $usuarios->idusuario->setSort("DESC");
            }
        }
    }

    // Reset command
    // cmd=reset (Reset search parameters)
    // cmd=resetall (Reset search and master/detail parameters)
    // cmd=resetsort (Reset sort parameters)
    function ResetCmd()
    {
        global $usuarios;

        // Get reset command
        if (@$_GET["cmd"] <> "") {
            $sCmd = $_GET["cmd"];

            // Reset search criteria
            if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
                $this->ResetSearchParms();

            // Reset sorting order
            if (strtolower($sCmd) == "resetsort") {
                $sOrderBy = "";
                $usuarios->setSessionOrderBy($sOrderBy);
                $usuarios->idusuario->setSort("");
                $usuarios->username->setSort("");
                $usuarios->zemail->setSort("");
                $usuarios->empresa->setSort("");
                $usuarios->nit_empresa->setSort("");
                $usuarios->fecha_creacion->setSort("");
                $usuarios->activo->setSort("");
                $usuarios->nivel->setSort("");
            }

            // Reset start position
            $this->StartRec = 1;
            $usuarios->setStartRecordNumber($this->StartRec);
        }
    }

    // Set up list options
    function SetupListOptions()
    {
        global $Security, $Language, $usuarios;

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

        // "copy"
        $item =& $this->ListOptions->Add("copy");
        $item->CssStyle = "white-space: nowrap;";
        $item->Visible = $Security->CanAdd();
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
    function RenderListOptions()
    {
        global $Security, $Language, $usuarios, $objForm;
        $this->ListOptions->LoadDefault();

        // "view"
        $oListOpt =& $this->ListOptions->Items["view"];
        if ($Security->CanView() && $this->ShowOptionLink() && $oListOpt->Visible)
            $oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . "<i class=\"fa fa-2x fa-eye\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\"></i>" . "</a>";

        // "edit"
        $oListOpt =& $this->ListOptions->Items["edit"];
        if ($Security->CanEdit() && $this->ShowOptionLink() && $oListOpt->Visible) {
            $oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . "<i class=\"fa fa-2x fa-pencil-square\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\"></i>" . "</a>";
        }

        // "copy"
        $oListOpt =& $this->ListOptions->Items["copy"];
        if ($Security->CanAdd() && $this->ShowOptionLink() && $oListOpt->Visible) {
            $oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->CopyUrl . "\">" . "<i class=\"fa fa-2x fa-clipboard\" alt=\"" . ew_HtmlEncode($Language->Phrase("CopyLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("CopyLink")) . "\"></i>" . "</a>";
        }

        // "delete"
        $oListOpt =& $this->ListOptions->Items["delete"];
        if ($Security->CanDelete() && $this->ShowOptionLink() && $oListOpt->Visible)
            $oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<i class=\"fa fa-2x fa-times\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\"></i>" . "</a>";
        $this->RenderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->ListOptions_Rendered();
    }

    function RenderListOptionsExt()
    {
        global $Security, $Language, $usuarios;
    }

    // Set up starting record parameters
    function SetUpStartRec()
    {
        global $usuarios;
        if ($this->DisplayRecs == 0)
            return;
        if ($this->IsPageRequest()) { // Validate request
            if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
                $this->StartRec = $_GET[EW_TABLE_START_REC];
                $usuarios->setStartRecordNumber($this->StartRec);
            } elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
                $PageNo = $_GET[EW_TABLE_PAGE_NO];
                if (is_numeric($PageNo)) {
                    $this->StartRec = ($PageNo - 1) * $this->DisplayRecs + 1;
                    if ($this->StartRec <= 0) {
                        $this->StartRec = 1;
                    } elseif ($this->StartRec >= intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1) {
                        $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1;
                    }
                    $usuarios->setStartRecordNumber($this->StartRec);
                }
            }
        }
        $this->StartRec = $usuarios->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
            $this->StartRec = 1; // Reset start record counter
            $usuarios->setStartRecordNumber($this->StartRec);
        } elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
            $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
            $usuarios->setStartRecordNumber($this->StartRec);
        } elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
            $this->StartRec = intval(($this->StartRec - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
            $usuarios->setStartRecordNumber($this->StartRec);
        }
    }

    // Load basic search values
    function LoadBasicSearchValues()
    {
        global $usuarios;
        $usuarios->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
        $usuarios->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
    }

    // Load recordset
    function LoadRecordset($offset = -1, $rowcnt = -1)
    {
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
    function LoadRow()
    {
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
    function LoadRowValues(&$rs)
    {
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

    // Load old record
    function LoadOldRecord()
    {
        global $usuarios;

        // Load key values from Session
        $bValidKey = TRUE;
        if (strval($usuarios->getKey("idusuario")) <> "")
            $usuarios->idusuario->CurrentValue = $usuarios->getKey("idusuario"); // idusuario
        else
            $bValidKey = FALSE;

        // Load old recordset
        if ($bValidKey) {
            $usuarios->CurrentFilter = $usuarios->KeyFilter();
            $sSql = $usuarios->SQL();
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
        global $conn, $Security, $Language, $usuarios;

        // Initialize URLs
        $this->ViewUrl = $usuarios->ViewUrl();
        $this->EditUrl = $usuarios->EditUrl();
        $this->InlineEditUrl = $usuarios->InlineEditUrl();
        $this->CopyUrl = $usuarios->CopyUrl();
        $this->InlineCopyUrl = $usuarios->InlineCopyUrl();
        $this->DeleteUrl = $usuarios->DeleteUrl();

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

    // Set up export options
    function SetupExportOptions()
    {
        global $Language, $usuarios;

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
        $item->Body = "<a name=\"emf_usuarios\" id=\"emf_usuarios\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_usuarios',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fusuarioslist,sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
        $item->Visible = TRUE;

        // Hide options for export/action
        if ($usuarios->Export <> "" ||
            $usuarios->CurrentAction <> "")
            $this->ExportOptions->HideAllOptions();
    }

    // Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
    function ExportData()
    {
        global $usuarios;
        $utf8 = (strtolower(EW_CHARSET) == "utf-8");
        $bSelectLimit = EW_SELECT_LIMIT;

        // Load recordset
        if ($bSelectLimit) {
            $this->TotalRecs = $usuarios->SelectRecordCount();
        } else {
            if ($rs = $this->LoadRecordset())
                $this->TotalRecs = $rs->RecordCount();
        }
        $this->StartRec = 1;

        // Export all
        if ($usuarios->ExportAll) {
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
        if ($usuarios->Export == "xml") {
            $XmlDoc = new cXMLDocument(EW_XML_ENCODING);
        } else {
            $ExportDoc = new cExportDocument($usuarios, "h");
        }
        $ParentTable = "";
        if ($bSelectLimit) {
            $StartRec = 1;
            $StopRec = $this->DisplayRecs;
        } else {
            $StartRec = $this->StartRec;
            $StopRec = $this->StopRec;
        }
        if ($usuarios->Export == "xml") {
            $usuarios->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
        } else {
            $sHeader = $this->PageHeader;
            $this->Page_DataRendering($sHeader);
            $ExportDoc->Text .= $sHeader;
            $usuarios->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
            $sFooter = $this->PageFooter;
            $this->Page_DataRendered($sFooter);
            $ExportDoc->Text .= $sFooter;
        }

        // Close recordset
        $rs->Close();

        // Export header and footer
        if ($usuarios->Export <> "xml") {
            $ExportDoc->ExportHeaderAndFooter();
        }

        // Clean output buffer
        if (!EW_DEBUG_ENABLED && ob_get_length())
            ob_end_clean();

        // Write BOM if utf-8
        if ($utf8 && !in_array($usuarios->Export, array("email", "xml")))
            echo "\xEF\xBB\xBF";

        // Write debug message if enabled
        if (EW_DEBUG_ENABLED)
            echo ew_DebugMsg();

        // Output data
        if ($usuarios->Export == "xml") {
            header("Content-Type: text/xml");
            echo $XmlDoc->XML();
        } elseif ($usuarios->Export == "email") {
            $this->ExportEmail($ExportDoc->Text);
            $this->Page_Terminate($usuarios->ExportReturnUrl());
        } elseif ($usuarios->Export == "pdf") {
            $this->ExportPDF($ExportDoc->Text);
        } else {
            echo $ExportDoc->Text;
        }
    }

    // Export email
    function ExportEmail($EmailContent)
    {
        global $Language, $usuarios;
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
        if ($usuarios->Email_Sending($Email, $EventArgs))
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
        global $usuarios;

        // Initialize
        $sQry = "export=html";

        // Build QueryString for search
        if ($usuarios->getSessionBasicSearchKeyword() <> "") {
            $sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . $usuarios->getSessionBasicSearchKeyword() . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . $usuarios->getSessionBasicSearchType();
        }

        // Build QueryString for pager
        $sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . $usuarios->getRecordsPerPage() . "&" . EW_TABLE_START_REC . "=" . $usuarios->getStartRecordNumber();
        return $sQry;
    }

    // Add search QueryString
    function AddSearchQueryString(&$Qry, &$Fld)
    {
        global $usuarios;
        $FldParm = substr($Fld->FldVar, 2);
        $FldSearchValue = $usuarios->getAdvancedSearch("x_" . $FldParm);
        if (strval($FldSearchValue) <> "") {
            $Qry .= "&x_" . $FldParm . "=" . FldSearchValue .
                "&z_" . $FldParm . "=" . $usuarios->getAdvancedSearch("z_" . $FldParm);
        }
        $FldSearchValue2 = $usuarios->getAdvancedSearch("y_" . $FldParm);
        if (strval($FldSearchValue2) <> "") {
            $Qry .= "&v_" . $FldParm . "=" . $usuarios->getAdvancedSearch("v_" . $FldParm) .
                "&y_" . $FldParm . "=" . $FldSearchValue2 .
                "&w_" . $FldParm . "=" . $usuarios->getAdvancedSearch("w_" . $FldParm);
        }
    }

    // Show link optionally based on User ID
    function ShowOptionLink()
    {
        global $Security, $usuarios;
        if ($Security->IsLoggedIn()) {
            if (!$Security->IsAdmin()) {
                return $Security->IsValidUserID($usuarios->idusuario->CurrentValue);
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
