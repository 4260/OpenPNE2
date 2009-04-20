<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_do_csv_access_analysis_month extends OpenPNE_Action
{
    function isSecure()
    {
        session_cache_limiter('public');
        return true;
    }

    function handleError($errors)
    {
        admin_client_redirect('access_analysis_month', array_shift($errors));
    }

    function execute($requests)
    {
        if (!LOG_C_ACCESS_LOG) {
            admin_client_redirect('top', '指定されたページにはアクセスできません');
        }

        $ktai_flag = $requests['ktai_flag'];

        $csv = '"年月","アクセス数"' . "\n";
        $csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');

        $access_analysis_month = p_access_analysis_month_access_analysis_month($ktai_flag);
        foreach ($access_analysis_month as $item) {
            list($year, $month, $day) = explode('-', $item['ym']);
            $csv .= sprintf("\"%d/%d\",%d\n", $year, $month, $item['count']);
        }

        //IE以外の場合、キャッシュをさせないヘッダを出力
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') === false) {
            send_nocache_headers(true);
        }
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=access_analysis_month.csv");
        echo $csv;
        exit;
    }
}

?>
