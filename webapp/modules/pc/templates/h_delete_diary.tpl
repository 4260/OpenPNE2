<div id="LayoutC">
<div id="Center">

({* {{{ yesNoButtonBox *})
<div class="dparts yesNoButtonBox"><div class="parts">
<div class="partsHeading"><h3>本当に削除しますか？</h3></div>

<div class="block">
<ul class="moreInfo button">
<li>
({t_form_block m=pc a=do_fh_diary_delete_c_diary})
<input type="hidden" name="target_c_diary_id" value="({$target_c_diary.c_diary_id})" />
<input type="submit" class="input_submit" value=" は い " />
({/t_form_block})
</li><li>
({t_form_block m=pc a=page_h_diary_edit})
<input type="hidden" name="target_c_diary_id" value="({$target_c_diary.c_diary_id})" />
<input type="hidden" name="target_c_member_id" value="({$target_c_diary.c_member_id})" />
<input type="submit" class="input_submit" value="いいえ" />
({/t_form_block})
</li>
</ul>
</div>

</div></div>
({* }}} *})

</div><!-- Center -->
</div><!-- LayoutC -->
