<?php if (@$gsExport == "") { ?>
    <p></p>
    <!-- right column (end) -->
    <?php if (isset($gTimer)) $gTimer->Stop() ?>
    </td>
    </tr>
    </table>
    <!-- content (end) -->
    <!-- footer (begin) --><!-- *** Note: Only licensed users are allowed to remove or change the following copyright statement. *** -->
    <link rel="stylesheet" type="text/css" href="modules/footer/css/footer.css">
    <div class="ewFooterRow">
        <div class="ewFooterText">
            © BASE16 2017
        </div>
        <!-- Place other links, for example, disclaimer, here -->
    </div>
    <!-- footer (end) -->
    </div>
    <table cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <div id="ewEmailDialog" class="phpmaker">
                    <?php include_once "ewemail8.php" ?>
                </div>
            </td>
        </tr>
    </table>
    <div class="yui-tt" id="ewTooltipDiv" style="visibility: hidden; border: 0px;" name="ewTooltipDivDiv"></div>
<?php } ?>
<script type="text/javascript">
    <!--
    <?php if (@$gsExport == "" || @$gsExport == "print") { ?>
    ewDom.getElementsByClassName(EW_TABLE_CLASS, "TABLE", null, ew_SetupTable); // init the table
    ewDom.getElementsByClassName(EW_GRID_CLASS, "TABLE", null, ew_SetupGrid); // init grids
    <?php } ?>
    <?php if (@$gsExport == "") { ?>
    ew_InitEmailDialog(); // Init the email dialog
    ew_InitTooltipDiv(); // init tooltip div
    <?php } ?>

    //-->
</script>
<?php if (@$gsExport == "") { ?>
    <script language="JavaScript" type="text/javascript">

        /*
        $(function() {
            window.parent.resizeiFrame();
        });
        */
    </script>
<?php } ?>
</body>
</html>
