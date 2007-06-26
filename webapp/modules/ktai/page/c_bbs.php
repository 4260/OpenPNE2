<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_page_c_bbs extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        $page_size = 5;
        $page += $direc;

        //ページ
        $this->set("page", $page);

        //トピックのコメントリスト
        $list = k_p_c_bbs_c_commu_topic_comment_list4c_c_commu_topic_id($target_c_commu_topic_id, $u, $page_size, $page);
        $this->set("c_commu_topic_comment_list", $list[0]);
        $this->set("is_prev", $list[1]);
        $this->set("is_next", $list[2]);

        //トピック名
        $this->set("c_commu_topic_name", k_p_c_bbs_c_commu_topic_name4c_commu_topic_id($target_c_commu_topic_id));
        //トピックID,トピック
        $this->set("c_commu_topic_id", $target_c_commu_topic_id);
        $this->set("c_commu_topic", db_commu_c_topic4c_commu_topic_id_2($target_c_commu_topic_id));

        //コミュニティ
        $c_commu = k_p_c_bbs_c_commu4c_commu_topic_id($target_c_commu_topic_id);
        $c_commu_id = $c_commu['c_commu_id'];
        $this->set("c_commu", $c_commu);

        //--- 権限チェック
        //コミュニティの存在の有無
        if (!$c_commu) {
            handle_kengen_error();
        }

        //コミュニティ掲示板閲覧権限
        if (!db_commu_is_c_commu_view4c_commu_idAc_member_id($c_commu_id, $u)) {
            handle_kengen_error();
        }

        //掲示板の閲覧権限 tplでやっている
        $this->set("is_c_commu_view", db_commu_is_c_commu_view4c_commu_idAc_member_id($c_commu['c_commu_id'], $u));
        $this->set("is_c_commu_member", db_commu_is_c_commu_member($c_commu['c_commu_id'], $u));
        $this->set("is_c_event_member", db_commu_is_c_event_member($target_c_commu_topic_id, $u));
        $this->set("is_c_event_admin", db_commu_is_c_event_admin($target_c_commu_topic_id, $u));
        $this->set('is_event_join_date', db_commu_is_event_join_date($target_c_commu_topic_id));

        //メンバーがコミュニティ管理者かどうか
        $this->set("is_admin", k_p_c_bbs_is_admin4c_member_id_c_commu_topic_id($u, $target_c_commu_topic_id));
        //コミュニティ管理者
        $this->set("c_member_admin", k_p_c_bbs_c_member_admin4c_commu_topic_id($target_c_commu_topic_id));

        if (MAIL_ADDRESS_HASHED) {
            $mail_address = "t{$target_c_commu_topic_id}-".t_get_user_hash($u)."@".MAIL_SERVER_DOMAIN;
        } else {
            $mail_address = "t{$target_c_commu_topic_id}"."@".MAIL_SERVER_DOMAIN;
        }
        $mail_address = MAIL_ADDRESS_PREFIX . $mail_address;
        $this->set("mail_address", $mail_address);

        return 'success';
    }
}

?>
