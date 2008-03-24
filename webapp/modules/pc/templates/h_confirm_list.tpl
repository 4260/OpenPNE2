<div id="LayoutC">
<div id="Center">

({* {{{ searchResultList *})
<div class="dparts searchResultList"><div class="parts">
<div class="partsHeading"><h3>あなたに({$WORD_FRIEND})リンクを要請しているメンバー</h3></div>

<div class="pagerAbsolute">
({if $anatani_c_friend_confirm_list})
<p>以下の人があなたに({$WORD_FRIEND})リンクを要請しています。<br />参加の承認または拒否を選択してください。</p>
({else})
<p>現在({$WORD_FRIEND})リンクを要請してるメンバーはいません。</p>
({/if})
</div>

({if $anatani_c_friend_confirm_list})
<div class="block">
({foreach from=$anatani_c_friend_confirm_list item=item})
<div class="ditem"><div class="item"><table><tr>
<td class="photo" rowspan="3"><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_from})"><img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image})" alt="" /></a></td>
<th>ニックネーム</th><td><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_from})">({$item.nickname})</a></td>
</tr><tr>
<th>メッセージ</th><td>({$item.message|nl2br})</td>
</tr><tr>
<th>&nbsp;</th><td class="operation"><span class="text"></span> <span class="moreInfo"><a href="({t_url m=pc a=do_h_confirm_list_insert_c_friend})&amp;target_c_friend_confirm_id=({$item.c_friend_confirm_id})&amp;sessid=({$PHPSESSID})"><img src="({t_img_url_skin filename=button_shonin})" alt="承認" /></a> <a href="({t_url m=pc a=do_h_confirm_list_delete_c_friend_confirm})&amp;target_c_friend_confirm_id=({$item.c_friend_confirm_id})&amp;sessid=({$PHPSESSID})" ><img src="({t_img_url_skin filename=button_kyohi})" alt="拒否" /></a></span></td>
</tr></table></div></div>
({/foreach})
</div>
({/if})

</div></div>
({* }}} *})

({* {{{ searchResultList *})
<div class="dparts searchResultList"><div class="parts">
<div class="partsHeading"><h3>あなたの管理コミュニティに参加を希望しているメンバー</h3></div>

<div class="pagerAbsolute">
({if $anatani_c_commu_member_confirm_list})
<p>以下の人があなたが管理しているコミュニティへの参加を希望しています。<br />参加の承認または拒否を選択してください。</p>
({else})
<p>現在あなたの管理コミュニティに参加を要請してるメンバーはいません。</p>
({/if})
</div>

({if $anatani_c_commu_member_confirm_list})
<div class="block">
({foreach from=$anatani_c_commu_member_confirm_list item=item})
<div class="ditem"><div class="item"><table><tr>
<td class="photo" rowspan="4"><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})"><img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image})" alt="" /></a></td>
<th>ニックネーム</th><td><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname})</a></td>
</tr><tr>
<th>参加希望<br />コミュニティ</th><td><a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">({$item.c_commu_name})</a></td>
</tr><tr>
<th>メッセージ</th><td>({$item.message|nl2br})</td>
</tr><tr>
<th>&nbsp;</th><td class="operation"><span class="text"></span> <span class="moreInfo"><a href="({t_url m=pc a=do_h_confirm_list_insert_c_commu_member})&amp;target_c_commu_member_confirm_id=({$item.c_commu_member_confirm_id})&amp;sessid=({$PHPSESSID})"><img src="({t_img_url_skin filename=button_shonin})" alt="承認" /></a> <a href="({t_url m=pc a=do_h_confirm_list_delete_c_commu_member_confirm})&amp;target_c_commu_member_confirm_id=({$item.c_commu_member_confirm_id})&amp;sessid=({$PHPSESSID})" ><img src="({t_img_url_skin filename=button_kyohi})" alt="拒否" /></a></span></td>
</tr></table></div></div>
({/foreach})
</div>
({/if})

</div></div>
({* }}} *})

({* {{{ searchResultList *})
<div class="dparts searchResultList"><div class="parts">
<div class="partsHeading"><h3>あなたにコミュニティ管理者交代を希望しているメンバー</h3></div>

<div class="pagerAbsolute">
({if $anatani_c_commu_admin_confirm_list})
<p>以下の人があなたにコミュニティ管理者交代を希望しています。<br />交代の承認または拒否を選択してください。</p>
({else})
<p>現在あなたにコミュニティ管理者交代を要請してるメンバーはいません。</p>
({/if})
</div>

({if $anatani_c_commu_admin_confirm_list})
<div class="block">
({foreach from=$anatani_c_commu_admin_confirm_list item=item})
<div class="ditem"><div class="item"><table><tr>
<td class="photo" rowspan="4"><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_admin})"><img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image})" alt="" /></a></td>
<th>ニックネーム</th><td><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_admin})">({$item.nickname})</a></td>
</tr><tr>
<th>コミュニティ</th><td><a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">({$item.c_commu_name})</a></td>
</tr><tr>
<th>メッセージ</th><td>({$item.message|nl2br})</td>
</tr><tr>
<th>&nbsp;</th><td class="operation"><span class="text"></span> <span class="moreInfo"><a href="({t_url m=pc a=do_h_confirm_list_update_c_commu_admin_confirm})&amp;target_c_commu_admin_confirm_id=({$item.c_commu_admin_confirm_id})&amp;sessid=({$PHPSESSID})"><img src="({t_img_url_skin filename=button_shonin})" alt="承認" /></a> <a href="({t_url m=pc a=do_h_confirm_list_delete_c_commu_admin_confirm})&amp;target_c_commu_admin_confirm_id=({$item.c_commu_admin_confirm_id})&amp;sessid=({$PHPSESSID})"><img src="({t_img_url_skin filename=button_kyohi})" alt="拒否" /></a></span></td>
</tr></table></div></div>
({/foreach})
</div>
({/if})

</div></div>
({* }}} *})

({* {{{ searchResultList *})
<div class="dparts searchResultList"><div class="parts">
<div class="partsHeading"><h3>あなたにコミュニティ副管理者を希望しているメンバー</h3></div>

<div class="pagerAbsolute">
({if $anatani_c_commu_sub_admin_confirm_list})
<p>以下の人があなたにコミュニティ副管理者を希望しています。<br />承認または拒否を選択してください。</p>
({else})
<p>現在あなたにコミュニティ副管理者を要請してるメンバーはいません。</p>
({/if})
</div>

({if $anatani_c_commu_sub_admin_confirm_list})
<div class="block">
({foreach from=$anatani_c_commu_sub_admin_confirm_list item=item})
<div class="ditem"><div class="item"><table><tr>
<td class="photo" rowspan="4"><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_sub_admin})"><img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image})" alt="" /></a></td>
<th>ニックネーム</th><td><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_sub_admin})">({$item.nickname})</a></td>
</tr><tr>
<th>コミュニティ</th><td><a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">({$item.c_commu_name})</a></td>
</tr><tr>
<th>メッセージ</th><td>({$item.message|nl2br})</td>
</tr><tr>
<th>&nbsp;</th><td class="operation"><span class="text"></span> <span class="moreInfo"><a href="({t_url m=pc a=do_h_confirm_list_update_c_commu_sub_admin_confirm})&amp;target_c_commu_sub_admin_confirm_id=({$item.c_commu_sub_admin_confirm_id})&amp;sessid=({$PHPSESSID})"><img src="({t_img_url_skin filename=button_shonin})" alt="承認" /></a> <a href="({t_url m=pc a=do_h_confirm_list_delete_c_commu_sub_admin_confirm})&amp;target_c_commu_sub_admin_confirm_id=({$item.c_commu_sub_admin_confirm_id})&amp;sessid=({$PHPSESSID})"><img src="({t_img_url_skin filename=button_kyohi})" alt="拒否" /></a></span></td>
</tr></table></div></div>
({/foreach})
</div>
({/if})

</div></div>
({* }}} *})

</div><!-- Center -->
</div><!-- LayoutC -->
