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
$auditoria_add = new cauditoria_add();
$Page =& $auditoria_add;

// Page init
$auditoria_add->Page_Init();

// Page main
$auditoria_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
    <!--

    // Create page object
    var auditoria_add = new ew_Page("auditoria_add");

    // page properties
    auditoria_add.PageID = "add"; // page ID
    auditoria_add.FormID = "fauditoriaadd"; // form ID
    var EW_PAGE_ID = auditoria_add.PageID; // for backward compatibility

    // extend page with ValidateForm function
    auditoria_add.ValidateForm = function (fobj) {
        ew_PostAutoSuggest(fobj);
        if (!this.ValidateRequired)
            return true; // ignore validation
        if (fobj.a_confirm && fobj.a_confirm.value == "F")
            return true;
        var i, elm, aelm, infix;
        var rowcnt = 1;
        for (i = 0; i < rowcnt; i++) {
            infix = "";
            elm = fobj.elements["x" + infix + "_fecha_hora"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($auditoria->fecha_hora->FldCaption()) ?>");
            elm = fobj.elements["x" + infix + "_fecha_hora"];
            if (elm && !ew_CheckEuroDate(elm.value))
                return ew_OnError(this, elm, "<?php echo ew_JsEncode2($auditoria->fecha_hora->FldErrMsg()) ?>");

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
    auditoria_add.Form_CustomValidate =
        function (fobj) { // DO NOT CHANGE THIS LINE!

            // Your custom validation code here, return false if invalid.
            return true;
        }
    <?php if (EW_CLIENT_VALIDATE) { ?>
    auditoria_add.ValidateRequired = true; // uses JavaScript validation
    <?php } else { ?>
    auditoria_add.ValidateRequired = false; // no JavaScript validation
    <?php } ?>

    //-->
</script>
<script language="JavaScript" type="text/javascript">
    <!--

    // Write your client script here, no need to add script tags.
    //-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>
    &nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $auditoria->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $auditoria->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $auditoria_add->ShowPageHeader(); ?>
<?php
$auditoria_add->ShowMessage();
?>
<form name="fauditoriaadd" id="fauditoriaadd" action="<?php echo ew_CurrentPage() ?>" method="post"
      onsubmit="return auditoria_add.ValidateForm(this);">
    <p>
        <input type="hidden" name="t" id="t" value="auditoria">
        <input type="hidden" name="a_add" id="a_add" value="A">
    <table cellspacing="0" class="ewGrid table-view table-edit">
        <tr>
            <td class="ewGridContent">
                <div class="ewGridMiddlePanel">
                    <table cellspacing="0" class="ewTable">
                        <?php if ($auditoria->fecha_hora->Visible) { // fecha_hora ?>
                            <tr id="r_fecha_hora"<?php echo $auditoria->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $auditoria->fecha_hora->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $auditoria->fecha_hora->CellAttributes() ?>><span id="el_fecha_hora">
<input type="text" name="x_fecha_hora" id="x_fecha_hora"
       value="<?php echo $auditoria->fecha_hora->EditValue ?>"<?php echo $auditoria->fecha_hora->EditAttributes() ?>>
</span><?php echo $auditoria->fecha_hora->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($auditoria->script->Visible) { // script ?>
                            <tr id="r_script"<?php echo $auditoria->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $auditoria->script->FldCaption() ?></td>
                                <td<?php echo $auditoria->script->CellAttributes() ?>><span id="el_script">
<input type="text" name="x_script" id="x_script" size="30" maxlength="80"
       value="<?php echo $auditoria->script->EditValue ?>"<?php echo $auditoria->script->EditAttributes() ?>>
</span><?php echo $auditoria->script->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($auditoria->usuario->Visible) { // usuario ?>
                            <tr id="r_usuario"<?php echo $auditoria->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $auditoria->usuario->FldCaption() ?></td>
                                <td<?php echo $auditoria->usuario->CellAttributes() ?>><span id="el_usuario">
<input type="text" name="x_usuario" id="x_usuario" size="30" maxlength="80"
       value="<?php echo $auditoria->usuario->EditValue ?>"<?php echo $auditoria->usuario->EditAttributes() ?>>
</span><?php echo $auditoria->usuario->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($auditoria->accion->Visible) { // accion ?>
                            <tr id="r_accion"<?php echo $auditoria->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $auditoria->accion->FldCaption() ?></td>
                                <td<?php echo $auditoria->accion->CellAttributes() ?>><span id="el_accion">
<input type="text" name="x_accion" id="x_accion" size="30" maxlength="80"
       value="<?php echo $auditoria->accion->EditValue ?>"<?php echo $auditoria->accion->EditAttributes() ?>>
</span><?php echo $auditoria->accion->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($auditoria->tabla->Visible) { // tabla ?>
                            <tr id="r_tabla"<?php echo $auditoria->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $auditoria->tabla->FldCaption() ?></td>
                                <td<?php echo $auditoria->tabla->CellAttributes() ?>><span id="el_tabla">
<input type="text" name="x_tabla" id="x_tabla" size="30" maxlength="80"
       value="<?php echo $auditoria->tabla->EditValue ?>"<?php echo $auditoria->tabla->EditAttributes() ?>>
</span><?php echo $auditoria->tabla->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($auditoria->campo->Visible) { // campo ?>
                            <tr id="r_campo"<?php echo $auditoria->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $auditoria->campo->FldCaption() ?></td>
                                <td<?php echo $auditoria->campo->CellAttributes() ?>><span id="el_campo">
<input type="text" name="x_campo" id="x_campo" size="30" maxlength="80"
       value="<?php echo $auditoria->campo->EditValue ?>"<?php echo $auditoria->campo->EditAttributes() ?>>
</span><?php echo $auditoria->campo->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($auditoria->valorclave->Visible) { // valorclave ?>
                            <tr id="r_valorclave"<?php echo $auditoria->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $auditoria->valorclave->FldCaption() ?></td>
                                <td<?php echo $auditoria->valorclave->CellAttributes() ?>><span id="el_valorclave">
<textarea name="x_valorclave" id="x_valorclave" cols="35"
          rows="4"<?php echo $auditoria->valorclave->EditAttributes() ?>><?php echo $auditoria->valorclave->EditValue ?></textarea>
</span><?php echo $auditoria->valorclave->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($auditoria->viejovalor->Visible) { // viejovalor ?>
                            <tr id="r_viejovalor"<?php echo $auditoria->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $auditoria->viejovalor->FldCaption() ?></td>
                                <td<?php echo $auditoria->viejovalor->CellAttributes() ?>><span id="el_viejovalor">
<textarea name="x_viejovalor" id="x_viejovalor" cols="35"
          rows="4"<?php echo $auditoria->viejovalor->EditAttributes() ?>><?php echo $auditoria->viejovalor->EditValue ?></textarea>
</span><?php echo $auditoria->viejovalor->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($auditoria->nuevovalor->Visible) { // nuevovalor ?>
                            <tr id="r_nuevovalor"<?php echo $auditoria->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $auditoria->nuevovalor->FldCaption() ?></td>
                                <td<?php echo $auditoria->nuevovalor->CellAttributes() ?>><span id="el_nuevovalor">
<textarea name="x_nuevovalor" id="x_nuevovalor" cols="35"
          rows="4"<?php echo $auditoria->nuevovalor->EditAttributes() ?>><?php echo $auditoria->nuevovalor->EditValue ?></textarea>
</span><?php echo $auditoria->nuevovalor->CustomMsg ?></td>
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
$auditoria_add->ShowPageFooter();
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
$auditoria_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cauditoria_add
{

    // Page ID
    var $PageID = 'add';

    // Table name
    var $TableName = 'auditoria';

    // Page object name
    var $PageObjName = 'auditoria_add';

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
    function cauditoria_add()
    {
        global $conn, $Language;

        // Language object
        if (!isset($Language)) $Language = new cLanguage();

        // Table object (auditoria)
        if (!isset($GLOBALS["auditoria"])) {
            $GLOBALS["auditoria"] = new cauditoria();
            $GLOBALS["Table"] =& $GLOBALS["auditoria"];
        }

        // Table object (usuarios)
        if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

        // Page ID
        if (!defined("EW_PAGE_ID"))
            define("EW_PAGE_ID", 'add', TRUE);

        // Table name (for backward compatibility)
        if (!defined("EW_TABLE_NAME"))
            define("EW_TABLE_NAME", 'auditoria', TRUE);

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
        if (!$Security->CanAdd()) {
            $Security->SaveLastUrl();
            $this->Page_Terminate("auditorialist.php");
        }
        $Security->UserID_Loading();
        if ($Security->IsLoggedIn()) $Security->LoadUserID();
        $Security->UserID_Loaded();

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
        global $objForm, $Language, $gsFormError, $auditoria;

        // Process form if post back
        if (@$_POST["a_add"] <> "") {
            $auditoria->CurrentAction = $_POST["a_add"]; // Get form action
            $this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
            $this->LoadFormValues(); // Load form values

            // Validate form
            if (!$this->ValidateForm()) {
                $auditoria->CurrentAction = "I"; // Form error, reset action
                $auditoria->EventCancelled = TRUE; // Event cancelled
                $this->RestoreFormValues(); // Restore form values
                $this->setFailureMessage($gsFormError);
            }
        } else { // Not post back

            // Load key values from QueryString
            $this->CopyRecord = TRUE;
            if (@$_GET["id"] != "") {
                $auditoria->id->setQueryStringValue($_GET["id"]);
                $auditoria->setKey("id", $auditoria->id->CurrentValue); // Set up key
            } else {
                $auditoria->setKey("id", ""); // Clear key
                $this->CopyRecord = FALSE;
            }
            if ($this->CopyRecord) {
                $auditoria->CurrentAction = "C"; // Copy record
            } else {
                $auditoria->CurrentAction = "I"; // Display blank record
                $this->LoadDefaultValues(); // Load default values
            }
        }

        // Perform action based on action code
        switch ($auditoria->CurrentAction) {
            case "I": // Blank record, no action required
                break;
            case "C": // Copy an existing record
                if (!$this->LoadRow()) { // Load record based on key
                    $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
                    $this->Page_Terminate("auditorialist.php"); // No matching record, return to list
                }
                break;
            case "A": // ' Add new record
                $auditoria->SendEmail = TRUE; // Send email on add success
                if ($this->AddRow($this->OldRecordset)) { // Add successful
                    $this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
                    $sReturnUrl = $auditoria->getReturnUrl();
                    if (ew_GetPageName($sReturnUrl) == "auditoriaview.php")
                        $sReturnUrl = $auditoria->ViewUrl(); // View paging, return to view page with keyurl directly
                    $this->Page_Terminate($sReturnUrl); // Clean up and return
                } else {
                    $auditoria->EventCancelled = TRUE; // Event cancelled
                    $this->RestoreFormValues(); // Add failed, restore form values
                }
        }

        // Render row based on row type
        $auditoria->RowType = EW_ROWTYPE_ADD;  // Render add type

        // Render row
        $auditoria->ResetAttrs();
        $this->RenderRow();
    }

    // Get upload files
    function GetUploadFiles()
    {
        global $objForm, $auditoria;

        // Get upload data
        $index = $objForm->Index; // Save form index
        $objForm->Index = 0;
        $confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
        $objForm->Index = $index; // Restore form index
    }

    // Load default values
    function LoadDefaultValues()
    {
        global $auditoria;
        $auditoria->fecha_hora->CurrentValue = NULL;
        $auditoria->fecha_hora->OldValue = $auditoria->fecha_hora->CurrentValue;
        $auditoria->script->CurrentValue = NULL;
        $auditoria->script->OldValue = $auditoria->script->CurrentValue;
        $auditoria->usuario->CurrentValue = NULL;
        $auditoria->usuario->OldValue = $auditoria->usuario->CurrentValue;
        $auditoria->accion->CurrentValue = NULL;
        $auditoria->accion->OldValue = $auditoria->accion->CurrentValue;
        $auditoria->tabla->CurrentValue = NULL;
        $auditoria->tabla->OldValue = $auditoria->tabla->CurrentValue;
        $auditoria->campo->CurrentValue = NULL;
        $auditoria->campo->OldValue = $auditoria->campo->CurrentValue;
        $auditoria->valorclave->CurrentValue = NULL;
        $auditoria->valorclave->OldValue = $auditoria->valorclave->CurrentValue;
        $auditoria->viejovalor->CurrentValue = NULL;
        $auditoria->viejovalor->OldValue = $auditoria->viejovalor->CurrentValue;
        $auditoria->nuevovalor->CurrentValue = NULL;
        $auditoria->nuevovalor->OldValue = $auditoria->nuevovalor->CurrentValue;
    }

    // Load form values
    function LoadFormValues()
    {

        // Load from form
        global $objForm, $auditoria;
        if (!$auditoria->fecha_hora->FldIsDetailKey) {
            $auditoria->fecha_hora->setFormValue($objForm->GetValue("x_fecha_hora"));
            $auditoria->fecha_hora->CurrentValue = ew_UnFormatDateTime($auditoria->fecha_hora->CurrentValue, 11);
        }
        if (!$auditoria->script->FldIsDetailKey) {
            $auditoria->script->setFormValue($objForm->GetValue("x_script"));
        }
        if (!$auditoria->usuario->FldIsDetailKey) {
            $auditoria->usuario->setFormValue($objForm->GetValue("x_usuario"));
        }
        if (!$auditoria->accion->FldIsDetailKey) {
            $auditoria->accion->setFormValue($objForm->GetValue("x_accion"));
        }
        if (!$auditoria->tabla->FldIsDetailKey) {
            $auditoria->tabla->setFormValue($objForm->GetValue("x_tabla"));
        }
        if (!$auditoria->campo->FldIsDetailKey) {
            $auditoria->campo->setFormValue($objForm->GetValue("x_campo"));
        }
        if (!$auditoria->valorclave->FldIsDetailKey) {
            $auditoria->valorclave->setFormValue($objForm->GetValue("x_valorclave"));
        }
        if (!$auditoria->viejovalor->FldIsDetailKey) {
            $auditoria->viejovalor->setFormValue($objForm->GetValue("x_viejovalor"));
        }
        if (!$auditoria->nuevovalor->FldIsDetailKey) {
            $auditoria->nuevovalor->setFormValue($objForm->GetValue("x_nuevovalor"));
        }
    }

    // Restore form values
    function RestoreFormValues()
    {
        global $objForm, $auditoria;
        $this->LoadOldRecord();
        $auditoria->fecha_hora->CurrentValue = $auditoria->fecha_hora->FormValue;
        $auditoria->fecha_hora->CurrentValue = ew_UnFormatDateTime($auditoria->fecha_hora->CurrentValue, 11);
        $auditoria->script->CurrentValue = $auditoria->script->FormValue;
        $auditoria->usuario->CurrentValue = $auditoria->usuario->FormValue;
        $auditoria->accion->CurrentValue = $auditoria->accion->FormValue;
        $auditoria->tabla->CurrentValue = $auditoria->tabla->FormValue;
        $auditoria->campo->CurrentValue = $auditoria->campo->FormValue;
        $auditoria->valorclave->CurrentValue = $auditoria->valorclave->FormValue;
        $auditoria->viejovalor->CurrentValue = $auditoria->viejovalor->FormValue;
        $auditoria->nuevovalor->CurrentValue = $auditoria->nuevovalor->FormValue;
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

    // Load old record
    function LoadOldRecord()
    {
        global $auditoria;

        // Load key values from Session
        $bValidKey = TRUE;
        if (strval($auditoria->getKey("id")) <> "")
            $auditoria->id->CurrentValue = $auditoria->getKey("id"); // id
        else
            $bValidKey = FALSE;

        // Load old recordset
        if ($bValidKey) {
            $auditoria->CurrentFilter = $auditoria->KeyFilter();
            $sSql = $auditoria->SQL();
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
        global $conn, $Security, $Language, $auditoria;

        // Initialize URLs
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
        } elseif ($auditoria->RowType == EW_ROWTYPE_ADD) { // Add row

            // fecha_hora
            $auditoria->fecha_hora->EditCustomAttributes = "";
            $auditoria->fecha_hora->EditValue = ew_HtmlEncode(ew_FormatDateTime($auditoria->fecha_hora->CurrentValue, 11));

            // script
            $auditoria->script->EditCustomAttributes = "";
            $auditoria->script->EditValue = ew_HtmlEncode($auditoria->script->CurrentValue);

            // usuario
            $auditoria->usuario->EditCustomAttributes = "";
            $auditoria->usuario->EditValue = ew_HtmlEncode($auditoria->usuario->CurrentValue);

            // accion
            $auditoria->accion->EditCustomAttributes = "";
            $auditoria->accion->EditValue = ew_HtmlEncode($auditoria->accion->CurrentValue);

            // tabla
            $auditoria->tabla->EditCustomAttributes = "";
            $auditoria->tabla->EditValue = ew_HtmlEncode($auditoria->tabla->CurrentValue);

            // campo
            $auditoria->campo->EditCustomAttributes = "";
            $auditoria->campo->EditValue = ew_HtmlEncode($auditoria->campo->CurrentValue);

            // valorclave
            $auditoria->valorclave->EditCustomAttributes = "";
            $auditoria->valorclave->EditValue = ew_HtmlEncode($auditoria->valorclave->CurrentValue);

            // viejovalor
            $auditoria->viejovalor->EditCustomAttributes = "";
            $auditoria->viejovalor->EditValue = ew_HtmlEncode($auditoria->viejovalor->CurrentValue);

            // nuevovalor
            $auditoria->nuevovalor->EditCustomAttributes = "";
            $auditoria->nuevovalor->EditValue = ew_HtmlEncode($auditoria->nuevovalor->CurrentValue);

            // Edit refer script
            // fecha_hora

            $auditoria->fecha_hora->HrefValue = "";

            // script
            $auditoria->script->HrefValue = "";

            // usuario
            $auditoria->usuario->HrefValue = "";

            // accion
            $auditoria->accion->HrefValue = "";

            // tabla
            $auditoria->tabla->HrefValue = "";

            // campo
            $auditoria->campo->HrefValue = "";

            // valorclave
            $auditoria->valorclave->HrefValue = "";

            // viejovalor
            $auditoria->viejovalor->HrefValue = "";

            // nuevovalor
            $auditoria->nuevovalor->HrefValue = "";
        }
        if ($auditoria->RowType == EW_ROWTYPE_ADD ||
            $auditoria->RowType == EW_ROWTYPE_EDIT ||
            $auditoria->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
            $auditoria->SetupFieldTitles();
        }

        // Call Row Rendered event
        if ($auditoria->RowType <> EW_ROWTYPE_AGGREGATEINIT)
            $auditoria->Row_Rendered();
    }

    // Validate form
    function ValidateForm()
    {
        global $Language, $gsFormError, $auditoria;

        // Initialize form error message
        $gsFormError = "";

        // Check if validation required
        if (!EW_SERVER_VALIDATE)
            return ($gsFormError == "");
        if (!is_null($auditoria->fecha_hora->FormValue) && $auditoria->fecha_hora->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $auditoria->fecha_hora->FldCaption());
        }
        if (!ew_CheckEuroDate($auditoria->fecha_hora->FormValue)) {
            ew_AddMessage($gsFormError, $auditoria->fecha_hora->FldErrMsg());
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
        global $conn, $Language, $Security, $auditoria;
        $rsnew = array();

        // fecha_hora
        $auditoria->fecha_hora->SetDbValueDef($rsnew, ew_UnFormatDateTime($auditoria->fecha_hora->CurrentValue, 11), ew_CurrentDate(), FALSE);

        // script
        $auditoria->script->SetDbValueDef($rsnew, $auditoria->script->CurrentValue, NULL, FALSE);

        // usuario
        $auditoria->usuario->SetDbValueDef($rsnew, $auditoria->usuario->CurrentValue, NULL, FALSE);

        // accion
        $auditoria->accion->SetDbValueDef($rsnew, $auditoria->accion->CurrentValue, NULL, FALSE);

        // tabla
        $auditoria->tabla->SetDbValueDef($rsnew, $auditoria->tabla->CurrentValue, NULL, FALSE);

        // campo
        $auditoria->campo->SetDbValueDef($rsnew, $auditoria->campo->CurrentValue, NULL, FALSE);

        // valorclave
        $auditoria->valorclave->SetDbValueDef($rsnew, $auditoria->valorclave->CurrentValue, NULL, FALSE);

        // viejovalor
        $auditoria->viejovalor->SetDbValueDef($rsnew, $auditoria->viejovalor->CurrentValue, NULL, FALSE);

        // nuevovalor
        $auditoria->nuevovalor->SetDbValueDef($rsnew, $auditoria->nuevovalor->CurrentValue, NULL, FALSE);

        // Call Row Inserting event
        $rs = ($rsold == NULL) ? NULL : $rsold->fields;
        $bInsertRow = $auditoria->Row_Inserting($rs, $rsnew);
        if ($bInsertRow) {
            $conn->raiseErrorFn = 'ew_ErrorFn';
            $AddRow = $conn->Execute($auditoria->InsertSQL($rsnew));
            $conn->raiseErrorFn = '';
        } else {
            if ($auditoria->CancelMessage <> "") {
                $this->setFailureMessage($auditoria->CancelMessage);
                $auditoria->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->Phrase("InsertCancelled"));
            }
            $AddRow = FALSE;
        }

        // Get insert id if necessary
        if ($AddRow) {
            $auditoria->id->setDbValue($conn->Insert_ID());
            $rsnew['id'] = $auditoria->id->DbValue;
        }
        if ($AddRow) {

            // Call Row Inserted event
            $rs = ($rsold == NULL) ? NULL : $rsold->fields;
            $auditoria->Row_Inserted($rs, $rsnew);
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
