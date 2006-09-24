<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 */

class biz_page_h_biz_group_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();
        $sessid = session_id();

        $sql = 'SELECT c_member_id, nickname FROM c_member WHERE c_member_id <>  ?';
        $params = array(
            intval($u),
        );
        $members = db_get_all($sql, $params);
        
        $sql = 'SELECT c_member_id, nickname FROM c_member WHERE c_member_id = ?';
        $params = array(
            intval($u),
        );
        $my_info = db_get_row($sql, $params);

        array_unshift($members, $my_info);

        $this->set("c_invite_list", $members);
        $this->set("c_member_id", $u);

        $member_list = unserialize($requests['memberlist']);

        $this->set("name", $requests['name']);
        $this->set("info", $requests['info']);
        $this->set("member_list", $member_list);


        return 'success';
    }
}

?>
