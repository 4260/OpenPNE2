<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// ファイル削除(確認画面)
class admin_page_delete_c_file_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        if (!OPENPNE_USE_FILEUPLOAD) {
            admin_client_redirect('top', '指定されたページにはアクセスできません');
        }

        $v = array();

        $v['c_file'] = db_file_c_file4c_file_id($requests['target_c_file_id']);

        $this->set($v);
        return 'success';
    }
}

?>
