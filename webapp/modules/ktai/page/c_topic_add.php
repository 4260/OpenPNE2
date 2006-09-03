<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_page_c_topic_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $c_commu_id = $requests['target_c_commu_id'];
        $title = $requests['title'];
        $body = $requests['body'];
        $event_flag = $requests['event_flag'];
        $err_msg = $requests['err_msg'];
        // ----------

        //--- 権限チェック
        //コミュニティメンバー
        if (!_db_is_c_commu_member($c_commu_id, $u)) {
            handle_kengen_error();
        }

        $this->set('c_commu', _db_c_commu4c_commu_id($c_commu_id));

        return 'success';
    }
}
?>
