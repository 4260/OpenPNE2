<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 */

// パスワード再発行ページ
class admin_biz_page_passwd extends OpenPNE_Action
{
    function execute($requests)
    {
        $v = array();

        $v['SNS_NAME'] = SNS_NAME;
        $v['c_member'] = db_common_c_member4c_member_id_LIGHT($requests['target_c_member_id']);

        $this->set($v);
        return 'success';
    }
}

?>
