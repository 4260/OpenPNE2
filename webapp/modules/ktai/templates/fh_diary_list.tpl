({$inc_ktai_header|smarty:nodefaults})

<table width="100%"><tr><td align="center" bgcolor="#0d6ddf">
<font color="#eeeeee"><a name="top">({$target_c_member.nickname})さんの日記</a></font><br>
</td></tr>
<tr><td bgcolor="#dddddd" align="center">
最新日記ﾘｽﾄ<br>
</td></tr></table>

({if $INC_NAVI_type=="h"})
&#xE719;<a href="({t_url m=ktai a=page_h_diary_edit})&amp;({$tail})">日記を書く</a>
<hr color="#0d6ddf">
({/if})

<center>
({$pager.start})件～({$pager.end})件を表示<br>
</center>

<hr color="#b3ceef">
<table width="100%">
({foreach from=$target_diary_list item=target_diary})
<tr><td bgcolor="({cycle values="#e0eaef,#ffffff"})">
({$target_diary.r_datetime|date_format:"%Y/%m/%d %H:%M"})({if $INC_NAVI_type=="h"}) [<a href="({t_url m=ktai a=page_h_diary_edit})&amp;target_c_diary_id=({$target_diary.c_diary_id})&amp;({$tail})">編集</a>]({/if})<br>
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$target_diary.c_diary_id})&amp;({$tail})">({$target_diary.subject|t_truncate:28:""})</a>(({$target_diary.num_comment}))<br>
</td></tr>
<tr><td>
<hr color="#b3ceef">
</td></tr>
({/foreach})
</table>
({if $is_prev || $is_next})
<center>
({if $is_prev})<a href="({t_url m=ktai a=page_fh_diary_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;page=({$page-1})({if $keyword})&amp;keyword=({$keyword})({/if})&amp;({$tail})" accesskey="4">&#xE6E5;前を表示</a>({/if})
({if $is_prev && $is_next})&nbsp;({/if})
({if $is_next})<a href="({t_url m=ktai a=page_fh_diary_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;page=({$page+1})({if $keyword})&amp;keyword=({$keyword})({/if})&amp;({$tail})" accesskey="6">&#xE6E7;次を表示</a>({/if})
<br>
</center>
({/if})
<hr color="#0d6ddf">
({if $INC_NAVI_type=="h"})
&#xE719;<a href="({t_url m=ktai a=page_h_diary_edit})&amp;({$tail})">日記を書く</a><br>
<table width="100%"><tr><td align="center" bgcolor="#0d6ddf">
<font color="#eeeeee">日記検索</font><br>
</td></tr>
</table>
({t_form _method=get m=ktai a=page_fh_diary_list})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<font color="#999966">ｷｰﾜｰﾄﾞ：</font><br>
<input type="text" name="keyword" value="({$keyword})"><br>
<center><input type="submit" value="検索する"></center>
</form>
({/if})
({if $INC_NAVI_type=="f"})
<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">({$target_c_member.nickname})さんのﾄｯﾌﾟ</a><br>
({/if})

({$inc_ktai_footer|smarty:nodefaults})
