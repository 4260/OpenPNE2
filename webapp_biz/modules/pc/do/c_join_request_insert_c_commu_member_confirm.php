<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

/**
 * コミュニティ参加リクエスチE
 */
class pc_do_c_join_request_insert_c_commu_member_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        $body = $requests['body'];
        // ----------

        //--- 権限チェチE��
        //コミュニティメンバ�EでなぁEor 参加承認中でなぁE

        $status = db_common_commu_status($u, $target_c_commu_id);
        if ($status['is_commu_member'] ||
            $status['is_commu_member_confirm']) {
            handle_kengen_error();
        }
        //---


        $c_member_id_from = $u;

        db_commu_insert_c_commu_member_confirm($target_c_commu_id, $c_member_id_from, $body);

        //メチE��ージ
        {
            $c_commu = _db_c_commu4c_commu_id($target_c_commu_id);
            $c_member_id_to = $c_commu['c_member_id_admin'];
            $c_member_from  = db_common_c_member4c_member_id($c_member_id_from);

            $subject ="コミュニティ参加要請メチE��ージ";
            $body_disp =
                $c_member_from['nickname']." さんから ".$c_commu['name']." コミュニティへの参加希望メチE��ージが届いてぁE��す、En".
                "\n".
                "メチE��ージ�E�\n".
                $body."\n".
                "\n".
                "こ�E要請につぁE��、承認征E��リストから承認また�E拒否を選択してください、En";

            // ---bizここから
            $biz_dir = OPENPNE_MODULES_BIZ_DIR.'/biz/';  //bizモジュールチE��レクトリの定義
            include_once($biz_dir.'lib/mysql_functions.php');  //bizモジュールよりライブラリを拝倁E

            if(biz_isKtaiMessage($target_c_member_id))
                biz_sendKtaiMessageSyoudakuMail($u, $target_c_member_id, $subject, $body);
            // ---bizここまで

            do_common_send_message_syoudaku($c_member_id_from, $c_member_id_to, $subject, $body_disp);
        }
 
        $p = array('target_c_commu_id' => $target_c_commu_id);
        openpne_redirect('pc', 'page_c_home', $p);
    }
}

?>
