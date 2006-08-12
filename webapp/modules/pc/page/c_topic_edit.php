<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_page_c_topic_edit extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $title = $requests['title'];
        $body = $requests['body'];
        $err_msg = $requests['err_msg'];
        // ----------

        $c_topic = c_topic_detail_c_topic4c_commu_topic_id($c_commu_topic_id);
        $c_commu_id = $c_topic['c_commu_id'];

        //--- 権限チェック
        if(!p_common_is_c_commu_view4c_commu_idAc_member_id($c_commu_id,$u)){
            handle_kengen_error();
        }
        if(!_db_is_c_topic_admin($c_commu_topic_id, $u) &&
            !_db_is_c_commu_admin($c_commu_id, $u)){
            handle_kengen_error();
        }
        //---

        if ($c_topic['event_flag']) {
            $p = array('target_c_commu_topic_id' => $c_topic['c_commu_topic_id']);
            openpne_redirect('pc', 'page_c_event_edit', $p);
        }

        $this->set('inc_navi',fetch_inc_navi("c",$c_commu_id));
        if($err_msg){
        $c_topic['name'] = $title;
            $c_topic['body'] = $body;
        }

        $this->set('err_msg',$err_msg);
        $this->set('c_topic',$c_topic);
        return 'success';
    }
}

?>
