<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "nivelesinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$niveles_list = new cniveles_list();
$Page =& $niveles_list;

// Page init
$niveles_list->Page_Init();

// Page main
$niveles_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($niveles->Export == "") { ?>
    <script type="text/javascript">
        <!--

        // Create page object
        var niveles_list = new ew_Page("niveles_list");

        // page properties
        niveles_list.PageID = "list"; // page ID
        niveles_list.FormID = "fniveleslist"; // form ID
        var EW_PAGE_ID = niveles_list.PageID; // for backward compatibility

        // extend page with Form_CustomValidate function
        niveles_list.Form_CustomValidate =
            function (fobj) { // DO NOT CHANGE THIS LINE!

                // Your custom validation code here, return false if invalid.
                return true;
            }
        <?php if (EW_CLIENT_VALIDATE) { ?>
        niveles_list.ValidateRequired = true; // uses JavaScript validation
        <?php } else { ?>
        niveles_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($niveles->Export == "") || (EW_EXPORT_MASTER_RECORD && $niveles->Export == "print")) { ?>
<?php } ?>
<?php
$bSelectLimit = EW_SELECT_LIMIT;
if ($bSelectLimit) {
    $niveles_list->TotalRecs = $niveles->SelectRecordCount();
} else {
    if ($niveles_list->Recordset = $niveles_list->LoadRecordset())
        $niveles_list->TotalRecs = $niveles_list->Recordset->RecordCount();
}
$niveles_list->StartRec = 1;
if ($niveles_list->DisplayRecs <= 0 || ($niveles->Export <> "" && $niveles->ExportAll)) // Display all records
    $niveles_list->DisplayRecs = $niveles_list->TotalRecs;
if (!($niveles->Export <> "" && $niveles->ExportAll))
    $niveles_list->SetUpStartRec(); // Set up start record position
if ($bSelectLimit)
    $niveles_list->Recordset = $niveles_list->LoadRecordset($niveles_list->StartRec - 1, $niveles_list->DisplayRecs);
?>
<p class="phpmaker ewTitle"
   style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $niveles->TableCaption() ?>
    &nbsp;&nbsp;<?php $niveles_list->ExportOptions->Render("body"); ?>
</p>
<?php $niveles_list->ShowPageHeader(); ?>
<?php
$niveles_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid">
    <tr>
        <td class="ewGridContent">
            <form name="fniveleslist" id="fniveleslist" class="ewForm" action="" method="post">
                <input type="hidden" name="t" id="t" value="niveles">
                <div id="gmp_niveles" class="ewGridMiddlePanel">
                    <?php if ($niveles_list->TotalRecs > 0) { ?>
                        <table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow"
                               data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow"
                               class="ewTable ewTableSeparate">
                            <?php echo $niveles->TableCustomInnerHtml ?>
                            <thead><!-- Table header -->
                            <tr class="ewTableHeader">
                                <?php

                                // Render list options
                                $niveles_list->RenderListOptions();

                                // Render list options (header, left)
                                $niveles_list->ListOptions->Render("header", "left");
                                ?>
                                <?php if ($niveles->idnivel->Visible) { // idnivel ?>
                                    <?php if ($niveles->SortUrl($niveles->idnivel) == "") { ?>
                                        <td><?php echo $niveles->idnivel->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $niveles->SortUrl($niveles->idnivel) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $niveles->idnivel->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($niveles->idnivel->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($niveles->idnivel->getSort() == "DESC") { ?>
                                                                <img src="phpimages/sortdown.gif" width="10" height="9"
                                                                     border="0"><?php } ?></td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($niveles->nombrenivel->Visible) { // nombrenivel ?>
                                    <?php if ($niveles->SortUrl($niveles->nombrenivel) == "") { ?>
                                        <td><?php echo $niveles->nombrenivel->FldCaption() ?></td>
                                    <?php } else { ?>
                                        <td>
                                            <div class="ewPointer"
                                                 onmousedown="ew_Sort(event,'<?php echo $niveles->SortUrl($niveles->nombrenivel) ?>',1);">
                                                <table cellspacing="0" class="ewTableHeaderBtn">
                                                    <thead>
                                                    <tr>
                                                        <td><?php echo $niveles->nombrenivel->FldCaption() ?></td>
                                                        <td style="width: 10px;"><?php if ($niveles->nombrenivel->getSort() == "ASC") { ?>
                                                                <img src="phpimages/sortup.gif" width="10" height="9"
                                                                     border="0"><?php } elseif ($niveles->nombrenivel->getSort() == "DESC") { ?>
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
                                $niveles_list->ListOptions->Render("header", "right");
                                ?>
                            </tr>
                            </thead>
                            <?php
                            if ($niveles->ExportAll && $niveles->Export <> "") {
                                $niveles_list->StopRec = $niveles_list->TotalRecs;
                            } else {

                                // Set the last record to display
                                if ($niveles_list->TotalRecs > $niveles_list->StartRec + $niveles_list->DisplayRecs - 1)
                                    $niveles_list->StopRec = $niveles_list->StartRec + $niveles_list->DisplayRecs - 1;
                                else
                                    $niveles_list->StopRec = $niveles_list->TotalRecs;
                            }
                            $niveles_list->RecCnt = $niveles_list->StartRec - 1;
                            if ($niveles_list->Recordset && !$niveles_list->Recordset->EOF) {
                                $niveles_list->Recordset->MoveFirst();
                                if (!$bSelectLimit && $niveles_list->StartRec > 1)
                                    $niveles_list->Recordset->Move($niveles_list->StartRec - 1);
                            } elseif (!$niveles->AllowAddDeleteRow && $niveles_list->StopRec == 0) {
                                $niveles_list->StopRec = $niveles->GridAddRowCount;
                            }

                            // Initialize aggregate
                            $niveles->RowType = EW_ROWTYPE_AGGREGATEINIT;
                            $niveles->ResetAttrs();
                            $niveles_list->RenderRow();
                            $niveles_list->RowCnt = 0;
                            while ($niveles_list->RecCnt < $niveles_list->StopRec) {
                                $niveles_list->RecCnt++;
                                if (intval($niveles_list->RecCnt) >= intval($niveles_list->StartRec)) {
                                    $niveles_list->RowCnt++;

                                    // Set up key count
                                    $niveles_list->KeyCount = $niveles_list->RowIndex;

                                    // Init row class and style
                                    $niveles->ResetAttrs();
                                    $niveles->CssClass = "";
                                    if ($niveles->CurrentAction == "gridadd") {
                                    } else {
                                        $niveles_list->LoadRowValues($niveles_list->Recordset); // Load row values
                                    }
                                    $niveles->RowType = EW_ROWTYPE_VIEW; // Render view
                                    $niveles->RowAttrs = array('onmouseover' => 'ew_MouseOver(event, this);', 'onmouseout' => 'ew_MouseOut(event, this);', 'onclick' => 'ew_Click(event, this);');

                                    // Render row
                                    $niveles_list->RenderRow();

                                    // Render list options
                                    $niveles_list->RenderListOptions();
                                    ?>
                                    <tr<?php echo $niveles->RowAttributes() ?>>
                                        <?php

                                        // Render list options (body, left)
                                        $niveles_list->ListOptions->Render("body", "left");
                                        ?>
                                        <?php if ($niveles->idnivel->Visible) { // idnivel ?>
                                            <td<?php echo $niveles->idnivel->CellAttributes() ?>>
                                                <div<?php echo $niveles->idnivel->ViewAttributes() ?>><?php echo $niveles->idnivel->ListViewValue() ?></div>
                                                <a name="<?php echo $niveles_list->PageObjName . "_row_" . $niveles_list->RowCnt ?>"
                                                   id="<?php echo $niveles_list->PageObjName . "_row_" . $niveles_list->RowCnt ?>"></a>
                                            </td>
                                        <?php } ?>
                                        <?php if ($niveles->nombrenivel->Visible) { // nombrenivel ?>
                                            <td<?php echo $niveles->nombrenivel->CellAttributes() ?>>
                                                <div<?php echo $niveles->nombrenivel->ViewAttributes() ?>><?php echo $niveles->nombrenivel->ListViewValue() ?></div>
                                            </td>
                                        <?php } ?>
                                        <?php

                                        // Render list options (body, right)
                                        $niveles_list->ListOptions->Render("body", "right");
                                        ?>
                                    </tr>
                                    <?php
                                }
                                if ($niveles->CurrentAction <> "gridadd")
                                    $niveles_list->Recordset->MoveNext();
                            }
                            ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </form>
            <?php

            // Close recordset
            if ($niveles_list->Recordset)
                $niveles_list->Recordset->Close();
            ?>
            <?php if ($niveles->Export == "") { ?>
                <div class="ewGridLowerPanel">
                    <?php if ($niveles->CurrentAction <> "gridadd" && $niveles->CurrentAction <> "gridedit") { ?>
                        <form name="ewpagerform" id="ewpagerform" class="ewForm"
                              action="<?php echo ew_CurrentPage() ?>">
                            <table border="0" cellspacing="0" cellpadding="0" class="ewPager">
                                <tr>
                                    <td nowrap>
                                        <span class="phpmaker pager">
                                            <span class="row">
                                                <?php if (!isset($niveles_list->Pager)) $niveles_list->Pager = new cNumericPager($niveles_list->StartRec, $niveles_list->DisplayRecs, $niveles_list->TotalRecs, $niveles_list->RecRange) ?>
                                                <?php if ($niveles_list->Pager->RecordCount > 0) { ?>
                                                    <?php if ($niveles_list->Pager->FirstButton->Enabled) { ?>
                                                        <a href="<?php echo $niveles_list->PageUrl() ?>start=<?php echo $niveles_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
                                                    <?php } ?>
                                            <?php if ($niveles_list->Pager->PrevButton->Enabled) { ?>
                                                        <a href="<?php echo $niveles_list->PageUrl() ?>start=<?php echo $niveles_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
                                                    <?php } ?>
                                            <?php foreach ($niveles_list->Pager->Items as $PagerItem) { ?>
                                                        <?php if ($PagerItem->Enabled) { ?><a href="<?php echo $niveles_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?>
                                                        <b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
                                                    <?php } ?>
                                            <?php if ($niveles_list->Pager->NextButton->Enabled) { ?>
                                                        <a href="<?php echo $niveles_list->PageUrl() ?>start=<?php echo $niveles_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
                                                    <?php } ?>
                                            <?php if ($niveles_list->Pager->LastButton->Enabled) { ?>
                                                        <a href="<?php echo $niveles_list->PageUrl() ?>start=<?php echo $niveles_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
                                                    <?php } ?>
                                                    <?php if ($niveles_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
                                                    <?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $niveles_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $niveles_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $niveles_list->Pager->RecordCount ?>
                                                <?php } else { ?>
                                                    <?php if ($Security->CanList()) { ?>
                                                        <?php if ($niveles_list->SearchWhere == "0=101") { ?>
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
                    <span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
    <a class="ewGridLink"
       href="<?php echo $niveles_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
                </div>
            <?php } ?>
        </td>
    </tr>
</table>
<?php if ($niveles->Export == "" && $niveles->CurrentAction == "") { ?>
<?php } ?>
<?php
$niveles_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
    echo ew_DebugMsg();
?>
<?php if ($niveles->Export == "") { ?>
    <script language="JavaScript" type="text/javascript">
        <!--

        // Write your table-specific startup script here
        // document.write("page loaded");
        //-->

    </script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$niveles_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cniveles_list
{

    // Page ID
    var $PageID = 'list';

    // Table name
    var $TableName = 'niveles';

    // Page object name
    var $PageObjName = 'niveles_list';

    // Page name
    function PageName()
    {
        return ew_CurrentPage();
    }

    // Page URL
    function PageUrl()
    {
        $PageUrl = ew_CurrentPage() . "?";
        global $niveles;
        if ($niveles->UseTokenInUrl) $PageUrl .= "t=" . $niveles->TableVar . "&"; // Add page token
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
        global $objForm, $niveles;
        if ($niveles->UseTokenInUrl) {
            if ($objForm)
                return ($niveles->TableVar == $objForm->GetValue("t"));
            if (@$_GET["t"] <> "")
                return ($niveles->TableVar == $_GET["t"]);
        } else {
            return TRUE;
        }
    }

    //
    // Page class constructor
    //
    function cniveles_list()
    {
        global $conn, $Language;

        // Language object
        if (!isset($Language)) $Language = new cLanguage();

        // Table object (niveles)
        if (!isset($GLOBALS["niveles"])) {
            $GLOBALS["niveles"] = new cniveles();
            $GLOBALS["Table"] =& $GLOBALS["niveles"];
        }

        // Initialize URLs
        $this->ExportPrintUrl = $this->PageUrl() . "export=print";
        $this->ExportExcelUrl = $this->PageUrl() . "export=excel";
        $this->ExportWordUrl = $this->PageUrl() . "export=word";
        $this->ExportHtmlUrl = $this->PageUrl() . "export=html";
        $this->ExportXmlUrl = $this->PageUrl() . "export=xml";
        $this->ExportCsvUrl = $this->PageUrl() . "export=csv";
        $this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
        $this->AddUrl = "nivelesadd.php";
        $this->InlineAddUrl = $this->PageUrl() . "a=add";
        $this->GridAddUrl = $this->PageUrl() . "a=gridadd";
        $this->GridEditUrl = $this->PageUrl() . "a=gridedit";
        $this->MultiDeleteUrl = "nivelesdelete.php";
        $this->MultiUpdateUrl = "nivelesupdate.php";

        // Table object (usuarios)
        if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

        // Page ID
        if (!defined("EW_PAGE_ID"))
            define("EW_PAGE_ID", 'list', TRUE);

        // Table name (for backward compatibility)
        if (!defined("EW_TABLE_NAME"))
            define("EW_TABLE_NAME", 'niveles', TRUE);

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
        global $niveles;

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
        if (!$Security->CanAdmin()) {
            $Security->SaveLastUrl();
            $this->Page_Terminate("login.php");
        }
        $Security->UserID_Loading();
        if ($Security->IsLoggedIn()) $Security->LoadUserID();
        $Security->UserID_Loaded();

        // Get export parameters
        if (@$_GET["export"] <> "") {
            $niveles->Export = $_GET["export"];
        } elseif (ew_IsHttpPost()) {
            if (@$_POST["exporttype"] <> "")
                $niveles->Export = $_POST["exporttype"];
        } else {
            $niveles->setExportReturnUrl(ew_CurrentUrl());
        }
        $gsExport = $niveles->Export; // Get export parameter, used in header
        $gsExportFile = $niveles->TableVar; // Get export file, used in header
        $Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
        if ($niveles->Export == "excel") {
            header('Content-Type: application/vnd.ms-excel' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xls');
        }
        if ($niveles->Export == "word") {
            header('Content-Type: application/vnd.ms-word' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
        }
        if ($niveles->Export == "xml") {
            header('Content-Type: text/xml' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xml');
        }
        if ($niveles->Export == "csv") {
            header('Content-Type: application/csv' . $Charset);
            header('Content-Disposition: attachment; filename=' . $gsExportFile . '.csv');
        }

        // Get grid add count
        $gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
            $niveles->GridAddRowCount = $gridaddcnt;

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
        global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $niveles;

        // Search filters
        $sSrchAdvanced = ""; // Advanced search filter
        $sSrchBasic = ""; // Basic search filter
        $sFilter = "";
        if ($this->IsPageRequest()) { // Validate request

            // Handle reset command
            $this->ResetCmd();

            // Hide all options
            if ($niveles->Export <> "" ||
                $niveles->CurrentAction == "gridadd" ||
                $niveles->CurrentAction == "gridedit") {
                $this->ListOptions->HideAllOptions();
                $this->ExportOptions->HideAllOptions();
            }

            // Set up sorting order
            $this->SetUpSortOrder();
        }

        // Restore display records
        if ($niveles->getRecordsPerPage() <> "") {
            $this->DisplayRecs = $niveles->getRecordsPerPage(); // Restore from Session
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
        $niveles->setSessionWhere($sFilter);
        $niveles->CurrentFilter = "";

        // Export data only
        if (in_array($niveles->Export, array("html", "word", "excel", "xml", "csv", "email", "pdf"))) {
            $this->ExportData();
            if ($niveles->Export <> "email")
                $this->Page_Terminate(); // Terminate response
            exit();
        }
    }

    // Set up sort parameters
    function SetUpSortOrder()
    {
        global $niveles;

        // Check for "order" parameter
        if (@$_GET["order"] <> "") {
            $niveles->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
            $niveles->CurrentOrderType = @$_GET["ordertype"];
            $niveles->UpdateSort($niveles->idnivel); // idnivel
            $niveles->UpdateSort($niveles->nombrenivel); // nombrenivel
            $niveles->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    function LoadSortOrder()
    {
        global $niveles;
        $sOrderBy = $niveles->getSessionOrderBy(); // Get ORDER BY from Session
        if ($sOrderBy == "") {
            if ($niveles->SqlOrderBy() <> "") {
                $sOrderBy = $niveles->SqlOrderBy();
                $niveles->setSessionOrderBy($sOrderBy);
            }
        }
    }

    // Reset command
    // cmd=reset (Reset search parameters)
    // cmd=resetall (Reset search and master/detail parameters)
    // cmd=resetsort (Reset sort parameters)
    function ResetCmd()
    {
        global $niveles;

        // Get reset command
        if (@$_GET["cmd"] <> "") {
            $sCmd = $_GET["cmd"];

            // Reset sorting order
            if (strtolower($sCmd) == "resetsort") {
                $sOrderBy = "";
                $niveles->setSessionOrderBy($sOrderBy);
                $niveles->idnivel->setSort("");
                $niveles->nombrenivel->setSort("");
            }

            // Reset start position
            $this->StartRec = 1;
            $niveles->setStartRecordNumber($this->StartRec);
        }
    }

    // Set up list options
    function SetupListOptions()
    {
        global $Security, $Language, $niveles;

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

        // "userpermission"
        $item =& $this->ListOptions->Add("userpermission");
        $item->CssStyle = "white-space: nowrap;";
        $item->Visible = $Security->IsAdmin();
        $item->OnLeft = FALSE;

        // Call ListOptions_Load event
        $this->ListOptions_Load();
    }

    // Render list options
    function RenderListOptions()
    {
        global $Security, $Language, $niveles, $objForm;
        $this->ListOptions->LoadDefault();

        // "edit"
        $oListOpt =& $this->ListOptions->Items["edit"];
        if ($Security->CanEdit() && $oListOpt->Visible) {
            $oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . "<i class=\"fa fa-2x fa-pencil-square-o\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\"></i>" . "</a>";
        }

        // "delete"
        $oListOpt =& $this->ListOptions->Items["delete"];
        if ($Security->CanDelete() && $oListOpt->Visible)
            $oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<i class=\"fa fa-2x fa-times\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\"></i>" . "</a>";

        // "userpermission"
        $oListOpt =& $this->ListOptions->Items["userpermission"];
        if ($niveles->idnivel->CurrentValue < 0) {
            $oListOpt->Body = "-";
        } else {
            $oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . "userpriv.php?idnivel=" . $niveles->idnivel->CurrentValue . "\">" . $Language->Phrase("Permission") . "</a>";
        }
        $this->RenderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->ListOptions_Rendered();
    }

    function RenderListOptionsExt()
    {
        global $Security, $Language, $niveles;
    }

    // Set up starting record parameters
    function SetUpStartRec()
    {
        global $niveles;
        if ($this->DisplayRecs == 0)
            return;
        if ($this->IsPageRequest()) { // Validate request
            if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
                $this->StartRec = $_GET[EW_TABLE_START_REC];
                $niveles->setStartRecordNumber($this->StartRec);
            } elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
                $PageNo = $_GET[EW_TABLE_PAGE_NO];
                if (is_numeric($PageNo)) {
                    $this->StartRec = ($PageNo - 1) * $this->DisplayRecs + 1;
                    if ($this->StartRec <= 0) {
                        $this->StartRec = 1;
                    } elseif ($this->StartRec >= intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1) {
                        $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1;
                    }
                    $niveles->setStartRecordNumber($this->StartRec);
                }
            }
        }
        $this->StartRec = $niveles->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
            $this->StartRec = 1; // Reset start record counter
            $niveles->setStartRecordNumber($this->StartRec);
        } elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
            $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
            $niveles->setStartRecordNumber($this->StartRec);
        } elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
            $this->StartRec = intval(($this->StartRec - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
            $niveles->setStartRecordNumber($this->StartRec);
        }
    }

    // Load recordset
    function LoadRecordset($offset = -1, $rowcnt = -1)
    {
        global $conn, $niveles;

        // Call Recordset Selecting event
        $niveles->Recordset_Selecting($niveles->CurrentFilter);

        // Load List page SQL
        $sSql = $niveles->SelectSQL();
        if ($offset > -1 && $rowcnt > -1)
            $sSql .= " LIMIT $rowcnt OFFSET $offset";

        // Load recordset
        $rs = ew_LoadRecordset($sSql);

        // Call Recordset Selected event
        $niveles->Recordset_Selected($rs);
        return $rs;
    }

    // Load row based on key values
    function LoadRow()
    {
        global $conn, $Security, $niveles;
        $sFilter = $niveles->KeyFilter();

        // Call Row Selecting event
        $niveles->Row_Selecting($sFilter);

        // Load SQL based on filter
        $niveles->CurrentFilter = $sFilter;
        $sSql = $niveles->SQL();
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
        global $conn, $niveles;
        if (!$rs || $rs->EOF) return;

        // Call Row Selected event
        $row =& $rs->fields;
        $niveles->Row_Selected($row);
        $niveles->idnivel->setDbValue($rs->fields('idnivel'));
        if (is_null($niveles->idnivel->CurrentValue)) {
            $niveles->idnivel->CurrentValue = 0;
        } else {
            $niveles->idnivel->CurrentValue = intval($niveles->idnivel->CurrentValue);
        }
        $niveles->nombrenivel->setDbValue($rs->fields('nombrenivel'));
    }

    // Load old record
    function LoadOldRecord()
    {
        global $niveles;

        // Load key values from Session
        $bValidKey = TRUE;
        if (strval($niveles->getKey("idnivel")) <> "")
            $niveles->idnivel->CurrentValue = $niveles->getKey("idnivel"); // idnivel
        else
            $bValidKey = FALSE;

        // Load old recordset
        if ($bValidKey) {
            $niveles->CurrentFilter = $niveles->KeyFilter();
            $sSql = $niveles->SQL();
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
        global $conn, $Security, $Language, $niveles;

        // Initialize URLs
        $this->ViewUrl = $niveles->ViewUrl();
        $this->EditUrl = $niveles->EditUrl();
        $this->InlineEditUrl = $niveles->InlineEditUrl();
        $this->CopyUrl = $niveles->CopyUrl();
        $this->InlineCopyUrl = $niveles->InlineCopyUrl();
        $this->DeleteUrl = $niveles->DeleteUrl();

        // Call Row_Rendering event
        $niveles->Row_Rendering();

        // Common render codes for all row types
        // idnivel
        // nombrenivel

        if ($niveles->RowType == EW_ROWTYPE_VIEW) { // View row

            // idnivel
            $niveles->idnivel->ViewValue = $niveles->idnivel->CurrentValue;
            $niveles->idnivel->ViewCustomAttributes = "";

            // nombrenivel
            $niveles->nombrenivel->ViewValue = $niveles->nombrenivel->CurrentValue;
            $niveles->nombrenivel->ViewCustomAttributes = "";

            // idnivel
            $niveles->idnivel->LinkCustomAttributes = "";
            $niveles->idnivel->HrefValue = "";
            $niveles->idnivel->TooltipValue = "";

            // nombrenivel
            $niveles->nombrenivel->LinkCustomAttributes = "";
            $niveles->nombrenivel->HrefValue = "";
            $niveles->nombrenivel->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($niveles->RowType <> EW_ROWTYPE_AGGREGATEINIT)
            $niveles->Row_Rendered();
    }

    // Set up export options
    function SetupExportOptions()
    {
        global $Language, $niveles;

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
        $item->Body = "<a name=\"emf_niveles\" id=\"emf_niveles\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_niveles',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fniveleslist,sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
        $item->Visible = TRUE;

        // Hide options for export/action
        if ($niveles->Export <> "" ||
            $niveles->CurrentAction <> "")
            $this->ExportOptions->HideAllOptions();
    }

    // Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
    function ExportData()
    {
        global $niveles;
        $utf8 = (strtolower(EW_CHARSET) == "utf-8");
        $bSelectLimit = EW_SELECT_LIMIT;

        // Load recordset
        if ($bSelectLimit) {
            $this->TotalRecs = $niveles->SelectRecordCount();
        } else {
            if ($rs = $this->LoadRecordset())
                $this->TotalRecs = $rs->RecordCount();
        }
        $this->StartRec = 1;

        // Export all
        if ($niveles->ExportAll) {
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
        if ($niveles->Export == "xml") {
            $XmlDoc = new cXMLDocument(EW_XML_ENCODING);
        } else {
            $ExportDoc = new cExportDocument($niveles, "h");
        }
        $ParentTable = "";
        if ($bSelectLimit) {
            $StartRec = 1;
            $StopRec = $this->DisplayRecs;
        } else {
            $StartRec = $this->StartRec;
            $StopRec = $this->StopRec;
        }
        if ($niveles->Export == "xml") {
            $niveles->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
        } else {
            $sHeader = $this->PageHeader;
            $this->Page_DataRendering($sHeader);
            $ExportDoc->Text .= $sHeader;
            $niveles->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
            $sFooter = $this->PageFooter;
            $this->Page_DataRendered($sFooter);
            $ExportDoc->Text .= $sFooter;
        }

        // Close recordset
        $rs->Close();

        // Export header and footer
        if ($niveles->Export <> "xml") {
            $ExportDoc->ExportHeaderAndFooter();
        }

        // Clean output buffer
        if (!EW_DEBUG_ENABLED && ob_get_length())
            ob_end_clean();

        // Write BOM if utf-8
        if ($utf8 && !in_array($niveles->Export, array("email", "xml")))
            echo "\xEF\xBB\xBF";

        // Write debug message if enabled
        if (EW_DEBUG_ENABLED)
            echo ew_DebugMsg();

        // Output data
        if ($niveles->Export == "xml") {
            header("Content-Type: text/xml");
            echo $XmlDoc->XML();
        } elseif ($niveles->Export == "email") {
            $this->ExportEmail($ExportDoc->Text);
            $this->Page_Terminate($niveles->ExportReturnUrl());
        } elseif ($niveles->Export == "pdf") {
            $this->ExportPDF($ExportDoc->Text);
        } else {
            echo $ExportDoc->Text;
        }
    }

    // Export email
    function ExportEmail($EmailContent)
    {
        global $Language, $niveles;
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
        if ($niveles->Email_Sending($Email, $EventArgs))
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
        global $niveles;

        // Initialize
        $sQry = "export=html";

        // Build QueryString for search
        // Build QueryString for pager

        $sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . $niveles->getRecordsPerPage() . "&" . EW_TABLE_START_REC . "=" . $niveles->getStartRecordNumber();
        return $sQry;
    }

    // Add search QueryString
    function AddSearchQueryString(&$Qry, &$Fld)
    {
        global $niveles;
        $FldParm = substr($Fld->FldVar, 2);
        $FldSearchValue = $niveles->getAdvancedSearch("x_" . $FldParm);
        if (strval($FldSearchValue) <> "") {
            $Qry .= "&x_" . $FldParm . "=" . FldSearchValue .
                "&z_" . $FldParm . "=" . $niveles->getAdvancedSearch("z_" . $FldParm);
        }
        $FldSearchValue2 = $niveles->getAdvancedSearch("y_" . $FldParm);
        if (strval($FldSearchValue2) <> "") {
            $Qry .= "&v_" . $FldParm . "=" . $niveles->getAdvancedSearch("v_" . $FldParm) .
                "&y_" . $FldParm . "=" . $FldSearchValue2 .
                "&w_" . $FldParm . "=" . $niveles->getAdvancedSearch("w_" . $FldParm);
        }
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
