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

if (!empty($_POST['submit'])) {
    if (empty($xoopsUser)) {
        $sender = 0;
    } else {
        $sender = $xoopsUser->getVar('uid');
    }
    $lid = (int)$_POST['lid'];
    $ip  = getenv('REMOTE_ADDR');
    if (0 != $sender) {
        // Check if REG user is trying to report twice.
        $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('xdir_broken') . ' WHERE lid=' . $lid . ' AND sender=' . $sender . '');
        list($count) = $xoopsDB->fetchRow($result);
        if ($count > 0) {
            redirect_header('index.php', 2, _MD_ALREADYREPORTED);
        }
    } else {
        // Check if the sender is trying to vote more than once.
        $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('xdir_broken') . " WHERE lid=$lid AND ip = '$ip'");
        list($count) = $xoopsDB->fetchRow($result);
        if ($count > 0) {
            redirect_header('index.php', 2, _MD_ALREADYREPORTED);
        }
    }
    $newid = $xoopsDB->genId($xoopsDB->prefix('xdir_broken') . '_reportid_seq');
    $sql   = sprintf("INSERT INTO %s (reportid, lid, sender, ip) VALUES (%u, %u, %u, '%s')", $xoopsDB->prefix('xdir_broken'), $newid, $lid, $sender, $ip);
    $xoopsDB->query($sql) or exit();
    $tags                      = [];
    $tags['BROKENREPORTS_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/admin/index.php?op=listBrokenLinks';
    $notificationHandler       = xoops_getHandler('notification');
    $notificationHandler->triggerEvent('global', 0, 'link_broken', $tags);
    redirect_header('index.php', 2, _MD_THANKSFORINFO);
} else {
    $GLOBALS['xoopsOption']['template_main'] = 'xdir_brokenlink.tpl';
    include XOOPS_ROOT_PATH . '/header.php';
    $xoopsTpl->assign('lang_reportbroken', _MD_REPORTBROKEN);
    $xoopsTpl->assign('link_id', (int)$_GET['lid']);
    $xoopsTpl->assign('lang_thanksforhelp', _MD_THANKSFORHELP);
    $xoopsTpl->assign('lang_forsecurity', _MD_FORSECURITY);
    $xoopsTpl->assign('lang_cancel', _MD_CANCEL);
    require_once XOOPS_ROOT_PATH . '/footer.php';
}
