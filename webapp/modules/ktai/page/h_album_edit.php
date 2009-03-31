<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_page_h_album_edit extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_album_id = $requests['target_c_album_id'];
        $subject = $requests['subject'];
        $description = $requests['description'];
        $public_flag = $requests['public_flag'];
        // ----------

        $c_member = db_member_c_member4c_member_id($u);
        if ($target_c_album_id) {
            $c_album = db_album_get_c_album4c_album_id($target_c_album_id);
            if ($c_album['c_member_id'] != $u) {
                handle_kengen_error();
            }
            $c_album['subject'] = $subject;
            $c_album['description'] = $description;
            $c_album['public_flag'] = $public_flag;
            $this->set('target_c_album', $c_album);
        } else {
            $c_album['public_flag'] = $c_member['public_flag_album'];
            $this->set('target_c_album', $c_album);
        }

        if (MAIL_ADDRESS_HASHED) {
            $mail_address = "a{$u}-".t_get_user_hash($u)."@".MAIL_SERVER_DOMAIN;
        } else {
            $mail_address = "album"."@".MAIL_SERVER_DOMAIN;;
        }
        $mail_address = MAIL_ADDRESS_PREFIX . $mail_address;
        $this->set('album_address', $mail_address);

        //メンバー情報
        $this->set('member', $c_member);


        return 'success';
    }
}

?>
