({$inc_ktai_header|smarty:nodefaults})

<table width="100%">
({if $smarty.const.OPENPNE_USE_KTAI_LOGO})
<tr><td align="center">
<img src="({t_img_url_skin filename=skin_ktai_header w=240 h=320 f=jpg})" alt="({$smarty.const.SNS_NAME})"><br>
</td></tr>
({else})
<tr><td align="center" bgcolor="#({$ktai_color_config.bg_02})">
<font color="#({$ktai_color_config.font_05})">({$smarty.const.SNS_NAME})</font><br>
</td></tr>
({/if})
</table>
<br>
({foreach from=$top item=data})
    ({ext_include file="inc_portal_Contents_Layout_ktai.tpl"})
({/foreach})
<br>
<center>
このﾍﾟｰｼﾞをﾌﾞｯｸﾏｰｸしてください<br>
</center>
<br>
<table width="100%"><tr><td bgcolor="#({$ktai_color_config.bg_02})">
[i:75]<font color="#({$ktai_color_config.font_05})">かんたんﾛｸﾞｲﾝ</font><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_04})">
<br>
<center>
({t_form _attr='utn' m=ktai a=do_o_easy_login})
<input type="hidden" name="login_params" value="({$requests.login_params})">
<input type="submit" value="かんたんﾛｸﾞｲﾝ"><br>
</form>
</center>
<br>
<a href="({t_url m=ktai a=page_o_whatis_easy_login})">&gt;&gt;かんたんﾛｸﾞｲﾝとは</a><br>
</td></tr></table>
<br>

<table width="100%"><tr><td bgcolor="#({$ktai_color_config.bg_02})">
<font color="#({$ktai_color_config.font_05})">[i:116]ﾊﾟｽﾜｰﾄﾞﾛｸﾞｲﾝ</font><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_04})">
({t_form m=ktai a=do_o_login})
<input type="hidden" name="login_params" value="({$requests.login_params})">
<font color="#({$ktai_color_config.bg_02})">★</font>携帯ﾒｰﾙｱﾄﾞﾚｽ<br>
<textarea name="username" rows="1" istyle="3" mode="alphabet"></textarea><br>
<font color="#({$ktai_color_config.bg_02})">★</font>ﾊﾟｽﾜｰﾄﾞ<br>
<input name="password" type="text" istyle="3" mode="alphabet" value=""><br>
<center>
<input name="submit" value="ﾛｸﾞｲﾝ" type="submit"><br>
</center>
</form>
<a href="({t_url m=ktai a=page_o_password_query})">&gt;&gt;ﾊﾟｽﾜｰﾄﾞを忘れた方</a><br>
</td></tr></table>
<br>

({foreach from=$bottom item=data})
    ({ext_include file="inc_portal_Contents_Layout_ktai.tpl"})
({/foreach})

<br>
<hr color="#({$ktai_color_config.border_01})">
({if $IS_CLOSED_SNS})
({$SNS_NAME})は招待制のｿｰｼｬﾙﾈｯﾄﾜｰｷﾝｸﾞｻｰﾋﾞｽです。<br>
登録には({$SNS_NAME})({if $smarty.const.IS_USER_INVITE})参加者({else})管理者({/if})からの招待が必要です。<br>

({elseif !((($smarty.const.OPENPNE_REGIST_FROM) & ($smarty.const.OPENPNE_REGIST_FROM_KTAI)) >> 1)})

新規登録はPCからおこなってください。<br>

({else})

新規登録するには以下のﾘﾝｸから、本文を入力せずにﾒｰﾙを送信してください。<br>
<br>
<a href="mailto:({$smarty.const.MAIL_ADDRESS_PREFIX})get@({$smarty.const.MAIL_SERVER_DOMAIN})">[i:106]ﾒｰﾙで登録!</a><br>
<br>
※かならず利用規約に同意してから登録をおこなってください。<br>

<hr color="#({$ktai_color_config.border_01})">
■<a href="({t_url m=ktai a=page_o_sns_kiyaku})">利用規約</a><br>
■<a href="({t_url m=ktai a=page_o_sns_privacy})">ﾌﾟﾗｲﾊﾞｼｰﾎﾟﾘｼｰ</a><br>
({/if})

({$inc_ktai_footer|smarty:nodefaults})
