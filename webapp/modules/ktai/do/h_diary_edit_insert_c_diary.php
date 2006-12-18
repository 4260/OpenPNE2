<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

/**
 * 日記を書く
 */
class ktai_do_h_diary_edit_insert_c_diary extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $subject = $requests['subject'];
        $body = $requests['body'];
        $public_flag = $requests['public_flag'];
        $target_c_diary_id = $requests['target_c_diary_id'];
        // ----------

        if (is_null($subject) || $subject === '') {
            $p = array('target_c_diary_id' => $target_c_diary_id, 'msg' => 2);
            openpne_redirect('ktai', 'page_h_diary_edit', $p);
        }

        if (is_null($body) || $body === '') {
            $p = array('target_c_diary_id' => $target_c_diary_id, 'msg' => 1);
            openpne_redirect('ktai', 'page_h_diary_edit', $p);
        }

        if (!$target_c_diary_id) {
            $update_c_diary_id = db_diary_insert_c_diary($u, $subject, $body, $public_flag);
        } else {
            $update_c_diary_id = $target_c_diary_id;

            $c_diary = db_diary_get_c_diary4id($target_c_diary_id);
            if ($c_diary['c_member_id'] != $u) {
                handle_kengen_error();
            }
        }

        /*
         * 携帯はWEBでは画像UPLOADなし
         */
        db_diary_update_c_diary($update_c_diary_id, $subject, $body, $public_flag);

        //日記を書いた人にポイント付与
        $point = db_action_get_point4c_action_id(4);
        db_point_add_point($u, $point);

        $p = array('target_c_member_id' => $u);
        openpne_redirect('ktai', 'page_fh_diary_list', $p);
    }
}

?>
