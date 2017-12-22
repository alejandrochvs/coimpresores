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
$niveles_view = new cniveles_view();
$Page =& $niveles_view;

// Page init
$niveles_view->Page_Init();

// Page main
$niveles_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($niveles->Export == "") { ?>
    <script type="text/javascript">
        <!--

        // Create page object
        var niveles_view = new ew_Page("niveles_view");

        // page properties
        niveles_view.PageID = "view"; // page ID
        niveles_view.FormID = "fnivelesview"; // form ID
        var EW_PAGE_ID = niveles_view.PageID; // for backward compatibility

        // extend page with Form_CustomValidate function
        niveles_view.Form_CustomValidate =
            function (fobj) { // DO NOT CHANGE THIS LINE!

                // Your custom validation code here, return false if invalid.
                return true;
            }
        <?php if (EW_CLIENT_VALIDATE) { ?>
        niveles_view.ValidateRequired = true; // uses JavaScript validation
        <?php } else { ?>
        niveles_view.ValidateRequired = false; // no JavaScript validation
        <?php } ?>

        //-->
    </script>
    <script language="JavaScript" type="text/javascript">
        <!--

        // Write your client script here, no need to add script tags.
        //-->

    </script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>
    &nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $niveles->TableCaption() ?>
    &nbsp;&nbsp;<?php $niveles_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($niveles->Export == "") { ?>
<p class="phpmaker">
    <a href="<?php echo $niveles_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
    <?php if ($Security->CanAdd()) { ?>
        <a href="<?php echo $niveles_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
    <?php } ?>
    <?php if ($Security->CanEdit()) { ?>
        <a href="<?php echo $niveles_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
    <?php } ?>
    <?php if ($Security->CanAdd()) { ?>
        <a href="<?php echo $niveles_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
    <?php } ?>
    <?php if ($Security->CanDelete()) { ?>
        <a href="<?php echo $niveles_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
    <?php } ?>
    <?php } ?>
</p>
<?php $niveles_view->ShowPageHeader(); ?>
<?php
$niveles_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid table-view">
    <tr>
        <td class="ewGridContent">
            <div class="ewGridMiddlePanel">
                <table cellspacing="0" class="ewTable">
                    <?php if ($niveles->idnivel->Visible) { // idnivel ?>
                        <tr id="r_idnivel"<?php echo $niveles->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $niveles->idnivel->FldCaption() ?></td>
                            <td<?php echo $niveles->idnivel->CellAttributes() ?>>
                                <div<?php echo $niveles->idnivel->ViewAttributes() ?>><?php echo $niveles->idnivel->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($niveles->nombrenivel->Visible) { // nombrenivel ?>
                        <tr id="r_nombrenivel"<?php echo $niveles->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $niveles->nombrenivel->FldCaption() ?></td>
                            <td<?php echo $niveles->nombrenivel->CellAttributes() ?>>
                                <div<?php echo $niveles->nombrenivel->ViewAttributes() ?>><?php echo $niveles->nombrenivel->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </td>
    </tr>
</table>
<p>
    <?php
    $niveles_view->ShowPageFooter();
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
    $niveles_view->Page_Terminate();
    ?>
    <?php

    //
    // Page class
    //
    class cniveles_view
    {

        // Page ID
        var $PageID = 'view';

        // Table name
        var $TableName = 'niveles';

        // Page object name
        var $PageObjName = 'niveles_view';

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
        function cniveles_view()
        {
            global $conn, $Language;

            // Language object
            if (!isset($Language)) $Language = new cLanguage();

            // Table object (niveles)
            if (!isset($GLOBALS["niveles"])) {
                $GLOBALS["niveles"] = new cniveles();
                $GLOBALS["Table"] =& $GLOBALS["niveles"];
            }
            $KeyUrl = "";
            if (@$_GET["idnivel"] <> "") {
                $this->RecKey["idnivel"] = $_GET["idnivel"];
                $KeyUrl .= "&idnivel=" . urlencode($this->RecKey["idnivel"]);
            }
            $this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
            $this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
            $this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
            $this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
            $this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
            $this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
            $this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

            // Table object (usuarios)
            if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

            // Page ID
            if (!defined("EW_PAGE_ID"))
                define("EW_PAGE_ID", 'view', TRUE);

            // Table name (for backward compatibility)
            if (!defined("EW_TABLE_NAME"))
                define("EW_TABLE_NAME", 'niveles', TRUE);

            // Start timer
            if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

            // Open connection
            if (!isset($conn)) $conn = ew_Connect();

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

        var $ExportOptions; // Export options
        var $DisplayRecs = 1;
        var $StartRec;
        var $StopRec;
        var $TotalRecs = 0;
        var $RecRange = 10;
        var $RecCnt;
        var $RecKey = array();
        var $Recordset;

        //
        // Page main
        //
        function Page_Main()
        {
            global $Language, $niveles;
            $sReturnUrl = "";
            $bMatchRecord = FALSE;
            if ($this->IsPageRequest()) { // Validate request
                if (@$_GET["idnivel"] <> "") {
                    $niveles->idnivel->setQueryStringValue($_GET["idnivel"]);
                    $this->RecKey["idnivel"] = $niveles->idnivel->QueryStringValue;
                } else {
                    $sReturnUrl = "niveleslist.php"; // Return to list
                }

                // Get action
                $niveles->CurrentAction = "I"; // Display form
                switch ($niveles->CurrentAction) {
                    case "I": // Get a record to display
                        if (!$this->LoadRow()) { // Load record based on key
                            if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
                                $this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
                            $sReturnUrl = "niveleslist.php"; // No matching record, return to list
                        }
                }
            } else {
                $sReturnUrl = "niveleslist.php"; // Not page request, return to list
            }
            if ($sReturnUrl <> "")
                $this->Page_Terminate($sReturnUrl);

            // Render row
            $niveles->RowType = EW_ROWTYPE_VIEW;
            $niveles->ResetAttrs();
            $this->RenderRow();
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

        // Render row values based on field settings
        function RenderRow()
        {
            global $conn, $Security, $Language, $niveles;

            // Initialize URLs
            $this->AddUrl = $niveles->AddUrl();
            $this->EditUrl = $niveles->EditUrl();
            $this->CopyUrl = $niveles->CopyUrl();
            $this->DeleteUrl = $niveles->DeleteUrl();
            $this->ListUrl = $niveles->ListUrl();

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
    }

    ?>
