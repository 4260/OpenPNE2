<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 */

class biz_page_h_biz_todo_posted_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $direc = $requests['direc'];
        $page = $requests['page'];    
        // ----------

        $this->set('inc_navi',fetch_inc_navi("h"));

        //日記一覧
        $page = $page + $direc;
        $page_size = 50;
        $this->set("page_size",$page_size);

        $lst = biz_getPostedTodo($u);
        $this->set("posted_list", $lst);
        /*
        $this->set("is_prev", $lst[1]);
        $this->set("is_next", $lst[2]);*/
        $this->set("total_num", count($lst));

        $this->set("page", $page);
        $pager = array();
        $pager['start'] = $page_size * ($page - 1) + 1;
        if (($pager['end'] = $page_size * $page) > $lst[3]) {
            $pager['end'] = $lst[3];
        }
        $this->set('pager', $pager);

        return 'success';
    }
}

?>
