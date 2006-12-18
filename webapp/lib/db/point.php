<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

function db_point_insert_log($c_member_id, $point, $memo)
{
    $data = array(
        'c_member_id' => intval($c_member_id),
        'point' => intval($point),
        'memo' => strval($memo),
        'r_datetime' => db_now(),
    );
    return db_insert('c_point_log', $data);
}

function db_point_insert_tags($c_point_log_id, $tags)
{
    $data = array(
        'c_point_log_id' => intval($c_point_log_id),
    );
    foreach ((array)$tags as $tag) {
        if ($tag) {
            $data['tag'] = strval($tag);
            db_insert('c_point_log_tag', $data);
        }
    }
}

function db_point_add_point($c_member_id, $point)
{
    $sql = 'SELECT c_profile_id, public_flag_default FROM c_profile WHERE name = \'PNE_POINT\'';
    if (!$c_profile = db_get_row($sql)) {
        return false;
    }
    $c_profile_id = $c_profile['c_profile_id'];
    $public_flag  = $c_profile['public_flag_default'];

    $sql = 'SELECT value FROM c_member_profile WHERE c_member_id = ? AND c_profile_id = ?';
    $params = array(intval($c_member_id), intval($c_profile_id));
    $p = db_get_one($sql, $params);

    //プロフィールにポイントがなければ追加
    if (!$p) {
        $data = array(
            'c_member_id' => intval($c_member_id),
            'c_profile_id'   => intval($c_profile_id),
            'c_profile_option_id' => 0,
            'value' => 0,
            'public_flag' => $public_flag,
        );
        db_insert('c_member_profile',$data);
    }

    // ポイント加算
    $p = intval($p) + intval($point);

    $sql = 'DELETE FROM c_member_profile WHERE c_member_id = ? AND c_profile_id = ?';
    db_query($sql, $params);
    do_config_prof_insert_c_member_profile($c_member_id, $c_profile_id, 0, $p, $public_flag);

    return $p;
}

function db_point_get_point($c_member_id)
{
    $sql = 'SELECT c_profile_id, public_flag_default FROM c_profile WHERE name = \'PNE_POINT\'';
    if (!$c_profile = db_get_row($sql)) {
        return false;
    }
    $c_profile_id = $c_profile['c_profile_id'];
    $public_flag  = $c_profile['public_flag_default'];

    $sql = 'SELECT value FROM c_member_profile WHERE c_member_id = ? AND c_profile_id = ?';
    $params = array(intval($c_member_id), intval($c_profile_id));
    return db_get_one($sql, $params);
}

?>
