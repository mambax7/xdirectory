<{if $link.premium >= "4"}>
    <table width='100%' cellspacing='1' align='center'>
        <tr>
            <td width='70%' align='left' valign="bottom">
                <{$link.adminlink}><a href="<{$xoops_url}>/modules/xdirectory/singlelink.php?cid=<{$link.cid}>&lid=<{$link.id}>"><b><{$link.title}></b></a> (<{$lang_category}> <{$link.category}>)<br>
                <{$link.address}><br>
                <{if $link.address2 != ""}>
                    <{$link.address2}>
                    <br>
                <{/if}>
                <{$link.city}>, <{$link.state}> <{$link.zip}><br>
                <strong><{$lang_phone}></strong><{$link.phone}><br>
                <{if $link.fax != ""}>
                    <strong><{$lang_fax}></strong><{$link.fax}>
                    <br>
                <{/if}>
                <{if $link.premium == "5"}>
                    <{if $link.url != ""}>
                        <a href='visit.php?cid=<{$link.cid}>&lid=<{$link.id}>' target='_blank'><img src='images/link.gif' border='0' alt='<{$lang_visit}>'><{$link.url}></a>
                        <br>
                    <{/if}>
                <{/if}>
            </td>
            <td align='right' width='30%'><a href="<{$xoops_url}>/modules/xdirectory/ratelink.php?cid=<{$link.cid}>&lid=<{$link.id}>"><b><{$lang_rating}></b><{$link.rating}> (<{$link.votes}>)</a>
                <br>
                <table border=0>
                    <tr>
                        <{if $link.email != ""}>
                            <td>
                                <form name=email action='<{$xoops_url}>/modules/xdirectory/contact.php' method=get>
                                    <input type='hidden' name='lid' value='<{$link.id}>'>
                                    <input type=submit value='Email'>
                                </form>
                            </td>
                        <{/if}>
                        <td>
                            <form name=mapForm2 action="http://us.rd.yahoo.com/maps/home/submit_a/*-http://maps.yahoo.com/maps" target="_new" method=get>
                                <{securityToken}><{*//mb*}>
                                <input type="hidden" name="addr" value="<{$link.address}>">
                                <input type="hidden" name="csz" value="<{$link.city}>, <{$link.state}> <{$link.zip}>">
                                <input type="hidden" name="country" value="us">
                                <input type=hidden name=srchtype value=a>
                                <input type=submit name="getmap" value="Map">
                            </form>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td colspan="2"><a href="<{$xoops_url}>/modules/xdirectory/ratelink.php?cid=<{$link.cid}>&lid=<{$link.id}>"><{$lang_ratethissite}></a> | <a href="<{$xoops_url}>/modules/xdirectory/modlink.php?lid=<{$link.id}>"><{$lang_modify}></a> | <a target="_top"
                                                                                                                                                                                                                                                        href="mailto:?subject=<{$link.mail_subject}>&body=<{$link.mail_body}>"><{$lang_tellafriend}></a>
                | <a href="<{$xoops_url}>/modules/xdirectory/singlelink.php?cid=<{$link.cid}>&lid=<{$link.id}>"><{$lang_comments}> (<{$link.comments}>)</a></td>
        </tr>
    </table>
    <br>
<{/if}>
