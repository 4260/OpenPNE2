<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_page_c_topic_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_id = $requests['target_c_commu_id'];
        $title = $requests['title'];
        $body = $requests['body'];
        $event_flag = $requests['event_flag'];
        $err_msg = $requests['err_msg'];
        // ----------

        if ($event_flag == 1) {
            $p = array('target_c_commu_id' => $c_commu_id);
            openpne_redirect('pc', 'page_c_event_add', $p);
        }

        //--- 権限チェック
        //コミュニティメンバー
        if (!_db_is_c_commu_member($c_commu_id, $u)) {
            $_REQUEST['target_c_commu_id'] = $c_commu_id;
            $_REQUEST['msg'] = "トピック作成をおこなうにはコミュニティに参加する必要があります";
            openpne_forward('pc', 'page', "c_home");
            exit;
        }
        $c_commu = p_c_home_c_commu4c_commu_id($c_commu_id);

        //トピック作成権限チェック
        if ($c_commu['topic_authority'] == 'admin_only' && !db_commu_is_c_commu_admin($c_commu_id, $u)) {
            $_REQUEST['target_c_commu_id'] = $c_commu_id;
            $_REQUEST['msg'] = "トピックは管理者だけが作成できます";
            openpne_forward('pc', 'page', "c_home");
            exit;
        }
        // ---

        $this->set('inc_navi', fetch_inc_navi("c", $c_commu_id));
        $this->set("c_commu", $c_commu);

        $this->set('err_msg', $err_msg);

        $this->set('title', $title);
        $this->set('body', $body);

        return 'success';
    }
}

?>
