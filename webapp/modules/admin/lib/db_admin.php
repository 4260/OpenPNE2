<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

/**
 * ユーザーリスト取得
 */
function db_admin_c_member_list($page, $page_size, &$pager)
{
    $sql = 'SELECT c_member_id FROM c_member ORDER BY c_member_id';
    $ids = db_get_col_page($sql, $page, $page_size);

    $c_member_list = array();
    foreach ($ids as $id) {
        $c_member_list[] = db_common_c_member4c_member_id($id, true, true, 'private');
    }

    $sql = 'SELECT COUNT(*) FROM c_member';
    $total_num = db_get_one($sql);
    $pager = admin_make_pager($page, $page_size, $total_num);

    return $c_member_list;
}

function db_admin_c_member4mail_address($mail_address)
{
    $sql = 'SELECT c_member_id FROM c_member_secure' .
            ' WHERE pc_address = ? OR ktai_address = ? OR regist_address = ?';
    $enc_address = t_encrypt($mail_address);
    $params = array($enc_address, $enc_address, $enc_address);
    $list = db_get_col($sql, $params);

    $c_member_list = array();
    foreach ($list as $c_member_id) {
        $c_member_list[] = db_common_c_member4c_member_id($c_member_id, true, true, 'private');
    }
    return $c_member_list;
}

function db_admin_c_siteadmin($target)
{
    $sql = 'SELECT * FROM c_siteadmin WHERE target = ?';
    $params = array($target);
    return db_get_row($sql, $params);
}

function db_admin_insert_c_siteadmin($target, $body)
{
    $data = array(
        'target' => $target,
        'body' => $body,
        'r_date' => db_now(),
    );
    return db_insert('c_siteadmin', $data);
}

function db_admin_update_c_siteadmin($target, $body)
{
    $data = array(
        'body' => $body,
        'r_date' => db_now(),
    );
    $where = array('target' => $target);
    return db_update('c_siteadmin', $data, $where);
}

function db_admin_update_c_sns_config($data)
{
    $where = array('c_sns_config_id' => 1);
    return db_update('c_sns_config', $data, $where);
}

function db_admin_delete_c_profile_option($c_profile_option_id)
{
    if (!$c_profile_option_id) {
        return false;
    }
    $sql = 'DELETE FROM c_member_profile WHERE c_profile_option_id = ?';
    $params = array(intval($c_profile_option_id));
    db_query($sql, $params);

    $sql = 'DELETE FROM c_profile_option WHERE c_profile_option_id = ?';
    db_query($sql, $params);

    return true;
}

function db_admin_insert_c_profile_option($c_profile_id, $value, $sort_order)
{
    $data = array(
        'c_profile_id' => intval($c_profile_id),
        'value' => $value,
        'sort_order' => intval($sort_order),
    );
    return db_insert('c_profile_option', $data);
}

function db_admin_update_c_profile_option($c_profile_option_id, $value, $sort_order)
{
    $data = array('value' => $value);
    $where = array('c_profile_option_id' => intval($c_profile_option_id));
    db_update('c_member_profile', $data, $where);

    $data = array(
        'value' => $value,
        'sort_order' => intval($sort_order),
    );
    db_update('c_profile_option', $data, $where);
}

function db_admin_insert_c_banner($a_href, $type, $nickname)
{
    $data = array(
        'a_href' => $a_href,
        'type' => $type,
        'nickname' => $nickname,
        'is_hidden_after' => 0,
        'is_hidden_before' => 0,
    );
    return db_insert('c_banner', $data);
}

function db_admin_update_c_banner($c_banner_id, $sets)
{
    $where = array('c_banner_id' => intval($c_banner_id));
    db_update('c_banner', $sets, $where);
}

function db_admin_delete_c_banner($c_banner_id)
{
    db_admin_delete_c_image4c_banner_id($c_banner_id);

    $sql = 'DELETE FROM c_banner WHERE c_banner_id = ?';
    $params = array(intval($c_banner_id));
    db_query($sql, $params);
}

function db_admin_delete_c_image4c_banner_id($c_banner_id)
{
    $sql = 'SELECT image_filename FROM c_banner WHERE c_banner_id = ?';
    $params = array(intval($c_banner_id));
    $image_filename = db_get_one($sql, $params);
    image_data_delete($image_filename);
}

function db_admin_insert_c_profile(
    $name
    , $caption
    , $is_required
    , $public_flag_edit
    , $public_flag_default
    , $form_type
    , $sort_order
    , $disp_regist
    , $disp_config
    , $disp_search
    , $val_type
    , $val_regexp
    , $val_min
    , $val_max
    )
{
    $data = array(
        'name' => $name,
        'caption' => $caption,
        'is_required' => (bool)$is_required,
        'public_flag_edit' => (bool)$public_flag_edit,
        'public_flag_default' => $public_flag_default,
        'form_type' => $form_type,
        'sort_order' => (int)$sort_order,
        'disp_regist' => (bool)$disp_regist,
        'disp_config' => (bool)$disp_config,
        'disp_search' => (bool)$disp_search,
        'val_type' => $val_type,
        'val_regexp' => $val_regexp,
        'val_min' => (int)$val_min,
        'val_max' => (int)$val_max,
    );
    return db_insert('c_profile', $data);
}

function db_admin_update_c_profile($c_profile_id
    , $name
    , $caption
    , $is_required
    , $public_flag_edit
    , $public_flag_default
    , $form_type
    , $sort_order
    , $disp_regist
    , $disp_config
    , $disp_search
    , $val_type
    , $val_regexp
    , $val_min
    , $val_max
    )
{
    $data = array(
        'name' => $name,
        'caption' => $caption,
        'is_required' => (bool)$is_required,
        'public_flag_edit' => (bool)$public_flag_edit,
        'public_flag_default' => $public_flag_default,
        'form_type' => $form_type,
        'sort_order' => intval($sort_order),
        'disp_regist' => (bool)$disp_regist,
        'disp_config' => (bool)$disp_config,
        'disp_search' => (bool)$disp_search,
        'val_type' => $val_type,
        'val_regexp' => $val_regexp,
        'val_min' => intval($val_min),
        'val_max' => intval($val_max),
    );
    $where = array('c_profile_id' => intval($c_profile_id));
    db_update('c_profile', $data, $where);

    // 公開設定が固定のときはユーザーの設定値を上書き
    if (!$public_flag_edit) {
        $data = array('public_flag' => $public_flag_default);
        db_update('c_member_profile', $data, $where);
    }
}

function db_admin_delete_c_profile($c_profile_id)
{
    $params = array(intval($c_profile_id));

    // メンバーのプロフィールから削除
    $sql = 'DELETE FROM c_member_profile WHERE c_profile_id = ?';
    db_query($sql, $params);

    // 選択肢項目を削除
    $sql = 'DELETE FROM c_profile_option WHERE c_profile_id = ?';
    db_query($sql, $params);

    // プロフィール項目を削除
    $sql = 'DELETE FROM c_profile WHERE c_profile_id = ?';
    db_query($sql, $params);
}

function db_admin_c_profile4c_profile_id($c_profile_id)
{
    $sql = 'SELECT * FROM c_profile WHERE c_profile_id = ?';
    $params = array(intval($c_profile_id));
    return db_get_row($sql, $params);
}

/**
 * 全バナー取得
 * 
 * @param  int $limit 取得最大件数
 * @return array_of_array  c_banner_list バナー配列
 */
function db_admin_c_banner_list4null($type = '')
{
    $sql = 'SELECT * FROM c_banner';
    $params = array();
    if ($type) {
        $sql .= ' WHERE type = ?';
        $params[] = $type;
    }
    return db_get_all($sql, $params);
}

function db_admin_c_commu_category_parent_list()
{
    $sql = 'SELECT * FROM c_commu_category_parent ORDER BY sort_order';
    return db_get_all($sql);
}

function db_admin_c_commu_category_list()
{
    $sql = 'SELECT * FROM c_commu_category ORDER BY sort_order';
    $list = db_get_all($sql);

    $category_list = array();
    foreach ($list as $item) {
        $category_list[$item['c_commu_category_parent_id']][] = $item;
    }
    return $category_list;
}

function db_admin_insert_c_commu_category_parent($name, $sort_order)
{
    $data = array(
        'name' => $name,
        'sort_order' => intval($sort_order),
    );
    return db_insert('c_commu_category_parent', $data);
}

function db_admin_update_c_commu_category_parent($c_commu_category_parent_id, $name, $sort_order)
{
    $data = array(
        'name' => $name,
        'sort_order' => intval($sort_order),
    );
    $where = array(
        'c_commu_category_parent_id' => intval($c_commu_category_parent_id)
    );
    db_update('c_commu_category_parent', $data, $where);
}

function db_admin_delete_c_commu_category_parent($c_commu_category_parent_id)
{
    $params = array(intval($c_commu_category_parent_id));

    // 小カテゴリを削除
    $sql = 'DELETE FROM c_commu_category WHERE c_commu_category_parent_id = ?';
    db_query($sql, $params);

    // 中カテゴリを削除
    $sql = 'DELETE FROM c_commu_category_parent WHERE c_commu_category_parent_id = ?';
    db_query($sql, $params);
}

function db_admin_insert_c_commu_category($c_commu_category_parent_id, $name, $sort_order)
{
    $data = array(
        'c_commu_category_parent_id' => intval($c_commu_category_parent_id),
        'name' => $name,
        'sort_order' => intval($sort_order),
    );
    return db_insert('c_commu_category', $data);
}

function db_admin_update_c_commu_category($c_commu_category_id, $name, $sort_order)
{
    $data = array(
        'name' => $name,
        'sort_order' => intval($sort_order)
    );
    $where = array('c_commu_category_id' => intval($c_commu_category_id));
    db_update('c_commu_category', $data, $where);
}

function db_admin_delete_c_commu_category($c_commu_category_id)
{
    // 小カテゴリを削除
    $sql = 'DELETE FROM c_commu_category WHERE c_commu_category_id = ?';
    $params = array(intval($c_commu_category_id));
    db_query($sql, $params);
}

function db_admin_c_admin_user_id4username($username)
{
    $sql = 'SELECT c_admin_user_id FROM c_admin_user WHERE username = ?';
    $params = array($username);
    return db_get_one($sql, $params);
}

function db_admin_authenticate_password($uid, $password)
{
    $sql = 'SELECT c_admin_user_id FROM c_admin_user WHERE c_admin_user_id = ? AND password = ?';
    $params = array(intval($uid), md5($password));
    return (bool)db_get_one($sql, $params);
}

function db_admin_update_c_admin_user_password($uid, $password)
{
    $data = array('password' => md5($password));
    $where = array('c_admin_user_id' => intval($uid));
    db_update('c_admin_user', $data, $where);
}

function db_admin_c_admin_config4name($name)
{
    $sql = 'SELECT value FROM c_admin_config WHERE name = ?';
    $params = array($name);
    return db_get_one($sql, $params);
}

function db_admin_insert_c_admin_config($name, $value)
{
    $data = array(
        'name' => $name,
        'value' => $value,
    );
    return db_insert('c_admin_config', $data);
}

function db_admin_update_c_admin_config($name, $value)
{
    $data = array('value' => $value);
    $where = array('name' => $name);
    db_update('c_admin_config', $data, $where);
}

function db_admin_replace_c_admin_config($name, $value)
{
    $sql = 'DELETE FROM c_admin_config WHERE name = ?';
    $params = array($name);
    db_query($sql, $params);

    $data = array(
        'name'  => strval($name),
        'value' => strval($value),
    );
    return db_insert('c_admin_config', $data);
}

function db_admin_c_admin_config_all()
{
    $sql = 'SELECT name, value FROM c_admin_config';
    return db_get_assoc($sql);
}

function db_admin_delete_c_image_link4image_filename($image_filename)
{
    // c_banner (削除)
    $sql = 'DELETE FROM c_banner WHERE image_filename = ?';
    $params = array($image_filename);
    db_query($sql, $params);

    // c_commu
    $tbl = 'c_commu';
    _db_admin_empty_image_filename($tbl, $image_filename);

    // c_commu_topic_comment
    $tbl = 'c_commu_topic_comment';
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename1');
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename2');
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename3');

    // c_diary
    $tbl = 'c_diary';
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename_1');
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename_2');
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename_3');

    // c_diary_comment
    $tbl = 'c_diary_comment';
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename_1');
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename_2');
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename_3');

    // c_member
    $tbl = 'c_member';
    _db_admin_empty_image_filename($tbl, $image_filename);
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename_1');
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename_2');
    _db_admin_empty_image_filename($tbl, $image_filename, 'image_filename_3');
}

function _db_admin_empty_image_filename($tbl, $image_filename, $column = 'image_filename')
{
    $data = array(
        db_escapeIdentifier($column) => '',
    );
    $where = array(
        db_escapeIdentifier($column) => $image_filename,
    );
    db_update(db_escapeIdentifier($tbl), $data, $where);
}

function db_admin_c_profile_name_exists($name)
{
    $sql = 'SELECT c_profile_id FROM c_profile WHERE name = ?';
    $params = array($name);
    return db_get_one($sql, $params);
}

function db_admin_update_is_login_rejected($c_member_id)
{
    $sql = 'SELECT is_login_rejected FROM c_member WHERE c_member_id = ?';
    $params = array(intval($c_member_id));
    $is_login_rejected = db_get_one($sql, $params);
    if (is_null($is_login_rejected)) {
        return false;
    }

    $data = array('is_login_rejected' => !($is_login_rejected));
    $where = array('c_member_id' => intval($c_member_id));
    return db_update('c_member', $data, $where);
}

function db_admin_c_admin_user_list()
{
    $sql = 'SELECT * FROM c_admin_user ORDER BY c_admin_user_id';
    return db_get_all($sql);
}

function db_admin_exists_c_admin_username($username)
{
    $sql = 'SELECT c_admin_user_id FROM c_admin_user WHERE username = ?';
    $params = array(strval($username));
    return (bool)db_get_one($sql, $params);
}

function db_admin_insert_c_admin_user($username, $password, $auth_type)
{
    $data = array(
        'username' => strval($username),
        'password' => md5($password),
        'auth_type' => strval($auth_type),
    );
    return db_insert('c_admin_user', $data);
}

function db_admin_delete_c_admin_user($c_admin_user_id)
{
    $sql = 'DELETE FROM c_admin_user WHERE c_admin_user_id = ?';
    $params = array(intval($c_admin_user_id));
    return db_query($sql, $params);
}

function db_admin_get_auth_type($c_admin_user_id)
{
    $sql = 'SELECT auth_type FROM c_admin_user WHERE c_admin_user_id = ?';
    $params = array(intval($c_admin_user_id));
    return db_get_one($sql, $params);
}

/**
 * ユーザーIDリスト取得(絞り込み対応)
 */
function _db_admin_c_member_id_list($cond_list)
{
    $sql = 'SELECT c_member_id'.
           ' FROM c_member'.
           ' WHERE 1';

    //開始年
    if (!empty($cond_list['s_year'])) {
        $sql .= ' AND birth_year >= ?';
        $params[] = $cond_list['s_year'];
    }
    //終了年
    if (!empty($cond_list['e_year'])) {
        $sql .= ' AND birth_year <= ?';
        $params[] = $cond_list['e_year'];
    }
    $sql .= ' ORDER BY c_member_id';

    $ids = db_get_col($sql, $params);

    //各プロフィールごとで絞り結果をマージする
    $_sql = 'SELECT name FROM c_profile WHERE (form_type = ? OR form_type = ?)';
    $profile = db_get_col($_sql, array('select', 'radio'));

    if ( $profile ) {
        foreach ($profile as $value) {
            if (!empty($cond_list[$value])) {
                $sql = 'SELECT c_member_id FROM c_member_profile WHERE c_profile_option_id = ?';
                $params = array($cond_list[$value]);
                $temp_ids = db_get_col($sql, $params);
                $ids = array_intersect($ids, $temp_ids);
            }
        }
    }

    return $ids;
}

/**
 * ユーザーリスト取得
 * 誕生年+プロフィール(select,radioのみ)
 */
function _db_admin_c_member_list($page, $page_size, &$pager, $cond_list)
{
    $ids = _db_admin_c_member_id_list($cond_list);
    $total_num = count($ids);
    $ids = array_slice($ids, ($page - 1) * $page_size, $page_size);

    $c_member_list = array();
    foreach ($ids as $id) {
        $c_member_list[] = db_common_c_member4c_member_id($id, true, true, 'private');
    }

    if ($total_num > 0) {
        $pager = admin_make_pager($page, $page_size, $total_num);
    }

    return $c_member_list;
}

function db_c_profile_option4c_profile_option_id($c_profile_option_id)
{
    $sql = "SELECT * FROM c_profile_option WHERE c_profile_option_id = ? ";
    $params = array(intval($c_profile_option_id));
    return db_get_row($sql, $params);
}

/**
 * メンバー絞込みパラメータ取得
 */
function validate_cond($requests)
{
    $cond_list = array();
    //誕生年
    if (!empty($requests['s_year'])) {
        $cond_list['s_year'] = intval($requests['s_year']);
    }
    if (!empty($requests['e_year'])) {
        $cond_list['e_year'] = intval($requests['e_year']);
    }
    //プロフィール
    $profile_list = db_common_c_profile_list();

    foreach ($profile_list as $key => $value) {
        if (!empty($requests[$key])) {
            $cond_list[$key] = intval($requests[$key]);
        }
    }
    return $cond_list;
}

function do_admin_send_mail($c_member_id, $subject, $body)
{
    $c_member = db_common_c_member4c_member_id($c_member_id, true);

    if ($c_member['secure']['pc_address']) {
        $send_address = $c_member['secure']['pc_address'];
    } else {
        $send_address = $c_member['secure']['ktai_address'];
    }

    if (OPENPNE_MAIL_QUEUE) {
        //メールキューに蓄積
        put_mail_queue($send_address, $subject, $body);
    } else {
        t_send_email($send_address, $subject, $body);
    }
}

//メッセージ受信メール（メールキュー蓄積対応）
function do_admin_send_message($c_member_id_from, $c_member_id_to, $subject, $body)
{
    //メッセージ
    $c_message_id = _do_insert_c_message($c_member_id_from, $c_member_id_to, $subject, $body);

    do_admin_send_message_mail_send($c_member_id_to, $c_member_id_from);
    do_admin_send_message_mail_send_ktai($c_member_id_to, $c_member_id_from);

    return $c_message_id;
}

//メッセージ受信メール（メールキュー蓄積対応）
function do_admin_send_message_mail_send($c_member_id_to, $c_member_id_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $pc_address = $c_member_to['secure']['pc_address'];
    $is_receive_mail = $c_member_to['is_receive_mail'];

    $params = array(
        "c_member_to"   => db_common_c_member4c_member_id($c_member_id_to),
        "c_member_from" => db_common_c_member4c_member_id($c_member_id_from),
    );
    return admin_fetch_send_mail($pc_address, 'm_pc_message_zyushin', $params, $is_receive_mail);
}

//◆メッセージ受信メール(携帯)
function do_admin_send_message_mail_send_ktai($c_member_id_to, $c_member_id_from)
{
    $c_member_to = db_common_c_member4c_member_id($c_member_id_to, true);
    $ktai_address = $c_member_to['secure']['ktai_address'];
    $is_receive_ktai_mail = $c_member_to['is_receive_ktai_mail'];
    $p = array('kad' => t_encrypt($c_member_to['secure']['ktai_address']));
    $login_url = openpne_gen_url('ktai', 'page_o_login', $p);

    $params = array(
        'c_member_to'   => db_common_c_member4c_member_id($c_member_id_to),
        'c_member_from' => db_common_c_member4c_member_id($c_member_id_from),
        'login_url' => $login_url,
    );
    return admin_fetch_send_mail($ktai_address, 'm_ktai_message_zyushin', $params, $is_receive_ktai_mail);
}

function admin_fetch_send_mail($address, $tpl_name, $params = array(), $force = true, $from = '')
{
    $tpl_name .= '.tpl';
    if ($tpl = fetch_mail_m_tpl($tpl_name, $params)) {
        list($subject, $body) = $tpl;
        if ($from) {
            if (OPENPNE_MAIL_QUEUE) {
                //メールキューに蓄積
                put_mail_queue($address, $subject, $body, $force, $from);
            } else {
                t_send_email($address, $subject, $body, $force, $from);
            }
        } else {
            if (OPENPNE_MAIL_QUEUE) {
                //メールキューに蓄積
                put_mail_queue($address, $subject, $body, $force);
            } else {
                t_send_email($address, $subject, $body, $force);
            }
        }
        return true;
    } else {
        return false;
    }
}

function db_access_analysis_c_admin_user_id4username($username)
{
    $sql = "SELECT c_admin_user_id FROM c_admin_user" .
        " WHERE username = ?";
    $params = array($username);
    return db_get_one($sql,$params);
}

function p_access_analysis_month_access_analysis_month($ktai_flag)
{
    $sql = "SELECT concat(left(r_datetime, 7), '-01') as ym, count(*) as count" .
            " FROM c_access_log " .
            " where ktai_flag = ?" .
            " group by ym";
    $params = array(intval($ktai_flag));            
    $list = db_get_all($sql,$params);
    return $list;
}


function p_access_analysis_day_access_analysis_day($ym, $ktai_flag)
{
    $sql = "SELECT left(r_datetime,10) as ymd , count(*) as count" .
            " FROM c_access_log " .
            " where left(r_datetime, 7) = ?" .
            " and ktai_flag = ? " .
            " group by ymd";            
    $params = array(intval(substr($ym,0,7)),intval($ktai_flag));
    $list = db_get_all($sql,$params);
    
    $year = substr($ym, 0, 4);
    $month = substr($ym, 5,2);
    
    $return = array();
    $days_num = date("t", mktime (0,0,0,$month,1,$year));
    for($i=1 ; $i<=$days_num; $i++) {
        $date = substr($ym,0,8) . substr("00".$i, -2, 2);

        $count = 0;
        foreach($list as $value) {
            if ($value['ymd'] == $date) {
                $count = $value['count'];
            }
        }
        $return[] = array("ymd"=>$date, "count"=>$count);
    }
    return $return;
}

function get_page_name($ktai_flag, $orderby=1)
{
    if ($orderby == 1) {
        $orderby_str = " order by page_name asc";
    } elseif ($orderby == -1) {
        $orderby_str = " order by page_name desc";
    }
    $sql = "select distinct page_name from c_access_log " .
            " where ktai_flag = ? " .
            $orderby_str;
    $params = array(intval($ktai_flag));
    return db_get_col($sql,$params);
}

function p_access_analysis_page_access_analysis_page4ym($ymd, $month_flag, $ktai_flag, $orderby)
{

    if ($orderby == 1) {
        $orderby_str = " order by page_name asc";
    } elseif ($orderby == -1) {
        $orderby_str = " order by page_name desc";
    } elseif ($orderby == 2) {
        $orderby_str = " order by count asc";
    } elseif ($orderby == -2) {
        $orderby_str = " order by count desc";
    }
    $sql = "select page_name , count(*) as count from c_access_log where ktai_flag = ? ";
    $params = array(intval($ktai_flag));
    if ($month_flag) {
        $sql .= " and left(r_datetime, 7) = ? ";
        array_push($params,substr($ymd,0,7));
    } else {
        $sql .= " and left(r_datetime,10) = ? ";
        array_push($params,$ymd);
    }
    $sql .= " group by page_name ".    $orderby_str;
    $list = db_get_all($sql,$params);

    $sum = 0;
    $return = array();
    if (abs($orderby) == 1) {
        $page_name = get_page_name($ktai_flag, $orderby);
        foreach($page_name as $name) {
            $count = 0;
            foreach($list as $value) {
                if ($value['page_name'] == $name) $count = $value['count'];
            }

                list($is_target_c_member_id,$is_target_c_commu_id,$is_target_c_topic_id,$is_target_c_diary_id,$is_c_member_id) = get_is_show($name);

            $return[] = array("page_name"=>$name, "count"=> $count, "is_target_c_member_id"=> $is_target_c_member_id, "is_target_c_commu_id"=> $is_target_c_commu_id, "is_target_c_topic_id"=> $is_target_c_topic_id, "is_target_c_diary_id"=> $is_target_c_diary_id, "is_c_member_id"=> $is_c_member_id);
            $sum += $count;
        }
    } elseif (abs($orderby) == 2) {
        $page_name = get_page_name($ktai_flag);

        $t_page_name = $page_name;

        //アクセスがゼロのページを取得する
        foreach($page_name as $key=>$name) {
            foreach($list as $value) {
                if ($value['page_name'] == $name) {
                    unset($page_name[$key]);//$listに含まれるページネームを削除
                }
            }
        }

        foreach($page_name as $key=>$name) {
            $page_name[$key] = array("page_name"=>$name, "count"=>0);
        }

        if ($orderby == 2) {
            $return = array_merge($page_name , $list);
        } elseif ($orderby == -2) {
            $return = array_merge($list, $page_name);
        }
        foreach($list as $value) {
            $sum += $value['count'];
        }

        foreach($return as $value) {

            list($is_target_c_member_id,$is_target_c_commu_id,$is_target_c_topic_id,$is_target_c_diary_id,$is_c_member_id) = get_is_show($value['page_name']);

            $value['is_target_c_member_id'] = $is_target_c_member_id;
            $value['is_target_c_commu_id'] = $is_target_c_commu_id;
            $value['is_target_c_topic_id'] = $is_target_c_topic_id;
            $value['is_target_c_diary_id'] = $is_target_c_diary_id;
            $value['is_c_member_id'] = $is_c_member_id;
            $t_return[] = $value;

        }

        $return = $t_return;

    }
    
    return array($return, $sum);
}


/*
 * target_commu
 * 
 */
function p_access_analysis_target_commu_target_commu4ym_page_name
($ymd, $month_flag, $page_name, $ktai_flag, $page, $page_size, $orderby=1)
{
    
    $start = ($page - 1) * $page_size;
    
    if ($orderby == 1) {
        $orderby_str = " order by target_c_commu_id asc";
    } elseif ($orderby == -1) {
        $orderby_str = " order by target_c_commu_id desc";
    } elseif ($orderby == 2) {
        $orderby_str = " order by count asc";
    } elseif ($orderby == -2) {
        $orderby_str = " order by count desc";
    }
    
    $sql = "select target_c_commu_id , count(*) as count from c_access_log  where ktai_flag = ? ";
    $params = array(intval($ktai_flag));
    if ($month_flag) {
            $sql .= " and left(r_datetime, 7) = ? ";
            array_push($params,substr($ymd,0,7));
    } else {
            $sql .= " and left(r_datetime,10) = ? ";
            array_push($params,$ymd);
    }
    if ($page_name!="all") {
            $sql .= " and page_name = ? ";
            array_push($params,$page_name);
    }
    $sql .= " and target_c_commu_id <> 0 ";
    $sql .= " group by target_c_commu_id " .$orderby_str." limit $start, $page_size";
    $list = db_get_all($sql,$params);

    $return = array();
    $sum = 0;
    foreach($list as $key => $value) {
        if ($value['target_c_commu_id']) {
            $c_commu = _db_c_commu4c_commu_id($value['target_c_commu_id']);
            $return[] = array_merge($value, $c_commu);
            $sum += $value['count'];
        }
    }

    $sql =   "select count(*) from c_access_log  where ktai_flag = ? ";
    $params = array(intval($ktai_flag));
    if ($month_flag) {
        $sql .= " and left(r_datetime, 7) = ? ";
        array_push($params,substr($ymd,0,7));
    } else {
        $sql .= " and left(r_datetime,10) = ? ";
        array_push($params,$ymd);
    }
    if ($page_name!="all") {
        $sql .= " and page_name = ? ";
        array_push($params,$page_name);
    }
    $sql .= " and target_c_commu_id <> 0 ";
    $sql .= " group by target_c_commu_id ";
    $result = db_get_all($sql,$params);
    $total_num = count($result);

    if ($total_num != 0) {
        $total_page_num =  ceil($total_num / $page_size);
        if ($page >= $total_page_num) {
            $next = false;
        }else{
            $next = true;
        }
        if ($page <= 1) {
            $prev = false;
        }else{
            $prev = true;
        }
    }
    $start_num = ($page - 1) * $page_size + 1 ;
    $end_num =   ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;

    return array($return, $sum, $prev, $next, $total_num, $start_num, $end_num);    
}

function p_access_analysis_target_topic_target_topic4ym_page_name
($ymd, $month_flag, $page_name, $ktai_flag, $page, $page_size, $orderby=1)
{
    
    $start = ($page - 1) * $page_size;
    
    if ($orderby == 1) {
        $orderby_str = " order by target_c_commu_topic_id asc";
    } elseif ($orderby == -1) {
        $orderby_str = " order by target_c_commu_topic_id desc";
    } elseif ($orderby == 2) {
        $orderby_str = " order by count asc";
    } elseif ($orderby == -2) {
        $orderby_str = " order by count desc";
    }
    $where =" where ktai_flag = ? ";
    $params = array(intval($ktai_flag));
    if ($month_flag) {
            $where .= " and left(r_datetime, 7) = ? ";
            array_push($params,substr($ymd,0,7));
    } else {
            $where .= " and left(r_datetime,10) = ? ";
            array_push($params,$ymd);
    }
    if ($page_name!="all") {
            $where .= " and page_name = ? ";
            array_push($params,$page_name);
    }
    $sql = "select target_c_commu_topic_id , count(*) as count from c_access_log ";
    $sql .= $where." group by target_c_commu_topic_id " .$orderby_str." limit $start, $page_size";
    $list = db_get_all($sql,$params);
    $sql = "select count(*) from c_access_log ";
    $sql .= $where ." group by target_c_commu_topic_id ";
    $result = db_get_all($sql,$params);
    $total_num = count($result);

    $return = array();
    $sum = 0;
    foreach($list as $key => $value) {
        if ($value['target_c_commu_topic_id']) {
            $c_commu_topic = c_topic_detail_c_topic4c_commu_topic_id($value['target_c_commu_topic_id']);
            $c_commu_topic['topic_name'] = $c_commu_topic['name'];
            $c_commu = _db_c_commu4c_commu_id($c_commu_topic['c_commu_id']);
            $c_commu_topic['commu_name'] = $c_commu['name'];
            $return[] = array_merge($value, $c_commu_topic);
            $sum += $value['count'];
        }
    }

    if ($total_num != 0) {
        $total_page_num =  ceil($total_num / $page_size);
        if ($page >= $total_page_num) {
            $next = false;
        }else{
            $next = true;
        }
        if ($page <= 1) {
            $prev = false;
        }else{
            $prev = true;
        }
    }
    $start_num = ($page - 1) * $page_size + 1 ;
    $end_num =   ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;

    return array($return, $sum, $prev, $next, $total_num, $start_num, $end_num);    
}

function p_access_analysis_target_diary_target_diary4ym_page_name
($ymd, $month_flag, $page_name, $ktai_flag, $page, $page_size, $orderby=1)
{
    
    $start = ($page - 1) * $page_size;
    
    if ($orderby == 1) {
        $orderby_str = " order by target_c_diary_id asc";
    } elseif ($orderby == -1) {
        $orderby_str = " order by target_c_diary_id desc";
    } elseif ($orderby == 2) {
        $orderby_str = " order by count asc";
    } elseif ($orderby == -2) {
        $orderby_str = " order by count desc";
    }
    
    $sql = "select target_c_diary_id , count(*) as count from c_access_log where ktai_flag = ? ";
    $params = array(intval($ktai_flag));
    if ($month_flag) {
            $sql .= " and left(r_datetime, 7) = ? ";
            array_push($params,substr($ymd,0,7));
    } else {
            $sql .= " and left(r_datetime,10) = ? ";
            array_push($params,$ymd);
    }
    if ($page_name!="all") {
            $sql .= " and page_name = ? ";
            array_push($params,$page_name);
    }
    $sql .= " and target_c_diary_id <> 0 ";
    $sql .= " group by target_c_diary_id " . $orderby_str. " limit $start, $page_size";
    $list = db_get_all($sql,$params);

    $return = array();
    $sum = 0;
    foreach ($list as $key => $value) {
        if ($value['target_c_diary_id']) {
            $c_diary = db_diary_get_c_diary4id($value['target_c_diary_id']);
            $c_member = db_common_c_member4c_member_id($c_diary['c_member_id']);
            $c_diary['nickname'] = $c_member['nickname'];
            $return[] = array_merge($value, $c_diary);
            $sum += $value['count'];
        }
    }

    $sql =   "select count(*) from c_access_log where ktai_flag = ? ";
    $params = array(intval($ktai_flag));
    if ($month_flag) {
            $sql .= " and left(r_datetime, 7) = ? ";
            array_push($params,substr($ymd,0,7));
    } else {
            $sql .= " and left(r_datetime,10) = ? ";
            array_push($params,$ymd);
    }
    $sql .= " and target_c_diary_id <> 0 ";
    $sql .= " group by target_c_diary_id ";
    $result = db_get_all($sql,$params);
    $total_num = count($result);

    if ($total_num != 0) {
        $total_page_num =  ceil($total_num / $page_size);
        if ($page >= $total_page_num) {
            $next = false;
        }else{
            $next = true;
        }
        if ($page <= 1) {
            $prev = false;
        }else{
            $prev = true;
        }
    }
    $start_num = ($page - 1) * $page_size + 1 ;
    $end_num =   ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;

    return array($return, $sum, $prev, $next, $total_num, $start_num, $end_num);    
}

function p_access_analysis_member_access_member4ym_page_name
($ymd, $month_flag, $page_name, $ktai_flag, $page, $page_size, $orderby=1)
{
    $start = ($page - 1) * $page_size;
    
    if ($orderby == 1) {
        $orderby_str = " order by target_c_member_id asc";
    } elseif ($orderby == -1) {
        $orderby_str = " order by target_c_member_id desc";
    } elseif ($orderby == 2) {
        $orderby_str = " order by count asc";
    } elseif ($orderby == -2) {
        $orderby_str = " order by count desc";
    }
    
    $where =" where ktai_flag = ? ";
    $params = array(intval($ktai_flag));
    if ($month_flag) {
        $where .= " and left(r_datetime, 7) = ? ";
        array_push($params,substr($ymd,0,7));
    } else {
        $where .= " and left(r_datetime,10) = ? ";
        array_push($params,$ymd);
    }
    if ($page_name!="all") {
        $where .= " and page_name = ? ";
        array_push($params,$page_name);
    }

    $sql = "select c_member_id , count(*) as count from c_access_log";
    $sql .= $where." group by c_member_id $orderby_str limit $start, $page_size";
    $list = db_get_all($sql,$params);
    $sql = "select count(*) from c_access_log ";
    $sql .=    $where ." group by c_member_id ";
    $result = db_get_all($sql,$params);
    $total_num = count($result);

    $return = array();
    $sum = 0;
    foreach($list as $key => $value) {
        if ($value['c_member_id']) {
            $c_member = _db_c_member4c_member_id($value['c_member_id']);
            $return[] = array_merge($value, $c_member);
            $sum += $value['count'];
        }
    }


    if ($total_num != 0) {
        $total_page_num =  ceil($total_num / $page_size);
        if ($page >= $total_page_num) {
            $next = false;
        }else{
            $next = true;
        }
        if ($page <= 1) {
            $prev = false;
        }else{
            $prev = true;
        }
    }
    $start_num = ($page - 1) * $page_size + 1 ;
    $end_num =   ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;
    return array($return, $sum, $prev, $next, $total_num, $start_num, $end_num);    
}

function p_access_analysis_target_member_access_member4ym_page_name
($ymd, $month_flag, $page_name, $ktai_flag, $page, $page_size, $orderby=1)
{
    $start = ($page - 1) * $page_size;
    
    if ($orderby == 1) {
        $orderby_str = " order by target_c_member_id asc";
    } elseif ($orderby == -1) {
        $orderby_str = " order by target_c_member_id desc";
    } elseif ($orderby == 2) {
        $orderby_str = " order by count asc";
    } elseif ($orderby == -2) {
        $orderby_str = " order by count desc";
    }
    $where =" where ktai_flag = ? ";
    $params = array(intval($ktai_flag));
        if ($month_flag) {
                $where .= " and left(r_datetime, 7) = ? ";
                array_push($params,substr($ymd,0,7));
        } else {
                $where .= " and left(r_datetime,10) = ? ";
                array_push($params,$ymd);
        }
        if ($page_name!="all") {
                $where .= " and page_name = ? ";
                array_push($params,$page_name);
        }
    $sql = "select target_c_member_id , count(*) as count from c_access_log ";
    $sql .= $where;
    $sql .= " AND target_c_member_id <> 0 ";
    $sql .= " group by target_c_member_id " . $orderby_str. " limit $start, $page_size";

    $list = db_get_all($sql,$params);

    $return = array();
    $sum = 0;
    foreach($list as $key => $value) {
        if ($value['target_c_member_id']) {
            $c_member = db_common_c_member4c_member_id($value['target_c_member_id']);
            $return[] = array_merge($value, $c_member);
            $sum += $value['count'];
        }
    }

    $where =" where ktai_flag = ? ";
    $params = array(intval($ktai_flag));
        if ($month_flag) {
                $where .= " and left(r_datetime, 7) = ? ";
                array_push($params,substr($ymd,0,7));
        } else {
                $where .= " and left(r_datetime,10) = ? ";
                array_push($params,$ymd);
        }
        if ($page_name != "all") {
                $where .= " and page_name = ? ";
                array_push($params,$page_name);
        }
    $sql = "select count(*) from c_access_log " ;
    $sql .= $where;
    $sql .= " AND target_c_member_id <> 0 ";
    $sql .= " group by target_c_member_id ";
    
    $result = db_get_all($sql,$params);
    $total_num = count($result);

    if ($total_num != 0) {
        $total_page_num =  ceil($total_num / $page_size);
        if ($page >= $total_page_num) {
            $next = false;
        } else {
            $next = true;
        }
        if ($page <= 1) {
            $prev = false;
        } else {
            $prev = true;
        }
    }
    $start_num = ($page - 1) * $page_size + 1 ;
    $end_num =   ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;

    return array($return, $sum, $prev, $next, $total_num, $start_num, $end_num);
}

function get_is_show($name)
{
    //必要のない詳細ボタンを消す
    switch($name) {
    case "h_home":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "fh_friend_list":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "h_message":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "fh_diary_list":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "h_message_box":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "f_home":
        $is_target_c_member_id = 1;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "h_com_find_all":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "reply_message":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "f_message_send":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "f_message_send":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;
    
    case "h_diary_list_all":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "h_search":
        $is_target_c_member_id = 0;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    case "f_message_send_confirm":
        $is_target_c_member_id = 1;
        $is_target_c_commu_id = 0;
        $is_target_c_topic_id = 0;
        $is_target_c_diary_id = 0;
        $is_c_member_id = 1;
        break;

    default:
        $is_target_c_member_id = 1;
        $is_target_c_commu_id = 1;
        $is_target_c_topic_id = 1;
        $is_target_c_diary_id = 1;
        $is_c_member_id = 1;
        break;
    }

    return array($is_target_c_member_id,$is_target_c_commu_id,$is_target_c_topic_id,$is_target_c_diary_id,$is_c_member_id);

}

/**

カラムごとに条件を指定して絞ったメンバーの一覧を返す

[引数]
適時追加していく

$s_access_date    最終ログイン時刻　開始年月日
$e_access_date    最終ログイン時刻　終了年月日

[返り値]
c_member_list

*/
function p_member_edit_c_member_list($page_size, $page,$s_access_date='', $e_access_date='')
{

    $page = intval($page);
    $page_size = intval($page_size);

    $limit = "";

    //page_sizeが0の時は全て表示(pagerなし)
    if ($page_size != 0) {
        $limit = " LIMIT ".($page_size*($page-1)).",$page_size";
    }
    $where = " WHERE 1 ";

    //指定された条件で絞っていく
    if ($s_access_date != "") {
        $where = $where . " and access_date >= ?";
        $params = array($s_access_date);
    }

    if ($e_access_date != "") {
        $where = $where . " and access_date < ?";
        $params = array($e_access_date);
    }

    $select = "SELECT * FROM c_member";
    $order = " order by c_member_id";

    $sql = $select . $where . $order . $limit;
    $list = db_get_all_limit($sql, 0, $limit, $params);
    
    $sql = "select count(*) from c_member".$where;

    $total_num = db_get_one($sql, $params);
    
    if ($total_num != 0 && $page_size != 0) {
        $total_page_num =  ceil($total_num / $page_size);
        if ($page >= $total_page_num) {
            $next = false;
        } else {
            $next = true;
        }
        if ($page <= 1) {
            $prev = false;
        } else {
            $prev = true;
        }
    }

    return array($list , $prev , $next, $total_num);
}

function _db_c_member4c_member_id($c_member_id)
{
    $sql = "SELECT * FROM c_member WHERE c_member_id= ? ";
        $params = array(intval($c_member_id));
    return db_get_row($sql,$params);
}

/**
 * 男と女の人数を取得
 */
function get_analysis_sex()
{
    $sql = "select count(*) from c_member where sex = '男'";
    $analysis_sex['male'] = get_one4db($sql);
    $sql = "select count(*) from c_member where sex = '女'";
    $analysis_sex['female'] = get_one4db($sql);
    
    return $analysis_sex;
    
}

/**
 * 世代の人数を取得
 */
function get_analysis_generation()
{
    $analysis_generation = array(
            '0～9' => 0,
            '10～19' => 0,
            '20～29' => 0,
            '30～39' => 0,
            '40～49' => 0,
            '50～59' => 0,
            '60～69' => 0,
            '70～79' => 0,
            '80～' =>0
    );
    
    $sql = "select ((year(curdate()) - birth_year)- (RIGHT(CURDATE(),5)<concat(birth_month,'-',birth_day))) as age from c_member;";
    $lst = db_get_all($sql);

    $temp = array_keys($analysis_generation);
    foreach($lst as $value) {
        $key = (int)($value['age'] / 10);
        if ($key > count($analysis_generation)-1) {
            $analysis_generation[$temp[count($analysis_generation)-1]]++;
        } else {
            $analysis_generation[$temp[$key]]++;
        }
    }

    return $analysis_generation;
    
}

/**
 * 地域別の人数を取得
 */
function get_analysis_region()
{
    $pref = p_regist_prof_c_profile_pref_list4null();
    $sql = "select pre_addr_c_profile_pref_id as pref_id from c_member";
    $lst = get_array_list4db($sql);

    foreach($pref as $value) {
        $analysis_region[$value] = 0;    
    }

    foreach ($lst as $value) {
        if ($value['pref_id'] == 0) {
            $analysis_region['その他']++;
        } else {
            $analysis_region[$pref[$value['pref_id']]]++;
        }
    }

    return $analysis_region;
    
}


function get_analysis_date_month($year = "", $month = "")
{
    $sql = "select date_format(r_date,'%Y-%m') from c_member order by r_date";
    $start_date = db_get_one($sql);

    $i = 0;
    list($y, $m) = split("-",$start_date);
    do{
        $date = date("Y-m", mktime (0,0,0,$m+$i++,1,$y));
        $analysis_date_month[$date] = 0;
    }while($date < date("Y-m"));    
    
    $sql = "select date_format(r_date,'%Y-%m') as d from c_member";
    $lst = db_get_all($sql);
    foreach ($lst as $value) {
        $analysis_date_month[$value['d']]++;
    }
    return $analysis_date_month;
}

function get_analysis_date_day_d($date="")
{
    if ($date == "") {
       $date = date("Y-m-d");
    }
    return $date;
}


function get_analysis_date_day($date="")
{
    if ($date == "") {
        $date = date("Y-m");
    }
    //一ヶ月の日数
    $day_num = date("t");

    for($i=1 ; $i<=$day_num; $i++) {
        //一桁の数を二桁にする
        if ($i < 10) {
            $i = "0".$i;
        }
        $analysis_date_day[$i] = 0;
    }

    
    $sql = "select date_format(r_date,'%d') as d from c_member where date_format(r_date,'%Y-%m') = ?";
    $params = array($date);
    $lst = db_get_all($sql,$params);

    foreach($lst as $value) {
        $analysis_date_day[$value['d']]++;
    }
    
    return $analysis_date_day;
}

function p_access_analysis_select_profile_list()
{
    $sql = "SELECT * " .
            " FROM c_profile " .
            " where form_type = 'select' ";
            
    $list = db_get_all($sql);
    return $list;
}

/**
 * 指定されたIDのプロフィールの人数別一覧を作成
 */
function get_analysis_profile($c_profile_id)
{
    $sql = "select count(*) as count,value,c_profile.caption from c_member_profile " .
        " LEFT JOIN c_profile ON c_profile.c_profile_id = c_member_profile.c_profile_id " .
        " WHERE c_member_profile.c_profile_id = ? GROUP BY value ";
    $params = array(intval($c_profile_id));
    $analysis_profile = db_get_all($sql,$params);
    
    return $analysis_profile;
}

function get_analysis_count_profile_all($c_profile_id)
{
    $sql = "select count(*) as count from c_member_profile " .
        " WHERE c_profile_id = ? ";
    $params = array(intval($c_profile_id));
    $analysis_profile = db_get_one($sql,$params);
    
    return $analysis_profile;
}

function analysis_profile4c_profile_id($c_profile_id)
{
    $sql = "SELECT * FROM c_profile" .
            " WHERE c_profile_id = ? ";
    $params = array(intval($c_profile_id));
    $profile = db_get_row($sql,$params);
    
    return $profile;
}
function monitor_diary_list($keyword,$page_size,$page)
{

    $page = intval($page);
    $page_size = intval($page_size);
    
    $where = " where 1 ";

    if ($keyword) {
        //全角空白を半角に統一
        $keyword = str_replace("　", " ", $keyword);
        $keyword_list = explode(" ", $keyword);
            
        for($i=0;$i < count($keyword_list);$i++) {
            $keyword = check_search_word( $keyword_list[$i] );
                
            $where .= " and (c_diary.subject like ? ";
            $where .= " or c_diary.body like ? ) ";
            $params[]="%$keyword%";
            $params[]="%$keyword%";
        }
    }
    
    $select = " select c_diary.*";
    $from = " FROM c_diary";
    $order = " ORDER BY r_datetime desc";
    
    $sql = $select . $from . $where . $order;
    $list = db_get_all_limit($sql,($page-1)*$page_size,$page_size,$params);
    foreach ($list as $key => $value) {
        $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
        $list[$key]['count_comments'] = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']); 
    }
    
    $sql = 
        "SELECT count(*) "
        . $from
        . $where ;
    $total_num = db_get_one($sql,$params);
    
    $total_page_num =  ceil($total_num / $page_size);
    $next = ($page < $total_page_num);
    $prev = ($page > 1);
    
    return array($list , $prev , $next, $total_num,$total_page_num);  
}

function monitor_diary_comment_list($keyword,$page_size,$page)
{

    $page = intval($page);
    $page_size = intval($page_size);
    
    $where = " where 1 ";

    if ($keyword) {
        //全角空白を半角に統一
        $keyword = str_replace("　", " ", $keyword);
        $keyword_list = explode(" ", $keyword);
            
        for($i=0;$i < count($keyword_list);$i++) {
            $keyword = check_search_word( $keyword_list[$i] );
                
            $where .= " and (c_diary_comment.body like ? ) ";
            $params[]="%$keyword%";
        }
    }
    
    $select = " select c_diary_comment.*,c_diary.subject";
    $from = " FROM c_diary_comment"
        ." LEFT JOIN c_diary ON c_diary.c_diary_id = c_diary_comment.c_diary_id ";
    $order = " ORDER BY r_datetime desc";
    
    $sql = $select . $from . $where . $order;
    $list = db_get_all_limit($sql,($page-1)*$page_size,$page_size,$params);
    foreach ($list as $key => $value) {
        $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
        $list[$key]['count_comments'] = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']); 
    }
    
    $sql = 
        "SELECT count(*) "
        . $from
        . $where ;
    $total_num = db_get_one($sql,$params);
    
    $total_page_num =  ceil($total_num / $page_size);
    $next = ($page < $total_page_num);
    $prev = ($page > 1);
    
    return array($list , $prev , $next, $total_num,$total_page_num);  
}


function monitor_topic_comment_list($keyword,$page_size,$page)
{

    $page = intval($page);
    $page_size = intval($page_size);
    
    $where = " where 1 ";

    if ($keyword) {
        $keyword = str_replace("?@", " ", $keyword);
        $keyword_list = explode(" ", $keyword);
            
        for($i=0;$i < count($keyword_list);$i++) {
            $keyword = check_search_word( $keyword_list[$i] );
                
            $where .= " AND (ctc.body like ? )";
            $params[]="%$keyword%";
        }
    }
    
    $select = " SELECT ctc.*,ct.name as topic_name,c.name as commu_name,m.nickname";
    $from = " FROM c_commu_topic_comment as ctc"
            ." LEFT JOIN c_member as m ON ctc.c_member_id = m.c_member_id "
            ." LEFT JOIN c_commu_topic as ct ON ct.c_commu_topic_id = ctc.c_commu_topic_id "
            ." LEFT JOIN c_commu as c ON c.c_commu_id = ct.c_commu_id ";
    $order = " ORDER BY r_datetime desc";
    
    $sql = $select . $from . $where . $order;
    
    $list = db_get_all_limit($sql,($page-1)*$page_size,$page_size,$params);
    
    foreach ($list as $key => $value) {
        $list[$key]['count_comments'] = _db_count_c_commu_topic_comments4c_commu_topic_id($value['c_commu_topic_id']); 
    }
    
    $sql = 
        "SELECT count(*) "
        . $from
        . $where ;
    $total_num = db_get_one($sql,$params);
    
    $total_page_num =  ceil($total_num / $page_size);
    $next = ($page < $total_page_num);
    $prev = ($page > 1);
    
    return array($list , $prev , $next, $total_num,$total_page_num);  
}

function monitor_topic_list($keyword,$page_size,$page)
{
    $page = intval($page);
    $page_size = intval($page_size);
    
    $where = " where 1 ";

    if ($keyword) {
        $keyword = str_replace("?@", " ", $keyword);
        $keyword_list = explode(" ", $keyword);
            
        for($i=0;$i < count($keyword_list);$i++) {
            $keyword = check_search_word( $keyword_list[$i] );
                
            $where .= " AND (ctc.body like ? ";
            $where .= " OR ct.name like ? ";
            $where .= " OR c.name like ? ) ";
            $params[]="%$keyword%";
            $params[]="%$keyword%";
            $params[]="%$keyword%";
        }
    }
    
    $select = " SELECT ct.*,ct.name as topic_name,c.name as commu_name,m.nickname,ctc.body as body";
    $from = " FROM c_commu_topic as ct"
            ." LEFT JOIN c_member as m ON ct.c_member_id = m.c_member_id "
            ." LEFT JOIN c_commu as c ON c.c_commu_id = ct.c_commu_id "
            ." LEFT JOIN c_commu_topic_comment as ctc ON (ctc.c_commu_topic_id = ct.c_commu_topic_id AND ctc.number = 0)";
    $order = " ORDER BY r_datetime desc";
    
    $sql = $select . $from . $where . $order;
    
    $list = db_get_all_limit($sql,($page-1)*$page_size,$page_size,$params);
    
    foreach ($list as $key => $value) {
        $list[$key]['count_comments'] = _db_count_c_commu_topic_comments4c_commu_topic_id($value['c_commu_topic_id']); 
    }
    
    $sql = 
        "SELECT count(*) "
        . $from
        . $where ;
    $total_num = db_get_one($sql,$params);
    
    $total_page_num =  ceil($total_num / $page_size);
    $next = ($page < $total_page_num);
    $prev = ($page > 1);
    
    return array($list , $prev , $next, $total_num,$total_page_num);  
}

function _db_count_c_commu_topic_comments4c_commu_topic_id($c_commu_topic_id)
{
    $sql = "SELECT count(*) FROM c_commu_topic_comment" .
        " WHERE c_commu_topic_id = ? AND number > 0";
    $params = array($c_commu_topic_id);
    return db_get_one($sql, $params);
}
?>
