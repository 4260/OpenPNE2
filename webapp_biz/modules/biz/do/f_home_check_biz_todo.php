<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class biz_do_f_home_check_biz_todo extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $chid = $requests['chid'];
        $id = $requests['target_id'];
        $is_check = $requests['is_check'];
        // ----------

		if (!biz_isPermissionTodo($u, $chid)) {
		    handle_kengen_error();
		}
        biz_checkTodo($chid, $is_check);

        $p = array('target_c_member_id' => $id);
        openpne_redirect('pc', 'page_f_home', $p);
    }
}
?>
