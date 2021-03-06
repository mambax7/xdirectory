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

$modversion['name']        = _MI_XDIR_NAME;
$modversion['version']     = 1.50;
$modversion['description'] = _MI_XDIR_DESC;
$modversion['credits']     = 'Adam Frick<br>( http://www.FolsomLiving.com/ )<br>xDirectory<br><br>Based on the MyLinks Module<br>By: Kazumi Ono<br>';
$modversion['help']        = 'xdir.html';
$modversion['license']     = 'GPL see LICENSE';
$modversion['official']    = 1;
$modversion['image']       = 'images/xdir_slogo.png';
$modversion['dirname']     = 'xdirectory';

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
//$modversion['sqlfile']['postgresql'] = "sql/pgsql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = 'xdir_broken';
$modversion['tables'][1] = 'xdir_cat';
$modversion['tables'][2] = 'xdir_links';
$modversion['tables'][3] = 'xdir_mod';
$modversion['tables'][4] = 'xdir_text';
$modversion['tables'][5] = 'xdir_votedata';

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// ------------------- Help files ------------------- //
$modversion['helpsection'] = [
    ['name' => _MI_XDIR_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_XDIR_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_XDIR_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_XDIR_SUPPORT, 'link' => 'page=support'],
];

// Blocks
$modversion['blocks'][1]['file']        = 'xdir_top.php';
$modversion['blocks'][1]['name']        = _MI_XDIR_BNAME1;
$modversion['blocks'][1]['description'] = 'Shows recently added web links';
$modversion['blocks'][1]['show_func']   = 'b_xdir_top_show';
$modversion['blocks'][1]['edit_func']   = 'b_xdir_top_edit';
$modversion['blocks'][1]['options']     = 'date|10|25';
$modversion['blocks'][1]['template']    = 'xdir_block_new.tpl';

$modversion['blocks'][2]['file']        = 'xdir_top.php';
$modversion['blocks'][2]['name']        = _MI_XDIR_BNAME2;
$modversion['blocks'][2]['description'] = 'Shows most visited web links';
$modversion['blocks'][2]['show_func']   = 'b_xdir_top_show';
$modversion['blocks'][2]['edit_func']   = 'b_xdir_top_edit';
$modversion['blocks'][2]['options']     = 'hits|10|25';
$modversion['blocks'][2]['template']    = 'xdir_block_top.tpl';

// Menu
$modversion['hasMain']        = 1;
$modversion['sub'][1]['name'] = _MI_XDIR_SMNAME1;
$modversion['sub'][1]['url']  = 'submit.php';
$modversion['sub'][2]['name'] = _MI_XDIR_SMNAME2;
$modversion['sub'][2]['url']  = 'topten.php?hit=1';
$modversion['sub'][3]['name'] = _MI_XDIR_SMNAME3;
$modversion['sub'][3]['url']  = 'topten.php?rate=1';

// Search
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'xdir_search';

// Comments
$modversion['hasComments']             = 1;
$modversion['comments']['itemName']    = 'lid';
$modversion['comments']['pageName']    = 'singlelink.php';
$modversion['comments']['extraParams'] = ['cid'];
// Comment callback functions
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'xdir_com_approve';
$modversion['comments']['callback']['update']  = 'xdir_com_update';

// Templates
$modversion['templates'][1]['file']         = 'xdir_brokenlink.tpl';
$modversion['templates'][1]['description']  = '';
$modversion['templates'][2]['file']         = 'xdir_link.tpl';
$modversion['templates'][2]['description']  = '';
$modversion['templates'][3]['file']         = 'xdir_index.tpl';
$modversion['templates'][3]['description']  = '';
$modversion['templates'][4]['file']         = 'xdir_modlink.tpl';
$modversion['templates'][4]['description']  = '';
$modversion['templates'][5]['file']         = 'xdir_ratelink.tpl';
$modversion['templates'][5]['description']  = '';
$modversion['templates'][6]['file']         = 'xdir_singlelink.tpl';
$modversion['templates'][6]['description']  = '';
$modversion['templates'][7]['file']         = 'xdir_submit.tpl';
$modversion['templates'][7]['description']  = '';
$modversion['templates'][8]['file']         = 'xdir_topten.tpl';
$modversion['templates'][8]['description']  = '';
$modversion['templates'][9]['file']         = 'xdir_viewcat.tpl';
$modversion['templates'][9]['description']  = '';
$modversion['templates'][10]['file']        = 'xdir_listingfull.tpl';
$modversion['templates'][10]['description'] = '';
$modversion['templates'][11]['file']        = 'xdir_premiumlink.tpl';
$modversion['templates'][11]['description'] = '';

// Config Settings (only for modules that need config settings generated automatically)

// name of config option for accessing its specified value. i.e. $xoopsModuleConfig['storyhome']
$modversion['config'][1]['name'] = 'popular';

// title of this config option displayed in config settings form
$modversion['config'][1]['title'] = '_MI_XDIR_POPULAR';

// description of this config option displayed under title
$modversion['config'][1]['description'] = '_MI_XDIR_POPULARDSC';

// form element type used in config form for this option. can be one of either textbox, textarea, select, select_multi, yesno, group, group_multi
$modversion['config'][1]['formtype'] = 'select';

// value type of this config option. can be one of either int, text, float, array, or other
// form type of 'group_multi', 'select_multi' must always be 'array'
// form type of 'yesno', 'group' must be always be 'int'
$modversion['config'][1]['valuetype'] = 'int';

// the default value for this option
// ignore it if no default
// 'yesno' formtype must be either 0(no) or 1(yes)
$modversion['config'][1]['default'] = 100;

// options to be displayed in selection box
// required and valid for 'select' or 'select_multi' formtype option only
// language constants can be used for both array keys and values
$modversion['config'][1]['options'] = ['5' => 5, '10' => 10, '50' => 50, '100' => 100, '200' => 200, '500' => 500, '1000' => 1000];

$modversion['config'][2]['name']        = 'newlinks';
$modversion['config'][2]['title']       = '_MI_XDIR_NEWLINKS';
$modversion['config'][2]['description'] = '_MI_XDIR_NEWLINKSDSC';
$modversion['config'][2]['formtype']    = 'select';
$modversion['config'][2]['valuetype']   = 'int';
$modversion['config'][2]['default']     = 10;
$modversion['config'][2]['options']     = ['5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30, '50' => 50];

$modversion['config'][3]['name']        = 'perpage';
$modversion['config'][3]['title']       = '_MI_XDIR_PERPAGE';
$modversion['config'][3]['description'] = '_MI_XDIR_PERPAGEDSC';
$modversion['config'][3]['formtype']    = 'select';
$modversion['config'][3]['valuetype']   = 'int';
$modversion['config'][3]['default']     = 10;
$modversion['config'][3]['options']     = ['5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30, '50' => 50];

$modversion['config'][4]['name']        = 'anonpost';
$modversion['config'][4]['title']       = '_MI_XDIR_ANONPOST';
$modversion['config'][4]['description'] = '';
$modversion['config'][4]['formtype']    = 'yesno';
$modversion['config'][4]['valuetype']   = 'int';
$modversion['config'][4]['default']     = 0;

$modversion['config'][5]['name']        = 'autoapprove';
$modversion['config'][5]['title']       = '_MI_XDIR_AUTOAPPROVE';
$modversion['config'][5]['description'] = '_MI_XDIR_AUTOAPPROVEDSC';
$modversion['config'][5]['formtype']    = 'yesno';
$modversion['config'][5]['valuetype']   = 'int';
$modversion['config'][5]['default']     = 0;

$modversion['config'][6]['name']        = 'frame';
$modversion['config'][6]['title']       = '_MI_XDIR_USEFRAMES';
$modversion['config'][6]['description'] = '_MI_XDIR_USEFRAMEDSC';
$modversion['config'][6]['formtype']    = 'yesno';
$modversion['config'][6]['valuetype']   = 'int';
$modversion['config'][6]['default']     = 0;

$modversion['config'][7]['name']        = 'useshots';
$modversion['config'][7]['title']       = '_MI_XDIR_USESHOTS';
$modversion['config'][7]['description'] = '_MI_XDIR_USESHOTSDSC';
$modversion['config'][7]['formtype']    = 'yesno';
$modversion['config'][7]['valuetype']   = 'int';
$modversion['config'][7]['default']     = 0;

$modversion['config'][8]['name']        = 'shotwidth';
$modversion['config'][8]['title']       = '_MI_XDIR_SHOTWIDTH';
$modversion['config'][8]['description'] = '_MI_XDIR_SHOTWIDTHDSC';
$modversion['config'][8]['formtype']    = 'textbox';
$modversion['config'][8]['valuetype']   = 'int';
$modversion['config'][8]['default']     = 140;

// Notification

$modversion['hasNotification']             = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'xdir_notify_iteminfo';

$modversion['notification']['category'][1]['name']           = 'global';
$modversion['notification']['category'][1]['title']          = _MI_XDIR_GLOBAL_NOTIFY;
$modversion['notification']['category'][1]['description']    = _MI_XDIR_GLOBAL_NOTIFYDSC;
$modversion['notification']['category'][1]['subscribe_from'] = ['index.php', 'viewcat.php', 'singlelink.php'];

$modversion['notification']['category'][2]['name']           = 'category';
$modversion['notification']['category'][2]['title']          = _MI_XDIR_CATEGORY_NOTIFY;
$modversion['notification']['category'][2]['description']    = _MI_XDIR_CATEGORY_NOTIFYDSC;
$modversion['notification']['category'][2]['subscribe_from'] = ['viewcat.php', 'singlelink.php'];
$modversion['notification']['category'][2]['item_name']      = 'cid';
$modversion['notification']['category'][2]['allow_bookmark'] = 1;

$modversion['notification']['category'][3]['name']           = 'link';
$modversion['notification']['category'][3]['title']          = _MI_XDIR_LINK_NOTIFY;
$modversion['notification']['category'][3]['description']    = _MI_XDIR_LINK_NOTIFYDSC;
$modversion['notification']['category'][3]['subscribe_from'] = 'singlelink.php';
$modversion['notification']['category'][3]['item_name']      = 'lid';
$modversion['notification']['category'][3]['allow_bookmark'] = 1;

$modversion['notification']['event'][1]['name']          = 'new_category';
$modversion['notification']['event'][1]['category']      = 'global';
$modversion['notification']['event'][1]['title']         = _MI_XDIR_GLOBAL_NEWCATEGORY_NOTIFY;
$modversion['notification']['event'][1]['caption']       = _MI_XDIR_GLOBAL_NEWCATEGORY_NOTIFYCAP;
$modversion['notification']['event'][1]['description']   = _MI_XDIR_GLOBAL_NEWCATEGORY_NOTIFYDSC;
$modversion['notification']['event'][1]['mail_template'] = 'global_newcategory_notify';
$modversion['notification']['event'][1]['mail_subject']  = _MI_XDIR_GLOBAL_NEWCATEGORY_NOTIFYSBJ;

$modversion['notification']['event'][2]['name']          = 'link_modify';
$modversion['notification']['event'][2]['category']      = 'global';
$modversion['notification']['event'][2]['admin_only']    = 1;
$modversion['notification']['event'][2]['title']         = _MI_XDIR_GLOBAL_LINKMODIFY_NOTIFY;
$modversion['notification']['event'][2]['caption']       = _MI_XDIR_GLOBAL_LINKMODIFY_NOTIFYCAP;
$modversion['notification']['event'][2]['description']   = _MI_XDIR_GLOBAL_LINKMODIFY_NOTIFYDSC;
$modversion['notification']['event'][2]['mail_template'] = 'global_linkmodify_notify';
$modversion['notification']['event'][2]['mail_subject']  = _MI_XDIR_GLOBAL_LINKMODIFY_NOTIFYSBJ;

$modversion['notification']['event'][3]['name']          = 'link_broken';
$modversion['notification']['event'][3]['category']      = 'global';
$modversion['notification']['event'][3]['admin_only']    = 1;
$modversion['notification']['event'][3]['title']         = _MI_XDIR_GLOBAL_LINKBROKEN_NOTIFY;
$modversion['notification']['event'][3]['caption']       = _MI_XDIR_GLOBAL_LINKBROKEN_NOTIFYCAP;
$modversion['notification']['event'][3]['description']   = _MI_XDIR_GLOBAL_LINKBROKEN_NOTIFYDSC;
$modversion['notification']['event'][3]['mail_template'] = 'global_linkbroken_notify';
$modversion['notification']['event'][3]['mail_subject']  = _MI_XDIR_GLOBAL_LINKBROKEN_NOTIFYSBJ;

$modversion['notification']['event'][4]['name']          = 'link_submit';
$modversion['notification']['event'][4]['category']      = 'global';
$modversion['notification']['event'][4]['admin_only']    = 1;
$modversion['notification']['event'][4]['title']         = _MI_XDIR_GLOBAL_LINKSUBMIT_NOTIFY;
$modversion['notification']['event'][4]['caption']       = _MI_XDIR_GLOBAL_LINKSUBMIT_NOTIFYCAP;
$modversion['notification']['event'][4]['description']   = _MI_XDIR_GLOBAL_LINKSUBMIT_NOTIFYDSC;
$modversion['notification']['event'][4]['mail_template'] = 'global_linksubmit_notify';
$modversion['notification']['event'][4]['mail_subject']  = _MI_XDIR_GLOBAL_LINKSUBMIT_NOTIFYSBJ;

$modversion['notification']['event'][5]['name']          = 'new_link';
$modversion['notification']['event'][5]['category']      = 'global';
$modversion['notification']['event'][5]['title']         = _MI_XDIR_GLOBAL_NEWLINK_NOTIFY;
$modversion['notification']['event'][5]['caption']       = _MI_XDIR_GLOBAL_NEWLINK_NOTIFYCAP;
$modversion['notification']['event'][5]['description']   = _MI_XDIR_GLOBAL_NEWLINK_NOTIFYDSC;
$modversion['notification']['event'][5]['mail_template'] = 'global_newlink_notify';
$modversion['notification']['event'][5]['mail_subject']  = _MI_XDIR_GLOBAL_NEWLINK_NOTIFYSBJ;

$modversion['notification']['event'][6]['name']          = 'link_submit';
$modversion['notification']['event'][6]['category']      = 'category';
$modversion['notification']['event'][6]['admin_only']    = 1;
$modversion['notification']['event'][6]['title']         = _MI_XDIR_CATEGORY_LINKSUBMIT_NOTIFY;
$modversion['notification']['event'][6]['caption']       = _MI_XDIR_CATEGORY_LINKSUBMIT_NOTIFYCAP;
$modversion['notification']['event'][6]['description']   = _MI_XDIR_CATEGORY_LINKSUBMIT_NOTIFYDSC;
$modversion['notification']['event'][6]['mail_template'] = 'category_linksubmit_notify';
$modversion['notification']['event'][6]['mail_subject']  = _MI_XDIR_CATEGORY_LINKSUBMIT_NOTIFYSBJ;

$modversion['notification']['event'][7]['name']          = 'new_link';
$modversion['notification']['event'][7]['category']      = 'category';
$modversion['notification']['event'][7]['title']         = _MI_XDIR_CATEGORY_NEWLINK_NOTIFY;
$modversion['notification']['event'][7]['caption']       = _MI_XDIR_CATEGORY_NEWLINK_NOTIFYCAP;
$modversion['notification']['event'][7]['description']   = _MI_XDIR_CATEGORY_NEWLINK_NOTIFYDSC;
$modversion['notification']['event'][7]['mail_template'] = 'category_newlink_notify';
$modversion['notification']['event'][7]['mail_subject']  = _MI_XDIR_CATEGORY_NEWLINK_NOTIFYSBJ;

$modversion['notification']['event'][8]['name']          = 'approve';
$modversion['notification']['event'][8]['category']      = 'link';
$modversion['notification']['event'][8]['invisible']     = 1;
$modversion['notification']['event'][8]['title']         = _MI_XDIR_LINK_APPROVE_NOTIFY;
$modversion['notification']['event'][8]['caption']       = _MI_XDIR_LINK_APPROVE_NOTIFYCAP;
$modversion['notification']['event'][8]['description']   = _MI_XDIR_LINK_APPROVE_NOTIFYDSC;
$modversion['notification']['event'][8]['mail_template'] = 'link_approve_notify';
$modversion['notification']['event'][8]['mail_subject']  = _MI_XDIR_LINK_APPROVE_NOTIFYSBJ;
