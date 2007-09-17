({$inc_ktai_header|smarty:nodefaults})

({if $inc_ktai_entry_point[1]})
({$inc_ktai_entry_point[1]|smarty:nodefaults})
({/if})

<table width="100%">
({if $smarty.const.OPENPNE_USE_KTAI_LOGO})
	<tr><td align="center">
		<a name="top"><img src="({t_img_url_skin filename=skin_ktai_header f=jpg})" alt="({$smarty.const.SNS_NAME})"></a><br>
	</td></tr>
({else})
	<tr><td align="center" bgcolor="#({$ktai_color_config.bg_01})">
		<font color="#({$ktai_color_config.font_01})"><a name="top">({$smarty.const.SNS_NAME})</a></font><br>
	</td></tr>
({/if})
({if $inc_ktai_entry_point[2]})
	<tr><td>({$inc_ktai_entry_point[2]|smarty:nodefaults})</td></tr>
({/if})
</table>
({if $inc_ktai_entry_point[3]})
({$inc_ktai_entry_point[3]|smarty:nodefaults})<br>
({/if})
({if $c_siteadmin})
({$c_siteadmin|smarty:nodefaults})<br>
({/if})
({if $num_f_confirm_list})
<a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})"><font color="#({$ktai_color_config.font_04})">★承認待ちのﾒﾝﾊﾞｰ({$num_f_confirm_list})名</font></a><br>
({/if})
({if $num_message_not_is_read})
<a href="({t_url m=ktai a=page_h_message_box})&amp;({$tail})"><font color="#({$ktai_color_config.font_04})">★新着ﾒｯｾｰｼﾞ({$num_message_not_is_read})件</font></a></font><br>
({/if})
({if $num_diary_not_is_read})
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$first_diary_read})&amp;({$tail})"><font color="#({$ktai_color_config.font_04})">★({$num_diary_not_is_read})件日記に新着ｺﾒﾝﾄ</font></a><br>
({/if})
({if $num_h_confirm_list })
<a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})"><font color="#({$ktai_color_config.font_04})">★ｺﾐｭﾆﾃｨ参加承認待ち({$num_h_confirm_list})名</font></a><br>
({/if})
({if $anatani_c_commu_admin_confirm_list})
<a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})"><font color="#({$ktai_color_config.font_04})">★ｺﾐｭﾆﾃｨ管理者交代依頼({$num_anatani_c_commu_admin_confirm_list})件</font></a><br>
({/if})
({if $anatani_c_commu_sub_admin_confirm_list})
<a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})"><font color="#({$ktai_color_config.font_04})">★ｺﾐｭﾆﾃｨ副管理者依頼({$num_anatani_c_commu_sub_admin_confirm_list})件</font></a><br>
({/if})
({if $anatani_c_commu_admin_confirm_list||$num_f_confirm_list||$num_message_not_is_read||$num_diary_not_is_read||$num_h_confirm_list||$anatani_c_commu_admin_confirm_list||$anatani_c_commu_sub_admin_confirm_list})
<br>
({/if})
<table width="100%" bgcolor="#({$ktai_color_config.bg_05})">
<tr><td colspan="2" align="center">
<hr color="#({$ktai_color_config.border_01})" size="3">
({if $birthday_flag})
<font color="#({$ktai_color_config.font_04})">☆Happy Birthday☆<br>
お誕生日おめでとうございます</font>
<hr color="#({$ktai_color_config.border_01})">
({/if})
[i:69]<a href="({t_url m=ktai_biz a=page_fh_biz_todo_list})&amp;({$tail})">ToDoﾘｽﾄ</a>/[i:176]<a href="({t_url m=ktai_biz a=page_fh_calendar_week})&amp;({$tail})">週間ｶﾚﾝﾀﾞｰ</a><br>
<hr color="#({$ktai_color_config.border_01})">
</td></tr>
<tr><td align="center" width="50%" valign="top">
<img src="({t_img_url filename=$c_member.image_filename w=120 h=120 f=jpg})" alt="({$c_member.nickname})さん"><br>
({$c_member.nickname})さん<br>
({if $smarty.const.OPENPNE_IS_POINT_ADMIN || $c_member.c_member_id != 1})
({if $smarty.const.OPENPNE_DISP_RANK && $rank})
<img src="({t_img_url filename=$rank.image_filename w=120 h=120 f=jpg})" alt="({$rank.name})"><br>
({/if})
({if $smarty.const.OPENPNE_DISP_POINT && $point})
({$point}) Point<br>
({/if})
({/if})
</td>

<td valign="top">
[i:1014]<a href="({t_url m=ktai a=page_h_diary_edit})&amp;({$tail})">日記を書く</a><br>
[i:70]<a href="({t_url m=ktai a=page_fh_diary_list})&amp;({$tail})">日記を読む</a><br>
[i:110]<a href="({t_url m=ktai a=page_h_message_box})&amp;({$tail})">ﾒｯｾｰｼﾞ</a><br>
[i:91]<a href="({t_url m=ktai a=page_h_ashiato})&amp;({$tail})">あしあと</a><br>
({if $smarty.const.IS_USER_INVITE && ($smarty.const.OPENPNE_REGIST_FROM != $smarty.const.OPENPNE_REGIST_FROM_NONE)})[i:140]<a href="({t_url m=ktai a=page_h_invite})&amp;({$tail})">友人を誘う</a><br>({/if})
</td></tr>
<tr><td colspan="2" align="center">
[i:119]<a href="#search">検索</a>/[i:70]<a href="({t_url m=ktai a=page_h_diary_list_all})&amp;({$tail})">最新日記</a>/[i:1015]<a href="({t_url m=ktai a=page_h_ranking})&amp;({$tail})">ﾗﾝｷﾝｸﾞ</a>
<hr color="#({$ktai_color_config.border_01})" size="3"></td></tr>

<tr>
<td colspan="2">
[i:140]<a href="({t_url m=ktai a=page_fh_friend_list})&amp;({$tail})">({$WORD_MY_FRIEND_HALF})</a>(({$c_friend_count|default:'0'}))<br>
[i:155]<a href="({t_url m=ktai a=page_fh_com_list})&amp;({$tail})">参加ｺﾐｭﾆﾃｨ</a>(({$fh_com_count_user|default:'0'}))<br>
[i:136]<a href="({t_url m=ktai a=page_h_bookmark_list})&amp;({$tail})">お気に入り</a>
<hr color="#({$ktai_color_config.border_01})" size="3"></td></tr>

<tr>
<td colspan="2"  align="center">
[i:140]<a href="({t_url m=ktai a=page_h_prof})&amp;({$tail})">ﾌﾟﾛﾌｨｰﾙ</a>/[i:68]<a href="({t_url m=ktai a=page_h_config_image})&amp;({$tail})">写真</a>/[i:76]<a href="({t_url m=ktai a=page_fh_intro})&amp;({$tail})">紹介文</a><br>
<hr color="#({$ktai_color_config.border_01})"></td></tr>
</table>
　
<br>

<table width="100%">
<tr><td bgcolor="#({$ktai_color_config.bg_04})">
<a accesskey="1" name="a1" href="#a1">[i:125]</a>({$WORD_FRIEND_HALF})最新日記<br>
</td></tr>
({foreach from=$c_diary_friend_list item=item})
<tr><td bgcolor="#({cycle values="`$ktai_color_config.bg_05`,`$ktai_color_config.bg_08`"})">
<font color="#({$ktai_color_config.font_02})">[({$item.r_date|date_format:"%m/%d"})]</font> ({$item.nickname|t_truncate:22:""})<br>
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;({$tail})">({$item.subject|t_truncate:28:""})(({$item.count_comments}))</a>
({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})
[i:68]
({/if})
<br>
</td></tr>
<tr><td>
<hr color="#({$ktai_color_config.border_02})">
</td></tr>
({/foreach})
<tr><td align="right">
({if $c_diary_friend_list})
<font color="#({$ktai_color_config.font_03})">⇒</font><a href="({t_url m=ktai a=page_h_diary_list_friend})&amp;({$tail})">もっと見る</a><br>
({/if})
</td></tr>
</table>
<br>

<table width="100%">
<tr><td bgcolor="#({$ktai_color_config.bg_06})">
<a accesskey="2" name="a2" href="#a2">[i:126]</a>日記ｺﾒﾝﾄ記入履歴<br>
</td></tr>
({foreach from=$c_diary_my_comment_list item=item})
<tr><td bgcolor="#({cycle values="`$ktai_color_config.bg_07`,`$ktai_color_config.bg_08`"})">
<font color="#({$ktai_color_config.font_02})">[({$item.r_datetime|date_format:"%m/%d"})]</font> ({$item.nickname|t_truncate:22:""})<br>
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;({$tail})">({$item.subject|t_truncate:28:""})(({$item.num_comment}))</a><br>
</td></tr>
<tr><td>
<hr color="#({$ktai_color_config.border_03})">
</td></tr>
({/foreach})
({if $c_diary_my_comment_list})
<tr><td align="right">
<font color="#({$ktai_color_config.font_03})">⇒</font><a href="({t_url m=ktai a=page_h_diary_comment_list})&amp;({$tail})">もっと見る</a><br>
</td></tr>
({/if})
</table>
<br>

<table width="100%">
<tr><td bgcolor="#({$ktai_color_config.bg_04})">
<a accesskey="3" name="a3" href="#a3">[i:127]</a>ｺﾐｭﾆﾃｨ最新書き込み<br>
</td></tr>
({foreach from=$c_commu_topic_list item=item})
<tr><td bgcolor="#({cycle values="`$ktai_color_config.bg_05`,`$ktai_color_config.bg_08`"})">
<font color="#({$ktai_color_config.font_02})">[({$item.r_datetime|date_format:"%m/%d"})]</font> ({$item.c_commu_name|t_truncate:22:""})<br>
<a href="({t_url m=ktai a=page_c_bbs})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})&amp;({$tail})">({$item.c_commu_topic_name|t_truncate:28:""})(({$item.number}))</a>
({if $item.image_filename1 || $item.image_filename2 || $item.image_filename3})
[i:68]
({/if})
<br>
</td></tr>
<tr><td>
<hr color="#({$ktai_color_config.border_02})">
</td></tr>
({/foreach})
({if $c_commu_topic_list})
<tr><td align="right">
<font color="#({$ktai_color_config.font_03})">⇒</font><a href="({t_url m=ktai a=page_h_com_comment_list})&amp;({$tail})">もっと見る</a><br>
</td></tr>
({/if})
</table>
<br>

<table width="100%">
<tr><td bgcolor="#({$ktai_color_config.bg_06})">
<a name="search">[i:119]検索</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_07})">
<a href="({t_url m=ktai a=page_h_friend_find_all})&amp;({$tail})">ﾒﾝﾊﾞｰ検索</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_08})">
<a href="({t_url m=ktai a=page_h_diary_list_all})&amp;({$tail})">日記検索</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_07})">
<a href="({t_url m=ktai a=page_h_com_find_all})&amp;({$tail})">ｺﾐｭﾆﾃｨ検索</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_08})">
<hr color="#({$ktai_color_config.border_03})">
</td></tr></table>
<br>
<table width="100%">
<tr><td bgcolor="#({$ktai_color_config.bg_04})">
[i:140]ﾌﾟﾛﾌｨｰﾙ変更<br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_05})">
<a href="({t_url m=ktai a=page_h_config_prof})&amp;({$tail})">ﾌﾟﾛﾌｨｰﾙ変更</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_08})">
<a href="({t_url m=ktai a=page_h_config_image})&amp;({$tail})">ﾌﾟﾛﾌｨｰﾙ写真設定</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_08})">
<hr color="#({$ktai_color_config.border_02})">
</td></tr></table>
<br>
<table width="100%">
<tr><td bgcolor="#({$ktai_color_config.bg_06})">
[i:75]設定変更<br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_07})">
<a href="({t_url m=ktai a=page_h_config_mail})&amp;({$tail})">携帯ﾒｰﾙｱﾄﾞﾚｽ変更</a><br>
({if $smarty.const.OPENPNE_ENABLE_PC})
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_08})">
<a href="({t_url m=ktai a=page_h_pc_send})&amp;({$tail})">PCｱﾄﾞﾚｽ登録</a><br>
({/if})
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_07})">
<a href="({t_url m=ktai a=page_h_config_password})&amp;({$tail})">ﾊﾟｽﾜｰﾄﾞ変更</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_08})">
<a href="({t_url m=ktai a=page_h_config_password_query})&amp;({$tail})">秘密の質問・答え設定</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_07})">
<a href="({t_url m=ktai a=page_h_config_easy_login})&amp;({$tail})">かんたんﾛｸﾞｲﾝ設定</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_08})">
<hr color="#({$ktai_color_config.border_03})">
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_08})">
<a href="({t_url m=ktai a=page_h_config_mail_receive})&amp;({$tail})">ﾒｰﾙ受信設定</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_07})">
<a href="({t_url m=ktai a=page_h_config_mail_ashiato})&amp;({$tail})">あしあとお知らせﾒｰﾙ設定</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_08})">
<a href="({t_url m=ktai a=page_h_config_public_flag_diary})&amp;({$tail})">日記の公開範囲設定</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_07})">
<a href="({t_url m=ktai a=page_h_config_access_block})&amp;({$tail})">ｱｸｾｽﾌﾞﾛｯｸ設定</a><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_08})">
<hr color="#({$ktai_color_config.border_03})">
</td></tr></table>
<br>
<hr color="#({$ktai_color_config.border_01})">

■<a href="({t_url m=ktai a=page_o_sns_kiyaku})">利用規約</a><br>
■<a href="({t_url m=ktai a=page_o_sns_privacy})">ﾌﾟﾗｲﾊﾞｼｰﾎﾟﾘｼｰ</a><br>
({if $u!=1})
■<a href="({t_url m=ktai a=page_h_taikai_confirm})&amp;({$tail})">退会手続き</a><br>
({/if})

({$inc_ktai_footer|smarty:nodefaults})
