<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// スキン画像更新
class admindb_image_insert_c_image2 extends OpenPNE_Action
{
    function execute($requests)
    {
        if (!empty($_FILES['upfile']) && !empty($requests['filename'])) {
            image_data_delete($requests['filename']);
            admin_insert_c_image($_FILES['upfile'], $requests['filename']);

            admin_client_redirect('edit_c_image', '画像を登録しました', 'filename='.$requests['filename']);
        }

        admin_client_redirect('edit_c_image');
    }
}

?>
