<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_page_h_regist_ktai_id_end extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();
        
        $this->set('inc_navi', fetch_inc_navi("h"));
        
        return 'success';
    }
}

?>
