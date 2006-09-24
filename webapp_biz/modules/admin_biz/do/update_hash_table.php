<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_0.txt PHP License 3.0
 */

// hash_table 更新
class admin_biz_do_update_hash_table extends OpenPNE_Action
{
    function execute($requests)
    {
        $hash_tbl =& AdminHashTable::singleton();
        $hash_tbl->updateTable();

        admin_biz_client_redirect('top', '管理用ページ名を変更しました');
    }
}

?>
