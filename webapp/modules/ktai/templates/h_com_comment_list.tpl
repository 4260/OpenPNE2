({$inc_ktai_header|smarty:nodefaults})
<table width="100%"><tr><td align="center" bgcolor="#0d6ddf">
<font color="#eeeeee"><a name="top">ｺﾐｭﾆﾃｨ最新書き込み</a></font><br>
</td></tr></table>
<center>
({$pager.start})～({$pager.end})件目を表示
</center>
<hr color="#b3ceef">
<table width="100%">
({foreach from=$h_com_comment_list item=each_topic})
<tr><td bgcolor="({cycle values="#e0eaef,#ffffff"})">
({$each_topic.r_datetime|date_format:"%Y/%m/%d %H:%M"})<br>
<a href="({t_url m=ktai a=page_c_bbs})&amp;target_c_commu_topic_id=({$each_topic.c_commu_topic_id})&amp;({$tail})">({$each_topic.c_commu_topic_name|t_truncate:50:""})(({$each_topic.number}))</a>(({$item.c_commu_name|t_truncate:17:""}))<br>
</td></tr>
<tr><td>
<hr color="#b3ceef">
</td></tr>
({/foreach})
</table>

({if $is_prev || $is_next})
<center>
({if $is_prev})<a href="({t_url m=ktai a=page_h_com_comment_list})&amp;page=({$page-1})&amp;({$tail})" accesskey="4">&#xE6E5;前を表示</a>({/if})
({if $is_prev && $is_next})&nbsp;({/if})
({if $is_next})<a href="({t_url m=ktai a=page_h_com_comment_list})&amp;page=({$page+1})&amp;({$tail})" accesskey="6">&#xE6E7;次を表示</a>({/if})
<br>
</center>
({/if})
({$inc_ktai_footer|smarty:nodefaults})
