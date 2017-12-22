<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "historial_pagosinfo.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$historial_pagos_view = new chistorial_pagos_view();
$Page =& $historial_pagos_view;

// Page init
$historial_pagos_view->Page_Init();

// Page main
$historial_pagos_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($historial_pagos->Export == "") { ?>
    <script type="text/javascript">
        <!--

        // Create page object
        var historial_pagos_view = new ew_Page("historial_pagos_view");

        // page properties
        historial_pagos_view.PageID = "view"; // page ID
        historial_pagos_view.FormID = "fhistorial_pagosview"; // form ID
        var EW_PAGE_ID = historial_pagos_view.PageID; // for backward compatibility

        // extend page with Form_CustomValidate function
        historial_pagos_view.Form_CustomValidate =
            function (fobj) { // DO NOT CHANGE THIS LINE!

                // Your custom validation code here, return false if invalid.
                return true;
            }
        <?php if (EW_CLIENT_VALIDATE) { ?>
        historial_pagos_view.ValidateRequired = true; // uses JavaScript validation
        <?php } else { ?>
        historial_pagos_view.ValidateRequired = false; // no JavaScript validation
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
    &nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $historial_pagos->TableCaption() ?>
    &nbsp;&nbsp;<?php $historial_pagos_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($historial_pagos->Export == "") { ?>
<p class="phpmaker">
    <a href="<?php echo $historial_pagos_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
    <?php if ($Security->CanAdd()) { ?>
        <?php if ($historial_pagos_view->ShowOptionLink()) { ?>
            <a href="<?php echo $historial_pagos_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
        <?php } ?>
    <?php } ?>
    <?php if ($Security->CanEdit()) { ?>
        <?php if ($historial_pagos_view->ShowOptionLink()) { ?>
            <a href="<?php echo $historial_pagos_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
        <?php } ?>
    <?php } ?>
    <?php if ($Security->CanDelete()) { ?>
        <?php if ($historial_pagos_view->ShowOptionLink()) { ?>
            <a href="<?php echo $historial_pagos_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
        <?php } ?>
    <?php } ?>
    <?php if ($Security->AllowList('pagos_x_docto')) { ?>
        <?php if ($historial_pagos_view->ShowOptionLink()) { ?>
            <a href="pagos_x_doctolist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=historial_pagos&idhistorial_pagos=<?php echo urlencode(strval($historial_pagos->idhistorial_pagos->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("pagos_x_docto", "TblCaption") ?>
            </a>
            &nbsp;
        <?php } ?>
    <?php } ?>
    <?php } ?>
</p>
<?php $historial_pagos_view->ShowPageHeader(); ?>
<?php
$historial_pagos_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid table-view">
    <tr>
        <td class="ewGridContent">
            <div class="ewGridMiddlePanel">
                <table cellspacing="0" class="ewTable">
                    <?php if ($historial_pagos->idhistorial_pagos->Visible) { // idhistorial_pagos ?>
                        <tr id="r_idhistorial_pagos"<?php echo $historial_pagos->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $historial_pagos->idhistorial_pagos->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->idhistorial_pagos->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->idhistorial_pagos->ViewAttributes() ?>><?php echo $historial_pagos->idhistorial_pagos->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->usuario->Visible) { // usuario ?>
                        <tr id="r_usuario"<?php echo $historial_pagos->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $historial_pagos->usuario->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->usuario->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->usuario->ViewAttributes() ?>><?php echo $historial_pagos->usuario->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->estado_pago->Visible) { // estado_pago ?>
                        <tr id="r_estado_pago"<?php echo $historial_pagos->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $historial_pagos->estado_pago->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->estado_pago->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->estado_pago->ViewAttributes() ?>><?php echo $historial_pagos->estado_pago->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->ref_venta->Visible) { // ref_venta ?>
                        <tr id="r_ref_venta"<?php echo $historial_pagos->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $historial_pagos->ref_venta->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->ref_venta->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->ref_venta->ViewAttributes() ?>><?php echo $historial_pagos->ref_venta->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->fecha_hora_creacion->Visible) { // fecha_hora_creacion ?>
                        <tr id="r_fecha_hora_creacion"<?php echo $historial_pagos->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $historial_pagos->fecha_hora_creacion->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->fecha_hora_creacion->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->fecha_hora_creacion->ViewAttributes() ?>><?php echo $historial_pagos->fecha_hora_creacion->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->riesgo->Visible) { // riesgo ?>
                        <tr id="r_riesgo"<?php echo $historial_pagos->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $historial_pagos->riesgo->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->riesgo->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->riesgo->ViewAttributes() ?>><?php echo $historial_pagos->riesgo->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->respuesta_pol->Visible) { // respuesta_pol ?>
                        <tr id="r_respuesta_pol"<?php echo $historial_pagos->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $historial_pagos->respuesta_pol->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->respuesta_pol->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->respuesta_pol->ViewAttributes() ?>><?php echo $historial_pagos->respuesta_pol->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($historial_pagos->monto_pago->Visible) { // monto_pago ?>
                        <tr id="r_monto_pago"<?php echo $historial_pagos->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $historial_pagos->monto_pago->FldCaption() ?></td>
                            <td<?php echo $historial_pagos->monto_pago->CellAttributes() ?>>
                                <div<?php echo $historial_pagos->monto_pago->ViewAttributes() ?>><?php echo $historial_pagos->monto_pago->ViewValue ?></div>
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
    $historial_pagos_view->ShowPageFooter();
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
    $historial_pagos_view->Page_Terminate();
    ?>
    <?php

    //
    // Page class
    //
    class chistorial_pagos_view
    {

        // Page ID
        var $PageID = 'view';

        // Table name
        var $TableName = 'historial_pagos';

        // Page object name
        var $PageObjName = 'historial_pagos_view';

        // Page name
        function PageName()
        {
            return ew_CurrentPage();
        }

        // Page URL
        function PageUrl()
        {
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
        function chistorial_pagos_view()
        {
            global $conn, $Language;

            // Language object
            if (!isset($Language)) $Language = new cLanguage();

            // Table object (historial_pagos)
            if (!isset($GLOBALS["historial_pagos"])) {
                $GLOBALS["historial_pagos"] = new chistorial_pagos();
                $GLOBALS["Table"] =& $GLOBALS["historial_pagos"];
            }
            $KeyUrl = "";
            if (@$_GET["idhistorial_pagos"] <> "") {
                $this->RecKey["idhistorial_pagos"] = $_GET["idhistorial_pagos"];
                $KeyUrl .= "&idhistorial_pagos=" . urlencode($this->RecKey["idhistorial_pagos"]);
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
                define("EW_TABLE_NAME", 'historial_pagos', TRUE);

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
            if (!$Security->CanView()) {
                $Security->SaveLastUrl();
                $this->Page_Terminate("historial_pagoslist.php");
            }
            $Security->UserID_Loading();
            if ($Security->IsLoggedIn()) $Security->LoadUserID();
            $Security->UserID_Loaded();
            if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
                $_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
                $this->Page_Terminate("historial_pagoslist.php");
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
            if (@$_GET["idhistorial_pagos"] <> "") {
                if ($gsExportFile <> "") $gsExportFile .= "_";
                $gsExportFile .= ew_StripSlashes($_GET["idhistorial_pagos"]);
            }
            if ($historial_pagos->Export == "excel") {
                header('Content-Type: application/vnd.ms-excel' . $Charset);
                header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xls');
            }
            if ($historial_pagos->Export == "word") {
                header('Content-Type: application/vnd.ms-word' . $Charset);
                header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
            }
            if ($historial_pagos->Export == "xml") {
                header('Content-Type: text/xml' . $Charset);
                header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xml');
            }
            if ($historial_pagos->Export == "csv") {
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
            global $Language, $historial_pagos;

            // Load current record
            $bLoadCurrentRecord = FALSE;
            $sReturnUrl = "";
            $bMatchRecord = FALSE;
            if ($this->IsPageRequest()) { // Validate request
                if (@$_GET["idhistorial_pagos"] <> "") {
                    $historial_pagos->idhistorial_pagos->setQueryStringValue($_GET["idhistorial_pagos"]);
                    $this->RecKey["idhistorial_pagos"] = $historial_pagos->idhistorial_pagos->QueryStringValue;
                } else {
                    $sReturnUrl = "historial_pagoslist.php"; // Return to list
                }

                // Get action
                $historial_pagos->CurrentAction = "I"; // Display form
                switch ($historial_pagos->CurrentAction) {
                    case "I": // Get a record to display
                        if (!$this->LoadRow()) { // Load record based on key
                            if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
                                $this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
                            $sReturnUrl = "historial_pagoslist.php"; // No matching record, return to list
                        }
                }

                // Export data only
                if (in_array($historial_pagos->Export, array("html", "word", "excel", "xml", "csv", "email", "pdf"))) {
                    if ($historial_pagos->Export == "email" && $historial_pagos->ExportReturnUrl() == ew_CurrentPage()) // Default return page
                        $historial_pagos->setExportReturnUrl($historial_pagos->ViewUrl()); // Add key
                    $this->ExportData();
                    if ($historial_pagos->Export <> "email")
                        $this->Page_Terminate(); // Terminate response
                    exit();
                }
            } else {
                $sReturnUrl = "historial_pagoslist.php"; // Not page request, return to list
            }
            if ($sReturnUrl <> "")
                $this->Page_Terminate($sReturnUrl);

            // Render row
            $historial_pagos->RowType = EW_ROWTYPE_VIEW;
            $historial_pagos->ResetAttrs();
            $this->RenderRow();
        }

        // Set up starting record parameters
        function SetUpStartRec()
        {
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
                        $this->StartRec = ($PageNo - 1) * $this->DisplayRecs + 1;
                        if ($this->StartRec <= 0) {
                            $this->StartRec = 1;
                        } elseif ($this->StartRec >= intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1) {
                            $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1;
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
                $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
                $historial_pagos->setStartRecordNumber($this->StartRec);
            } elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
                $this->StartRec = intval(($this->StartRec - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
                $historial_pagos->setStartRecordNumber($this->StartRec);
            }
        }

        // Load recordset
        function LoadRecordset($offset = -1, $rowcnt = -1)
        {
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
        function LoadRow()
        {
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
        function LoadRowValues(&$rs)
        {
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

        // Render row values based on field settings
        function RenderRow()
        {
            global $conn, $Security, $Language, $historial_pagos;

            // Initialize URLs
            $this->AddUrl = $historial_pagos->AddUrl();
            $this->EditUrl = $historial_pagos->EditUrl();
            $this->CopyUrl = $historial_pagos->CopyUrl();
            $this->DeleteUrl = $historial_pagos->DeleteUrl();
            $this->ListUrl = $historial_pagos->ListUrl();

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

                // respuesta_pol
                $historial_pagos->respuesta_pol->LinkCustomAttributes = "";
                $historial_pagos->respuesta_pol->HrefValue = "";
                $historial_pagos->respuesta_pol->TooltipValue = "";

                // monto_pago
                $historial_pagos->monto_pago->LinkCustomAttributes = "";
                $historial_pagos->monto_pago->HrefValue = "";
                $historial_pagos->monto_pago->TooltipValue = "";
            }

            // Call Row Rendered event
            if ($historial_pagos->RowType <> EW_ROWTYPE_AGGREGATEINIT)
                $historial_pagos->Row_Rendered();
        }

        // Set up export options
        function SetupExportOptions()
        {
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
            $item->Visible = TRUE;

            // Export to Email
            $item =& $this->ExportOptions->Add("email");
            $item->Body = "<a name=\"emf_historial_pagos\" id=\"emf_historial_pagos\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_historial_pagos',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
            $item->Visible = TRUE;

            // Hide options for export/action
            if ($historial_pagos->Export <> "")
                $this->ExportOptions->HideAllOptions();
        }

        // Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
        function ExportData()
        {
            global $historial_pagos;
            $utf8 = (strtolower(EW_CHARSET) == "utf-8");
            $bSelectLimit = FALSE;

            // Load recordset
            if ($bSelectLimit) {
                $this->TotalRecs = $historial_pagos->SelectRecordCount();
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
            if ($historial_pagos->Export == "xml") {
                $XmlDoc = new cXMLDocument(EW_XML_ENCODING);
            } else {
                $ExportDoc = new cExportDocument($historial_pagos, "v");
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
                $historial_pagos->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
            } else {
                $sHeader = $this->PageHeader;
                $this->Page_DataRendering($sHeader);
                $ExportDoc->Text .= $sHeader;
                $historial_pagos->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
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
        function ExportEmail($EmailContent)
        {
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
        function ExportQueryString()
        {
            global $historial_pagos;

            // Initialize
            $sQry = "export=html";

            // Add record key QueryString
            $sQry .= "&" . substr($historial_pagos->KeyUrl("", ""), 1);
            return $sQry;
        }

        // Show link optionally based on User ID
        function ShowOptionLink()
        {
            global $Security, $historial_pagos;
            if ($Security->IsLoggedIn()) {
                if (!$Security->IsAdmin()) {
                    return $Security->IsValidUserID($historial_pagos->usuario->CurrentValue);
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
    }

    ?>
