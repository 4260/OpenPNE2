({$inc_ktai_header|smarty:nodefaults})

<table width="100%"><tr><td align="center" bgcolor="#({$ktai_color_config.bg_01})">
<font color="#({$ktai_color_config.font_01})"><a name="top">({$c_commu.name})</a></font><br>
</td></tr>
<tr><td bgcolor="#({$ktai_color_config.bg_02})" align="center">
ｺﾐｭﾆﾃｨﾒﾝﾊﾞｰ管理<br>
</td></tr></table>
<center>
({$pager.start})～({$pager.end})件目を表示
</center>
<hr color="#({$ktai_color_config.border_01})">

<table width="100%">
({foreach from=$c_member_list item=item})
<tr><td bgcolor="({cycle values="#`$ktai_color_config.bg_05`,#ffffff"})">
<font color="#({$ktai_color_config.font_02})">ﾆｯｸﾈｰﾑ：</font><br>
({$item.nickname})<br>
({if $c_commu.c_member_id_admin != $item.c_member_id})
<br>
<a href="({t_url m=ktai a=page_c_edit_member_delete_c_commu_member_confirm})&amp;target_c_commu_id=({$c_commu.c_commu_id})&amp;target_c_member_id=({$item.c_member_id})&amp;({$tail})">ｺﾐｭﾆﾃｨから退会させる</a><br>
({if $count_member > 1 && $c_commu.c_member_id_sub_admin != $u})
({if $admin_list})
<a href="({t_url m=ktai a=do_c_edit_member_insert_c_commu_admin_confirm})&amp;target_c_commu_id=({$item.c_member_id})&amp;target_c_member_id=({$item.c_member_id})&amp;({$tail})">管理権を渡す</a><br>
({/if})
({if $subadmin_list})
<a href="({t_url m=ktai a=do_c_edit_member_insert_c_commu_sub_admin_confirm})&amp;target_c_commu_id=({$item.c_member_id})&amp;target_c_member_id=({$item.c_member_id})&amp;({$tail})">副管理者に任命</a><br>
({/if})
({/if})
({/if})
</td></tr>
<tr><td>
<hr color="#({$ktai_color_config.border_02})">
</td></tr>
({/foreach})
</table>
({if $is_prev || $is_next})
<center>
({if $is_prev})<a href="({t_url m=ktai a=page_c_edit_member})&amp;target_c_commu_id=({$c_commu.c_commu_id})&amp;page=({$page-1})&amp;({$tail})" accesskey="4">%%i128%%前を表示</a>({/if})
({if $is_prev && $is_next})&nbsp;({/if})
({if $is_next})<a href="({t_url m=ktai a=page_c_edit_member})&amp;target_c_commu_id=({$c_commu.c_commu_id})&amp;page=({$page+1})&amp;({$tail})" accesskey="6">%%i130%%次を表示</a>({/if})
<br>
</center>
({/if})
<a href="({t_url m=ktai a=page_c_home})&amp;target_c_commu_id=({$c_commu.c_commu_id})&amp;({$tail})">ｺﾐｭﾆﾃｨﾄｯﾌﾟ</a><br>
</font>

({$inc_ktai_footer|smarty:nodefaults})
