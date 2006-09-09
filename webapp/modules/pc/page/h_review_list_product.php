<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_page_h_review_list_product extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_review_id = $requests['c_review_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------
        $page_size = 30;
        $page = $page + $direc;

        $this->set('inc_navi', fetch_inc_navi('h'));
        $this->set('c_review', p_h_review_list_product_c_review4c_review_id($c_review_id));

        list($c_review_list, $is_prev, $is_next, $total_num, $start_num, $end_num) = p_h_review_list_product_c_review_list4c_review_id($c_review_id, $page, $page_size);
        $this->set('c_review_list', $c_review_list);
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("page", $page);
        $this->set("total_num", $total_num);
        $this->set('start_num', $start_num);
        $this->set('end_num', $end_num);

        return 'success';
    }
}

?>
