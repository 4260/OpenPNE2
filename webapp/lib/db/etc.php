<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

/**
 * 管理画面用アカウントが存在するかどうか
 * setup が完了しているかどうかの判定に使う
 * 
 * @return bool 存在するかどうか
 */
function db_admin_user_exists()
{
    $sql = 'SELECT c_admin_user_id FROM c_admin_user';
    return (bool)db_get_one($sql);
}

/**
 * 配色設定を取得
 */
function db_select_c_sns_config($target_id = 1)
{
    $sql = 'SELECT * FROM c_sns_config WHERE c_sns_config_id = ?';
    $params = array(intval($target_id));
    return db_get_row($sql, $params);
}

/**
 * 配色設定を全て取得
 */
function db_select_c_sns_config_all()
{
    $sql = 'SELECT * FROM c_sns_config';
    return db_get_all($sql);
}

/**
 * siteadminを取得
 */
function p_common_c_siteadmin4target_pagename($target_pagename)
{
    $sql = 'SELECT body FROM c_siteadmin WHERE target = ?';
    $params = array($target_pagename);
    return db_get_one($sql, $params);
}

/**
 * 都道府県リストを取得
 */
function p_regist_prof_c_profile_pref_list4null()
{
    $hint = db_mysql_hint('FORCE INDEX (sort_order)');
    $sql = 'SELECT c_profile_pref_id, pref FROM c_profile_pref' . $hint .
           ' ORDER BY sort_order';
    return db_get_assoc($sql);
}

/**
 * 都道府県リスト(全データ)を取得
 */
function db_etc_c_profile_pref_list()
{
    $hint = db_mysql_hint('FORCE INDEX (sort_order)');
    $sql = 'SELECT * FROM c_profile_pref' . $hint . ' ORDER BY sort_order';
    return db_get_all($sql);
}

/**
 * IDから都道府県リスト(全データ)を取得
 */
function db_etc_c_profile_pref4id($c_profile_pref_id)
{
    $sql = 'SELECT * FROM c_profile_pref WHERE c_profile_pref_id = ?';
    $params = array(intval($c_profile_pref_id));
    return db_get_row($sql, $params);
}

/**
 * 特定の緯度経度の都道府県を取得
 */
function db_etc_c_profile_pref_id4latlng($lat, $lng, $zoom)
{
    if (!$lat || !$lng) {
        return false;
    }

    $sql = 'SELECT c_profile_pref_id FROM c_profile_pref' .
        ' WHERE map_latitude = ? AND map_longitude = ? AND map_zoom = ?';
    $params = array($lat, $lng, intval($zoom));
    return db_get_one($sql, $params);
}

/**
 * 秘密の質問を取得
 */
function p_common_c_password_query4null()
{
    $sql = 'SELECT c_password_query_id, c_password_query_question FROM c_password_query';
    return db_get_assoc($sql);
}


function check_search_word($search_word)
{
    $search_word = str_replace("_", "\_", $search_word);
    $search_word = str_replace("%", "\%", $search_word);
    return $search_word;
}

//---

function do_common_c_pc_address_pre4pc_address($pc_address)
{
    $sql = 'SELECT * FROM c_pc_address_pre WHERE pc_address = ?';
    $params = array($pc_address);
    return db_get_row($sql, $params);
}

function do_common_c_pc_address_pre4sid($sid)
{
    $sql = 'SELECT * FROM c_pc_address_pre WHERE session = ?';
    $params = array($sid);
    return db_get_row($sql, $params);
}

/**
 * パスワードが正しいかどうか認証する
 * 
 * @param int $c_member_id
 * @param string $password 平文のパスワード
 * @return bool パスワードが正しいかどうか
 */
function db_common_authenticate_password($c_member_id, $password, $is_ktai = false)
{
    $auth_config = get_auth_config($is_ktai);
    
    if (IS_SLAVEPNE) {
        $username = db_member_username4c_member_id($c_member_id, $is_ktai);
    } else {
        $auth_config['options']['usernamecol'] = 'c_member_id';
    	$username = $c_member_id;
    }
    
    $storage = Auth::_factory($auth_config['storage'],$auth_config['options']);
    return $storage->fetchData($username, $password, false);
}

/**
 * 日記ページのカレンダー生成
 */
function db_common_diary_monthly_calendar($year, $month, $c_member_id, $u = null)
{
    include_once 'Calendar/Month/Weekdays.php';
    $Month = new Calendar_Month_Weekdays($year, $month, 0);
    $Month->build();

    $is_diary_list = p_h_diary_is_diary_written_list4date($year, $month, $c_member_id, $u);

    $calendar = array();
    $week = 0;
    while ($Day = $Month->fetch()) {
        if ($Day->isFirst()) $week++;

        if ($Day->isEmpty()) {
            $calendar['days'][$week][] = array();
        } else {
            $day = $Day->thisDay();
            $item = array(
                'day' => $day,
                'is_diary' => in_array($day, $is_diary_list),
            );
            $calendar['days'][$week][] = $item;
        }
    }

    // 最初に日記を書いた日
    $sql = 'SELECT r_datetime FROM c_diary WHERE c_member_id = ? ORDER BY r_datetime';
    $first_datetime = db_get_one($sql, array(intval($c_member_id)));

    // 前の月、次の月
    $prev_month = $Month->prevMonth('timestamp');
    $this_month = $Month->thisMonth('timestamp');
    $next_month = $Month->nextMonth('timestamp');

    $ym = array(
        'disp_year'  => $year,
        'disp_month' => $month,
        'prev_year'  => null,
        'prev_month' => null,
        'next_year'  => null,
        'next_month' => null,
    );
    if ($first_datetime && strtotime($first_datetime) < $this_month) {
        $ym['prev_year'] = date('Y', $prev_month);
        $ym['prev_month'] = date('n', $prev_month);
    }
    if ($next_month < time()) {
        $ym['next_year'] = date('Y', $next_month);
        $ym['next_month'] = date('n', $next_month);
    }
    $calendar['ym'] = $ym;

    return $calendar;
}

/**
 * メッセージページのカレンダー生成
 */
function db_common_message_monthly_calendar($u, $year, $month, $c_member_id, $box)
{
    include_once 'Calendar/Month/Weekdays.php';
    $Month = new Calendar_Month_Weekdays($year, $month, 0);
    $Month->build();

    $is_message_list = db_message_is_message_list4date($u, $year, $month, $box);

    $calendar = array();
    $week = 0;
    while ($Day = $Month->fetch()) {
        if ($Day->isFirst()) $week++;

        if ($Day->isEmpty()) {
            $calendar['days'][$week][] = array();
        } else {
            $day = $Day->thisDay();
            $item = array(
                'day' => $day,
                'is_message' => @in_array($day, $is_message_list),
            );
            $calendar['days'][$week][] = $item;
        }
    }

    if ($box == 'inbox' || !$box) {
        $where = "c_member_id_to = ?".
                 " AND is_deleted_to = 0" .
                 " AND is_send = 1";
    } elseif ($box == 'outbox') {
        $where = "c_member_id_from = ?".
                 " AND is_deleted_from = 0" .
                 " AND is_send = 1";
    } else {
        return null;
    }

    // 最初にメッセージを書いた日
    $sql = "SELECT r_datetime FROM c_message WHERE $where ORDER BY r_datetime";
    $first_datetime = db_get_one($sql, array(intval($u)));

    // 前の月、次の月
    $prev_month = $Month->prevMonth('timestamp');
    $this_month = $Month->thisMonth('timestamp');
    $next_month = $Month->nextMonth('timestamp');

    $ym = array(
        'disp_year'  => $year,
        'disp_month' => $month,
        'prev_year'  => null,
        'prev_month' => null,
        'next_year'  => null,
        'next_month' => null,
    );
    if ($first_datetime && strtotime($first_datetime) < $this_month) {
        $ym['prev_year'] = date('Y', $prev_month);
        $ym['prev_month'] = date('n', $prev_month);
    }
    if ($next_month < time()) {
        $ym['next_year'] = date('Y', $next_month);
        $ym['next_month'] = date('n', $next_month);
    }
    $calendar['ym'] = $ym;

    return $calendar;
}

//---

/**
 * スキン画像のfilenameを取得
 */
function db_get_c_skin_filename_list()
{
    $sql = 'SELECT skinname, filename FROM c_skin_filename';
    return db_get_assoc($sql);
}

function db_get_c_skin_filename4skinname($skinname)
{
    static $table;
    if (!isset($table)) {
        $table = (array)db_get_c_skin_filename_list();
    }

    if (empty($table[$skinname])) {
        return '';
    } else {
        return $table[$skinname];
    }
}

//---

/**
 * DBテンプレートを読み込み
 */
function db_get_c_template_source($name)
{
    $sql = 'SELECT source FROM c_template WHERE name = ?';
    $params = array(strval($name));
    return db_get_one($sql, $params);
}

/**
 * ナビゲーション項目を取得
 */
function db_get_c_navi($navi_type = 'h')
{
    $sql = 'SELECT * FROM c_navi WHERE navi_type = ? ORDER BY sort_order';
    $params = array(strval($navi_type));
    return db_get_all($sql, $params);
}

?>
<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

//--- 退会

/**
 * SNSメンバー退会
 * 
 * @param int $c_member_id
 */
function db_common_delete_c_member($c_member_id)
{
    //function cache削除
    cache_drop_c_member($c_member_id);

    //// --- 双方向パターン
    $double = array(intval($c_member_id), intval($c_member_id));

    // c_access_block
    $sql = 'DELETE FROM c_access_block WHERE c_member_id = ? OR c_member_id_block = ?';
    db_query($sql, $double);

    // c_bookmark
    $sql = 'DELETE FROM c_bookmark WHERE c_member_id_from = ? OR c_member_id_to = ?';
    db_query($sql, $double);

    // c_friend
    $sql = 'DELETE FROM c_friend WHERE c_member_id_from = ? OR c_member_id_to = ?';
    db_query($sql, $double);

    // c_friend_confirm
    $sql = 'DELETE FROM c_friend_confirm WHERE c_member_id_from = ? OR c_member_id_to = ?';
    db_query($sql, $double);


    //// --- 単一パターン
    $single = array(intval($c_member_id));

    // c_ktai_address_pre
    $sql = 'DELETE FROM c_ktai_address_pre WHERE c_member_id = ?';
    db_query($sql, $single);

    // c_member_ktai_pre
    $sql = 'DELETE FROM c_member_ktai_pre WHERE c_member_id_invite = ?';
    db_query($sql, $single);

    // c_pc_address_pre
    $sql = 'DELETE FROM c_pc_address_pre WHERE c_member_id = ?';
    db_query($sql, $single);

    // c_review_clip
    $sql = 'DELETE FROM c_review_clip WHERE c_member_id = ?';
    db_query($sql, $single);

    // c_review_comment
    $sql = 'DELETE FROM c_review_comment WHERE c_member_id = ?';
    db_query($sql, $single);

    // c_rss_cache
    $sql = 'DELETE FROM c_rss_cache WHERE c_member_id = ?';
    db_query($sql, $single);

    // c_schedule
    $sql = 'DELETE FROM c_schedule WHERE c_member_id = ?';
    db_query($sql, $single);


    //// --- 特殊パターン

    ///コミュニティ関連
    // c_commu_member
    $sql = 'DELETE FROM c_commu_member WHERE c_member_id = ?';
    db_query($sql, $single);

    // c_commu (画像)
    $sql = 'SELECT * FROM c_commu WHERE c_member_id_admin = ?';
    $c_commu_list = db_get_all($sql, $single);

    foreach ($c_commu_list as $c_commu) {
        if (!_db_count_c_commu_member_list4c_commu_id($c_commu['c_commu_id'])) {
            // コミュニティ削除
            db_common_delete_c_commu($c_commu['c_commu_id']);
        } else {
            // 管理者交代
            // 参加日時が一番古い人
            $sql = 'SELECT c_member_id FROM c_commu_member WHERE c_commu_id = ?'.
                ' ORDER BY r_datetime';
            $params = array(intval($c_commu['c_commu_id']));
            $new_admin_id = db_get_one($sql, $params);

            $data = array('c_member_id_admin' => intval($new_admin_id));
            $where = array('c_commu_id' => intval($c_commu['c_commu_id']));
            db_update('c_commu', $data, $where);
        }
    }

    // c_commu_admin_confirm
    $sql = 'DELETE FROM c_commu_admin_confirm WHERE c_member_id_to = ?';
    db_query($sql, $single);

    // c_commu_member_confirm
    $sql = 'DELETE FROM c_commu_member_confirm WHERE c_member_id = ?';
    db_query($sql, $single);

    // c_commu_review
    $sql = 'DELETE FROM c_commu_review WHERE c_member_id = ?';
    db_query($sql, $single);

    // c_event_member
    $sql = 'DELETE FROM c_event_member WHERE c_member_id = ?';
    db_query($sql, $single);


    ///日記関連
    // c_diary (画像)
    $sql = 'SELECT * FROM c_diary WHERE c_member_id = ?';
    $c_diary_list = db_get_all($sql, $single);
    foreach ($c_diary_list as $c_diary) {
        image_data_delete($c_diary['image_filename_1']);
        image_data_delete($c_diary['image_filename_2']);
        image_data_delete($c_diary['image_filename_3']);

        // c_diary_comment
        $sql = 'SELECT * FROM c_diary_comment WHERE c_diary_id = ?';
        $params = array(intval($c_diary['c_diary_id']));
        $c_diary_comment_list = db_get_all($sql, $params);
        foreach ($c_diary_comment_list as $c_diary_comment) {
            image_data_delete($c_diary_comment['image_filename_1']);
            image_data_delete($c_diary_comment['image_filename_2']);
            image_data_delete($c_diary_comment['image_filename_3']);
        }

        $sql = 'DELETE FROM c_diary_comment WHERE c_diary_id = ?';
        db_query($sql, $params);
    }
    $sql = 'DELETE FROM c_diary WHERE c_member_id = ?';
    db_query($sql, $single);


    ///メンバー関連
    // c_member_pre
    $sql = 'SELECT * FROM c_member_pre WHERE c_member_id_invite = ?';
    $c_member_pre_list = db_get_all($sql, $single);
    foreach ($c_member_pre_list as $c_member_pre) {
        // c_member_pre_profile
        $sql = 'DELETE FROM c_member_pre_profile WHERE c_member_pre_id = ?';
        $params = array(intval($c_member_pre['c_member_pre_id']));
        db_query($sql, $params);
    }
    $sql = 'DELETE FROM c_member_pre WHERE c_member_id_invite = ?';
    db_query($sql, $single);

    // c_member_profile
    $sql = 'DELETE FROM c_member_profile WHERE c_member_id = ?';
    db_query($sql, $single);

    // c_member_secure
    $sql = 'DELETE FROM c_member_secure WHERE c_member_id = ?';
    db_query($sql, $single);

    // c_member (画像)
    $sql = 'SELECT image_filename_1, image_filename_2, image_filename_3' .
        ' FROM c_member WHERE c_member_id = ?';
    $c_member = db_get_row($sql, $single);
    image_data_delete($c_member['image_filename_1']);
    image_data_delete($c_member['image_filename_2']);
    image_data_delete($c_member['image_filename_3']);

    $sql = 'DELETE FROM c_member WHERE c_member_id = ?';
    db_query($sql, $single);
    
    $sql = 'DELETE FROM c_username WHERE c_member_id = ?';
    db_query($sql, $single);
}

/**
 * コミュニティ削除
 * 関連情報を合わせて削除する
 * 
 * @param int $c_commu_id
 */
function db_common_delete_c_commu($c_commu_id)
{
    //function cacheの削除
    cache_drop_c_commu($c_commu_id);

    $single = array(intval($c_commu_id));

    $sql = 'SELECT * FROM c_commu WHERE c_commu_id = ?';
    $c_commu = db_get_row($sql, $single);

    // 画像削除
    image_data_delete($c_commu['image_filename']);

    // c_commu_admin_confirm
    $sql = 'DELETE FROM c_commu_admin_confirm WHERE c_commu_id = ?';
    db_query($sql, $single);

    // c_commu_member
    $sql = 'DELETE FROM c_commu_member WHERE c_commu_id = ?';
    db_query($sql, $single);

    // c_commu_member_confirm
    $sql = 'DELETE FROM c_commu_member_confirm WHERE c_commu_id = ?';
    db_query($sql, $single);

    // c_commu_review
    $sql = 'DELETE FROM c_commu_review WHERE c_commu_id = ?';
    db_query($sql, $single);

    ///トピック関連
    $sql = 'SELECT * FROM c_commu_topic WHERE c_commu_id = ?';
    $topic_list = db_get_all($sql, $single);

    foreach ($topic_list as $topic) {
        // c_commu_topic_comment(画像)
        $sql = 'SELECT image_filename1, image_filename2, image_filename3' .
            ' FROM c_commu_topic_comment WHERE c_commu_topic_id = ?';
        $params = array(intval($topic['c_commu_topic_id']));
        $topic_comment_list = db_get_all($sql, $params);
        foreach ($topic_comment_list as $topic_comment) {
            image_data_delete($topic_comment['image_filename1']);
            image_data_delete($topic_comment['image_filename2']);
            image_data_delete($topic_comment['image_filename3']);
        }
        $sql = 'DELETE FROM c_commu_topic_comment WHERE c_commu_topic_id = ?';
        db_query($sql, $params);

        // c_event_member
        $sql = 'DELETE FROM c_event_member WHERE c_commu_topic_id = ?';
        db_query($sql, $params);
    }

    // c_commu_topic
    $sql = 'DELETE FROM c_commu_topic WHERE c_commu_id = ?';
    db_query($sql, $single);

    // c_commu
    $sql = 'DELETE FROM c_commu WHERE c_commu_id = ?';
    db_query($sql, $single);
}

//--- ログ

/**
 * バナーのクリックログを追加
 */
function db_banner_insert_c_banner_log($c_banner_id, $c_member_id, $clicked_from)
{
    $data = array(
        'c_banner_id' => intval($c_banner_id),
        'c_member_id' => intval($c_member_id),
        'clicked_from' => $clicked_from,
        'r_datetime' => db_now(),
        'r_date' => db_now(),
    );
    return db_insert('c_banner_log', $data);
}

/**
 * 検索ログを追加
 */
function do_common_insert_search_log($c_member_id, $searchword)
{
    if (!$searchword) return false;

    $data = array(
        'c_member_id' => intval($c_member_id),
        'searchword'  => $searchword,
        'r_datetime'  => db_now(),
    );
    return db_insert('c_searchlog', $data);
}

function p_access_log($c_member_id, $page_name, $ktai_flag = "0")
{
    if (!$page_name) return false;

    $data = array(
        'c_member_id'             => intval($c_member_id),
        'page_name'               => $page_name,
        'target_c_member_id'      => '',
        'target_c_commu_id'       => '',
        'target_c_commu_topic_id' => '',
        'target_c_diary_id'       => '',
        'ktai_flag'               => (bool)$ktai_flag,
        'r_datetime' => db_now(),
    );

    $target_ids = array(
        'target_c_member_id',
        'target_c_commu_id',
        'target_c_commu_topic_id',
        'target_c_diary_id',
    );
    foreach ($target_ids as $key) {
        if (isset($_REQUEST[$key])) {
            $data[$key] = intval($_REQUEST[$key]);
        }
    }

    db_insert('c_access_log', $data);
}

/**
 * スキン画像のfilenameを登録
 */
function db_replace_c_skin_filename($skinname, $filename)
{
    db_delete_c_skin_filename($skinname);

    $data = array(
        'skinname' => strval($skinname),
        'filename' => strval($filename),
    );
    return db_insert('c_skin_filename', $data);
}

/**
 * スキン画像を削除(デフォルトに戻す)
 */
function db_delete_c_skin_filename($skinname)
{
    $sql = 'SELECT * FROM c_skin_filename WHERE skinname = ?';
    $params = array(strval($skinname));
    if ($skin_filename = db_get_row($sql, $params)) {
        image_data_delete($skin_filename['filename']);
        $sql = 'DELETE FROM c_skin_filename WHERE skinname = ?';
        return db_query($sql, $params);
    } else {
        return false;
    }
}

/**
 * デフォルト画像をマスター画像からコピー(デフォルトに戻すの一環)
 */
function db_master_copy_c_skin_filename($skinname)
{

    $data = array(
        'skinname' => strval($skinname),
        'filename' => 'skin_'.strval($skinname).'.gif',
    );
    db_insert('c_skin_filename', $data);

    $sql = "INSERT INTO c_image (SELECT '', ?, bin, ?, type FROM c_image WHERE filename = ?)";
    $params = array(
        'skin_'.strval($skinname).'.gif',
        db_now(),
        'skin_'.strval($skinname).'_master.gif',
    );
    db_query($sql, $params);
}

//---

/**
 * DBテンプレートを削除
 */
function db_delete_c_template($name)
{
    $sql = 'DELETE FROM c_template WHERE name = ?';
    $params = array(strval($name));
    return db_query($sql, $params);
}

/**
 * DBテンプレートを登録
 */
function db_replace_c_template($name, $source)
{
    db_delete_c_template($name);

    $data = array(
        'name' => strval($name),
        'source' => strval($source),
        'r_datetime' => db_now(),
    );
    return db_insert('c_template', $data);
}

/**
 * ナビゲーション項目を削除
 */
function db_delete_c_navi($navi_type, $sort_order)
{
    $sql = 'DELETE FROM c_navi WHERE navi_type = ? AND sort_order = ?';
    $params = array(strval($navi_type), intval($sort_order));
    return db_query($sql, $params);
}

/**
 * ナビゲーション項目を登録
 */
function db_replace_c_navi($navi_type, $sort_order, $url, $caption)
{
    db_delete_c_navi($navi_type, $sort_order);

    $data = array(
        'navi_type' => strval($navi_type),
        'sort_order' => intval($sort_order),
        'url' => strval($url),
        'caption' => strval($caption),
    );
    return db_insert('c_navi', $data);
}

//小窓の使用範囲をチェック
function db_is_use_cmd($src, $type)
{
    $sql = 'SELECT * FROM c_cmd WHERE name = ?';
    $params = array(strval($src));
    $c_cmd = db_get_row($sql, $params);

    $permit_list = db_get_permit_list();

    foreach ($permit_list as $key => $name) {
        if (($c_cmd['permit'] & $key)
         && preg_match('/'.$c_cmd['name'].'/', $src)
         && $name == $type) {
            return true;
        }
    }

    return false;
}

//小窓の使用範囲のリスト
function db_get_permit_list()
{
    return array(
        '1' => 'community',
        '2' => 'diary',
        '4' => 'profile',
    );
}

/**
 * カレンダーの祝日を取得する
 */
function db_c_holiday_list4date($m, $d)
{
    $sql = 'SELECT name FROM c_holiday WHERE month = ? AND day = ?';
    $params = array(intval($m), intval($d));
    return db_get_col($sql, $params);
}
?>
