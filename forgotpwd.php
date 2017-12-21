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
$forgotpwd = new cforgotpwd();
$Page =& $forgotpwd;

// Page init
$forgotpwd->Page_Init();

// Page main
$forgotpwd->Page_Main();
?>
<?php include_once "header.php" ?>
<link rel="stylesheet" type="text/css" href='modules/forgotpwd/css/forgotpwd.css'/>
<script language="JavaScript" type="text/javascript">
    <!--

    // Write your client script here, no need to add script tags.
    //-->

</script>
<script type="text/javascript">
    <!--
    var forgotpwd = new ew_Page("forgotpwd");

    // extend page with ValidateForm function
    forgotpwd.ValidateForm = function (fobj) {
        if (!this.ValidateRequired)
            return true; // ignore validation
        if (!ew_HasValue(fobj.email))
            return ew_OnError(this, fobj.email, ewLanguage.Phrase("EnterValidEmail"));
        if (!ew_CheckEmail(fobj.email.value))
            return ew_OnError(this, fobj.email, ewLanguage.Phrase("EnterValidEmail"));

        // Call Form Custom Validate event
        if (!this.Form_CustomValidate(fobj)) return false;
        return true;
    }

    // extend page with Form_CustomValidate function
    forgotpwd.Form_CustomValidate =
        function (fobj) { // DO NOT CHANGE THIS LINE!

            // Your custom validation code here, return false if invalid.
            return true;
        }

    // requires js validation
    <?php if (EW_CLIENT_VALIDATE) { ?>
    forgotpwd.ValidateRequired = true;
    <?php } else { ?>
    forgotpwd.ValidateRequired = false;
    <?php } ?>

    //-->
</script>

<?php
$forgotpwd->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return forgotpwd.ValidateForm(this);">
    <table border="0" cellspacing="0" cellpadding="4">
        <tr>
            <td><img src="modules/global/img/logo-wide.png" alt=""></td>
            <td>
                <label><?php echo $Language->Phrase("UserEmail") ?></label>
            </td>
            <td>
                <span class="phpmaker"><input type="text" name="email" id="email" value="<?php ew_HtmlEncode($forgotpwd->Email) ?>" size="30" maxlength="250"></span>
            </td>
            <td>
                <p class="phpmaker ewTitle"><?php echo $Language->Phrase("RequestPwdPage") ?></p>
                <p class="phpmaker"><a href="login.php"><?php echo $Language->Phrase("BackToLogin") ?></a></p>
            </td>
        </tr>
        <tr>
            <td>
                <span class="phpmaker button">
                    <button type="submit" name="submit" id="submit" value="<?php echo ew_BtnCaption($Language->Phrase("SendPwd")) ?>">Enviar contraseña</button>
                </span>
            </td>
        </tr>
    </table>
</form>
<br>
<?php
$forgotpwd->ShowPageFooter();
if (EW_DEBUG_ENABLED)
    echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
    <!--

    // Write your startup script here
    // document.write("page loaded");
    //-->


</script>
<?php include_once "footer.php" ?>
<?php
$forgotpwd->Page_Terminate();
?>
<?php

//
// Page class
//
class cforgotpwd
{

    // Page ID
    var $PageID = 'forgotpwd';

    // Page object name
    var $PageObjName = 'forgotpwd';

    // Page name
    function PageName()
    {
        return ew_CurrentPage();
    }

    // Page URL
    function PageUrl()
    {
        $PageUrl = ew_CurrentPage() . "?";
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
        return TRUE;
    }

    //
    // Page class constructor
    //
    function cforgotpwd()
    {
        global $conn, $Language;

        // Language object
        if (!isset($Language)) $Language = new cLanguage();

        // Table object (usuarios)
        if (!isset($GLOBALS["usuarios"])) $GLOBALS["usuarios"] = new cusuarios();

        // Page ID
        if (!defined("EW_PAGE_ID"))
            define("EW_PAGE_ID", 'forgotpwd', TRUE);

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
        global $usuarios;

        // User profile
        $UserProfile = new cUserProfile();
        $UserProfile->LoadProfile(@$_SESSION[EW_SESSION_USER_PROFILE]);

        // Security
        $Security = new cAdvancedSecurity();

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

    var $Email = "";

    //
    // Page main
    //
    function Page_Main()
    {
        global $conn, $Language, $gsFormError, $usuarios;
        if (ew_IsHttpPost()) {
            $bValidEmail = FALSE;
            $bEmailSent = FALSE;

            // Setup variables
            $this->Email = $_POST["email"];
            if ($this->ValidateForm($this->Email)) {

                // Set up filter (SQL WHERE clause) and get Return SQL
                // SQL constructor in usuarios class, usuariosinfo.php

                $sFilter = str_replace("%e", ew_AdjustSql($this->Email), EW_USER_EMAIL_FILTER);
                $usuarios->CurrentFilter = $sFilter;
                $sSql = $usuarios->SQL();
                if ($RsUser = $conn->Execute($sSql)) {
                    if (!$RsUser->EOF) {
                        $rsold = $RsUser->fields;
                        $bValidEmail = TRUE;

                        // Call User Recover Password event
                        $bValidEmail = $this->User_RecoverPassword($rsold);
                        if ($bValidEmail) {
                            $sUserName = $rsold['username'];
                            $sPassword = $rsold['password'];
                            if (EW_ENCRYPTED_PASSWORD) {
                                $sPassword = substr($sPassword, 0, 16); // Use first 16 characters only
                                $rsnew = array('password' => $sPassword); // Reset the password
                                $conn->Execute($usuarios->UpdateSQL($rsnew));
                            }
                        }
                    } else {
                        $this->setFailureMessage($Language->Phrase("InvalidEmail"));
                    }
                    if ($bValidEmail) {
                        $Email = new cEmail();
                        $Email->Load("phptxt/forgotpwd.txt");
                        $Email->ReplaceSender(EW_SENDER_EMAIL); // Replace Sender
                        $Email->ReplaceRecipient($this->Email); // Replace Recipient
                        $Email->ReplaceContent('<!--$UserName-->', $sUserName);
                        $Email->ReplaceContent('<!--$Password-->', $sPassword);
                        $Email->Charset = EW_EMAIL_CHARSET;
                        $Args = array();
                        $Args["rs"] =& $rsnew;
                        if ($this->Email_Sending($Email, $Args))
                            $bEmailSent = $Email->Send();
                    }
                    $RsUser->Close();
                }
                if ($bEmailSent) {
                    $this->setSuccessMessage($Language->Phrase("PwdEmailSent")); // Set success message
                    $this->Page_Terminate("login.php"); // Return to login page
                } elseif ($bValidEmail) {
                    $this->setFailureMessage($Language->Phrase("FailedToSendMail")); // Set up error message
                }
            } else {
                $this->setFailureMessage($gsFormError);
            }
        }
    }

    //
    // Validate form
    //
    function ValidateForm($email)
    {
        global $gsFormError, $Language;

        // Initialize form error message
        $gsFormError = "";

        // Check if validation required
        if (!EW_SERVER_VALIDATE)
            return TRUE;
        if ($email == "") {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterValidEmail"));
        }
        if (!ew_CheckEmail($email)) {
            ew_AddMessage($gsFormError, $Language->Phrase("EnterValidEmail"));
        }

        // Return validate result
        $ValidateForm = ($gsFormError == "");

        // Call Form Custom Validate event
        $sFormCustomError = "";
        $ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
        if ($sFormCustomError <> "") {
            ew_AddMessage($gsFormError, $sFormCustomError);
        }
        return $ValidateForm;
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

    // Email Sending event
    function Email_Sending(&$Email, &$Args)
    {

        //var_dump($Email); var_dump($Args); exit();
        return TRUE;
    }

    // Form Custom Validate event
    function Form_CustomValidate(&$CustomError)
    {

        // Return error message in CustomError
        return TRUE;
    }

    // User RecoverPassword event
    function User_RecoverPassword(&$rs)
    {

        // Return FALSE to abort
        return TRUE;
    }
}

?>
