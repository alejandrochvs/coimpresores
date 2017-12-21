<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "yuimenubar yuimenubarnav", TRUE);
define("EW_MENUBAR_ITEM_CLASSNAME", "yuimenubaritem", TRUE);
define("EW_MENUBAR_ITEM_LABEL_CLASSNAME", "yuimenubaritemlabel", TRUE);
define("EW_MENU_CLASSNAME", "yuimenu", TRUE);
define("EW_MENU_ITEM_CLASSNAME", "yuimenuitem", TRUE); // Vertical
define("EW_MENU_ITEM_LABEL_CLASSNAME", "yuimenuitemlabel", TRUE); // Vertical
?>
<?php

// Menu Rendering event
function Menu_Rendering(&$Menu) {

	// Change menu items here
}

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<link rel="stylesheet" href="modules/ewmenu/css/ewmenu.css" type="text/css" />
<!-- Begin Main Menu -->
<div class="main-menu">
    <div class="span">
        <img src="modules/global/img/logo.png" style="max-height: 30px; width: auto;" alt="">
    </div>
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(2, $Language->MenuPhrase("2", "MenuText"), "documento_contablelist.php", -1, "", AllowListMenu('documento_contable'), FALSE);
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "historial_pagoslist.php", -1, "", AllowListMenu('historial_pagos'), FALSE);
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(5, $Language->MenuPhrase("5", "MenuText"), "usuarioslist.php", 6, "", AllowListMenu('usuarios'), FALSE);
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "niveleslist.php", 6, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE);
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "auditorialist.php", 6, "", AllowListMenu('auditoria'), FALSE);
$RootMenu->AddMenuItem(8, $Language->MenuPhrase("8", "MenuText"), "pagos_onlinelist.php", -1, "", AllowListMenu('pagos_online'), FALSE);
$RootMenu->AddMenuItem(-2, $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
<script type="text/javascript">
<!--

// init the menu
var RootMenu = new YAHOO.widget.MenuBar("RootMenu", { autosubmenudisplay: true, hidedelay: 750, lazyload: true });
RootMenu.render();        

//-->
</script>
