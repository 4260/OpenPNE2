<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_do_h_home_search extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        if (!is_null($requests['community_x'])) {
            $p = array('keyword' => $requests['q']);
            openpne_redirect('pc', 'page_h_com_find_all', $p);
        } elseif (!is_null($requests['web_x'])) {
            $q = urlencode($requests['q']);
            client_redirect_absolute('http://www.google.com/search?hl=ja&q='.$q);
        }
        //--- bizここから
        elseif(!is_null($requests['group_x']))
        {
            $p = array('keyword' => urlencode($requests['q']));
            openpne_redirect('biz', 'page_h_biz_group_find_all', $p);
        }
        //--- bizここまで
        else { // default
            $p = array('keyword' => $requests['q']);
            openpne_redirect('pc', 'page_h_diary_list_all', $p);
        }
    }
}

?>
