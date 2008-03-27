<div id="LayoutC">
<div id="Center">

({* {{{ formTable *})
<div class="dparts formTable"><div class="parts">
<div class="partsHeading"><h3>プロフィール確認</h3></div>
<div class="partsInfo">
<p>以下の内容で登録します。確認のうえ、登録ボタンをクリックしてください。</p>
</div>
<table>
({if $smarty.const.OPENPNE_AUTH_MODE == 'pneid'})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="dot" class="dot" /></td>
<td style="width:150px;" class="bg_05" align="left" valign="middle">

<div class="padding_s">

ログインID <span class="caution">※</span>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="dot" class="dot" /></td>
<td style="width:413px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$prof.login_id})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="dot" class="dot" /></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" alt="dot" class="dot" /></td>
</tr>
({/if})
({*********})
({capture name="nick"})
<tr>
<th>ニックネーム <strong>※</strong></th>
<td>({$prof.nickname})</td>
</tr>
({/capture})
({capture name="birth"})
<tr>
<th>生まれた年 <strong>※</strong></th>
<td>
({$prof.birth_year})年
({if $prof.public_flag_birth_year == 'friend'})
（({$WORD_MY_FRIEND})まで公開）
({elseif $prof.public_flag_birth_year == 'private'})
（公開しない）
({/if})
</td>
</tr>
<tr>
<th>誕生日 <strong>※</strong></th>
<td>
({$prof.birth_month})月({$prof.birth_day})日
</td>
</tr>
({/capture})
({foreach from=$profile_list item=profile})
({strip})

({if !$_cnt_nick && $profile.sort_order >= $smarty.const.SORT_ORDER_NICK
  && !$_cnt_birth && $profile.sort_order >= $smarty.const.SORT_ORDER_BIRTH})
({counter assign="_cnt_nick"})
({counter assign="_cnt_birth"})
({if $smarty.const.SORT_ORDER_NICK > $smarty.const.SORT_ORDER_BIRTH})
({$smarty.capture.birth|smarty:nodefaults})
({$smarty.capture.nick|smarty:nodefaults})
({else})
({$smarty.capture.nick|smarty:nodefaults})
({$smarty.capture.birth|smarty:nodefaults})
({/if})
({/if})

({if !$_cnt_nick && $profile.sort_order >= $smarty.const.SORT_ORDER_NICK})
({counter assign="_cnt_nick"})
({$smarty.capture.nick|smarty:nodefaults})
({/if})

({if !$_cnt_birth && $profile.sort_order >= $smarty.const.SORT_ORDER_BIRTH})
({counter assign="_cnt_birth"})
({$smarty.capture.birth|smarty:nodefaults})
({/if})

({/strip})
({if $profile.disp_regist})
<tr>
<th>({$profile.caption})({if $profile.is_required}) <strong>※</strong>({/if})</th>
<td>
({* #1952 *})({if $prof.profile[$profile.name].value})
({* #1952 *})
({* #1952 *})({if $profile.form_type == 'textarea'})
({* #1952 *})    ({$prof.profile[$profile.name].value|nl2br|t_url2cmd:'profile'|t_cmd:'profile'})
({* #1952 *})({elseif $profile.form_type == 'checkbox'})
({* #1952 *})    ({$prof.profile[$profile.name].value|@t_implode:", "})
({* #1952 *})({else})
({* #1952 *})    ({$prof.profile[$profile.name].value})
({* #1952 *})({/if})
({* #1952 *})
({* #1952 *})({if $prof.profile[$profile.name].public_flag == 'friend'})
({* #1952 *})（({$WORD_MY_FRIEND})まで公開）
({* #1952 *})({elseif $prof.profile[$profile.name].public_flag == 'private'})
({* #1952 *})（公開しない）
({* #1952 *})({/if})
({* #1952 *})
({* #1952 *})({/if})
</td>
</tr>
({/if})
({/foreach})
({* #1952 *})({if !$_cnt_nick && !$_cnt_birth})
({* #1952 *})({if $smarty.const.SORT_ORDER_NICK > $smarty.const.SORT_ORDER_BIRTH})
({* #1952 *})({$smarty.capture.birth|smarty:nodefaults})
({* #1952 *})({$smarty.capture.nick|smarty:nodefaults})
({* #1952 *})({else})
({* #1952 *})({$smarty.capture.nick|smarty:nodefaults})
({* #1952 *})({$smarty.capture.birth|smarty:nodefaults})
({* #1952 *})({/if})
({* #1952 *})({else})
({* #1952 *})({if !$_cnt_nick})({$smarty.capture.nick|smarty:nodefaults})({/if})
({* #1952 *})({if !$_cnt_birth})({$smarty.capture.birth|smarty:nodefaults})({/if})
({* #1952 *})({/if})
<tr>
<th>PCメールアドレス <strong>※</strong></th>
<td>({$pc_address})</td>
</tr>
<tr>
<th>パスワード <strong>※</strong></th>
<td>（表示しません）</td>
</tr>
<tr>
<th>秘密の質問 <strong>※</strong></th>
<td>({$password_query_name})</td>
</tr>
<tr>
<th>質問の答え <strong>※</strong></th>
<td>({$prof.c_password_query_answer})</td>
</tr>
</table>
<div class="operation">
<ul class="moreInfo button">
<li>
({t_form_block m=pc a=do_o_regist_prof})
<input type="hidden" name="mode" value="register" />
<input type="hidden" name="sid" value="({$sid})" />
<input type="submit" class="input_submit" value="登録" />
({/t_form_block})
</li>
<li>
({t_form_block m=pc a=do_o_regist_prof})
<input type="hidden" name="mode" value="input" />
<input type="hidden" name="sid" value="({$sid})" />
<input type="submit" class="input_submit" value="修正" />
({/t_form_block})
</li>
</ul>
</div>
</div></div>
({* }}} *})

</div><!-- Center -->
</div><!-- LayoutC -->
