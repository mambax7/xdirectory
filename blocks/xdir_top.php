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

/******************************************************************************
 * Function: b_xdir_top_show
 * Input   : $options[0] = date for the most recent links
 *                    hits for the most popular links
 *           $block['content'] = The optional above content
 *           $options[1]   = How many reviews are displayes
 * Output  : Returns the desired most recent or most popular links
 *****************************************************************************
 * @param $options
 * @return array
 */
function b_xdir_top_show($options)
{
    global $xoopsDB;
    $block  = [];
    $myts   = MyTextSanitizer::getInstance();
    $result = $xoopsDB->query('SELECT lid, cid, title, date, hits FROM ' . $xoopsDB->prefix('xdir_links') . ' WHERE status>0 ORDER BY ' . $options[0] . ' DESC', $options[1], 0);
    while ($myrow = $xoopsDB->fetchArray($result)) {
        $link  = [];
        $title = $myts->htmlSpecialChars($myrow['title']);
        if (!XOOPS_USE_MULTIBYTES) {
            if (strlen($myrow['title']) >= $options[2]) {
                $title = $myts->htmlSpecialChars(substr($myrow['title'], 0, $options[2] - 1)) . '...';
            }
        }
        $link['id']    = $myrow['lid'];
        $link['cid']   = $myrow['cid'];
        $link['title'] = $title;
        if ($options[0] == 'date') {
            $link['date'] = formatTimestamp($myrow['date'], 's');
        } elseif ($options[0] == 'hits') {
            $link['hits'] = $myrow['hits'];
        }
        $block['links'][] = $link;
    }

    return $block;
}

function b_xdir_top_edit($options)
{
    $form = '' . _MB_XDIR_DISP . '&nbsp;';
    $form .= "<input type='hidden' name='options[]' value='";
    if ($options[0] == 'date') {
        $form .= "date'";
    } else {
        $form .= "hits'";
    }
    $form .= '>';
    $form .= "<input type='text' name='options[]' value='" . $options[1] . "'>&nbsp;" . _MB_XDIR_LINKS . '';
    $form .= '&nbsp;<br>' . _MB_XDIR_CHARS . "&nbsp;<input type='text' name='options[]' value='" . $options[2] . "'>&nbsp;" . _MB_XDIR_LENGTH . '';

    return $form;
}
