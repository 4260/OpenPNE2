<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_page_f_home extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------

        if ($target_c_member_id == $u) {
            openpne_redirect('ktai', 'page_h_home');
        }

        if (!db_member_is_active_c_member_id($target_c_member_id)) {
            ktai_display_error('該当するメンバーが見つかりません。');
        }

        if (db_member_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('ktai', 'page_h_access_block');
        }

        //管理画面HTML
        $this->set('c_siteadmin', p_common_c_siteadmin4target_pagename('k_f_home'));

        //ターゲットのc_member

        $is_friend = db_friend_is_friend($u, $target_c_member_id);
        if ($is_friend) {
            $target_c_member = db_member_c_member_with_profile($target_c_member_id, 'friend');
        } else {
            $target_c_member = db_member_c_member_with_profile($target_c_member_id, 'public');
        }
        $target_c_member['last_login'] = p_f_home_last_login4access_date($target_c_member['access_date']);
        if ($target_c_member['birth_year']) {
            $target_c_member['age'] = getAge($target_c_member['birth_year'], $target_c_member['birth_month'], $target_c_member['birth_day']);
        }
        $this->set("target_c_member", $target_c_member);

        //ターゲットの最新日記５件
        $this->set("c_diary_list", db_diary_get_c_diary_list4c_member_id($target_c_member_id, 5, $u));

        //フレンドランダム５人
        $this->set("c_friend_list", db_friend_c_friend_list_random4c_member_id($target_c_member_id, 5));

        //参加コミュニティ最新書き込み５件
        $this->set("c_commu_list", k_p_h_home_c_commu_list_lastupdate4c_member_id($target_c_member_id, 5));

        //ターゲットと自分との関係
        $this->set("relation", db_friend_relationship4two_members($u, $target_c_member_id));

        $this->set('profile_list', db_member_c_profile_list());

        // 誕生日まであと何日？
        $this->set('days_birthday', db_member_count_days_birthday4c_member_id($target_c_member_id));

        // inc_entry_point
        $this->set('inc_ktai_entry_point', fetch_ktai_inc_entry_point_f_home($this->getView()));

        //PNEPOINT
        $point = db_point_get_point($target_c_member_id);
        $this->set("point", $point);

        //rank
        $this->set("rank", db_point_get_rank4point($point));

        //あしあとをつける
        db_ashiato_insert_c_ashiato($target_c_member_id, $u);

        return 'success';
    }
}

?>
