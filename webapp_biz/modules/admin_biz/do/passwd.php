<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// パスワード�E発衁E
class admin_biz_do_passwd extends OpenPNE_Action
{
    function execute($requests)
    {
        $c_member_id = $requests['target_c_member_id'];
        $password = $requests['password'];

        if (!ctype_alnum($password) ||
            strlen($password) < 6 ||
            strlen($password) > 12) {
            admin_biz_client_redirect('passwd',
                'パスワード�E6�E�E2斁E���E半角英数で入力してください',
                'target_c_member_id='.$c_member_id);
            exit;
        }

        if ($requests['password'] !== $requests['password2']) {
            admin_biz_client_redirect('passwd',
                'パスワードが一致してぁE��せん',
                'target_c_member_id='.$c_member_id);
            exit;
        }

        //パスワード変更
        do_common_update_password($c_member_id, $password);

        //メール送信
        $c_member_secure = db_common_c_member_secure4c_member_id($c_member_id);
        if ($c_member_secure['pc_address']) {
            do_password_query_mail_send($c_member_id, $c_member_secure['pc_address'], $password);
        } else {
            db_mail_send_m_ktai_password_query($c_member_id, $password);
        }

        admin_biz_client_redirect('top', 'ユーザーのパスワードを変更し、メールを送信しました');
    }
}

?>
