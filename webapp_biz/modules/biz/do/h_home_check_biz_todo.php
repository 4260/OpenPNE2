<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 */

class biz_do_h_home_check_biz_todo extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $chid = $requests['chid'];
        $is_check = $requests['is_check'];
        // ----------

        biz_checkTodo($chid, $is_check);
        client_redirect_absolute("?m=pc&a=page_h_home");
    }
}

?>
