({$inc_ktai_header|smarty:nodefaults})
<table width="100%"><tr><td align="center" bgcolor="#0d6ddf">
<font color="#eeeeee"><a name="top">設定変更</a></font><br>
</td></tr>
<tr><td bgcolor="#dddddd" align="center">
ﾒｰﾙ受信設定<br>
</td></tr></table>
新着ﾒｯｾｰｼﾞの通知などを登録携帯ﾒｰﾙｱﾄﾞﾚｽにお知らせします。 <br>
<hr color="#0d6ddf">
<font color="#999966">ﾒｰﾙ受信設定：</font><br>
({t_form m=ktai a=do_h_config_mail_receive_update_mail_receive})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="radio" name="is_receive_ktai_mail" value="1"({if $c_member.is_receive_ktai_mail}) checked="checked"({/if})>
受け取る<br>
<input type="radio" name="is_receive_ktai_mail" value="0"({if !$c_member.is_receive_ktai_mail}) checked="checked"({/if})>
受け取らない<br>
<center>
<input type="submit" value="変更">
</center>
</form>

<hr color="#0d6ddf">
%%i117%%<a href="({t_url m=ktai a=page_h_config})&amp;({$tail})">設定変更</a><br>

({$inc_ktai_footer|smarty:nodefaults})
