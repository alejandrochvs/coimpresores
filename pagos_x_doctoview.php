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
$pagos_x_docto_view = new cpagos_x_docto_view();
$Page =& $pagos_x_docto_view;

// Page init
$pagos_x_docto_view->Page_Init();

// Page main
$pagos_x_docto_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($pagos_x_docto->Export == "") { ?>
    <script type="text/javascript">
        <!--

        // Create page object
        var pagos_x_docto_view = new ew_Page("pagos_x_docto_view");

        // page properties
        pagos_x_docto_view.PageID = "view"; // page ID
        pagos_x_docto_view.FormID = "fpagos_x_doctoview"; // form ID
        var EW_PAGE_ID = pagos_x_docto_view.PageID; // for backward compatibility

        // extend page with Form_CustomValidate function
        pagos_x_docto_view.Form_CustomValidate =
            function (fobj) { // DO NOT CHANGE THIS LINE!

                // Your custom validation code here, return false if invalid.
                return true;
            }
        <?php if (EW_CLIENT_VALIDATE) { ?>
        pagos_x_docto_view.ValidateRequired = true; // uses JavaScript validation
        <?php } else { ?>
        pagos_x_docto_view.ValidateRequired = false; // no JavaScript validation
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
    &nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pagos_x_docto->TableCaption() ?>
    &nbsp;&nbsp;<?php $pagos_x_docto_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($pagos_x_docto->Export == "") { ?>
<p class="phpmaker">
    <a href="<?php echo $pagos_x_docto_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
    <?php if ($Security->CanEdit()) { ?>
        <?php if ($pagos_x_docto_view->ShowOptionLink()) { ?>
            <a href="<?php echo $pagos_x_docto_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
        <?php } ?>
    <?php } ?>
    <?php if ($Security->CanDelete()) { ?>
        <?php if ($pagos_x_docto_view->ShowOptionLink()) { ?>
            <a href="<?php echo $pagos_x_docto_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
        <?php } ?>
    <?php } ?>
    <?php } ?>
</p>
<?php $pagos_x_docto_view->ShowPageHeader(); ?>
<?php
$pagos_x_docto_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid table-view">
    <tr>
        <td class="ewGridContent">
            <div class="ewGridMiddlePanel">
                <table cellspacing="0" class="ewTable">
                    <?php if ($pagos_x_docto->iddoctocontable->Visible) { // iddoctocontable ?>
                        <tr id="r_iddoctocontable"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->iddoctocontable->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->iddoctocontable->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->iddoctocontable->ViewAttributes() ?>><?php echo $pagos_x_docto->iddoctocontable->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->historial->Visible) { // historial ?>
                        <tr id="r_historial"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->historial->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->historial->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->historial->ViewAttributes() ?>><?php echo $pagos_x_docto->historial->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->tipo_docto->Visible) { // tipo_docto ?>
                        <tr id="r_tipo_docto"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->tipo_docto->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->tipo_docto->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->tipo_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->tipo_docto->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->consec_docto->Visible) { // consec_docto ?>
                        <tr id="r_consec_docto"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->consec_docto->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->consec_docto->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->consec_docto->ViewAttributes() ?>><?php echo $pagos_x_docto->consec_docto->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->valor->Visible) { // valor ?>
                        <tr id="r_valor"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->valor->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->valor->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->valor->ViewAttributes() ?>><?php echo $pagos_x_docto->valor->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->cia->Visible) { // cia ?>
                        <tr id="r_cia"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->cia->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->cia->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->cia->ViewAttributes() ?>><?php echo $pagos_x_docto->cia->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->nit->Visible) { // nit ?>
                        <tr id="r_nit"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->nit->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->nit->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->nit->ViewAttributes() ?>><?php echo $pagos_x_docto->nit->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->tercero->Visible) { // tercero ?>
                        <tr id="r_tercero"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->tercero->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->tercero->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->tercero->ViewAttributes() ?>><?php echo $pagos_x_docto->tercero->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->fecha->Visible) { // fecha ?>
                        <tr id="r_fecha"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->fecha->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->fecha->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->fecha->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->dias_vencidos->Visible) { // dias_vencidos ?>
                        <tr id="r_dias_vencidos"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->dias_vencidos->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->dias_vencidos->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->dias_vencidos->ViewAttributes() ?>><?php echo $pagos_x_docto->dias_vencidos->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->estado->Visible) { // estado ?>
                        <tr id="r_estado"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->estado->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->estado->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->estado->ViewAttributes() ?>><?php echo $pagos_x_docto->estado->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->usuario->Visible) { // usuario ?>
                        <tr id="r_usuario"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->usuario->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->usuario->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->usuario->ViewAttributes() ?>><?php echo $pagos_x_docto->usuario->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->estado_pago->Visible) { // estado_pago ?>
                        <tr id="r_estado_pago"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->estado_pago->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->estado_pago->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->estado_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->estado_pago->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->descripcion->Visible) { // descripcion ?>
                        <tr id="r_descripcion"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->descripcion->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->descripcion->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->descripcion->ViewAttributes() ?>><?php echo $pagos_x_docto->descripcion->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->fecha_vencimiento->Visible) { // fecha_vencimiento ?>
                        <tr id="r_fecha_vencimiento"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->fecha_vencimiento->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->fecha_vencimiento->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->fecha_vencimiento->ViewAttributes() ?>><?php echo $pagos_x_docto->fecha_vencimiento->ViewValue ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($pagos_x_docto->monto_pago->Visible) { // monto_pago ?>
                        <tr id="r_monto_pago"<?php echo $pagos_x_docto->RowAttributes() ?>>
                            <td class="ewTableHeader"><?php echo $pagos_x_docto->monto_pago->FldCaption() ?></td>
                            <td<?php echo $pagos_x_docto->monto_pago->CellAttributes() ?>>
                                <div<?php echo $pagos_x_docto->monto_pago->ViewAttributes() ?>><?php echo $pagos_x_docto->monto_pago->ViewValue ?></div>
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
    $pagos_x_docto_view->ShowPageFooter();
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
    $pagos_x_docto_view->Page_Terminate();
    ?>
    <?php

    //
    // Page class
    //
    class cpagos_x_docto_view
    {

        // Page ID
        var $PageID = 'view';

        // Table name
        var $TableName = 'pagos_x_docto';

        // Page object name
        var $PageObjName = 'pagos_x_docto_view';

        // Page name
        function PageName()
        {
            return ew_CurrentPage();
        }

        // Page URL
        function PageUrl()
        {
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
        function cpagos_x_docto_view()
        {
            global $conn, $Language;

            // Language object
            if (!isset($Language)) $Language = new cLanguage();

            // Table object (pagos_x_docto)
            if (!isset($GLOBALS["pagos_x_docto"])) {
                $GLOBALS["pagos_x_docto"] = new cpagos_x_docto();
                $GLOBALS["Table"] =& $GLOBALS["pagos_x_docto"];
            }
            $KeyUrl = "";
            if (@$_GET["iddoctocontable"] <> "") {
                $this->RecKey["iddoctocontable"] = $_GET["iddoctocontable"];
                $KeyUrl .= "&iddoctocontable=" . urlencode($this->RecKey["iddoctocontable"]);
            }
            $this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
            $this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
            $this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
            $this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
            $this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
            $this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
            $this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

            // Table object (historial_pagos)
            if (!isset($GLOBALS['historial_pagos'])) $GLOBALS['historial_pagos'] = new chistorial_pagos();

            // Table object (usuarios)
            if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

            // Page ID
            if (!defined("EW_PAGE_ID"))
                define("EW_PAGE_ID", 'view', TRUE);

            // Table name (for backward compatibility)
            if (!defined("EW_TABLE_NAME"))
                define("EW_TABLE_NAME", 'pagos_x_docto', TRUE);

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
            if (!$Security->CanView()) {
                $Security->SaveLastUrl();
                $this->Page_Terminate("pagos_x_doctolist.php");
            }
            $Security->UserID_Loading();
            if ($Security->IsLoggedIn()) $Security->LoadUserID();
            $Security->UserID_Loaded();
            if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
                $_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
                $this->Page_Terminate("pagos_x_doctolist.php");
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
            if (@$_GET["iddoctocontable"] <> "") {
                if ($gsExportFile <> "") $gsExportFile .= "_";
                $gsExportFile .= ew_StripSlashes($_GET["iddoctocontable"]);
            }
            if ($pagos_x_docto->Export == "excel") {
                header('Content-Type: application/vnd.ms-excel' . $Charset);
                header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xls');
            }
            if ($pagos_x_docto->Export == "word") {
                header('Content-Type: application/vnd.ms-word' . $Charset);
                header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
            }
            if ($pagos_x_docto->Export == "xml") {
                header('Content-Type: text/xml' . $Charset);
                header('Content-Disposition: attachment; filename=' . $gsExportFile . '.xml');
            }
            if ($pagos_x_docto->Export == "csv") {
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
            global $Language, $pagos_x_docto;

            // Load current record
            $bLoadCurrentRecord = FALSE;
            $sReturnUrl = "";
            $bMatchRecord = FALSE;
            if ($this->IsPageRequest()) { // Validate request
                if (@$_GET["iddoctocontable"] <> "") {
                    $pagos_x_docto->iddoctocontable->setQueryStringValue($_GET["iddoctocontable"]);
                    $this->RecKey["iddoctocontable"] = $pagos_x_docto->iddoctocontable->QueryStringValue;
                } else {
                    $sReturnUrl = "pagos_x_doctolist.php"; // Return to list
                }

                // Get action
                $pagos_x_docto->CurrentAction = "I"; // Display form
                switch ($pagos_x_docto->CurrentAction) {
                    case "I": // Get a record to display
                        if (!$this->LoadRow()) { // Load record based on key
                            if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
                                $this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
                            $sReturnUrl = "pagos_x_doctolist.php"; // No matching record, return to list
                        }
                }

                // Export data only
                if (in_array($pagos_x_docto->Export, array("html", "word", "excel", "xml", "csv", "email", "pdf"))) {
                    if ($pagos_x_docto->Export == "email" && $pagos_x_docto->ExportReturnUrl() == ew_CurrentPage()) // Default return page
                        $pagos_x_docto->setExportReturnUrl($pagos_x_docto->ViewUrl()); // Add key
                    $this->ExportData();
                    if ($pagos_x_docto->Export <> "email")
                        $this->Page_Terminate(); // Terminate response
                    exit();
                }
            } else {
                $sReturnUrl = "pagos_x_doctolist.php"; // Not page request, return to list
            }
            if ($sReturnUrl <> "")
                $this->Page_Terminate($sReturnUrl);

            // Render row
            $pagos_x_docto->RowType = EW_ROWTYPE_VIEW;
            $pagos_x_docto->ResetAttrs();
            $this->RenderRow();
        }

        // Set up starting record parameters
        function SetUpStartRec()
        {
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
                        $this->StartRec = ($PageNo - 1) * $this->DisplayRecs + 1;
                        if ($this->StartRec <= 0) {
                            $this->StartRec = 1;
                        } elseif ($this->StartRec >= intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1) {
                            $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1;
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
                $this->StartRec = intval(($this->TotalRecs - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
                $pagos_x_docto->setStartRecordNumber($this->StartRec);
            } elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
                $this->StartRec = intval(($this->StartRec - 1) / $this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
                $pagos_x_docto->setStartRecordNumber($this->StartRec);
            }
        }

        // Load recordset
        function LoadRecordset($offset = -1, $rowcnt = -1)
        {
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
        function LoadRow()
        {
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
        function LoadRowValues(&$rs)
        {
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

        // Render row values based on field settings
        function RenderRow()
        {
            global $conn, $Security, $Language, $pagos_x_docto;

            // Initialize URLs
            $this->AddUrl = $pagos_x_docto->AddUrl();
            $this->EditUrl = $pagos_x_docto->EditUrl();
            $this->CopyUrl = $pagos_x_docto->CopyUrl();
            $this->DeleteUrl = $pagos_x_docto->DeleteUrl();
            $this->ListUrl = $pagos_x_docto->ListUrl();

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

                // descripcion
                $pagos_x_docto->descripcion->ViewValue = $pagos_x_docto->descripcion->CurrentValue;
                $pagos_x_docto->descripcion->ViewCustomAttributes = "";

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

                // historial
                $pagos_x_docto->historial->LinkCustomAttributes = "";
                $pagos_x_docto->historial->HrefValue = "";
                $pagos_x_docto->historial->TooltipValue = "";

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

                // tercero
                $pagos_x_docto->tercero->LinkCustomAttributes = "";
                $pagos_x_docto->tercero->HrefValue = "";
                $pagos_x_docto->tercero->TooltipValue = "";

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

                // usuario
                $pagos_x_docto->usuario->LinkCustomAttributes = "";
                $pagos_x_docto->usuario->HrefValue = "";
                $pagos_x_docto->usuario->TooltipValue = "";

                // estado_pago
                $pagos_x_docto->estado_pago->LinkCustomAttributes = "";
                $pagos_x_docto->estado_pago->HrefValue = "";
                $pagos_x_docto->estado_pago->TooltipValue = "";

                // descripcion
                $pagos_x_docto->descripcion->LinkCustomAttributes = "";
                $pagos_x_docto->descripcion->HrefValue = "";
                $pagos_x_docto->descripcion->TooltipValue = "";

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
        function SetupExportOptions()
        {
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
            $item->Visible = TRUE;

            // Export to Email
            $item =& $this->ExportOptions->Add("email");
            $item->Body = "<a name=\"emf_pagos_x_docto\" id=\"emf_pagos_x_docto\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_pagos_x_docto',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . "<img src=\"phpimages/exportemail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToEmail")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
            $item->Visible = TRUE;

            // Hide options for export/action
            if ($pagos_x_docto->Export <> "")
                $this->ExportOptions->HideAllOptions();
        }

        // Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
        function ExportData()
        {
            global $pagos_x_docto;
            $utf8 = (strtolower(EW_CHARSET) == "utf-8");
            $bSelectLimit = FALSE;

            // Load recordset
            if ($bSelectLimit) {
                $this->TotalRecs = $pagos_x_docto->SelectRecordCount();
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
            if ($pagos_x_docto->Export == "xml") {
                $XmlDoc = new cXMLDocument(EW_XML_ENCODING);
            } else {
                $ExportDoc = new cExportDocument($pagos_x_docto, "v");
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
                $pagos_x_docto->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
            } else {
                $sHeader = $this->PageHeader;
                $this->Page_DataRendering($sHeader);
                $ExportDoc->Text .= $sHeader;
                $pagos_x_docto->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
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
        function ExportEmail($EmailContent)
        {
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
        function ExportQueryString()
        {
            global $pagos_x_docto;

            // Initialize
            $sQry = "export=html";

            // Add record key QueryString
            $sQry .= "&" . substr($pagos_x_docto->KeyUrl("", ""), 1);
            return $sQry;
        }

        // Show link optionally based on User ID
        function ShowOptionLink()
        {
            global $Security, $pagos_x_docto;
            if ($Security->IsLoggedIn()) {
                if (!$Security->IsAdmin()) {
                    return $Security->IsValidUserID($pagos_x_docto->usuario->CurrentValue);
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
