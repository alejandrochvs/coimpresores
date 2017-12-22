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
$documento_contable_add = new cdocumento_contable_add();
$Page =& $documento_contable_add;

// Page init
$documento_contable_add->Page_Init();

// Page main
$documento_contable_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
    <!--

    // Create page object
    var documento_contable_add = new ew_Page("documento_contable_add");

    // page properties
    documento_contable_add.PageID = "add"; // page ID
    documento_contable_add.FormID = "fdocumento_contableadd"; // form ID
    var EW_PAGE_ID = documento_contable_add.PageID; // for backward compatibility

    // extend page with ValidateForm function
    documento_contable_add.ValidateForm = function (fobj) {
        ew_PostAutoSuggest(fobj);
        if (!this.ValidateRequired)
            return true; // ignore validation
        if (fobj.a_confirm && fobj.a_confirm.value == "F")
            return true;
        var i, elm, aelm, infix;
        var rowcnt = 1;
        for (i = 0; i < rowcnt; i++) {
            infix = "";
            elm = fobj.elements["x" + infix + "_tipo_docto"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documento_contable->tipo_docto->FldCaption()) ?>");
            elm = fobj.elements["x" + infix + "_consec_docto"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documento_contable->consec_docto->FldCaption()) ?>");
            elm = fobj.elements["x" + infix + "_consec_docto"];
            if (elm && !ew_CheckInteger(elm.value))
                return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documento_contable->consec_docto->FldErrMsg()) ?>");
            elm = fobj.elements["x" + infix + "_valor"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documento_contable->valor->FldCaption()) ?>");
            elm = fobj.elements["x" + infix + "_valor"];
            if (elm && !ew_CheckInteger(elm.value))
                return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documento_contable->valor->FldErrMsg()) ?>");
            elm = fobj.elements["x" + infix + "_cia"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documento_contable->cia->FldCaption()) ?>");
            elm = fobj.elements["x" + infix + "_cia"];
            if (elm && !ew_CheckInteger(elm.value))
                return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documento_contable->cia->FldErrMsg()) ?>");
            elm = fobj.elements["x" + infix + "_fecha"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documento_contable->fecha->FldCaption()) ?>");
            elm = fobj.elements["x" + infix + "_fecha"];
            if (elm && !ew_CheckEuroDate(elm.value))
                return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documento_contable->fecha->FldErrMsg()) ?>");
            elm = fobj.elements["x" + infix + "_estado"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documento_contable->estado->FldCaption()) ?>");
            elm = fobj.elements["x" + infix + "_usuario"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documento_contable->usuario->FldCaption()) ?>");
            elm = fobj.elements["x" + infix + "_usuario"];
            if (elm && !ew_CheckInteger(elm.value))
                return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documento_contable->usuario->FldErrMsg()) ?>");
            elm = fobj.elements["x" + infix + "_estado_pago"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($documento_contable->estado_pago->FldCaption()) ?>");
            elm = fobj.elements["x" + infix + "_estado_pago"];
            if (elm && !ew_CheckInteger(elm.value))
                return ew_OnError(this, elm, "<?php echo ew_JsEncode2($documento_contable->estado_pago->FldErrMsg()) ?>");

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
        }

        // Process detail page
        var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
        if (detailpage != "") {
            return eval(detailpage + ".ValidateForm(fobj)");
        }
        return true;
    }

    // extend page with Form_CustomValidate function
    documento_contable_add.Form_CustomValidate =
        function (fobj) { // DO NOT CHANGE THIS LINE!

            // Your custom validation code here, return false if invalid.
            return true;
        }
    <?php if (EW_CLIENT_VALIDATE) { ?>
    documento_contable_add.ValidateRequired = true; // uses JavaScript validation
    <?php } else { ?>
    documento_contable_add.ValidateRequired = false; // no JavaScript validation
    <?php } ?>

    //-->
</script>
<script language="JavaScript" type="text/javascript">
    <!--

    // Write your client script here, no need to add script tags.
    //-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>
    &nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $documento_contable->TableCaption() ?></p>
<p class="phpmaker"><a
            href="<?php echo $documento_contable->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $documento_contable_add->ShowPageHeader(); ?>
<?php
$documento_contable_add->ShowMessage();
?>
<form name="fdocumento_contableadd" id="fdocumento_contableadd" action="<?php echo ew_CurrentPage() ?>" method="post"
      onsubmit="return documento_contable_add.ValidateForm(this);">
    <p>
        <input type="hidden" name="t" id="t" value="documento_contable">
        <input type="hidden" name="a_add" id="a_add" value="A">
    <table cellspacing="0" class="ewGrid table-view table-edit">
        <tr>
            <td class="ewGridContent">
                <div class="ewGridMiddlePanel">
                    <table cellspacing="0" class="ewTable">
                        <?php if ($documento_contable->tipo_docto->Visible) { // tipo_docto ?>
                            <tr id="r_tipo_docto"<?php echo $documento_contable->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $documento_contable->tipo_docto->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $documento_contable->tipo_docto->CellAttributes() ?>><span
                                            id="el_tipo_docto">
<input type="text" name="x_tipo_docto" id="x_tipo_docto" size="30" maxlength="45"
       value="<?php echo $documento_contable->tipo_docto->EditValue ?>"<?php echo $documento_contable->tipo_docto->EditAttributes() ?>>
</span><?php echo $documento_contable->tipo_docto->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($documento_contable->consec_docto->Visible) { // consec_docto ?>
                            <tr id="r_consec_docto"<?php echo $documento_contable->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $documento_contable->consec_docto->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $documento_contable->consec_docto->CellAttributes() ?>><span
                                            id="el_consec_docto">
<input type="text" name="x_consec_docto" id="x_consec_docto" size="30"
       value="<?php echo $documento_contable->consec_docto->EditValue ?>"<?php echo $documento_contable->consec_docto->EditAttributes() ?>>
</span><?php echo $documento_contable->consec_docto->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($documento_contable->valor->Visible) { // valor ?>
                            <tr id="r_valor"<?php echo $documento_contable->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $documento_contable->valor->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $documento_contable->valor->CellAttributes() ?>><span id="el_valor">
<input type="text" name="x_valor" id="x_valor" size="30"
       value="<?php echo $documento_contable->valor->EditValue ?>"<?php echo $documento_contable->valor->EditAttributes() ?>>
</span><?php echo $documento_contable->valor->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($documento_contable->cia->Visible) { // cia ?>
                            <tr id="r_cia"<?php echo $documento_contable->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $documento_contable->cia->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $documento_contable->cia->CellAttributes() ?>><span id="el_cia">
<input type="text" name="x_cia" id="x_cia" size="30"
       value="<?php echo $documento_contable->cia->EditValue ?>"<?php echo $documento_contable->cia->EditAttributes() ?>>
</span><?php echo $documento_contable->cia->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($documento_contable->tercero->Visible) { // tercero ?>
                            <tr id="r_tercero"<?php echo $documento_contable->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $documento_contable->tercero->FldCaption() ?></td>
                                <td<?php echo $documento_contable->tercero->CellAttributes() ?>><span id="el_tercero">
<input type="text" name="x_tercero" id="x_tercero" size="30" maxlength="45"
       value="<?php echo $documento_contable->tercero->EditValue ?>"<?php echo $documento_contable->tercero->EditAttributes() ?>>
</span><?php echo $documento_contable->tercero->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($documento_contable->fecha->Visible) { // fecha ?>
                            <tr id="r_fecha"<?php echo $documento_contable->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $documento_contable->fecha->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $documento_contable->fecha->CellAttributes() ?>><span id="el_fecha">
<input type="text" name="x_fecha" id="x_fecha"
       value="<?php echo $documento_contable->fecha->EditValue ?>"<?php echo $documento_contable->fecha->EditAttributes() ?>>
</span><?php echo $documento_contable->fecha->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($documento_contable->estado->Visible) { // estado ?>
                            <tr id="r_estado"<?php echo $documento_contable->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $documento_contable->estado->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $documento_contable->estado->CellAttributes() ?>><span id="el_estado">
<input type="text" name="x_estado" id="x_estado" size="30" maxlength="45"
       value="<?php echo $documento_contable->estado->EditValue ?>"<?php echo $documento_contable->estado->EditAttributes() ?>>
</span><?php echo $documento_contable->estado->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($documento_contable->usuario->Visible) { // usuario ?>
                            <tr id="r_usuario"<?php echo $documento_contable->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $documento_contable->usuario->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $documento_contable->usuario->CellAttributes() ?>><span id="el_usuario">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
    <div<?php echo $documento_contable->usuario->ViewAttributes() ?>><?php echo $documento_contable->usuario->EditValue ?></div>
    <input type="hidden" name="x_usuario" id="x_usuario"
           value="<?php echo ew_HtmlEncode($documento_contable->usuario->CurrentValue) ?>">
<?php } else { ?>
    <input type="text" name="x_usuario" id="x_usuario" size="30"
           value="<?php echo $documento_contable->usuario->EditValue ?>"<?php echo $documento_contable->usuario->EditAttributes() ?>>
<?php } ?>
</span><?php echo $documento_contable->usuario->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($documento_contable->estado_pago->Visible) { // estado_pago ?>
                            <tr id="r_estado_pago"<?php echo $documento_contable->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $documento_contable->estado_pago->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $documento_contable->estado_pago->CellAttributes() ?>><span
                                            id="el_estado_pago">
<input type="text" name="x_estado_pago" id="x_estado_pago" size="30"
       value="<?php echo $documento_contable->estado_pago->EditValue ?>"<?php echo $documento_contable->estado_pago->EditAttributes() ?>>
</span><?php echo $documento_contable->estado_pago->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <p>
        <input type="submit" name="btnAction" id="btnAction"
               value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$documento_contable_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
    echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
    <!--

    // Write your table-specific startup script here
    // document.write("page loaded");
    //-->

</script>
<?php include_once "footer.php" ?>
<?php
$documento_contable_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cdocumento_contable_add
{

    // Page ID
    var $PageID = 'add';

    // Table name
    var $TableName = 'documento_contable';

    // Page object name
    var $PageObjName = 'documento_contable_add';

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
    function cdocumento_contable_add()
    {
        global $conn, $Language;

        // Language object
        if (!isset($Language)) $Language = new cLanguage();

        // Table object (documento_contable)
        if (!isset($GLOBALS["documento_contable"])) {
            $GLOBALS["documento_contable"] = new cdocumento_contable();
            $GLOBALS["Table"] =& $GLOBALS["documento_contable"];
        }

        // Table object (usuarios)
        if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

        // Page ID
        if (!defined("EW_PAGE_ID"))
            define("EW_PAGE_ID", 'add', TRUE);

        // Table name (for backward compatibility)
        if (!defined("EW_TABLE_NAME"))
            define("EW_TABLE_NAME", 'documento_contable', TRUE);

        // Start timer
        if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

        // Open connection
        if (!isset($conn)) $conn = ew_Connect();
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
        if (!$Security->CanAdd()) {
            $Security->SaveLastUrl();
            $this->Page_Terminate("documento_contablelist.php");
        }
        $Security->UserID_Loading();
        if ($Security->IsLoggedIn()) $Security->LoadUserID();
        $Security->UserID_Loaded();
        if ($Security->IsLoggedIn() && strval($Security->CurrentUserID()) == "") {
            $_SESSION[EW_SESSION_FAILURE_MESSAGE] = $Language->Phrase("NoPermission");
            $this->Page_Terminate("documento_contablelist.php");
        }

        // Create form object
        $objForm = new cFormObj();

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

    var $DbMasterFilter = "";
    var $DbDetailFilter = "";
    var $Priv = 0;
    var $OldRecordset;
    var $CopyRecord;

    //
    // Page main
    //
    function Page_Main()
    {
        global $objForm, $Language, $gsFormError, $documento_contable;

        // Process form if post back
        if (@$_POST["a_add"] <> "") {
            $documento_contable->CurrentAction = $_POST["a_add"]; // Get form action
            $this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
            $this->LoadFormValues(); // Load form values

            // Validate form
            if (!$this->ValidateForm()) {
                $documento_contable->CurrentAction = "I"; // Form error, reset action
                $documento_contable->EventCancelled = TRUE; // Event cancelled
                $this->RestoreFormValues(); // Restore form values
                $this->setFailureMessage($gsFormError);
            }
        } else { // Not post back

            // Load key values from QueryString
            $this->CopyRecord = TRUE;
            if (@$_GET["iddoctocontable"] != "") {
                $documento_contable->iddoctocontable->setQueryStringValue($_GET["iddoctocontable"]);
                $documento_contable->setKey("iddoctocontable", $documento_contable->iddoctocontable->CurrentValue); // Set up key
            } else {
                $documento_contable->setKey("iddoctocontable", ""); // Clear key
                $this->CopyRecord = FALSE;
            }
            if ($this->CopyRecord) {
                $documento_contable->CurrentAction = "C"; // Copy record
            } else {
                $documento_contable->CurrentAction = "I"; // Display blank record
                $this->LoadDefaultValues(); // Load default values
            }
        }

        // Perform action based on action code
        switch ($documento_contable->CurrentAction) {
            case "I": // Blank record, no action required
                break;
            case "C": // Copy an existing record
                if (!$this->LoadRow()) { // Load record based on key
                    $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
                    $this->Page_Terminate("documento_contablelist.php"); // No matching record, return to list
                }
                break;
            case "A": // ' Add new record
                $documento_contable->SendEmail = TRUE; // Send email on add success
                if ($this->AddRow($this->OldRecordset)) { // Add successful
                    $this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
                    $sReturnUrl = $documento_contable->getReturnUrl();
                    if (ew_GetPageName($sReturnUrl) == "documento_contableview.php")
                        $sReturnUrl = $documento_contable->ViewUrl(); // View paging, return to view page with keyurl directly
                    $this->Page_Terminate($sReturnUrl); // Clean up and return
                } else {
                    $documento_contable->EventCancelled = TRUE; // Event cancelled
                    $this->RestoreFormValues(); // Add failed, restore form values
                }
        }

        // Render row based on row type
        $documento_contable->RowType = EW_ROWTYPE_ADD;  // Render add type

        // Render row
        $documento_contable->ResetAttrs();
        $this->RenderRow();
    }

    // Get upload files
    function GetUploadFiles()
    {
        global $objForm, $documento_contable;

        // Get upload data
        $index = $objForm->Index; // Save form index
        $objForm->Index = 0;
        $confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
        $objForm->Index = $index; // Restore form index
    }

    // Load default values
    function LoadDefaultValues()
    {
        global $documento_contable;
        $documento_contable->tipo_docto->CurrentValue = NULL;
        $documento_contable->tipo_docto->OldValue = $documento_contable->tipo_docto->CurrentValue;
        $documento_contable->consec_docto->CurrentValue = NULL;
        $documento_contable->consec_docto->OldValue = $documento_contable->consec_docto->CurrentValue;
        $documento_contable->valor->CurrentValue = NULL;
        $documento_contable->valor->OldValue = $documento_contable->valor->CurrentValue;
        $documento_contable->cia->CurrentValue = NULL;
        $documento_contable->cia->OldValue = $documento_contable->cia->CurrentValue;
        $documento_contable->tercero->CurrentValue = NULL;
        $documento_contable->tercero->OldValue = $documento_contable->tercero->CurrentValue;
        $documento_contable->fecha->CurrentValue = NULL;
        $documento_contable->fecha->OldValue = $documento_contable->fecha->CurrentValue;
        $documento_contable->estado->CurrentValue = NULL;
        $documento_contable->estado->OldValue = $documento_contable->estado->CurrentValue;
        $documento_contable->usuario->CurrentValue = CurrentUserID();
        $documento_contable->estado_pago->CurrentValue = 0;
    }

    // Load form values
    function LoadFormValues()
    {

        // Load from form
        global $objForm, $documento_contable;
        if (!$documento_contable->tipo_docto->FldIsDetailKey) {
            $documento_contable->tipo_docto->setFormValue($objForm->GetValue("x_tipo_docto"));
        }
        if (!$documento_contable->consec_docto->FldIsDetailKey) {
            $documento_contable->consec_docto->setFormValue($objForm->GetValue("x_consec_docto"));
        }
        if (!$documento_contable->valor->FldIsDetailKey) {
            $documento_contable->valor->setFormValue($objForm->GetValue("x_valor"));
        }
        if (!$documento_contable->cia->FldIsDetailKey) {
            $documento_contable->cia->setFormValue($objForm->GetValue("x_cia"));
        }
        if (!$documento_contable->tercero->FldIsDetailKey) {
            $documento_contable->tercero->setFormValue($objForm->GetValue("x_tercero"));
        }
        if (!$documento_contable->fecha->FldIsDetailKey) {
            $documento_contable->fecha->setFormValue($objForm->GetValue("x_fecha"));
            $documento_contable->fecha->CurrentValue = ew_UnFormatDateTime($documento_contable->fecha->CurrentValue, 11);
        }
        if (!$documento_contable->estado->FldIsDetailKey) {
            $documento_contable->estado->setFormValue($objForm->GetValue("x_estado"));
        }
        if (!$documento_contable->usuario->FldIsDetailKey) {
            $documento_contable->usuario->setFormValue($objForm->GetValue("x_usuario"));
        }
        if (!$documento_contable->estado_pago->FldIsDetailKey) {
            $documento_contable->estado_pago->setFormValue($objForm->GetValue("x_estado_pago"));
        }
    }

    // Restore form values
    function RestoreFormValues()
    {
        global $objForm, $documento_contable;
        $this->LoadOldRecord();
        $documento_contable->tipo_docto->CurrentValue = $documento_contable->tipo_docto->FormValue;
        $documento_contable->consec_docto->CurrentValue = $documento_contable->consec_docto->FormValue;
        $documento_contable->valor->CurrentValue = $documento_contable->valor->FormValue;
        $documento_contable->cia->CurrentValue = $documento_contable->cia->FormValue;
        $documento_contable->tercero->CurrentValue = $documento_contable->tercero->FormValue;
        $documento_contable->fecha->CurrentValue = $documento_contable->fecha->FormValue;
        $documento_contable->fecha->CurrentValue = ew_UnFormatDateTime($documento_contable->fecha->CurrentValue, 11);
        $documento_contable->estado->CurrentValue = $documento_contable->estado->FormValue;
        $documento_contable->usuario->CurrentValue = $documento_contable->usuario->FormValue;
        $documento_contable->estado_pago->CurrentValue = $documento_contable->estado_pago->FormValue;
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
        $documento_contable->estado->setDbValue($rs->fields('estado'));
        $documento_contable->usuario->setDbValue($rs->fields('usuario'));
        $documento_contable->estado_pago->setDbValue($rs->fields('estado_pago'));
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
        // estado
        // usuario
        // estado_pago

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
            $documento_contable->fecha->ViewValue = ew_FormatDateTime($documento_contable->fecha->ViewValue, 11);
            $documento_contable->fecha->ViewCustomAttributes = "";

            // estado
            $documento_contable->estado->ViewValue = $documento_contable->estado->CurrentValue;
            $documento_contable->estado->ViewCustomAttributes = "";

            // usuario
            $documento_contable->usuario->ViewValue = $documento_contable->usuario->CurrentValue;
            $documento_contable->usuario->ViewCustomAttributes = "";

            // estado_pago
            $documento_contable->estado_pago->ViewValue = $documento_contable->estado_pago->CurrentValue;
            $documento_contable->estado_pago->ViewCustomAttributes = "";

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

            // cia
            $documento_contable->cia->LinkCustomAttributes = "";
            $documento_contable->cia->HrefValue = "";
            $documento_contable->cia->TooltipValue = "";

            // tercero
            $documento_contable->tercero->LinkCustomAttributes = "";
            $documento_contable->tercero->HrefValue = "";
            $documento_contable->tercero->TooltipValue = "";

            // fecha
            $documento_contable->fecha->LinkCustomAttributes = "";
            $documento_contable->fecha->HrefValue = "";
            $documento_contable->fecha->TooltipValue = "";

            // estado
            $documento_contable->estado->LinkCustomAttributes = "";
            $documento_contable->estado->HrefValue = "";
            $documento_contable->estado->TooltipValue = "";

            // usuario
            $documento_contable->usuario->LinkCustomAttributes = "";
            $documento_contable->usuario->HrefValue = "";
            $documento_contable->usuario->TooltipValue = "";

            // estado_pago
            $documento_contable->estado_pago->LinkCustomAttributes = "";
            $documento_contable->estado_pago->HrefValue = "";
            $documento_contable->estado_pago->TooltipValue = "";
        } elseif ($documento_contable->RowType == EW_ROWTYPE_ADD) { // Add row

            // tipo_docto
            $documento_contable->tipo_docto->EditCustomAttributes = "";
            $documento_contable->tipo_docto->EditValue = ew_HtmlEncode($documento_contable->tipo_docto->CurrentValue);

            // consec_docto
            $documento_contable->consec_docto->EditCustomAttributes = "";
            $documento_contable->consec_docto->EditValue = ew_HtmlEncode($documento_contable->consec_docto->CurrentValue);

            // valor
            $documento_contable->valor->EditCustomAttributes = "";
            $documento_contable->valor->EditValue = ew_HtmlEncode($documento_contable->valor->CurrentValue);

            // cia
            $documento_contable->cia->EditCustomAttributes = "";
            $documento_contable->cia->EditValue = ew_HtmlEncode($documento_contable->cia->CurrentValue);

            // tercero
            $documento_contable->tercero->EditCustomAttributes = "";
            $documento_contable->tercero->EditValue = ew_HtmlEncode($documento_contable->tercero->CurrentValue);

            // fecha
            $documento_contable->fecha->EditCustomAttributes = "";
            $documento_contable->fecha->EditValue = ew_HtmlEncode(ew_FormatDateTime($documento_contable->fecha->CurrentValue, 11));

            // estado
            $documento_contable->estado->EditCustomAttributes = "";
            $documento_contable->estado->EditValue = ew_HtmlEncode($documento_contable->estado->CurrentValue);

            // usuario
            $documento_contable->usuario->EditCustomAttributes = "";
            if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
                $documento_contable->usuario->CurrentValue = CurrentUserID();
                $documento_contable->usuario->EditValue = $documento_contable->usuario->CurrentValue;
                $documento_contable->usuario->ViewCustomAttributes = "";
            } else {
                $documento_contable->usuario->EditValue = ew_HtmlEncode($documento_contable->usuario->CurrentValue);
            }

            // estado_pago
            $documento_contable->estado_pago->EditCustomAttributes = "";
            $documento_contable->estado_pago->EditValue = ew_HtmlEncode($documento_contable->estado_pago->CurrentValue);

            // Edit refer script
            // tipo_docto

            $documento_contable->tipo_docto->HrefValue = "";

            // consec_docto
            $documento_contable->consec_docto->HrefValue = "";

            // valor
            $documento_contable->valor->HrefValue = "";

            // cia
            $documento_contable->cia->HrefValue = "";

            // tercero
            $documento_contable->tercero->HrefValue = "";

            // fecha
            $documento_contable->fecha->HrefValue = "";

            // estado
            $documento_contable->estado->HrefValue = "";

            // usuario
            $documento_contable->usuario->HrefValue = "";

            // estado_pago
            $documento_contable->estado_pago->HrefValue = "";
        }
        if ($documento_contable->RowType == EW_ROWTYPE_ADD ||
            $documento_contable->RowType == EW_ROWTYPE_EDIT ||
            $documento_contable->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
            $documento_contable->SetupFieldTitles();
        }

        // Call Row Rendered event
        if ($documento_contable->RowType <> EW_ROWTYPE_AGGREGATEINIT)
            $documento_contable->Row_Rendered();
    }

    // Validate form
    function ValidateForm()
    {
        global $Language, $gsFormError, $documento_contable;

        // Initialize form error message
        $gsFormError = "";

        // Check if validation required
        if (!EW_SERVER_VALIDATE)
            return ($gsFormError == "");
        if (!is_null($documento_contable->tipo_docto->FormValue) && $documento_contable->tipo_docto->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documento_contable->tipo_docto->FldCaption());
        }
        if (!is_null($documento_contable->consec_docto->FormValue) && $documento_contable->consec_docto->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documento_contable->consec_docto->FldCaption());
        }
        if (!ew_CheckInteger($documento_contable->consec_docto->FormValue)) {
            ew_AddMessage($gsFormError, $documento_contable->consec_docto->FldErrMsg());
        }
        if (!is_null($documento_contable->valor->FormValue) && $documento_contable->valor->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documento_contable->valor->FldCaption());
        }
        if (!ew_CheckInteger($documento_contable->valor->FormValue)) {
            ew_AddMessage($gsFormError, $documento_contable->valor->FldErrMsg());
        }
        if (!is_null($documento_contable->cia->FormValue) && $documento_contable->cia->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documento_contable->cia->FldCaption());
        }
        if (!ew_CheckInteger($documento_contable->cia->FormValue)) {
            ew_AddMessage($gsFormError, $documento_contable->cia->FldErrMsg());
        }
        if (!is_null($documento_contable->fecha->FormValue) && $documento_contable->fecha->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documento_contable->fecha->FldCaption());
        }
        if (!ew_CheckEuroDate($documento_contable->fecha->FormValue)) {
            ew_AddMessage($gsFormError, $documento_contable->fecha->FldErrMsg());
        }
        if (!is_null($documento_contable->estado->FormValue) && $documento_contable->estado->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documento_contable->estado->FldCaption());
        }
        if (!is_null($documento_contable->usuario->FormValue) && $documento_contable->usuario->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documento_contable->usuario->FldCaption());
        }
        if (!ew_CheckInteger($documento_contable->usuario->FormValue)) {
            ew_AddMessage($gsFormError, $documento_contable->usuario->FldErrMsg());
        }
        if (!is_null($documento_contable->estado_pago->FormValue) && $documento_contable->estado_pago->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $documento_contable->estado_pago->FldCaption());
        }
        if (!ew_CheckInteger($documento_contable->estado_pago->FormValue)) {
            ew_AddMessage($gsFormError, $documento_contable->estado_pago->FldErrMsg());
        }

        // Return validate result
        $ValidateForm = ($gsFormError == "");

        // Call Form_CustomValidate event
        $sFormCustomError = "";
        $ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
        if ($sFormCustomError <> "") {
            ew_AddMessage($gsFormError, $sFormCustomError);
        }
        return $ValidateForm;
    }

    // Add record
    function AddRow($rsold = NULL)
    {
        global $conn, $Language, $Security, $documento_contable;

        // Check if valid User ID
        $bValidUser = FALSE;
        if ($Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
            $bValidUser = $Security->IsValidUserID($documento_contable->usuario->CurrentValue);
            if (!$bValidUser) {
                $sUserIdMsg = str_replace("%c", CurrentUserID(), $Language->Phrase("UnAuthorizedUserID"));
                $sUserIdMsg = str_replace("%u", $documento_contable->usuario->CurrentValue, $sUserIdMsg);
                $this->setFailureMessage($sUserIdMsg);
                return FALSE;
            }
        }
        $rsnew = array();

        // tipo_docto
        $documento_contable->tipo_docto->SetDbValueDef($rsnew, $documento_contable->tipo_docto->CurrentValue, "", FALSE);

        // consec_docto
        $documento_contable->consec_docto->SetDbValueDef($rsnew, $documento_contable->consec_docto->CurrentValue, 0, FALSE);

        // valor
        $documento_contable->valor->SetDbValueDef($rsnew, $documento_contable->valor->CurrentValue, 0, FALSE);

        // cia
        $documento_contable->cia->SetDbValueDef($rsnew, $documento_contable->cia->CurrentValue, 0, FALSE);

        // tercero
        $documento_contable->tercero->SetDbValueDef($rsnew, $documento_contable->tercero->CurrentValue, NULL, FALSE);

        // fecha
        $documento_contable->fecha->SetDbValueDef($rsnew, ew_UnFormatDateTime($documento_contable->fecha->CurrentValue, 11), ew_CurrentDate(), FALSE);

        // estado
        $documento_contable->estado->SetDbValueDef($rsnew, $documento_contable->estado->CurrentValue, "", FALSE);

        // usuario
        $documento_contable->usuario->SetDbValueDef($rsnew, $documento_contable->usuario->CurrentValue, 0, FALSE);

        // estado_pago
        $documento_contable->estado_pago->SetDbValueDef($rsnew, $documento_contable->estado_pago->CurrentValue, 0, strval($documento_contable->estado_pago->CurrentValue) == "");

        // Call Row Inserting event
        $rs = ($rsold == NULL) ? NULL : $rsold->fields;
        $bInsertRow = $documento_contable->Row_Inserting($rs, $rsnew);
        if ($bInsertRow) {
            $conn->raiseErrorFn = 'ew_ErrorFn';
            $AddRow = $conn->Execute($documento_contable->InsertSQL($rsnew));
            $conn->raiseErrorFn = '';
        } else {
            if ($documento_contable->CancelMessage <> "") {
                $this->setFailureMessage($documento_contable->CancelMessage);
                $documento_contable->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->Phrase("InsertCancelled"));
            }
            $AddRow = FALSE;
        }

        // Get insert id if necessary
        if ($AddRow) {
            $documento_contable->iddoctocontable->setDbValue($conn->Insert_ID());
            $rsnew['iddoctocontable'] = $documento_contable->iddoctocontable->DbValue;
        }
        if ($AddRow) {

            // Call Row Inserted event
            $rs = ($rsold == NULL) ? NULL : $rsold->fields;
            $documento_contable->Row_Inserted($rs, $rsnew);
        }
        return $AddRow;
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
}

?>
