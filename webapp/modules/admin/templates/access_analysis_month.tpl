({$inc_header|smarty:nodefaults})


<h2>({$item_str})ページ月次集計</h2>

<br>
<br>
<b>アクセスユーザ数</b><font size=1 color=red>（ＰＣ＋携帯の７日以内のログインユーザ数）</font><br>
({$active_num}) 人<br>
<br>
<br>
今月最もアクセスのあった<br>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_diary')})&ktai_flag=({if $item_str=='PC版'})0({else})1({/if})&ymd=({$nowtime})&month_flag=1&page_name=all&orderby2=-2">日記</a> 
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_member')})&ktai_flag=({if $item_str=='PC版'})0({else})1({/if})&ymd=({$nowtime})&month_flag=1&page_name=all&orderby2=-2">ユーザー</a> 
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_commu')})&ktai_flag=({if $item_str=='PC版'})0({else})1({/if})&ymd=({$nowtime})&month_flag=1&page_name=all&orderby2=-2">コミュニティ</a>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_topic')})&ktai_flag=({if $item_str=='PC版'})0({else})1({/if})&ymd=({$nowtime})&month_flag=1&page_name=all&orderby2=-2">トピック</a>
<br><br>
今月最もアクセスをした<br>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_member')})&ktai_flag=({if $item_str=='PC版'})0({else})1({/if})&ymd=({$nowtime})&month_flag=1&page_name=all&orderby2=-2">ユーザー</a> 

<br>
<br>

<table>
({foreach from=$access_analysis_month item=item})

<tr>
<td>
({$item.ym|date_format:"%Y年%m月"})
</td>
<td>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_page')})&ymd=({$item.ym})&month_flag=1&ktai_flag=({$ktai_flag})">
({$item.count})
</a>
</td>
<td>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_day')})&ymd=({$item.ym})&ktai_flag=({$ktai_flag})">日次集計</a>
</td>

</tr>
({/foreach})
</table>

({$inc_footer|smarty:nodefaults})