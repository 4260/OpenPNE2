({$inc_ktai_header|smarty:nodefaults})

<table width="100%"><tr><td align="center" bgcolor="#({$ktai_color_config.bg_01})">
<font color="#({$ktai_color_config.font_01})"><a name="top">ｺﾐｭﾆﾃｨの作成</a></font><br>
</td></tr></table>

({t_form m=ktai a=do_h_com_add_insert_c_commu})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<font color="#({$ktai_color_config.font_02})">ｺﾐｭﾆﾃｨ名：</font><br>
<input type="text" name="name" value=""><br>
<br>
<font color="#({$ktai_color_config.font_02})">ｶﾃｺﾞﾘ：</font><br>
<select name="c_commu_category_id">
({foreach from=$c_commu_category_list item=c_commu_category})
<option value="({$c_commu_category.c_commu_category_id})">({$c_commu_category.name})
({/foreach})
</select><br>
<br>
<font color="#({$ktai_color_config.font_02})">説明文：</font><br>
<textarea name="info" rows="6"></textarea><br>
<br>
<font color="#({$ktai_color_config.font_02})">参加条件と公開範囲：</font><br>
<select name="public_flag">
<option value="public" selected="selected">誰でも参加可能、掲示板は全員に公開
<option value="auth_sns">参加には管理者の承認が必要、掲示板は全員に公開
<option value="auth_commu_member">参加には管理者の承認が必要、掲示板はｺﾐｭﾆﾃｨﾒﾝﾊﾞｰにのみ公開
</select><br>
<hr color="#({$ktai_color_config.border_01})">
<center>
<input type="submit" value="ｺﾐｭﾆﾃｨを作成する">
</center>
</form>

({$inc_ktai_footer|smarty:nodefaults})
