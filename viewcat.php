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
$mytree = new XoopsTree($xoopsDB->prefix('xdir_cat'), 'cid', 'pid');

$cid                                     = (int)$_GET['cid'];
$GLOBALS['xoopsOption']['template_main'] = 'xdir_viewcat.tpl';
include XOOPS_ROOT_PATH . '/header.php';

if (isset($_GET['show'])) {
    $show = (int)$_GET['show'];
} else {
    $show = $xoopsModuleConfig['perpage'];
}
$min = isset($_GET['min']) ? (int)$_GET['min'] : 0;
if (!isset($max)) {
    $max = $min + $show;
}
if (isset($_GET['orderby'])) {
    $orderby = convertorderbyin($_GET['orderby']);
} else {
    $orderby = 'title ASC';
}

$pathstring = "<a href='index.php'>" . _MD_MAIN . '</a> : ';
$pathstring .= $mytree->getNicePathFromId($cid, 'title', 'viewcat.php?op=');
$xoopsTpl->assign('category_path', $pathstring);
$xoopsTpl->assign('category_id', $cid);
// get child category objects
$arr = [];
$arr = $mytree->getFirstChild($cid, 'title');
if (count($arr) > 0) {
    $scount = 1;
    foreach ($arr as $ele) {
        $sub_arr         = [];
        $sub_arr         = $mytree->getFirstChild($ele['cid'], 'title');
        $space           = 0;
        $chcount         = 0;
        $infercategories = '';
        foreach ($sub_arr as $sub_ele) {
            $chtitle = $myts->htmlSpecialChars($sub_ele['title']);
            if ($chcount > 5) {
                $infercategories .= '...';
                break;
            }
            if ($space > 0) {
                $infercategories .= ', ';
            }
            $infercategories .= "<a href=\"" . XOOPS_URL . '/modules/xdirectory/viewcat.php?cid=' . $sub_ele['cid'] . "\">" . $chtitle . '</a>';
            $space++;
            $chcount++;
        }
        $xoopsTpl->append('subcategories', [
            'title'           => $myts->htmlSpecialChars($ele['title']),
            'id'              => $ele['cid'],
            'infercategories' => $infercategories,
            'totallinks'      => getTotalItems($ele['cid'], 1),
            'count'           => $scount
        ]);
        $scount++;
    }
}

if (1 == $xoopsModuleConfig['useshots']) {
    $xoopsTpl->assign('shotwidth', $xoopsModuleConfig['shotwidth']);
    $xoopsTpl->assign('tablewidth', $xoopsModuleConfig['shotwidth'] + 10);
    $xoopsTpl->assign('show_screenshot', true);
    $xoopsTpl->assign('lang_noscreenshot', _MD_NOSHOTS);
}

if (!empty($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid())) {
    $isadmin = true;
} else {
    $isadmin = false;
}
$fullcountresult = $xoopsDB->query('select count(*) from ' . $xoopsDB->prefix('xdir_links') . " where cid=$cid and status>0");
list($numrows) = $xoopsDB->fetchRow($fullcountresult);
$page_nav = '';
if ($numrows > 0) {
    $xoopsTpl->assign('lang_description', _MD_DESCRIPTIONC);
    $xoopsTpl->assign('lang_lastupdate', _MD_LASTUPDATEC);
    $xoopsTpl->assign('lang_hits', _MD_HITSC);
    $xoopsTpl->assign('lang_rating', _MD_RATINGC);
    $xoopsTpl->assign('lang_ratethissite', _MD_RATETHISSITE);
    $xoopsTpl->assign('lang_reportbroken', _MD_REPORTBROKEN);
    $xoopsTpl->assign('lang_tellafriend', _MD_TELLAFRIEND);
    $xoopsTpl->assign('lang_modify', _MD_MODIFY);
    $xoopsTpl->assign('lang_category', _MD_CATEGORYC);
    $xoopsTpl->assign('lang_visit', _MD_VISIT);
    $xoopsTpl->assign('show_links', true);
    $xoopsTpl->assign('lang_comments', _COMMENTS);
    $xoopsTpl->assign('lang_phone', _MD_BUSPHONE);
    $xoopsTpl->assign('lang_fax', _MD_BUSFAX);
    $xoopsTpl->assign('lang_email', _MD_BUSEMAIL);
    $xoopsTpl->assign('lang_url', _MD_SITEURL);

    $sql    = 'select l.lid, l.cid, l.title, l.address, l.address2, l.city, l.state, l.zip, l.country, l.phone, l.fax, l.email, l.url, l.logourl, l.status, l.date, l.hits, l.rating, l.votes, l.comments, l.premium, t.description from '
              . $xoopsDB->prefix('xdir_links')
              . ' l, '
              . $xoopsDB->prefix('xdir_text')
              . " t where cid=$cid and l.lid=t.lid and status>0 order by $orderby";
    $result = $xoopsDB->query($sql, $show, $min);

    //if 2 or more items in result, show the sort menu
    if ($numrows > 1) {
        $xoopsTpl->assign('show_nav', true);
        $orderbyTrans = convertorderbytrans($orderby);
        $xoopsTpl->assign('lang_sortby', _MD_SORTBY);
        $xoopsTpl->assign('lang_title', _MD_TITLE);
        $xoopsTpl->assign('lang_titleatoz', _MD_TITLEATOZ);
        $xoopsTpl->assign('lang_titleztoa', _MD_TITLEZTOA);
        $xoopsTpl->assign('lang_date', _MD_DATE);
        $xoopsTpl->assign('lang_dateold', _MD_DATEOLD);
        $xoopsTpl->assign('lang_datenew', _MD_DATENEW);
        $xoopsTpl->assign('lang_rating', _MD_RATING);
        $xoopsTpl->assign('lang_ratinglow', _MD_RATINGLTOH);
        $xoopsTpl->assign('lang_ratinghigh', _MD_RATINGHTOL);
        $xoopsTpl->assign('lang_popularity', _MD_POPULARITY);
        $xoopsTpl->assign('lang_popularityleast', _MD_POPULARITYLTOM);
        $xoopsTpl->assign('lang_popularitymost', _MD_POPULARITYMTOL);
        $xoopsTpl->assign('lang_cursortedby', sprintf(_MD_CURSORTEDBY, convertorderbytrans($orderby)));
    }
    while (list($lid, $cid, $ltitle, $address, $address2, $city, $state, $zip, $country, $phone, $fax, $email, $url, $logourl, $status, $time, $hits, $rating, $votes, $comments, $premium, $description) = $xoopsDB->fetchRow($result)) {
        //			$result2 = $xoopsDB->query("select lid, cid, title, address, address2, city, state, zip, country, phone, fax, email, url, logourl, submitter, status, date, hits, rating, votes, comments from ".$xoopsDB->prefix("xdir_links")." where cid=$cid and premium==1");
        $result2 = $xoopsDB->query('select l.lid, l.cid, l.title, l.address, l.address2, l.city, l.state, l.zip, l.country, l.phone, l.fax, l.email, l.url, l.logourl, l.status, l.date, l.hits, l.rating, l.votes, l.comments, l.premium, t.description from '
                                   . $xoopsDB->prefix('xdir_links')
                                   . ' l, '
                                   . $xoopsDB->prefix('xdir_text')
                                   . " t where cid=$cid and l.lid=t.lid and status>0 order by $orderby");
        list($premlid, $premcid, $premtitle, $premaddress, $premaddress2, $premcity, $premstate, $premzip, $premcountry, $premphone, $premfax, $prememail, $premurl, $premlogourl, $premstatus, $premdate, $premhits, $premrating, $premvotes, $premcomments, $premdescription) = $xoopsDB->fetchRow($result2);
        //			$result2 = $xoopsDB->query("select description from ".$xoopsDB->prefix("xdir_text")." where lid=$lid");
        //			list($origdescription) = $xoopsDB->fetchRow($result2);
        if ($isadmin) {
            $adminlink = '<a href="' . XOOPS_URL . '/modules/xdirectory/admin/?op=modLink&lid=' . $lid . '"><img src="' . XOOPS_URL . '/modules/xdirectory/images/editicon.gif" border="0" alt="' . _MD_EDITTHISLINK . '"></a>';
        } else {
            $adminlink = '';
        }
        if (1 == $votes) {
            $votestring = _MD_ONEVOTE;
        } else {
            $votestring = sprintf(_MD_NUMVOTES, $votes);
        }
        $path = $mytree->getPathFromId($cid, 'title');
        $path = substr($path, 1);
        $path = str_replace('/', " <img src='" . XOOPS_URL . "/modules/xdirectory/images/arrow.gif' board='0' alt=''> ", $path);
        $new  = newlinkgraphic($time, $status);
        $pop  = popgraphic($hits);
        $xoopsTpl->append('links', [
            'id'           => $lid,
            'cid'          => $cid,
            'url'          => $url,
            'rating'       => number_format($rating, 2),
            'title'        => $myts->htmlSpecialChars($ltitle) . $new . $pop,
            'address'      => $myts->htmlSpecialChars($address),
            'address2'     => $myts->htmlSpecialChars($address2),
            'city'         => $myts->htmlSpecialChars($city),
            'state'        => $myts->htmlSpecialChars($state),
            'zip'          => $myts->htmlSpecialChars($zip),
            'country'      => $myts->htmlSpecialChars($country),
            'phone'        => $myts->htmlSpecialChars($phone),
            'fax'          => $myts->htmlSpecialChars($fax),
            'email'        => $myts->htmlSpecialChars($email),
            'category'     => $path,
            'logourl'      => $myts->htmlSpecialChars($logourl),
            'updated'      => formatTimestamp($time, 'm'),
            'description'  => $myts->displayTarea($description, 0),
            'adminlink'    => $adminlink,
            'hits'         => $hits,
            'comments'     => $comments,
            'premium'      => $premium,
            'votes'        => $votestring,
            'mail_subject' => rawurlencode(sprintf(_MD_INTRESTLINK, $xoopsConfig['sitename'])),
            'mail_body'    => rawurlencode(sprintf(_MD_INTLINKFOUND, $xoopsConfig['sitename']) . ':  ' . XOOPS_URL . '/modules/xdirectory/singlelink.php?cid=' . $cid . '&lid=' . $lid)
        ]);
    }
    $orderby = convertorderbyout($orderby);
    //Calculates how many pages exist.  Which page one should be on, etc...
    $linkpages = ceil($numrows / $show);
    //Page Numbering
    if (1 != $linkpages && 0 != $linkpages) {
        $cid  = (int)$_GET['cid'];
        $prev = $min - $show;
        if ($prev >= 0) {
            $page_nav .= "<a href='viewcat.php?cid=$cid&min=$prev&orderby=$orderby&show=$show'><b><u>�</u></b></a> ";
        }
        $counter     = 1;
        $currentpage = ($max / $show);
        while ($counter <= $linkpages) {
            $mintemp = ($show * $counter) - $show;
            if ($counter == $currentpage) {
                $page_nav .= "<b>($counter)</b> ";
            } else {
                $page_nav .= "<a href='viewcat.php?cid=$cid&min=$mintemp&orderby=$orderby&show=$show'>$counter</a> ";
            }
            $counter++;
        }
        if ($numrows > $max) {
            $page_nav .= "<a href='viewcat.php?cid=$cid&min=$max&orderby=$orderby&show=$show'>";
            $page_nav .= '<b><u>�</u></b></a>';
        }
    }
}
$xoopsTpl->assign('page_nav', $page_nav);
include XOOPS_ROOT_PATH . '/footer.php';
