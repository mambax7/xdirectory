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

function xdir_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;
    $sql = 'SELECT l.lid,l.cid,l.title,l.submitter,l.date,c.title,t.description FROM ' . $xoopsDB->prefix('xdir_links') . ' l LEFT JOIN ' . $xoopsDB->prefix('xdir_cat') . ' c ON c.cid=l.cid LEFT JOIN ' . $xoopsDB->prefix('xdir_text') . ' t ON t.lid=l.lid WHERE status>0';
    if (0 != $userid) {
        $sql .= ' AND l.submitter=' . $userid . ' ';
    }
    // because count() returns 1 even if a supplied variable
    // is not an array, we must check if $querryarray is really an array
    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= " AND ((l.title LIKE '%$queryarray[0]%' OR c.title LIKE '%$queryarray[0]%' OR t.description LIKE '%$queryarray[0]%')";
        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";
            $sql .= "(l.title LIKE '%$queryarray[$i]%' OR c.title LIKE '%$queryarray[0]%' OR t.description LIKE '%$queryarray[$i]%')";
        }
        $sql .= ') ';
    }
    $sql    .= 'ORDER BY l.date DESC';
    $result = $xoopsDB->query($sql, $limit, $offset);
    $ret    = [];
    $i      = 0;
    while ($myrow = $xoopsDB->fetchArray($result)) {
        $ret[$i]['image'] = 'images/home.gif';
        $ret[$i]['link']  = 'singlelink.php?cid=' . $myrow['cid'] . '&amp;lid=' . $myrow['lid'] . '';
        $ret[$i]['title'] = $myrow['title'];
        $ret[$i]['time']  = $myrow['date'];
        $ret[$i]['uid']   = $myrow['submitter'];
        $i++;
    }

    return $ret;
}
