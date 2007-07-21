({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="日記削除"})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

<h2>日記削除</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

この日記を削除します。削除後に復元させることはできないので注意してください。

<form action="./" method="post">
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('delete_kakikomi_c_diary')})" />
<input type="hidden" name="target_c_diary_id" value="({$diary.c_diary_id})" />
<span class="textBtnS"><input type="submit" value="削除" /></span>
</form>

<table class="basicType2">
<tbody>
({****})
<tr>
<th>ID</th>
<td class="type1">
({$diary.c_diary_id})
</td>
</tr>
({****})
<tr>
<th>タイトル</th>
<td>
<a href="({t_url _absolute=1 m=pc a=page_fh_diary})&amp;target_c_diary_id=({$diary.c_diary_id})" target="_blank">({$diary.subject})</a> (コメント({$diary.count_comments})件)
</td>
</tr>
({****})
<tr>
<th>作成者</th>
<td>
<a href="({t_url _absolute=1 m=pc a=page_f_home})&amp;target_c_member_id=({$diary.c_member_id})" target="_blank">({$diary.c_member.nickname})</a>
</td>
</tr>
({****})
<tr>
<th>作成日</th>
<td>
({$diary.r_datetime})
</td>
</tr>
({****})
<tr>
<th>日記本文</th>
<td width="500">
({if $diary.image_filename_1 || $diary.image_filename_2 || $diary.image_filename_3})
<div>
({if $diary.image_filename_1})<span class="padding_s"><a href="({t_img_url filename=$diary.image_filename_1})" target="_blank"><img src="({t_img_url filename=$diary.image_filename_1 w=120 h=120})"></a></span>({/if})
({if $diary.image_filename_2})<span class="padding_s"><a href="({t_img_url filename=$diary.image_filename_2})" target="_blank"><img src="({t_img_url filename=$diary.image_filename_2 w=120 h=120})"></a></span>({/if})
({if $diary.image_filename_3})<span class="padding_s"><a href="({t_img_url filename=$diary.image_filename_3})" target="_blank"><img src="({t_img_url filename=$diary.image_filename_3 w=120 h=120})"></a></span>({/if})
</div>
({/if})
({$diary.body|t_truncate:"120"|nl2br})
</td>
</tr>
({****})
</tbody>
</table>

({$inc_footer|smarty:nodefaults})
