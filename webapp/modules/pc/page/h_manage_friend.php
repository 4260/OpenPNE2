<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_page_h_manage_friend extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        $this->set('inc_navi',fetch_inc_navi("h"));
        $this->set('c_friend_list',p_h_manage_friend_c_friend_list_disp4c_member_id($u));

        return 'success';
    }
}

?>
