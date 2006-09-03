<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// バナー追加
class admin_do_insert_c_banner extends OpenPNE_Action
{
    function execute($requests)
    {
        //c_banner insert
        $c_banner_id = db_admin_insert_c_banner($requests['a_href'], $requests['type'], $requests['nickname']);
        //c_banner insert

        //c_image delete && insert
        $ext = t_check_image_format($_FILES['upfile']);
        $c_banner['image_filename'] = "b_{$c_banner_id}_".time().".{$ext}";
        admin_insert_c_image($_FILES['upfile'], $c_banner['image_filename']);
        //c_image delete && insert

        //c_banner update
        db_admin_update_c_banner($c_banner_id, $c_banner);
        //c_banner update

        admin_client_redirect('edit_c_banner', 'バナーを追加しました');
    }
}

?>
