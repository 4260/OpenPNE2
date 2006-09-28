<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

/**
 * フレンドリクエストを送る
 */
class pc_do_f_link_request_insert_c_friend_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $body = $requests['body'];
        // ----------

        //--- 権限チェック
        //フレンドでない or フレンド承認中でない

        $status = db_common_friend_status($u, $target_c_member_id);
        if ($status['is_friend']) {
            $p = array('target_c_member_id' => $target_c_member_id);
            openpne_redirect('pc', 'page_f_link_request_err_already', $p);
        } elseif($status['is_friend_confirm']) {
            $p = array('target_c_member_id' => $target_c_member_id);
            openpne_redirect('pc', 'page_f_link_request_err_wait', $p);
        }

        //アクセスブロック設定
        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('pc', 'page_h_access_block');
        }
        //---


        $c_member_id_from = $u;

        db_friend_insert_c_friend_confirm($c_member_id_from,$target_c_member_id,$body);

        //メッセージ
        $c_member_to   = db_common_c_member4c_member_id($target_c_member_id);
        $c_member_from = db_common_c_member4c_member_id($c_member_id_from);

        $subject =WORD_FRIEND."リンク要請メッセージ";
        $body_disp =
            $c_member_from['nickname']." さんから".WORD_FRIEND."リンク要請のメッセージが届いています。\n".
            "\n".
            "メッセージ：\n".
            $body."\n".
            "\n".
            "この要請について、承認待ちリストから承認または拒否を選択してください。\n";

        // ---bizここから
        $biz_dir = OPENPNE_MODULES_BIZ_DIR.'/biz/';  //bizモジュールディレクトリの定義
        include_once($biz_dir.'lib/mysql_functions.php');  //bizモジュールよりライブラリを拝借
        if(biz_isKtaiMessage($target_c_member_id))
            biz_sendKtaiMessageSyoudakuMail($c_member_id_from, $target_c_member_id, $subject, $body_disp);
        // ---bizここまで


        do_common_send_message_syoudaku($c_member_id_from, $target_c_member_id, $subject, $body_disp);

        $p = array('target_c_member_id' => $target_c_member_id);
        openpne_redirect('pc', 'page_f_home', $p);
    }
}

?>
