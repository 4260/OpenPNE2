<div id="LayoutC">
<div id="Center">

({if $total_num})
({* {{{ recentList *})
<div class="dparts recentList"><div class="parts">
<div class="partsHeading"><h3>日記コメント記入履歴</h3></div>

<div class="pagerRelative">
({if $is_prev})<p class="prev"><a href="({t_url m=pc a=page_h_diary_comment_list})&amp;page=({$page})&amp;direc=-1">前を表示</a></p>
({/if})
<p class="number">({$pager.start})件～({$pager.end})件を表示</p>
({if $is_next})<p class="next"><a href="({t_url m=pc a=page_h_diary_comment_list})&amp;page=({$page})&amp;direc=1">次を表示</a></p>
({/if})
</div>

({foreach from=$h_diary_comment_list item=item})
<dl>
<dt>({$item.r_datetime|date_format:"%Y年%m月%d日 %H:%M"})</dt>
<dd><a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;comment_count=({$item.num_comment})">({$item.subject}) (({$item.num_comment}))</a> (({$item.nickname}))</dd>
</dl>
({/foreach})

<div class="pagerRelative">
({if $is_prev})<p class="prev"><a href="({t_url m=pc a=page_h_diary_comment_list})&amp;page=({$page})&amp;direc=-1">前を表示</a></p>
({/if})
<p class="number">({$pager.start})件～({$pager.end})件を表示</p>
({if $is_next})<p class="next"><a href="({t_url m=pc a=page_h_diary_comment_list})&amp;page=({$page})&amp;direc=1">次を表示</a></p>
({/if})
</div>
</div></div>
({* }}} *})

({else})
({* {{{ simpleBox *})
<div class="dparts simpleBox"><div class="parts">
<div class="partsHeading"><h3>日記コメント記入履歴</h3></div>
<div class="block">
<p>まだ記入した日記コメントはありません。</p>
</div>
</div></div>
({* }}} *})
({/if})

</div><!-- Center -->
</div><!-- LayoutC -->
