<br><br>

<p align="center">

    <font size="4"><strong>Business Directory</strong></font>

</p>

<h4><{$lang_requestmod}></h4>
<form action="modlink.php" method="post">
    <{securityToken}><{*//mb*}>
    <table width="80%">
        <tr>
            <td align="right"><{$lang_linkid}></td>
            <td><b><{$link.id}></b></td>
        </tr>
        <tr>
            <td align="right"><{$lang_sitetitle}></td>
            <td><input type="text" name="title" size="50" maxlength="100" value="<{$link.title}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_siteaddress}></td>
            <td><input type="text" name="address" size="50" maxlength="100" value="<{$link.address}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_siteaddress2}></td>
            <td><input type="text" name="address2" size="50" maxlength="100" value="<{$link.address2}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_sitecity}></td>
            <td><input type="text" name="city" size="50" maxlength="100" value="<{$link.city}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_sitestate}></td>
            <td><input type="text" name="state" size="50" maxlength="100" value="<{$link.state}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_sitezip}></td>
            <td><input type="text" name="zip" size="50" maxlength="100" value="<{$link.zip}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_country}></td>
            <td><input type="text" name="country" size="50" maxlength="100" value="<{$link.country}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_sitephone}></td>
            <td><input type="text" name="phone" size="50" maxlength="100" value="<{$link.phone}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_fax}></td>
            <td><input type="text" name="fax" size="50" maxlength="100" value="<{$link.fax}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_email}></td>
            <td><input type="text" name="email" size="50" maxlength="100" value="<{$link.email}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_siteurl}></td>
            <td><input type="text" name="url" size="50" maxlength="100" value="<{$link.url}>"></td>
        </tr>
        <tr>
            <td align="right"><{$lang_category}></td>
            <td><{$category_selbox}></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td align="right" valign="top"><{$lang_description}></td>
            <td><textarea name=description cols=60 rows=5><{$link.description}></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><br><input type="hidden" name="logourl" value="<{$link.logourl}>"></input><input type="hidden" name="lid" value="<{$link.id}>"></input><input type="submit" name="submit" value="<{$lang_sendrequest}>"></input> <input type=button value="<{$lang_cancel}>"
                                                                                                                                                                                                                                                                   onclick="javascript:history.go(-1)"></input>
            </td>
        </tr>
    </table>
</form>

