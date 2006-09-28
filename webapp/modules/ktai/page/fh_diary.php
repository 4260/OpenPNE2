<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_page_fh_diary extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_diary_id = $requests['target_c_diary_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        $page_size = 10;
        $page += $direc;

        //ページ
        $this->set("page", $page);

        $c_diary = db_diary_get_c_diary4id($target_c_diary_id);

        $target_c_member = k_p_fh_diary_c_member4c_diary_id($target_c_diary_id);        $target_c_member_id = $target_c_member['c_member_id'];

        if ($u != $target_c_member_id) {

            // check public_flag
            if (!pne_check_diary_public_flag($target_c_diary_id, $u)) {
                ktai_display_error('この日記にはアクセスできません');
            }
            //アクセスブロック設定
            if (p_common_is_access_block($u, $target_c_member_id)) {
                openpne_redirect('ktai', 'page_h_access_block');
            }
        }
        //管理画面HTML
        $this->set('c_siteadmin', p_common_c_siteadmin4target_pagename('k_fh_diary'));

        //日記の作者情報
        $this->set("target_diary_writer", $target_c_member);

        //日記
        $this->set("target_c_diary", $c_diary);
        //自分で日記を見たとき
        if ($c_diary['c_member_id'] == $u) {
            //日記を閲覧済みにする
            db_diary_update_c_diary_is_checked($target_c_diary_id, 1);
            $this->set("type", 'h');
            
        }
        //コメント
        list ($c_diary_comment_list, $is_prev, $is_next, $total_num, $total_page_num)
            = k_p_fh_diary_c_diary_comment_list4c_diary_id($target_c_diary_id, $page_size, $page);

        $this->set("c_diary_comment", array_reverse($c_diary_comment_list));
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("total_num", $total_num);
        $this->set("total_page_num", $total_page_num);
        $this->set("page_size", $page_size);

        $pager = array();
        $pager['end'] = $total_num - ($page_size * ($page - 1));
        $pager['start'] = $pager['end'] - count($c_diary_comment_list) + 1;
        $this->set('pager', $pager);

        // f or h
        $this->set("INC_NAVI_type", k_p_fh_common_get_type($target_c_member['c_member_id'], $u));

        //あしあとをつける
        db_ashiato_insert_c_ashiato($target_c_member_id, $u);

        return 'success';
    }
}

?>
