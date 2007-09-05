<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// CMD一覧
class admin_page_list_c_cmd extends OpenPNE_Action
{
    function execute($requests)
    {
        $cmd_file_list = admin_get_cmd_file_list();
        $c_cmd_setting_list = db_admin_get_c_cmd_list4name($cmd_file_list);
        $c_cmd_list = array_flip($cmd_file_list);
        ksort($c_cmd_list);

        $permit_list = db_get_permit_list();

        $this->set("permit_list", $permit_list);

        foreach ($c_cmd_setting_list as $key1 => $value) {
            $permit = $value['permit'];
            $c_cmd_id = $value['c_cmd_id'];
            foreach ($permit_list as $key => $name) {
                $is_permit[$name] = ($permit & $key) ? 1:0 ;
            }
            if ($permit == 0) {
                $disabled = true;
            } else {
                $disabled = false;
            }
            $c_cmd_list[$value['name']] = array(
                'c_cmd_id' => $c_cmd_id,
            	'permit' => $is_permit,
                'disabled' => $disabled,
            );
        }

        $this->set("c_cmd_list", $c_cmd_list);
        return 'success';
    }
}

?>
