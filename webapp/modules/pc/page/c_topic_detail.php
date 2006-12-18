<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_page_c_topic_detail extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        $all = $requests['all'];
        $body = $requests['body'];
        $err_msg = $requests['err_msg'];
        // ----------

        $c_topic = c_topic_detail_c_topic4c_commu_topic_id($c_commu_topic_id);
        $c_commu_id = $c_topic['c_commu_id'];

        $c_commu = db_commu_c_commu4c_commu_id($c_commu_id);

        //コミュニティの存在の有無
        if (!$c_commu) {
            openpne_redirect('pc', 'page_h_err_c_home');
        }

        //--- 権限チェック
        //コミュニティ掲示板閲覧権限
        if (!db_commu_is_c_commu_view4c_commu_idAc_member_id($c_commu_id, $u)) {
            handle_kengen_error();
        }
        //---

        if ($c_topic['event_flag']) {
            $p = array('target_c_commu_topic_id' => $c_topic['c_commu_topic_id']);
            openpne_redirect('pc', 'page_c_event_detail', $p);
        }

        $this->set('inc_navi', fetch_inc_navi('c', $c_commu_id));

        //詳細部分
        $this->set("c_commu", $c_commu);
        $this->set("c_topic", $c_topic);

        //書き込み一覧部分
        $page += $direc;
        if ($all==1) {
            $page_size = 1000;
        } else {
            $page_size = 10;
        }

        list($c_topic_write, $is_prev, $is_next, $total_num, $start_num, $end_num)
            = db_commu_c_topic_write4c_commu_topic_id($c_commu_topic_id, $page, $page_size);
        $this->set("c_topic_write", $c_topic_write);
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("page", $page);
        $this->set("total_num", $total_num);
        $this->set('start_num', $start_num);
        $this->set('end_num', $end_num);

        $this->set('all', $all);

        //新しく書き込むの部分
        $this->set('body', $body);
        $this->set('err_msg', $err_msg);

        $this->set("is_c_commu_admin", db_commu_is_c_commu_admin($c_commu_id, $u));
        $this->set("is_c_commu_member", db_commu_is_c_commu_member($c_commu_id, $u));
        $this->set("is_c_event_member", db_commu_is_c_event_member($c_commu_topic_id, $u));
        $this->set("is_c_topic_admin", db_commu_is_c_topic_admin($c_commu_topic_id, $u));
        $this->set('c_member_id', $u);
        return 'success';
    }
}

?>
