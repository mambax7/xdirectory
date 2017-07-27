<{if $link.logourl != ""}>
    <br>
    <img src="<{$xoops_url}>/modules/xdirectory/images/shots/<{$link.logourl}>">
    <br>
<{/if}>
<table class="outer" width='100%' cellspacing='1'>
    <!--  <tr>
    <td class="head" colspan='2' align='left' height="18"><{$lang_category}> <{$link.category}></td>
  </tr> -->
    <tr>
        <td class="even" width='60%' align='left' valign="bottom">
            <table width='100%' cellspacing='0' cellpadding="4">
                <tr>
                    <td>
                        <b><{$link.title}></b><br>
                        <{$link.address}><br>
                        <{if $link.address2 != ""}>
                            <{$link.address2}>
                            <br>
                        <{/if}>
                        <{$link.city}>, <{$link.state}> <{$link.zip}><br>
                        <strong><{$lang_phone}></strong><{$link.phone}>
                        <{if $link.fax != ""}>
                            <br>
                            <strong><{$lang_fax}></strong><{$link.fax}>
                        <{/if}>
                        <{if $link.url != ""}>
                            <{if $link.premium == "1"}>
                                <br>
                                <a href='visit.php?cid=<{$link.cid}>&lid=<{$link.id}>' target='_blank'><img src='images/link.gif' border='0' alt='<{$lang_visit}>'><{$link.url}></a>
                            <{/if}>
                        <{/if}>
                    </td>
                    <td class="even" align='right' width='40%'><a href="<{$xoops_url}>/modules/xdirectory/ratelink.php?cid=<{$link.cid}>&lid=<{$link.id}>"><b><{$lang_rating}></b><{$link.rating}> (<{$link.votes}>)</a>
                        <br><br>
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
            </table>
        </td>
    </tr>
    <tr>
        <td class="odd" colspan='2' align='left'><{$link.adminlink}><b><{$lang_description}></b><br>
            <div style="text-align: justify;"><{$link.description}></div>
            <br></td>
    </tr>
    <tr>
        <td class="foot" colspan='2' align='center'><a href="<{$xoops_url}>/modules/xdirectory/ratelink.php?cid=<{$link.cid}>&lid=<{$link.id}>"><{$lang_ratethissite}></a> | <a href="<{$xoops_url}>/modules/xdirectory/modlink.php?lid=<{$link.id}>"><{$lang_modify}></a> | <a target="_top"
                                                                                                                                                                                                                                                                                href="mailto:?subject=<{$link.mail_subject}>&body=<{$link.mail_body}>"><{$lang_tellafriend}></a>
            | <a href="<{$xoops_url}>/modules/xdirectory/singlelink.php?cid=<{$link.cid}>&lid=<{$link.id}>"><{$lang_comments}> (<{$link.comments}>)</a></td>
    </tr>
</table>
<br>
