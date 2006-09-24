<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 */

//グループを削除
class biz_do_h_biz_group_delete extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();
        $sessid = session_id();

        biz_deleteGroup($requests['target_id']);
        
        client_redirect_absolute("?m=biz&a=page_h_biz_group_find_all&msg=".urlencode('グループを削除しました'));

    }
}

?>
