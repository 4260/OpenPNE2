<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

function p_h_calendar_c_schedule_list4date($year, $month, $day, $c_member_id)
{
    $date = sprintf('%04d-%02d-%02d', $year, $month, $day);

    $sql = 'SELECT * FROM c_schedule WHERE c_member_id = ?' .
            ' AND start_date <= ? AND end_date >= ?';
    $params = array(intval($c_member_id), $date, $date);
    return db_get_all($sql, $params);
}

function p_common_c_schedule4c_schedule_id($c_schedule_id)
{
    $sql = 'SELECT * FROM c_schedule WHERE c_schedule_id = ?';
    return db_get_row($sql, array(intval($c_schedule_id)));
}

function p_h_calendar_birth4c_member_id($month, $c_member_id)
{
    $ids = db_friend_c_member_id_list($c_member_id);
    $ids[] = $c_member_id;
    $ids = implode(', ', $ids);

    $sql = 'SELECT * FROM c_member' .
        ' WHERE c_member_id IN ('. $ids . ')' .
        ' AND birth_month = ?';
    $params = array(intval($month));
    $list = db_get_all($sql, $params);

    $res = array();
    foreach ($list as $item) {
        $day = intval($item['birth_day']);
        $res[$day][] = $item;
    }
    return $res;
}

function p_h_calendar_event4c_member_id($year, $month, $c_member_id)
{
    $sql = 'SELECT c_commu_id FROM c_commu_member WHERE c_member_id = ?';
    $params = array(intval($c_member_id));
    $ids = db_get_col($sql, $params);
    $ids = implode(', ', $ids);
    if (!$ids) {
        return array();
    }

    $sql = 'SELECT * FROM c_commu_topic WHERE c_commu_id IN ('.$ids.')' .
            ' AND event_flag = 1 AND open_date > ? AND open_date <= ?';
    $params = array(
        sprintf('%04d-%02d', intval($year), intval($month)) . '-00',
        sprintf('%04d-%02d', intval($year), intval($month)) . '-31'
    );
    $list = db_get_all($sql, $params);

    $res = array();
    foreach ($list as $item) {
        $item['is_join'] = p_common_is_c_event_member($item['c_commu_topic_id'], $c_member_id);

        $day = date('j', strtotime($item['open_date']));
        $res[$day][] = $item;
    }
    return $res;
}

function db_schedule_c_member_list4mail()
{
    $sql = 'SELECT * FROM c_schedule WHERE start_date = ? AND is_receive_mail = 1';
    $params = array(date('Y-m-d'));
    return db_get_all($sql, $params);
}

?>
