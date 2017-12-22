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
$niveles_edit = new cniveles_edit();
$Page =& $niveles_edit;

// Page init
$niveles_edit->Page_Init();

// Page main
$niveles_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
    <!--

    // Create page object
    var niveles_edit = new ew_Page("niveles_edit");

    // page properties
    niveles_edit.PageID = "edit"; // page ID
    niveles_edit.FormID = "fnivelesedit"; // form ID
    var EW_PAGE_ID = niveles_edit.PageID; // for backward compatibility

    // extend page with ValidateForm function
    niveles_edit.ValidateForm = function (fobj) {
        ew_PostAutoSuggest(fobj);
        if (!this.ValidateRequired)
            return true; // ignore validation
        if (fobj.a_confirm && fobj.a_confirm.value == "F")
            return true;
        var i, elm, aelm, infix;
        var rowcnt = 1;
        for (i = 0; i < rowcnt; i++) {
            infix = "";
            elm = fobj.elements["x" + infix + "_idnivel"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($niveles->idnivel->FldCaption()) ?>");
            elm = fobj.elements["x" + infix + "_idnivel"];
            if (elm && !ew_CheckInteger(elm.value))
                return ew_OnError(this, elm, "<?php echo ew_JsEncode2($niveles->idnivel->FldErrMsg()) ?>");
            elm = fobj.elements["x" + infix + "_nombrenivel"];
            if (elm && !ew_HasValue(elm))
                return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($niveles->nombrenivel->FldCaption()) ?>");
            elmId = fobj.elements["x" + infix + "_idnivel"];
            elmName = fobj.elements["x" + infix + "_nombrenivel"];
            if (elmId && elmName) {
                elmId.value = elmId.value.replace(/^\s+|\s+$/, '');
                elmName.value = elmName.value.replace(/^\s+|\s+$/, '');
                if (elmId && !ew_CheckInteger(elmId.value))
                    return ew_OnError(this, elmId, ewLanguage.Phrase("UserLevelIDInteger"));
                var level = parseInt(elmId.value);
                if (level == 0) {
                    if (elmName.value.toLowerCase() != "default")
                        return ew_OnError(this, elmName, ewLanguage.Phrase("UserLevelDefaultName"));
                } else if (level == -1) {
                    if (elmName.value.toLowerCase() != "administrator")
                        return ew_OnError(this, elmName, ewLanguage.Phrase("UserLevelAdministratorName"));
                } else if (level < -1) {
                    return ew_OnError(this, elmId, ewLanguage.Phrase("UserLevelIDIncorrect"));
                } else if (level > 0) {
                    if (elmName.value.toLowerCase() == "administrator" || elmName.value.toLowerCase() == "default")
                        return ew_OnError(this, elmName, ewLanguage.Phrase("UserLevelNameIncorrect"));
                }
            }

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
    niveles_edit.Form_CustomValidate =
        function (fobj) { // DO NOT CHANGE THIS LINE!

            // Your custom validation code here, return false if invalid.
            return true;
        }
    <?php if (EW_CLIENT_VALIDATE) { ?>
    niveles_edit.ValidateRequired = true; // uses JavaScript validation
    <?php } else { ?>
    niveles_edit.ValidateRequired = false; // no JavaScript validation
    <?php } ?>

    //-->
</script>
<script language="JavaScript" type="text/javascript">
    <!--

    // Write your client script here, no need to add script tags.
    //-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>
    &nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $niveles->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $niveles->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $niveles_edit->ShowPageHeader(); ?>
<?php
$niveles_edit->ShowMessage();
?>
<form name="fnivelesedit" id="fnivelesedit" action="<?php echo ew_CurrentPage() ?>" method="post"
      onsubmit="return niveles_edit.ValidateForm(this);">
    <p>
        <input type="hidden" name="a_table" id="a_table" value="niveles">
        <input type="hidden" name="a_edit" id="a_edit" value="U">
    <table cellspacing="0" class="ewGrid table-view table-edit">
        <tr>
            <td class="ewGridContent">
                <div class="ewGridMiddlePanel">
                    <table cellspacing="0" class="ewTable">
                        <?php if ($niveles->idnivel->Visible) { // idnivel ?>
                            <tr id="r_idnivel"<?php echo $niveles->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $niveles->idnivel->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $niveles->idnivel->CellAttributes() ?>><span id="el_idnivel">
<div<?php echo $niveles->idnivel->ViewAttributes() ?>><?php echo $niveles->idnivel->EditValue ?></div>
<input type="hidden" name="x_idnivel" id="x_idnivel"
       value="<?php echo ew_HtmlEncode($niveles->idnivel->CurrentValue) ?>">
</span><?php echo $niveles->idnivel->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($niveles->nombrenivel->Visible) { // nombrenivel ?>
                            <tr id="r_nombrenivel"<?php echo $niveles->RowAttributes() ?>>
                                <td class="ewTableHeader"><?php echo $niveles->nombrenivel->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
                                <td<?php echo $niveles->nombrenivel->CellAttributes() ?>><span id="el_nombrenivel">
<input type="text" name="x_nombrenivel" id="x_nombrenivel" size="30" maxlength="80"
       value="<?php echo $niveles->nombrenivel->EditValue ?>"<?php echo $niveles->nombrenivel->EditAttributes() ?>>
</span><?php echo $niveles->nombrenivel->CustomMsg ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <p>
        <input type="submit" name="btnAction" id="btnAction"
               value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$niveles_edit->ShowPageFooter();
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
$niveles_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cniveles_edit
{

    // Page ID
    var $PageID = 'edit';

    // Table name
    var $TableName = 'niveles';

    // Page object name
    var $PageObjName = 'niveles_edit';

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
    function cniveles_edit()
    {
        global $conn, $Language;

        // Language object
        if (!isset($Language)) $Language = new cLanguage();

        // Table object (niveles)
        if (!isset($GLOBALS["niveles"])) {
            $GLOBALS["niveles"] = new cniveles();
            $GLOBALS["Table"] =& $GLOBALS["niveles"];
        }

        // Table object (usuarios)
        if (!isset($GLOBALS['usuarios'])) $GLOBALS['usuarios'] = new cusuarios();

        // Page ID
        if (!defined("EW_PAGE_ID"))
            define("EW_PAGE_ID", 'edit', TRUE);

        // Table name (for backward compatibility)
        if (!defined("EW_TABLE_NAME"))
            define("EW_TABLE_NAME", 'niveles', TRUE);

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

    var $DbMasterFilter;
    var $DbDetailFilter;

    //
    // Page main
    //
    function Page_Main()
    {
        global $objForm, $Language, $gsFormError, $niveles;

        // Load key from QueryString
        if (@$_GET["idnivel"] <> "")
            $niveles->idnivel->setQueryStringValue($_GET["idnivel"]);
        if (@$_POST["a_edit"] <> "") {
            $niveles->CurrentAction = $_POST["a_edit"]; // Get action code
            $this->LoadFormValues(); // Get form values

            // Validate form
            if (!$this->ValidateForm()) {
                $niveles->CurrentAction = ""; // Form error, reset action
                $this->setFailureMessage($gsFormError);
                $niveles->EventCancelled = TRUE; // Event cancelled
                $this->RestoreFormValues();
            }
        } else {
            $niveles->CurrentAction = "I"; // Default action is display
        }

        // Check if valid key
        if ($niveles->idnivel->CurrentValue == "")
            $this->Page_Terminate("niveleslist.php"); // Invalid key, return to list
        switch ($niveles->CurrentAction) {
            case "I": // Get a record to display
                if (!$this->LoadRow()) { // Load record based on key
                    $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
                    $this->Page_Terminate("niveleslist.php"); // No matching record, return to list
                }
                break;
            Case "U": // Update
                $niveles->SendEmail = TRUE; // Send email on update success
                if ($this->EditRow()) { // Update record based on key
                    $this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
                    $sReturnUrl = $niveles->getReturnUrl();
                    $this->Page_Terminate($sReturnUrl); // Return to caller
                } else {
                    $niveles->EventCancelled = TRUE; // Event cancelled
                    $this->RestoreFormValues(); // Restore form values if update failed
                }
        }

        // Render the record
        $niveles->RowType = EW_ROWTYPE_EDIT; // Render as Edit
        $niveles->ResetAttrs();
        $this->RenderRow();
    }

    // Get upload files
    function GetUploadFiles()
    {
        global $objForm, $niveles;

        // Get upload data
        $index = $objForm->Index; // Save form index
        $objForm->Index = 0;
        $confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
        $objForm->Index = $index; // Restore form index
    }

    // Load form values
    function LoadFormValues()
    {

        // Load from form
        global $objForm, $niveles;
        if (!$niveles->idnivel->FldIsDetailKey) {
            $niveles->idnivel->setFormValue($objForm->GetValue("x_idnivel"));
        }
        if (!$niveles->nombrenivel->FldIsDetailKey) {
            $niveles->nombrenivel->setFormValue($objForm->GetValue("x_nombrenivel"));
        }
    }

    // Restore form values
    function RestoreFormValues()
    {
        global $objForm, $niveles;
        $this->LoadRow();
        $niveles->idnivel->CurrentValue = $niveles->idnivel->FormValue;
        $niveles->nombrenivel->CurrentValue = $niveles->nombrenivel->FormValue;
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
        } elseif ($niveles->RowType == EW_ROWTYPE_EDIT) { // Edit row

            // idnivel
            $niveles->idnivel->EditCustomAttributes = "";
            $niveles->idnivel->EditValue = $niveles->idnivel->CurrentValue;
            $niveles->idnivel->ViewCustomAttributes = "";

            // nombrenivel
            $niveles->nombrenivel->EditCustomAttributes = "";
            $niveles->nombrenivel->EditValue = ew_HtmlEncode($niveles->nombrenivel->CurrentValue);

            // Edit refer script
            // idnivel

            $niveles->idnivel->HrefValue = "";

            // nombrenivel
            $niveles->nombrenivel->HrefValue = "";
        }
        if ($niveles->RowType == EW_ROWTYPE_ADD ||
            $niveles->RowType == EW_ROWTYPE_EDIT ||
            $niveles->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
            $niveles->SetupFieldTitles();
        }

        // Call Row Rendered event
        if ($niveles->RowType <> EW_ROWTYPE_AGGREGATEINIT)
            $niveles->Row_Rendered();
    }

    // Validate form
    function ValidateForm()
    {
        global $Language, $gsFormError, $niveles;

        // Initialize form error message
        $gsFormError = "";

        // Check if validation required
        if (!EW_SERVER_VALIDATE)
            return ($gsFormError == "");
        if (!is_null($niveles->idnivel->FormValue) && $niveles->idnivel->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $niveles->idnivel->FldCaption());
        }
        if (!ew_CheckInteger($niveles->idnivel->FormValue)) {
            ew_AddMessage($gsFormError, $niveles->idnivel->FldErrMsg());
        }
        if (!is_null($niveles->nombrenivel->FormValue) && $niveles->nombrenivel->FormValue == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $niveles->nombrenivel->FldCaption());
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

    // Update record based on key values
    function EditRow()
    {
        global $conn, $Security, $Language, $niveles;
        $sFilter = $niveles->KeyFilter();
        $niveles->CurrentFilter = $sFilter;
        $sSql = $niveles->SQL();
        $conn->raiseErrorFn = 'ew_ErrorFn';
        $rs = $conn->Execute($sSql);
        $conn->raiseErrorFn = '';
        if ($rs === FALSE)
            return FALSE;
        if ($rs->EOF) {
            $EditRow = FALSE; // Update Failed
        } else {

            // Save old values
            $rsold =& $rs->fields;
            $rsnew = array();

            // idnivel
            // nombrenivel

            $niveles->nombrenivel->SetDbValueDef($rsnew, $niveles->nombrenivel->CurrentValue, "", $niveles->nombrenivel->ReadOnly);

            // Call Row Updating event
            $bUpdateRow = $niveles->Row_Updating($rsold, $rsnew);
            if ($bUpdateRow) {
                $conn->raiseErrorFn = 'ew_ErrorFn';
                if (count($rsnew) > 0)
                    $EditRow = $conn->Execute($niveles->UpdateSQL($rsnew));
                else
                    $EditRow = TRUE; // No field to update
                $conn->raiseErrorFn = '';
            } else {
                if ($niveles->CancelMessage <> "") {
                    $this->setFailureMessage($niveles->CancelMessage);
                    $niveles->CancelMessage = "";
                } else {
                    $this->setFailureMessage($Language->Phrase("UpdateCancelled"));
                }
                $EditRow = FALSE;
            }
        }

        // Call Row_Updated event
        if ($EditRow)
            $niveles->Row_Updated($rsold, $rsnew);
        $rs->Close();
        return $EditRow;
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
