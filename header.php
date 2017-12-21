<?php

// Compatibility with PHP Report Maker
if (!isset($Language)) {
	include_once "ewcfg8.php";
	include_once "ewshared8.php";
	$Language = new cLanguage();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

	<title><?php echo $Language->ProjectPhrase("BodyTitle") ?></title>
<?php if (@$gsExport == "") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo ew_YuiHost() ?>build/menu/assets/skins/sam/menu.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="phpcss/ewmenu.css">
<link rel="stylesheet" type="text/css" href="<?php echo ew_YuiHost() ?>build/button/assets/skins/sam/button.css">
<link rel="stylesheet" type="text/css" href="<?php echo ew_YuiHost() ?>build/container/assets/skins/sam/container.css">
<link rel="stylesheet" type="text/css" href="<?php echo ew_YuiHost() ?>build/resize/assets/skins/sam/resize.css">
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo EW_PROJECT_STYLESHEET_FILENAME ?>">
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/utilities/utilities.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/button/button-min.js"></script>
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/container/container-min.js"></script>
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/resize/resize-min.js"></script>
<script type="text/javascript" src="<?php echo ew_YuiHost() ?>build/menu/menu.js"></script>
<script type="text/javascript">
<!--
var EW_LANGUAGE_ID = "<?php echo $gsLanguage ?>";
var EW_DATE_SEPARATOR = "/"; 
if (EW_DATE_SEPARATOR == "") EW_DATE_SEPARATOR = "/"; // Default date separator
var EW_UPLOAD_ALLOWED_FILE_EXT = "gif,jpg,jpeg,bmp,png,doc,xls,pdf,zip"; // Allowed upload file extension
var EW_FIELD_SEP = ", "; // Default field separator

// Ajax settings
var EW_RECORD_DELIMITER = "\r";
var EW_FIELD_DELIMITER = "|";
var EW_LOOKUP_FILE_NAME = "ewlookup8.php"; // Lookup file name
var EW_AUTO_SUGGEST_MAX_ENTRIES = <?php echo EW_AUTO_SUGGEST_MAX_ENTRIES ?>; // Auto-Suggest max entries

// Common JavaScript messages
var EW_ADDOPT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("AddBtn"))) ?>";
var EW_EMAIL_EXPORT_BUTTON_SUBMIT_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("SendEmailBtn"))) ?>";
var EW_BUTTON_CANCEL_TEXT = "<?php echo ew_JsEncode2(ew_BtnCaption($Language->Phrase("CancelBtn"))) ?>";
var ewTooltipDiv;
var ew_TooltipTimer = null;
var EW_MAX_EMAIL_RECIPIENT = <?php echo EW_MAX_EMAIL_RECIPIENT ?>;

//-->
</script>
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
<script type="text/javascript" src="phpjs/ewp8.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="phpjs/userfn8.js"></script>
<script type="text/javascript">
<!--
<?php echo $Language->ToJSON() ?>

//-->
</script>
<?php
?>
<script type="text/javascript" src="jquery-1.9.1.js"></script>
<script type="text/javascript" src="jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" src="jquery.cookie.js"></script>
<script type="text/javascript" src="globalize.js"></script>
<script type="text/javascript" src="globalize.culture.es-CO.js"></script>
<script type="text/javascript" src="pa_pagos.js"></script>
<link rel="stylesheet" type="text/css" href="pa_pagos.css">
<link rel="stylesheet" type="text/css" href="pa_coimpresores/jquery-ui-1.10.2.custom.min.css">
<?php

?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="generator" content="PHPMaker v8.0.2">
</head>
<body class="yui-skin-sam">
<?php if (@$gsExport == "") { ?>
<div class="ewLayout">
	<!-- header (begin) --><!-- *** Note: Only licensed users are allowed to change the logo *** -->
  <div class="ewHeaderRow"><img src="phpimages/pagos_en_linea_corto.png" alt="" border="0"></div>
	<!-- header (end) -->
<div class="ewMenuRow">
<?php include_once "ewmenu.php" ?>
</div>
	<!-- content (begin) -->
  <table cellspacing="0" class="ewContentTable">
		<tr>
	    <td class="ewContentColumn">
			<!-- right column (begin) -->
				<p class="phpmaker ewTitle"><b><?php echo $Language->ProjectPhrase("BodyTitle") ?></b></p>
<?php } ?>
