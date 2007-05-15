<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

require_once './config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

require_once 'kcaptcha/kcaptcha.php';

@session_start();
$captcha = new KCAPTCHA();
$_SESSION['captcha_keystring'] = $captcha->getKeyString();

?>
