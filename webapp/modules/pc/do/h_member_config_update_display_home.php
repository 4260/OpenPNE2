<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_do_h_member_config_update_display_home extends OpenPNE_Action
{
    function handleError($errors)
    {
        $_REQUEST['msg'] = array_shift($errors);
        openpne_forward('pc', 'page', 'h_config', $errors);
        exit;
    }

    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        db_member_update_c_member_config($u, 'IS_DISPLAY_NEWDIARY_HOME', $requests['IS_DISPLAY_NEWDIARY_HOME']);
        db_member_update_c_member_config($u, 'IS_DISPLAY_NEWTOPIC_HOME', $requests['IS_DISPLAY_NEWTOPIC_HOME']);

        openpne_redirect('pc', 'page_h_home');
    }
}

?>
