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

function newlinkgraphic($time, $status)
{
    $count     = 7;
    $new       = '';
    $startdate = (time() - (86400 * $count));
    if ($startdate < $time) {
        if (1 == $status) {
            $new = "&nbsp;<img src=\"" . XOOPS_URL . "/modules/xdirectory/images/newred.gif\" alt=\"" . _MD_NEWTHISWEEK . "\">";
        } elseif (2 == $status) {
            $new = "&nbsp;<img src=\"" . XOOPS_URL . "/modules/xdirectory/images/update.gif\" alt=\"" . _MD_UPTHISWEEK . "\">";
        }
    }

    return $new;
}

function popgraphic($hits)
{
    global $xoopsModuleConfig;
    if ($hits >= $xoopsModuleConfig['popular']) {
        return "&nbsp;<img src=\"" . XOOPS_URL . "/modules/xdirectory/images/pop.gif\" alt=\"" . _MD_POPULAR . "\">";
    }

    return '';
}

//Reusable Link Sorting Functions
function convertorderbyin($orderby)
{
    switch (trim($orderby)) {
        case 'titleA':
            $orderby = 'title ASC';
            break;
        case 'dateA':
            $orderby = 'date ASC';
            break;
        case 'hitsA':
            $orderby = 'hits ASC';
            break;
        case 'ratingA':
            $orderby = 'rating ASC';
            break;
        case 'titleD':
            $orderby = 'title DESC';
            break;
        case 'hitsD':
            $orderby = 'hits DESC';
            break;
        case 'ratingD':
            $orderby = 'rating DESC';
            break;
        case'dateD':
        default:
            $orderby = 'date DESC';
            break;
    }

    return $orderby;
}

function convertorderbytrans($orderby)
{
    if ('hits ASC' == $orderby) {
        $orderbyTrans = '' . _MD_POPULARITYLTOM . '';
    }
    if ('hits DESC' == $orderby) {
        $orderbyTrans = '' . _MD_POPULARITYMTOL . '';
    }
    if ('title ASC' == $orderby) {
        $orderbyTrans = '' . _MD_TITLEATOZ . '';
    }
    if ('title DESC' == $orderby) {
        $orderbyTrans = '' . _MD_TITLEZTOA . '';
    }
    if ('date ASC' == $orderby) {
        $orderbyTrans = '' . _MD_DATEOLD . '';
    }
    if ('date DESC' == $orderby) {
        $orderbyTrans = '' . _MD_DATENEW . '';
    }
    if ('rating ASC' == $orderby) {
        $orderbyTrans = '' . _MD_RATINGLTOH . '';
    }
    if ('rating DESC' == $orderby) {
        $orderbyTrans = '' . _MD_RATINGHTOL . '';
    }

    return $orderbyTrans;
}

function convertorderbyout($orderby)
{
    if ('title ASC' == $orderby) {
        $orderby = 'titleA';
    }
    if ('date ASC' == $orderby) {
        $orderby = 'dateA';
    }
    if ('hits ASC' == $orderby) {
        $orderby = 'hitsA';
    }
    if ('rating ASC' == $orderby) {
        $orderby = 'ratingA';
    }
    if ('title DESC' == $orderby) {
        $orderby = 'titleD';
    }
    if ('date DESC' == $orderby) {
        $orderby = 'dateD';
    }
    if ('hits DESC' == $orderby) {
        $orderby = 'hitsD';
    }
    if ('rating DESC' == $orderby) {
        $orderby = 'ratingD';
    }

    return $orderby;
}

//updates rating data in itemtable for a given item
function updaterating($sel_id)
{
    global $xoopsDB;
    $query = 'SELECT rating FROM ' . $xoopsDB->prefix('xdir_votedata') . ' WHERE lid = ' . $sel_id . '';
    //echo $query;
    $voteresult  = $xoopsDB->query($query);
    $votesDB     = $xoopsDB->getRowsNum($voteresult);
    $totalrating = 0;
    while (list($rating) = $xoopsDB->fetchRow($voteresult)) {
        $totalrating += $rating;
    }
    $finalrating = $totalrating / $votesDB;
    $finalrating = number_format($finalrating, 4);
    $query       = 'UPDATE ' . $xoopsDB->prefix('xdir_links') . " SET rating=$finalrating, votes=$votesDB WHERE lid = $sel_id";
    //echo $query;
    $xoopsDB->query($query) or exit();
}

//returns the total number of items in items table that are accociated with a given table $table id
function getTotalItems($sel_id, $status = '')
{
    global $xoopsDB, $mytree;
    $count = 0;
    $arr   = [];
    $query = 'SELECT count(*) FROM ' . $xoopsDB->prefix('xdir_links') . ' WHERE cid=' . $sel_id . '';
    if ('' != $status) {
        $query .= " and status>=$status";
    }
    $result = $xoopsDB->query($query);
    list($thing) = $xoopsDB->fetchRow($result);
    $count = $thing;
    $arr   = $mytree->getAllChildId($sel_id);
    $size  = count($arr);
    for ($i = 0; $i < $size; $i++) {
        $query2 = 'SELECT count(*) FROM ' . $xoopsDB->prefix('xdir_links') . ' WHERE cid=' . $arr[$i] . '';
        if ('' != $status) {
            $query2 .= " and status>=$status";
        }
        $result2 = $xoopsDB->query($query2);
        list($thing) = $xoopsDB->fetchRow($result2);
        $count += $thing;
    }

    return $count;
}
