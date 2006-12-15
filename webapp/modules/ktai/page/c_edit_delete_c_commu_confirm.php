<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_page_c_edit_delete_c_commu_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        // ----------

        //--- 権限チェック
        //コミュニティ管理者
        if (!_db_is_c_commu_admin($target_c_commu_id, $u)) {
            handle_kengen_error();
        }
        //---

        $this->set('inc_navi', fetch_inc_navi("c", $target_c_commu_id));

        $this->set("c_commu_id", $target_c_commu_id);

        return 'success';
    }
}

?>
