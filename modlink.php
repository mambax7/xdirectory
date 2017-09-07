<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    {@link https://xoops.org/ XOOPS Project}
 * @license      {@link http://www.gnu.org/licenses/gpl-2.0.html GNU GPL 2 or later}
 * @package
 * @since
 * @author       XOOPS Development Team
 * @author       Adam Frick, africk69@yahoo.com (based on mylinks module)
 */

include __DIR__ . '/header.php';
$myts = MyTextSanitizer::getInstance(); // MyTextSanitizer object
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';
require_once XOOPS_ROOT_PATH . '/class/module.errorhandler.php';
$mytree = new XoopsTree($xoopsDB->prefix('xdir_cat'), 'cid', 'pid');

if (!empty($_POST['submit'])) {
    $eh = new ErrorHandler; //ErrorHandler object
    if (empty($xoopsUser)) {
        redirect_header(XOOPS_URL . '/user.php', 2, _MD_MUSTREGFIRST);
    } else {
        $user = $xoopsUser->getVar('uid');
    }
    $lid = (int)$_POST['lid'];

    // Check if Title exist
    if ($_POST['title'] == '') {
        $eh->show('1001');
    }

    // Check if URL exist
    //if ($_POST["url"]=="") {
    //$eh->show("1016");
    //}

    // Check if Description exist
    if ($_POST['description'] == '') {
        $eh->show('1008');
    }

    $url         = $myts->makeTboxData4Save($_POST['url']);
    $logourl     = $myts->makeTboxData4Save($_POST['logourl']);
    $cid         = (int)$_POST['cid'];
    $title       = $myts->makeTboxData4Save($_POST['title']);
    $description = $myts->makeTareaData4Save($_POST['description']);
    $newid       = $xoopsDB->genId($xoopsDB->prefix('xdir_mod') . '_requestid_seq');
    $sql         = sprintf(
        "INSERT INTO %s (requestid, lid, cid, title, address, address2, city, state, zip, country, phone, fax, email, url, logourl, description, modifysubmitter) VALUES (%u, %u, %u, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %u)",
                           $xoopsDB->prefix('xdir_mod'),
        $newid,
        $lid,
        $cid,
        $title,
        $address,
        $address2,
        $city,
        $state,
        $zip,
        $country,
        $phone,
        $fax,
        $email,
        $url,
        $logourl,
        $description,
        $user
    );
    $xoopsDB->query($sql) || $eh->show('0013');
    $tags                      = [];
    $tags['MODIFYREPORTS_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/admin/index.php?op=listModReq';
    $notificationHandler       = xoops_getHandler('notification');
    $notificationHandler->triggerEvent('global', 0, 'link_modify', $tags);
    redirect_header('index.php', 2, _MD_THANKSFORINFO);
} else {
    $lid = (int)$_GET['lid'];
    if (empty($xoopsUser)) {
        redirect_header(XOOPS_URL . '/user.php', 2, _MD_MUSTREGFIRST);
    }
    $GLOBALS['xoopsOption']['template_main'] = 'xdir_modlink.tpl';
    include XOOPS_ROOT_PATH . '/header.php';
    $result = $xoopsDB->query('select cid, title, address, address2, city, state, zip, country, phone, fax, email, url, logourl from ' . $xoopsDB->prefix('xdir_links') . " where lid=$lid and status>0");
    $xoopsTpl->assign('lang_requestmod', _MD_REQUESTMOD);
    list($cid, $title, $address, $address2, $city, $state, $zip, $country, $phone, $fax, $email, $url, $logourl) = $xoopsDB->fetchRow($result);
    $result2 = $xoopsDB->query('SELECT description FROM ' . $xoopsDB->prefix('xdir_text') . " WHERE lid=$lid");
    list($description) = $xoopsDB->fetchRow($result2);
    $xoopsTpl->assign('link', [
        'id'          => $lid,
        'rating'      => number_format($rating, 2),
        'title'       => $myts->htmlSpecialChars($title),
        'address'     => $myts->htmlSpecialChars($address),
        'address2'    => $myts->htmlSpecialChars($address2),
        'city'        => $myts->htmlSpecialChars($city),
        'state'       => $myts->htmlSpecialChars($state),
        'zip'         => $myts->htmlSpecialChars($zip),
        'country'     => $myts->htmlSpecialChars($country),
        'phone'       => $myts->htmlSpecialChars($phone),
        'fax'         => $myts->htmlSpecialChars($fax),
        'email'       => $myts->htmlSpecialChars($email),
        'url'         => $myts->htmlSpecialChars($url),
        '$logourl'    => $myts->htmlSpecialChars($logourl),
        'updated'     => formatTimestamp($time, 'm'),
        'description' => $myts->htmlSpecialChars($description),
        'adminlink'   => $adminlink,
        'hits'        => $hits,
        'votes'       => $votestring
    ]);
    $xoopsTpl->assign('lang_linkid', _MD_LINKID);
    $xoopsTpl->assign('lang_sitetitle', _MD_SITETITLE);
    $xoopsTpl->assign('lang_siteaddress', _MD_BUSADDRESS);
    $xoopsTpl->assign('lang_siteaddress2', _MD_BUSADDRESS2);
    $xoopsTpl->assign('lang_sitecity', _MD_BUSCITY);
    $xoopsTpl->assign('lang_sitestate', _MD_BUSSTATE);
    $xoopsTpl->assign('lang_sitezip', _MD_BUSZIP);
    $xoopsTpl->assign('lang_country', _MD_BUSCOUNTRY);
    $xoopsTpl->assign('lang_sitephone', _MD_BUSPHONE);
    $xoopsTpl->assign('lang_fax', _MD_BUSFAX);
    $xoopsTpl->assign('lang_email', _MD_BUSEMAIL);
    $xoopsTpl->assign('lang_siteurl', _MD_SITEURL);
    $xoopsTpl->assign('lang_category', _MD_CATEGORYC);
    ob_start();
    $mytree->makeMySelBox('title', 'title', $cid);
    $selbox = ob_get_contents();
    ob_end_clean();
    $xoopsTpl->assign('category_selbox', $selbox);
    $xoopsTpl->assign('lang_description', _MD_DESCRIPTIONC);
    $xoopsTpl->assign('lang_sendrequest', _MD_SENDREQUEST);
    $xoopsTpl->assign('lang_cancel', _CANCEL);
    include XOOPS_ROOT_PATH . '/footer.php';
}