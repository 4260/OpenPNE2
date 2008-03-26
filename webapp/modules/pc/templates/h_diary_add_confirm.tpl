<div id="LayoutC">
<div id="Center">

({* {{{ formTable *})
<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>日記を書く</h3></div>
<div class="partsInfo"
<p>以下の内容でよろしいですか？</p>
</div>
<table>
<tr>
<th>タイトル</th>
<td>({$form_val.subject})</td>
</tr>
<tr>
<th>本文</th>
<td>({$form_val.body|nl2br|t_url2cmd:'diary'|t_cmd:'diary'})</td>
</tr>
({if $form_val.upfile_1.name})
<tr>
<th>写真1</th>
<td>({$form_val.upfile_1.name})</td>
</tr>
({/if})
({if $form_val.upfile_2.name})
<tr>
<th>写真2</th>
<td>({$form_val.upfile_2.name})</td>
</tr>
({/if})
({if $form_val.upfile_3.name})
<tr>
<th>写真3</th>
<td>({$form_val.upfile_3.name})</td>
</tr>
({/if})
({if $form_val.category})
<tr>
<th>カテゴリ</th>
<td>({$form_val.category})</td>
</tr>
({/if})
<tr>
<th>公開範囲</th>
<td>
({* #1952 *})({if $form_val.public_flag == "public"})
({* #1952 *})全員に公開
({* #1952 *})({elseif $form_val.public_flag == "friend"})
({* #1952 *})({$WORD_MY_FRIEND})まで公開
({* #1952 *})({elseif $form_val.public_flag == "private"})
({* #1952 *})公開しない
({* #1952 *})({/if})
</td>
</tr>
</table>
<div class="operation">
<ul class="moreInfo button">
<li>
({t_form_block m=pc a=do_h_diary_add_insert_c_diary})
<input type="hidden" name="subject" value="({$form_val.subject})" />
<input type="hidden" name="body" value="({$form_val.body})" />
<input type="hidden" name="public_flag" value="({$form_val.public_flag})" />
<input type="hidden" name="tmpfile_1" value="({$form_val.tmpfile_1})" />
<input type="hidden" name="tmpfile_2" value="({$form_val.tmpfile_2})" />
<input type="hidden" name="tmpfile_3" value="({$form_val.tmpfile_3})" />
<input type="hidden" name="category" value="({$form_val.category})" />
<input type="submit" class="input_submit" value="作成" />
({/t_form_block})
</li>
<li>
({t_form_block m=pc a=page_h_diary_add})
<input type="hidden" name="subject" value="({$form_val.subject})" />
<input type="hidden" name="body" value="({$form_val.body})" />
<input type="hidden" name="public_flag" value="({$form_val.public_flag})" />
<input type="hidden" name="category" value="({$form_val.category})" />
<input type="submit" class="input_submit" value="修正" />
({/t_form_block})
</li>
</ul>
</div>
</div></div>
({* }}} *})

</div><!-- Center -->
</div><!-- LayoutC -->
