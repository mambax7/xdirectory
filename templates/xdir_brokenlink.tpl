<br><br>

<p align="center">
    <!--    <a href="<{$xoops_url}>/modules/xdirectory/index.php"><img src="<{$xoops_url}>/modules/xdirectory/images/logo.gif" border="0" alt=""></a> -->

    <font size="4"><strong>Business Directory</strong></font>

</p>

<div>
    <h4><{$lang_reportbroken}></h4>
    <form action="brokenlink.php" method="POST">
        <{securityToken}><{*//mb*}>
        <input type="hidden" name="lid" value="<{$link_id}>"><{$lang_thanksforhelp}><br><{$lang_forsecurity}><br><br><input type="submit" name="submit" value="<{$lang_reportbroken}>"> <input type=button value="<{$lang_cancel}>" onclick="javascript:history.go(-1)">
    </form>
</div>

<br>
