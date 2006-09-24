<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<title>({$title})</title>
<link rel="stylesheet" href="modules/admin/default.css" type="text/css">
</head>

<body>

<table border="0" cellspacing="0" cellpadding="0">

<tr>
<td style="width:100%;background:#000000;color:#ffffff;padding:5px;" colspan="2">

<h1><a href="?m=({$module_name})" title="({$title})">({$title})</a></h1>

</td>
</tr>
<tr>
<td style="background:#F0F3F3;padding:5px;" valign="top">

({if $display_navi})
<div id="site_navi">

<p>PNEBIZ関連設定・管理</p>
<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('biz_edit_c_admin_config')})" title="基本設定">基本設定</a><br>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('biz_shisetsu_list')})" title="施設管理">施設管理</a><br>
</ul>

<p>管理ページ設定</p>
<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_admin_password')})" title="パスワード変更: 管理画面ログイン用パスワードの変更">パスワード変更</a><br>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('update_hash_table')})" title="ページ名ランダム生成: 管理画面のページ名を推測不可能なランダム文字列で置換">ページ名ランダム生成</a><br>
<li><a href="?m=({$module_name})&amp;a=do_({$hash_tbl->hash('logout','do')})&amp;sessid=({$PHPSESSID})" title="ログアウト: 管理画面からログアウト">ログアウト</a>
</ul>

<div style="text-align:left;padding:.5em 5px;">
【<a href="./" title="サイトを表示" target="_blank">サイトを表示</a>】
</div>

</div>
({else})
&nbsp;
({/if})

</td>
<td style="width:100%;padding:5px;" valign="top">
