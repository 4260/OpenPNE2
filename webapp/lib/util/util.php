<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

/**
 * リダイレクト
 * 
 * @param string $module
 * @param string $action
 * @param array  $params
 */
function openpne_redirect($module, $action = '', $params = array())
{
    if ($module == 'ktai') {
        if (session_id()) {
            $params['ksid'] = session_id();
        }
    }
    $url = openpne_gen_url($module, $action, $params);
    client_redirect_absolute($url);
}

/**
 * クライアントリダイレクト
 * 
 * @param   string  $dest ジャンプ先URI(絶対パス)
 */
function client_redirect_absolute($dest)
{
    // 改行文字を削除
    $dest = str_replace(array("\r", "\n"), '', $dest);
    header('Location: '. $dest);
    exit;
}

/**
 * クライアントリダイレクト(ログインページ)
 */
function client_redirect_login()
{
    client_redirect_absolute(get_login_url());
}

/**
 * ログインページを取得
 * 
 * @return string ログインページURL
 */
function get_login_url()
{
    if (LOGIN_URL_PC) {
        return LOGIN_URL_PC;
    } else {
        return openpne_gen_url('pc', 'page_o_login');
    }
}

//---

/**
 * URLを生成
 */
function openpne_gen_url($module, $action = '', $params = array(), $absolute = true, $force = false)
{
    switch ($force) {
    case 'ssl':
        $url = OPENPNE_SSL_URL;
        break;
    case 'nonssl':
        $url = OPENPNE_URL;
        break;
    default:
        $url = openpne_gen_url_head($module, $action, $absolute);
        break;
    }

    $p = array('m' => $module, 'a' => $action) + (array)$params;
    if (need_ssl_param($module, $action, $force)) {
        $p['ssl_param'] = 1;
    } else {
        unset($p['ssl_param']);
    }
    if ($q = http_build_query($p)) {
        $url .= '?' . $q;
    }
    return $url;
}

function openpne_gen_url_head($module, $action = '', $absolute = true)
{
    if (OPENPNE_USE_PARTIAL_SSL) {
        switch (openpne_ssl_type($module, $action)) {
        case 'SSL_REQUIRED':
            $head = ($absolute || !is_ssl()) ? OPENPNE_SSL_URL : './';
            break;
        case 'SSL_SELECTABLE':
            if ($absolute) {
                $head = (is_ssl()) ? OPENPNE_SSL_URL : OPENPNE_URL;
            } else {
                $head = './';
            }
            break;
        case 'SSL_DISABLED':
            $head = ($absolute || is_ssl()) ? OPENPNE_URL : './';
            break;
        }
    } else {
        $head = ($absolute) ? OPENPNE_URL : './';
    }
    return $head;
}

//---

/**
 * module / action が部分SSL対象かどうかを判別する
 */
function openpne_ssl_type($m, $a)
{
    if (in_array($a, (array)$GLOBALS['_OPENPNE_SSL_REQUIRED'][$m]) ||
        in_array($m, (array)$GLOBALS['_OPENPNE_SSL_REQUIRED_MODULES'])
    ) {
        $type = 'SSL_REQUIRED';
    } elseif (in_array($a, (array)$GLOBALS['_OPENPNE_SSL_SELECTABLE'][$m])) {
        $type = 'SSL_SELECTABLE';
    } else {
        $type = 'SSL_DISABLED';
    }
    return $type;
}

/**
 * 現在のリクエストがSSL通信であるかどうかを判別
 */
function is_ssl()
{
    static $is_ssl;
    if (!isset($is_ssl)) {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $is_ssl = true;
        } elseif (OPENPNE_USE_SSL_PARAM && !empty($_REQUEST['ssl_param'])) {
            $is_ssl = true;
        } else {
            $is_ssl = false;
        }
    }
    return $is_ssl;
}

function need_ssl_param($module, $action = '', $force = false)
{
    $need = false;
    if (OPENPNE_USE_PARTIAL_SSL && OPENPNE_USE_SSL_PARAM) {
        switch ($force) {
        case 'ssl':
            $need = true;
            break;
        case 'nonssl':
            $need = false;
            break;
        default:
            switch (openpne_ssl_type($module, $action)) {
            case 'SSL_REQUIRED':
                $need = true;
                break;
            case 'SSL_SELECTABLE':
                $need = is_ssl();
                break;
            case 'SSL_DISABLED':
                break;
            }
            break;
        }
    }
    return $need;
}

//---

function is_ktai_mail_address($mail)
{
    $pieces = explode('@', $mail);
    $domain = array_pop($pieces);

    return in_array($domain, $GLOBALS['OpenPNE']['KTAI_DOMAINS']);
}

function db_common_is_mailaddress($value)
{
    if (preg_match('/^[^:;@,\s\x80-\xFF]+@\w[\w\-.]*\.[a-zA-Z]+$/', $value)) {
        return true;
    } else {
        return false;
    }
}

//---

function _mt_srand()
{
    if (version_compare(phpversion(), '4.2.0', '<')) {
        list($usec, $sec) = explode(' ', microtime());
        $seed = (float)$sec + ((float)$usec * 100000);

        mt_srand($seed);
    }
}

function do_common_create_password($length = 8)
{
    // パスワードに使用する文字
    $elem = 'abcdefghkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ2345679';
    $max = strlen($elem) - 1;

    _mt_srand();
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= substr($elem, mt_rand(0, $max), 1);
    }
    return $password;
}

function create_hash()
{
    _mt_srand();
    return md5(uniqid(mt_rand(), true));
}

//---

function &get_crypt_blowfish()
{
    static $singleton;
    if (empty($singleton)) {
        if (OPENPNE_USE_OLD_CRYPT_BLOWFISH) {
            include_once 'Crypt/BlowfishOld.php';
            $singleton = new Crypt_BlowfishOld(ENCRYPT_KEY);
        } else {
            include_once 'Crypt/Blowfish.php';
            $singleton = new Crypt_Blowfish(ENCRYPT_KEY);
        }
    }
    return $singleton;
}

/**
 * 可逆的な暗号化をする
 * 
 * @param string $str 平文
 * @return string 暗号文
 */
function t_encrypt($str)
{
    if (!$str) return '';

    $bf =& get_crypt_blowfish();
    $str = $bf->encrypt($str);

    //base64
    $str = base64_encode($str);

    return $str;
}

/**
 * 可逆的な暗号を復号化する
 * 
 * @param string $str 暗号文
 * @return string 平文
 */
function t_decrypt($str)
{
    if (!$str) return '';

    //base64
    $str = base64_decode($str);

    $bf =& get_crypt_blowfish();
    return rtrim($bf->decrypt($str));
}

function t_wordwrap($str, $width = 80, $break = "\n")
{
    if (!$width) {
        return $str;
    }

    $lines = explode($break, $str);
    foreach ($lines as $key => $line) {
        if (mb_strwidth($line) > $width) {
            $new_line = '';
            do {
                if ($new_line) {
                    $new_line .= $break;
                }
                $tmp = mb_strimwidth($line, 0, $width);
                $new_line .= $tmp;
                $line = substr($line, strlen($tmp));
            } while (strlen($line) > 0);
            $lines[$key] = $new_line;
        }
    }
    return implode($break, $lines);
}

function util_is_unused_mail($name)
{
    $unused = explode(',', UNUSED_MAILS);
    return in_array($name, $unused);
}

function util_get_c_navi($navi_type = 'h')
{
    switch ($navi_type) {
    case 'global':
        $navi_type = 'global';
        $navi = array(
            array('url' => '?m=pc&a=page_h_search', 'caption' => 'メンバー検索'),
            array('url' => '?m=pc&a=page_h_com_find_all', 'caption' => 'コミュニティ検索'),
            array('url' => '?m=pc&a=page_h_review_search', 'caption' => 'レビュー検索'),
            array('url' => '?m=pc&a=page_h_home', 'caption' => 'マイホーム'),
            array('url' => '?m=pc&a=page_h_invite', 'caption' => '友人を誘う'),
            array('url' => '?m=pc&a=page_h_diary_list_all', 'caption' => '最新日記'),
            array('url' => '?m=pc&a=page_h_ranking', 'caption' => 'ランキング'),
            array('url' => '?m=pc&a=page_h_config', 'caption' => '設定変更'),
        );
        break;
    case 'h':
    default:
        $navi_type = 'h';
        $navi = array(
            array('url' => '?m=pc&a=page_h_home', 'caption' => 'ホーム'),
            array('url' => '?m=pc&a=page_fh_friend_list', 'caption' => WORD_MY_FRIEND),
            array('url' => '?m=pc&a=page_fh_diary_list', 'caption' => '日記'),
            array('url' => '?m=pc&a=page_h_message_box', 'caption' => 'メッセージ'),
            array('url' => '?m=pc&a=page_h_ashiato', 'caption' => 'あしあと'),
            array('url' => '?m=pc&a=page_h_bookmark_list', 'caption' => 'お気に入り'),
            array('url' => '?m=pc&a=page_fh_review_list_member', 'caption' => 'マイレビュー'),
            array('url' => '?m=pc&a=page_h_prof', 'caption' => 'マイページ確認'),
            array('url' => '?m=pc&a=page_h_config_prof', 'caption' => 'プロフィール変更'),
        );
        break;
    case 'f':
        $navi = array(
            array('url' => '?m=pc&a=page_f_home', 'caption' => 'ホーム'),
            array('url' => '?m=pc&a=page_fh_friend_list', 'caption' => WORD_FRIEND),
            array('url' => '?m=pc&a=page_fh_diary_list', 'caption' => '日記を読む'),
            array('url' => '?m=pc&a=page_f_message_send', 'caption' => 'メッセージを送る'),
            array('url' => '?m=pc&a=page_f_bookmark_add', 'caption' => 'お気に入りに追加'),
            array('url' => '?m=pc&a=page_fh_review_list_member', 'caption' => 'レビュー'),
            array('url' => '?m=pc&a=page_f_invite', 'caption' => WORD_MY_FRIEND.'に紹介'),
            array('url' => '?m=pc&a=page_f_link_request', 'caption' => WORD_MY_FRIEND.'に追加'),
            array('url' => '?m=pc&a=page_f_intro_edit', 'caption' => '紹介文を書く'),
        );
        break;
    case 'c':
        $navi = array(
            array('url' => '?m=pc&a=page_c_home', 'caption' => 'コミュニティトップ'),
            array('url' => '?m=pc&a=page_c_topic_list', 'caption' => '掲示板'),
            array('url' => '?m=pc&a=page_c_member_review', 'caption' => 'おすすめレビュー'),
            array('url' => '?m=pc&a=page_c_join_commu', 'caption' => 'コミュニティに参加'),
            array('url' => '?m=pc&a=page_c_invite', 'caption' => WORD_MY_FRIEND.'に紹介'),
            array('url' => '?m=pc&a=page_c_leave_commu', 'caption' => 'コミュニティを退会'),
        );
        break;
    }
    $db = db_get_c_navi($navi_type);
    foreach ($db as $value) {
        $i = $value['sort_order'] - 1;
        $navi[$i] = array('url' => $value['url'], 'caption' => $value['caption']);
    }
    return $navi;
}

/**
 * checkdate の wrapper function
 * Warning 対策
 */
function t_checkdate($month, $day, $year)
{
    return checkdate(intval($month), intval($day), intval($year));
}

/**
 * Date_Calc::isFutureDate の wrapper function
 */
function t_isFutureDate($day, $month, $year)
{
    include_once 'Date/Calc.php';
    return Date_Calc::isFutureDate(intval($day), intval($month), intval($year));
}

//---

/**
 * Check c_diary.public_flag
 * 
 * @param int $c_diary_id
 * @param int $c_member_id
 * @return bool allowed or not
 */
function pne_check_diary_public_flag($c_diary_id, $c_member_id)
{
    $c_diary = db_diary_get_c_diary4id($c_diary_id);
    if ($c_diary['c_member_id'] == $c_member_id) {
        return true;
    }

    switch ($c_diary['public_flag']) {
    case 'public':
        $allowed = true;
        break;
    case 'friend':
        $allowed = db_friend_is_friend($c_diary['c_member_id'], $c_member_id);
        break;
    case 'private':
    default:
        $allowed = false;
        break;
    }

    return $allowed;
}

function pne_url2a($url, $target = '_blank')
{
    $length = 60;
    $etc = '...';

    if (strlen($url) > $length) {
        $length -= strlen($etc);
        $urlstr = substr($url, 0, $length) . $etc;
    } else {
        $urlstr = $url;
    }
    if ($target) {
        $target = sprintf(' target="%s"', $target);
    }

    $url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    $urlstr = htmlspecialchars($urlstr, ENT_QUOTES, 'UTF-8');

    return sprintf('<a href="%s"%s>%s</a>', $url, $target, $urlstr);
}

function get_auth_config($is_ktai = false)
{
    if (IS_SLAVEPNE) {
        $config = $GLOBALS['_OPENPNE_AUTH_CONFIG'];
    } else {
        $config['storage'] = 'DB';
        if ($is_ktai) {
            $config['options'] = array(
                'dsn'         => db_get_dsn(),
                'table'       => 'c_member_secure',
                'usernamecol' => 'ktai_address',
                'passwordcol' => 'hashed_password',
                'cryptType'   => 'md5',
            );
        } else {
            $config['options'] = array(
                'dsn'         => db_get_dsn(),
                'table'       => 'c_member_secure',
                'usernamecol' => 'pc_address',
                'passwordcol' => 'hashed_password',
                'cryptType'   => 'md5',
            );
        }
    }
    return $config;
}

function crypt_func($raw_value,$cryptType)
{
    if (   isset($cryptType) 
        && $cryptType == 'none') {
        $cryptFunction = 'strval';
    } elseif (   isset($cryptType) 
              && function_exists($cryptType)) {
        $cryptFunction = $cryptType;
    } else {
        $cryptFunction = 'md5';
    }
    
    return $cryptFunction($raw_value);
}

function check_action4pne_slave($is_ktai = false)
{
    if (IS_SLAVEPNE) {
        if ($is_ktai) {
            openpne_redirect('ktai');
        } else {
            openpne_redirect('pc');
        }
    }
}

function util_include_php_files($dir)
{
    if (!is_dir($dir)) {
        return;
    }
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file[0] === '.') {
                continue;
            }
            $path = realpath($dir . '/' . $file);
            if (is_dir($path)) {
                util_include_php_files($path);
            } else {
                if (substr($file, -4, 4) === '.php') {
                    include_once $path;
                }
            }
        }
        closedir($dh);
    }
}

function util_cast_public_flag_diary($public_flag, $default = 'public')
{
    switch ($public_flag) {
    case 'public':
    case 'friend':
    case 'private':
        break;
    default:
        $public_flag = $default;
        break;
    }
    return $public_flag;
}

/**
 * 登録してもよいメールアドレスかどうか
 */
function util_is_regist_mail_address($mail_address, $c_member_id = 0)
{
    if (!db_common_is_mailaddress($mail_address)) {
        return false;
    }

    if (!db_member_is_limit_domain4mail_address($mail_address)) {
        return false;
    }

    if (db_member_is_sns_join4mail_address($mail_address, $c_member_id)) {
        return false;
    }

    return true;
}

/**
 * アップロード可能な拡張子のリストを取得
 */
function util_get_file_allowed_extensions($format = null)
{
    $list = array();
    if (FILE_ALLOWED_EXTENTIONS) {
        $exts = explode(',', FILE_ALLOWED_EXTENTIONS);
        foreach ((array)$exts as $ext) {
            if (trim($ext) !== '') {
                $list[] = trim($ext);
            }
        }
    }
    if ($format === 'string') {
        if ($list) {
            foreach ($list as $key => $value) {
                $list[$key] = '*.' . $value;
            }
            $list = implode('; ', $list);
        } else {
            $list = '';
        }
    }
    return $list;
}

/**
 * アップロード可能な拡張子かどうか
 */
function util_check_file_extention($filename)
{
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $list = util_get_file_allowed_extensions();
    return (!$list || in_array($extension, $list));
}

/**
 * 参照可能なメッセージかどうか
 * 
 * ・指定メンバーが送信者で、完全削除済でない
 * ・指定メンバーが受信者で、送信済であり完全削除済でない
 * 
 * @param int $c_member_id
 * @param int $c_message_id
 * @return bool
 */
function util_is_readable_message($c_member_id, $c_message_id)
{
    $c_message = db_message_c_message4c_message_id($c_message_id);

    if ($c_message['c_member_id_from'] == $c_member_id) {  // 自分が送信者
        if (!$c_message['is_kanzen_sakujo_from']) {  // 完全削除済でない
            return true;
        }
    } elseif ($c_message['c_member_id_to'] == $c_member_id)  { // 自分が受信者
        if ($c_message['is_send'] && !$c_message['is_kanzen_sakujo_to']) {  // 送信済であり完全削除済でない
            return true;
        }
    }

    return false;
}

function util_get_color_config()
{
    $c_config_color = db_etc_c_config_color();
    $color_config = array(
        'border_01' => $c_config_color['color_1'],
        'border_07' => $c_config_color['color_2'],
        'border_10' => $c_config_color['color_3'],    
        'bg_00' => $c_config_color['color_4'],
        'bg_01' => $c_config_color['color_5'],
        'bg_02' => $c_config_color['color_6'],
        'bg_03' => $c_config_color['color_7'],
        'bg_04' => $c_config_color['color_8'],
        'bg_05' => $c_config_color['color_9'],
        'bg_06' => $c_config_color['color_10'],
        'bg_07' => $c_config_color['color_11'],
        'bg_08' => $c_config_color['color_12'],
        'bg_09' => $c_config_color['color_13'],
        'bg_10' => $c_config_color['color_14'],
        'bg_11' => $c_config_color['color_15'],
        'bg_12' => $c_config_color['color_16'],
        'bg_13' => $c_config_color['color_17'],
        'bg_14' => $c_config_color['color_18'],
    );
    return $color_config;
}

function util_get_color_config_ktai()
{
    $c_config_color = db_etc_c_config_color_ktai();

    if (empty($c_config_color['color_23'])) {
        $c_config_color['color_23'] = 'FFFFFF';
    }

    $color_config = array(
        'bg_01' => $c_config_color['color_1'],
        'bg_02' => $c_config_color['color_2'],
        'bg_03' => $c_config_color['color_3'],
        'bg_04' => $c_config_color['color_4'],
        'bg_05' => $c_config_color['color_5'],
        'bg_06' => $c_config_color['color_6'],
        'bg_07' => $c_config_color['color_7'],
        'bg_08' => $c_config_color['color_8'],
        'bg_09' => $c_config_color['color_9'],
        'bg_10' => $c_config_color['color_10'],
        'border_01' => $c_config_color['color_11'],
        'border_02' => $c_config_color['color_12'],
        'border_03' => $c_config_color['color_13'],
        'font_01' => $c_config_color['color_14'],
        'font_02' => $c_config_color['color_15'],
        'font_03' => $c_config_color['color_23'],
        'font_04' => $c_config_color['color_17'],
        'font_05' => $c_config_color['color_18'],
        'font_06' => $c_config_color['color_19'],
        'font_07' => $c_config_color['color_20'],
        'font_08' => $c_config_color['color_21'],
        'font_09' => $c_config_color['color_22'],
    );
    return $color_config;
}

/**
 * メンバー登録を行う
 * 
 * @param array $c_member
 * @param array $c_member_secure
 * @param array $c_member_profile_list
 * @param bool $is_password_encrypted    パスワードが既に暗号化済みかどうか
 * @return int
 */
function util_regist_c_member($c_member, $c_member_secure, $c_member_profile_list = array(), $is_password_encrypted = false)
{
    // メール受信設定をデフォルト値に
    $c_member['is_receive_mail'] = 1;
    $c_member['is_receive_ktai_mail'] = 1;
    $c_member['is_receive_daily_news'] = 1;

    // メンバー登録
    $u = db_member_insert_c_member($c_member, $c_member_secure, $is_password_encrypted);
    if ($u === false) {  // メンバー登録に失敗した場合
        return false;
    }

    if (OPENPNE_USE_POINT_RANK) {
        //入会者にポイント加算
        $point = db_action_get_point4c_action_id(1);
        db_point_add_point($u, $point);

        //メンバー招待をした人にポイント加算
        $point = db_action_get_point4c_action_id(7);
        db_point_add_point($c_member['c_member_id_invite'], $point);
    }

    // c_member_profile
    db_member_update_c_member_profile($u, $c_member_profile_list);

    // 招待者とフレンドリンク
    db_friend_insert_c_friend($u, $c_member['c_member_id_invite']);

    //管理画面で指定したコミュニティに強制参加
    $c_commu_id_list = db_commu_regist_join_list();
    foreach ($c_commu_id_list as $c_commu_id) {
        db_commu_join_c_commu($c_commu_id, $u);
    }

    return $u;
}

?>
