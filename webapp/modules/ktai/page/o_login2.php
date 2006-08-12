<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_page_o_login2 extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        // --- リクエスト変数
        $ses = $requests['ses'];
        $c_member_id = intval($requests['id']);
        // ----------

        // セッションが有効かどうか
        if (!$pre = c_ktai_address_pre4session($ses)) {
            // 無効の場合、login へリダイレクト
            $c_member_secure = db_common_c_member_secure4c_member_id($c_member_id);
            $p = array('kad' => t_encrypt($c_member_secure['ktai_address']));
            openpne_redirect('ktai', 'page_o_login', $p);
        }

        $this->set('ses', $ses);
        $this->set('pre', $pre);
        return 'success';
    }
}

?>
