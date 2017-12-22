<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "auditoriainfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$auditoria_view = new cauditoria_view();
$Page =& $auditoria_view;

// Page init
$auditoria_view->Page_Init();

// Page main
$auditoria_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($auditoria->Export == "") { ?>
    <script type="text/javascript">
        <!--

        // Create page object
        var auditoria_view = new ew_Page("auditoria_view");

        // page properties
        auditoria_view.PageID = "view"; // page ID
        auditoria_view.FormID = "fauditoriaview"; // form ID
        var EW_PAGE_ID = auditoria_view.PageID; // for backward compatibility

        // extend page with Form_CustomValidate function
        auditoria_view.Form_CustomValidate =
            function (fobj) { // DO NOT CHANGE THIS LINE!

                // Your custom validation code here, return false if invalid.
                return true;
            }
        <?php if (EW_CLIENT_VALIDATE) { ?>
        auditoria_view.ValidateRequired = true; // uses JavaScript validation
        <?php } else { ?>
        auditoria_view.ValidateRequired = false; // no JavaScript validation
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
    &nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $auditoria->TableCaption() ?>
    &nbsp;&nbsp;<?php $auditoria_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($auditoria->Export == "") { ?>
<p class="phpmaker">
    <a href="<?php echo $auditoria_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
    <?php } ?>
</p>
<?php $auditoria_view->ShowPageHeader(); ?>
<?php
$auditoria_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid table-view">
    <tr>
        <td class="ewGridContent">
            <div class="ewGridMiddlePanel">
                <table cellspacing="0" class="ewTable">
                    <?php if ($auditoria->id->Visible) { // id ?>
                        <tr id="r_id"<?php echo $auditoria->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $auditoria->id->FldCaption() ?></td>
                            <td<?php echo $auditoria->id->CellAttributes() ?>>
                                <div<?php echo $auditoria->id->ViewAttributes() ?>><?php echo $auditoria->id->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($auditoria->fecha_hora->Visible) { // fecha_hora ?>
                        <tr id="r_fecha_hora"<?php echo $auditoria->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $auditoria->fecha_hora->FldCaption() ?></td>
                            <td<?php echo $auditoria->fecha_hora->CellAttributes() ?>>
                                <div<?php echo $auditoria->fecha_hora->ViewAttributes() ?>><?php echo $auditoria->fecha_hora->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($auditoria->script->Visible) { // script ?>
                        <tr id="r_script"<?php echo $auditoria->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $auditoria->script->FldCaption() ?></td>
                            <td<?php echo $auditoria->script->CellAttributes() ?>>
                                <div<?php echo $auditoria->script->ViewAttributes() ?>><?php echo $auditoria->script->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($auditoria->usuario->Visible) { // usuario ?>
                        <tr id="r_usuario"<?php echo $auditoria->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $auditoria->usuario->FldCaption() ?></td>
                            <td<?php echo $auditoria->usuario->CellAttributes() ?>>
                                <div<?php echo $auditoria->usuario->ViewAttributes() ?>><?php echo $auditoria->usuario->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($auditoria->accion->Visible) { // accion ?>
                        <tr id="r_accion"<?php echo $auditoria->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $auditoria->accion->FldCaption() ?></td>
                            <td<?php echo $auditoria->accion->CellAttributes() ?>>
                                <div<?php echo $auditoria->accion->ViewAttributes() ?>><?php echo $auditoria->accion->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($auditoria->tabla->Visible) { // tabla ?>
                        <tr id="r_tabla"<?php echo $auditoria->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $auditoria->tabla->FldCaption() ?></td>
                            <td<?php echo $auditoria->tabla->CellAttributes() ?>>
                                <div<?php echo $auditoria->tabla->ViewAttributes() ?>><?php echo $auditoria->tabla->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($auditoria->campo->Visible) { // campo ?>
                        <tr id="r_campo"<?php echo $auditoria->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $auditoria->campo->FldCaption() ?></td>
                            <td<?php echo $auditoria->campo->CellAttributes() ?>>
                                <div<?php echo $auditoria->campo->ViewAttributes() ?>><?php echo $auditoria->campo->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($auditoria->valorclave->Visible) { // valorclave ?>
                        <tr id="r_valorclave"<?php echo $auditoria->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $auditoria->valorclave->FldCaption() ?></td>
                            <td<?php echo $auditoria->valorclave->CellAttributes() ?>>
                                <div<?php echo $auditoria->valorclave->ViewAttributes() ?>><?php echo $auditoria->valorclave->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($auditoria->viejovalor->Visible) { // viejovalor ?>
                        <tr id="r_viejovalor"<?php echo $auditoria->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $auditoria->viejovalor->FldCaption() ?></td>
                            <td<?php echo $auditoria->viejovalor->CellAttributes() ?>>
                                <div<?php echo $auditoria->viejovalor->ViewAttributes() ?>><?php echo $auditoria->viejovalor->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($auditoria->nuevovalor->Visible) { // nuevovalor ?>
                        <tr id="r_nuevovalor"<?php echo $auditoria->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $auditoria->nuevovalor->FldCaption() ?></td>
                            <td<?php echo $auditoria->nuevovalor->CellAttributes() ?>>
                                <div<?php echo $auditoria->nuevovalor->ViewAttributes() ?>><?php echo $auditoria->nuevovalor->ViewValue ?></div>
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
    $auditoria_view->ShowPageFooter();
    if (EW_DEBUG_ENABLED)
        echo ew_DebugMsg();
    ?>
    <?php if ($auditoria->Export == "") { ?>
        <script language="JavaScript" type="text/javascript">
            <!--

            // Write your table-specific startup script here
            // document.write("page loaded");
            //-->

        </script>
    <?php } ?>
    <?php include_once "footer.php" ?>
    <?php
    $auditoria_view->Page_Terminate();
    ?>
    <?php

    //
    // Page class
    //
    class cauditoria_view
    {

        // Page ID
        var $PageID = 'view';

        // Table name
        var $TableName = 'auditoria';

        // Page object name
        var $PageObjName = 'auditoria_view';

        // Page name
        function PageName()
        {
            return ew_CurrentPage();
        }

        // Page URL
        function PageUrl()
        {
            $PageUrl = ew_CurrentPage() . "?";
            global $auditoria;
            if ($auditoria->UseTokenInUrl) $PageUrl .= "t=" . $auditoria->TableVar . "&"; // Add page token
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
            global $objForm, $auditoria;
            if ($auditoria->UseTokenInUrl) {
                if ($objForm)
                    return ($auditoria->TableVar == $objForm->GetValue("t"));
                if (@$_GET["t"] <> "")
                    return ($auditoria->TableVar == $_GET["t"]);
            } else {
                return TRUE;
            }
        }

        //
        // Page class constructor
        //
        function cauditoria_view()
        {
            global $conn, $Language;

            // Language object
            if (!isset($Language)) $Language = new cLanguage();

            // Table object (auditoria)
            if (!isset($GLOBALS["auditoria"])) {
                $GLOBALS["auditoria"] = new cauditoria();
                $GLOBALS["Table"] =& $GLOBALS["auditoria"];
            }
            $KeyUrl = "";
            if (@$_GET["id"] <> "") {
                $this->RecKey["id"] = $_GET["id"];
                $KeyUrl .= "&id=" . urlencode($this->RecKey["id"]);
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
                define("EW_TABLE_NAME", 'auditoria', TRUE);

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
            global $auditoria;

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
            if (!$Security->CanView()) {
                $Security->SaveLastUrl();
                $this->Page_Terminate("auditorialist.php");
            }
            $Security->UserID_Loading();
            if ($Security->IsLoggedIn()) $Security->LoadUserID();
            $Security->UserID_Loaded();

            // Get export parameters
            if (@$_GET["export"] <> "") {
                $auditoria->Export = $_GET["export"];
            } elseif (ew_IsHttpPost()) {
                if (@$_POST["exporttype"] <> "")
                    $auditoria->Export = $_POST["exporttype"];
            } else {
                $auditoria->setExportReturnUrl(ew_CurrentUrl());
            }
            $gsExport = $auditoria->Export; // Get export parameter, used in header
            $gsExportFile = $auditoria->TableVar; // Get export file, used in header
            $Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
            if (@$_GET["id"] <> "") {
                if ($gsExportFile <> "") $gsExportFile .= "_";
                $gsExportFile .= ew_StripSlashes($_GET["id"]);
            }
            if ($auditoria->Export == "excel") {
                header('Content-Type: application/vnd.ms-excel' . $Charset);
                header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xls');
            }
            if ($auditoria->Export == "word") {
                header('Content-Type: application/vnd.ms-word' . $Charset);
                header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
            }
            if ($auditoria->Export == "xml") {
                header('Content-Type: text/xml' . $Charset);
                header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xml');
            }
            if ($auditoria->Export == "csv") {
                header('Content-Type: application/csv' . $Charset);
                header('Content-Disposition: attachment; filename=' . $gsExportFile . '.csv');
            }

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
            global $Language, $auditoria;

            // Load current record
            $bLoadCurrentRecord = FALSE;
            $sReturnUrl = "";
            $bMatchRecord = FALSE;
            if ($this->IsPageRequest()) { // Validate request
                if (@$_GET["id"] <> "") {
                    $auditoria->id->setQueryStringValue($_GET["id"]);
                    $this->RecKey["id"] = $auditoria->id->QueryStringValue;
                } else {
                    $sReturnUrl = "auditorialist.php"; // Return to list
                }

                // Get action
                $auditoria->CurrentAction = "I"; // Display form
                switch ($auditoria->CurrentAction) {
                    case "I": // Get a record to display
                        if (!$this->LoadRow()) { // Load record based on key
                            if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
                                $this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
                            $sReturnUrl = "auditorialist.php"; // No matching record, return to list
                        }
                }

                // Export data only
                if (in_array($auditoria->Export, array("html", "word", "excel", "xml", "csv", "email", "pdf"))) {
                    if ($auditoria->Export == "email" && $auditoria->ExportReturnUrl() == ew_CurrentPage()) // Default return page
                        $auditoria->setExportReturnUrl($auditoria->ViewUrl()); // Add key
                    $this->ExportData();
                    if ($auditoria->Export <> "email")
                        $this->Page_Terminate(); // Terminate response
                    exit();
                }
            } else {
                $sReturnUrl = "auditorialist.php"; // Not page request, return to list
            }
            if ($sReturnUrl <> "")
                $this->Page_Terminate($sReturnUrl);

            // Render row
            $auditoria->RowType = EW_ROWTYPE_VIEW;
            $auditoria->ResetAttrs();
            $this->RenderRow();
        }

        // Set up starting record parameters
        function SetUpStartRec()
        {
            global $auditoria;
            if ($this->DisplayRecs == 0)
                return;
            if ($this->IsPageRequest()) { // Validate request
                if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
                    $this->StartRec = $_GET[EW_TABLE_START_REC];
                    $auditoria->setStartRecordNumber($this->StartRec);
                } elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
                    $PageNo = $_GET[EW_TABLE_PAGE_NO];
                    if (is_numeric($PageNo)) {
                        $this->StartRec = ($PageNo - 1) * $this->DisplayRecs + 1;
                        if ($this->StartRec <= 0) {
                            $this->StartRec = 1;
                        } elseif ($this->StartRec >= intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1) {
                            $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1;
                        }
                        $auditoria->setStartRecordNumber($this->StartRec);
                    }
                }
            }
            $this->StartRec = $auditoria->getStartRecordNumber();

            // Check if correct start record counter
            if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
                $this->StartRec = 1; // Reset start record counter
                $auditoria->setStartRecordNumber($this->StartRec);
            } elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
                $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
                $auditoria->setStartRecordNumber($this->StartRec);
            } elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
                $this->StartRec = intval(($this->StartRec - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
                $auditoria->setStartRecordNumber($this->StartRec);
            }
        }

        // Load recordset
        function LoadRecordset($offset = -1, $rowcnt = -1)
        {
            global $conn, $auditoria;

            // Call Recordset Selecting event
            $auditoria->Recordset_Selecting($auditoria->CurrentFilter);

            // Load List page SQL
            $sSql = $auditoria->SelectSQL();
            if ($offset > -1 && $rowcnt > -1)
                $sSql .= " LIMIT $rowcnt OFFSET $offset";

            // Load recordset
            $rs = ew_LoadRecordset($sSql);

            // Call Recordset Selected event
            $auditoria->Recordset_Selected($rs);
            return $rs;
        }

        // Load row based on key values
        function LoadRow()
        {
            global $conn, $Security, $auditoria;
            $sFilter = $auditoria->KeyFilter();

            // Call Row Selecting event
            $auditoria->Row_Selecting($sFilter);

            // Load SQL based on filter
            $auditoria->CurrentFilter = $sFilter;
            $sSql = $auditoria->SQL();
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
            global $conn, $auditoria;
            if (!$rs || $rs->EOF) return;

            // Call Row Selected event
            $row =& $rs->fields;
            $auditoria->Row_Selected($row);
            $auditoria->id->setDbValue($rs->fields('id'));
            $auditoria->fecha_hora->setDbValue($rs->fields('fecha_hora'));
            $auditoria->script->setDbValue($rs->fields('script'));
            $auditoria->usuario->setDbValue($rs->fields('usuario'));
            $auditoria->accion->setDbValue($rs->fields('accion'));
            $auditoria->tabla->setDbValue($rs->fields('tabla'));
            $auditoria->campo->setDbValue($rs->fields('campo'));
            $auditoria->valorclave->setDbValue($rs->fields('valorclave'));
            $auditoria->viejovalor->setDbValue($rs->fields('viejovalor'));
            $auditoria->nuevovalor->setDbValue($rs->fields('nuevovalor'));
        }

        // Render row values based on field settings
        function RenderRow()
        {
            global $conn, $Security, $Language, $auditoria;

            // Initialize URLs
            $this->AddUrl = $auditoria->AddUrl();
            $this->EditUrl = $auditoria->EditUrl();
            $this->CopyUrl = $auditoria->CopyUrl();
            $this->DeleteUrl = $auditoria->DeleteUrl();
            $this->ListUrl = $auditoria->ListUrl();

            // Call Row_Rendering event
            $auditoria->Row_Rendering();

            // Common render codes for all row types
            // id
            // fecha_hora
            // script
            // usuario
            // accion
            // tabla
            // campo
            // valorclave
            // viejovalor
            // nuevovalor

            if ($auditoria->RowType == EW_ROWTYPE_VIEW) { // View row

                // id
                $auditoria->id->ViewValue = $auditoria->id->CurrentValue;
                $auditoria->id->ViewCustomAttributes = "";

                // fecha_hora
                $auditoria->fecha_hora->ViewValue = $auditoria->fecha_hora->CurrentValue;
                $auditoria->fecha_hora->ViewValue = ew_FormatDateTime($auditoria->fecha_hora->ViewValue, 11);
                $auditoria->fecha_hora->ViewCustomAttributes = "";

                // script
                $auditoria->script->ViewValue = $auditoria->script->CurrentValue;
                $auditoria->script->ViewCustomAttributes = "";

                // usuario
                $auditoria->usuario->ViewValue = $auditoria->usuario->CurrentValue;
                $auditoria->usuario->ViewCustomAttributes = "";

                // accion
                $auditoria->accion->ViewValue = $auditoria->accion->CurrentValue;
                $auditoria->accion->ViewCustomAttributes = "";

                // tabla
                $auditoria->tabla->ViewValue = $auditoria->tabla->CurrentValue;
                $auditoria->tabla->ViewCustomAttributes = "";

                // campo
                $auditoria->campo->ViewValue = $auditoria->campo->CurrentValue;
                $auditoria->campo->ViewCustomAttributes = "";

                // valorclave
                $auditoria->valorclave->ViewValue = $auditoria->valorclave->CurrentValue;
                $auditoria->valorclave->ViewCustomAttributes = "";

                // viejovalor
                $auditoria->viejovalor->ViewValue = $auditoria->viejovalor->CurrentValue;
                $auditoria->viejovalor->ViewCustomAttributes = "";

                // nuevovalor
                $auditoria->nuevovalor->ViewValue = $auditoria->nuevovalor->CurrentValue;
                $auditoria->nuevovalor->ViewCustomAttributes = "";

                // id
                $auditoria->id->LinkCustomAttributes = "";
                $auditoria->id->HrefValue = "";
                $auditoria->id->TooltipValue = "";

                // fecha_hora
                $auditoria->fecha_hora->LinkCustomAttributes = "";
                $auditoria->fecha_hora->HrefValue = "";
                $auditoria->fecha_hora->TooltipValue = "";

                // script
                $auditoria->script->LinkCustomAttributes = "";
                $auditoria->script->HrefValue = "";
                $auditoria->script->TooltipValue = "";

                // usuario
                $auditoria->usuario->LinkCustomAttributes = "";
                $auditoria->usuario->HrefValue = "";
                $auditoria->usuario->TooltipValue = "";

                // accion
                $auditoria->accion->LinkCustomAttributes = "";
                $auditoria->accion->HrefValue = "";
                $auditoria->accion->TooltipValue = "";

                // tabla
                $auditoria->tabla->LinkCustomAttributes = "";
                $auditoria->tabla->HrefValue = "";
                $auditoria->tabla->TooltipValue = "";

                // campo
                $auditoria->campo->LinkCustomAttributes = "";
                $auditoria->campo->HrefValue = "";
                $auditoria->campo->TooltipValue = "";

                // valorclave
                $auditoria->valorclave->LinkCustomAttributes = "";
                $auditoria->valorclave->HrefValue = "";
                $auditoria->valorclave->TooltipValue = "";

                // viejovalor
                $auditoria->viejovalor->LinkCustomAttributes = "";
                $auditoria->viejovalor->HrefValue = "";
                $auditoria->viejovalor->TooltipValue = "";

                // nuevovalor
                $auditoria->nuevovalor->LinkCustomAttributes = "";
                $auditoria->nuevovalor->HrefValue = "";
                $auditoria->nuevovalor->TooltipValue = "";
            }

            // Call Row Rendered event
            if ($auditoria->RowType <> EW_ROWTYPE_AGGREGATEINIT)
                $auditoria->Row_Rendered();
        }

        // Set up export options
        function SetupExportOptions()
        {
            global $Language, $auditoria;

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
            $item->Visible = TRUE;

            // Export to Email
            $item =& $this->ExportOptions->Add("email");
            $item->Body = "<a name=\"emf_auditoria\" id=\"emf_auditoria\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_auditoria',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
            $item->Visible = TRUE;

            // Hide options for export/action
            if ($auditoria->Export <> "")
                $this->ExportOptions->HideAllOptions();
        }

        // Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
        function ExportData()
        {
            global $auditoria;
            $utf8 = (strtolower(EW_CHARSET) == "utf-8");
            $bSelectLimit = FALSE;

            // Load recordset
            if ($bSelectLimit) {
                $this->TotalRecs = $auditoria->SelectRecordCount();
            } else {
                if ($rs = $this->LoadRecordset())
                    $this->TotalRecs = $rs->RecordCount();
            }
            $this->StartRec = 1;
            $this->SetUpStartRec(); // Set up start record position

            // Set the last record to display
            if ($this->DisplayRecs < 0) {
                $this->StopRec = $this->TotalRecs;
            } else {
                $this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
            }
            if (!$rs) {
                header("Content-Type:"); // Remove header
                header("Content-Disposition:");
                $this->ShowMessage();
                return;
            }
            if ($auditoria->Export == "xml") {
                $XmlDoc = new cXMLDocument(EW_XML_ENCODING);
            } else {
                $ExportDoc = new cExportDocument($auditoria, "v");
            }
            $ParentTable = "";
            if ($bSelectLimit) {
                $StartRec = 1;
                $StopRec = $this->DisplayRecs;
            } else {
                $StartRec = $this->StartRec;
                $StopRec = $this->StopRec;
            }
            if ($auditoria->Export == "xml") {
                $auditoria->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
            } else {
                $sHeader = $this->PageHeader;
                $this->Page_DataRendering($sHeader);
                $ExportDoc->Text .= $sHeader;
                $auditoria->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
                $sFooter = $this->PageFooter;
                $this->Page_DataRendered($sFooter);
                $ExportDoc->Text .= $sFooter;
            }

            // Close recordset
            $rs->Close();

            // Export header and footer
            if ($auditoria->Export <> "xml") {
                $ExportDoc->ExportHeaderAndFooter();
            }

            // Clean output buffer
            if (!EW_DEBUG_ENABLED && ob_get_length())
                ob_end_clean();

            // Write BOM if utf-8
            if ($utf8 && !in_array($auditoria->Export, array("email", "xml")))
                echo "\xEF\xBB\xBF";

            // Write debug message if enabled
            if (EW_DEBUG_ENABLED)
                echo ew_DebugMsg();

            // Output data
            if ($auditoria->Export == "xml") {
                header("Content-Type: text/xml");
                echo $XmlDoc->XML();
            } elseif ($auditoria->Export == "email") {
                $this->ExportEmail($ExportDoc->Text);
                $this->Page_Terminate($auditoria->ExportReturnUrl());
            } elseif ($auditoria->Export == "pdf") {
                $this->ExportPDF($ExportDoc->Text);
            } else {
                echo $ExportDoc->Text;
            }
        }

        // Export email
        function ExportEmail($EmailContent)
        {
            global $Language, $auditoria;
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
            if ($auditoria->Email_Sending($Email, $EventArgs))
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
            global $auditoria;

            // Initialize
            $sQry = "export=html";

            // Add record key QueryString
            $sQry .= "&" . substr($auditoria->KeyUrl("", ""), 1);
            return $sQry;
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
