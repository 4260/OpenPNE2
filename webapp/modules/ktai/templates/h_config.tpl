({$inc_ktai_header|smarty:nodefaults})
<table width="100%"><tr><td align="center" bgcolor="#0d6ddf">
<font color="#eeeeee"><a name="top">設定変更</a></font><br>
</td></tr></table>
({if $msg})
<font color="#ff0000">({$msg})</font>
<hr color="#b3ceef">
({/if})
<font color="#0d6ddf">◆</font><a href="({t_url m=ktai a=page_h_config_mail_receive})&amp;({$tail})">ﾒｰﾙ受信設定</a><br>
({if !$is_unused_ashiato})
<font color="#0d6ddf">◆</font><a href="({t_url m=ktai a=page_h_config_mail_ashiato})&amp;({$tail})">あしあとお知らせﾒｰﾙ設定</a><br>
({/if})
<font color="#0d6ddf">◆</font><a href="({t_url m=ktai a=page_h_config_public_flag_diary})&amp;({$tail})">日記の公開範囲設定</a><br>
<font color="#0d6ddf">◆</font><a href="({t_url m=ktai a=page_h_config_access_block})&amp;({$tail})">ｱｸｾｽﾌﾞﾛｯｸ設定</a><br>
<br>
以下の変更にはﾊﾟｽﾜｰﾄﾞの入力が必要です。<br>
<br>
<font color="#0d6ddf">◆</font><a href="({t_url m=ktai a=page_h_config_mail})&amp;({$tail})">携帯ﾒｰﾙｱﾄﾞﾚｽ変更</a><br>
({if $smarty.const.OPENPNE_ENABLE_PC})
<font color="#0d6ddf">◆</font><a href="({t_url m=ktai a=page_h_pc_send})&amp;({$tail})">PCﾒｰﾙｱﾄﾞﾚｽ登録</a><br>
({/if})
<br>
<font color="#0d6ddf">◆</font><a href="({t_url m=ktai a=page_h_config_password})&amp;({$tail})">ﾊﾟｽﾜｰﾄﾞ変更</a><br>
<font color="#0d6ddf">◆</font><a href="({t_url m=ktai a=page_h_config_password_query})&amp;({$tail})">秘密の質問答え設定</a><br>
<font color="#0d6ddf">◆</font><a href="({t_url m=ktai a=page_h_config_easy_login})&amp;({$tail})">かんたんﾛｸﾞｲﾝ設定</a><br>
<br>
◇({if $u!=1})
<a href="({t_url m=ktai a=page_h_taikai_confirm})&amp;({$tail})">退会手続き</a><br>
({else})
退会手続き<br>
ID 1 のﾒﾝﾊﾞｰは退会することができません。<br>
({/if})

({$inc_ktai_footer|smarty:nodefaults})
