({ext_include file="inc_header.tpl"})
({ext_include file="inc_layoutcolumn_top_720px.tpl"})

({***************************})
({**ここから：メインコンテンツ**})
({***************************})

<img src="./skin/dummy.gif" alt="" class="v_spacer_l">

<!-- ******************************************** -->
<!-- ******ここから：フレンド追加****** -->
({t_form m=pc a=page_f_link_request_confirm})
<input type="hidden" name="sessid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_member_id" value="({$target_member.c_member_id})">

<table border="0" cellspacing="0" cellpadding="0" style="width:580px;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:566px;" class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="center">
<!-- *ここから：フレンド追加＞内容* -->
({*ここから：header*})
<table border="0" cellspacing="0" cellpadding="0" style="width:566px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:528px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">({$WORD_MY_FRIEND})に追加</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:566px;">
({*********})
<tr>
<td style="width:566px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:564px;" class="bg_09" align="left" valign="middle" colspan="3">

<div class="padding_w_m">

({$target_member.nickname}) さんとは既にお知り合いですか？<br>
({$WORD_MY_FRIEND})リンク申請メッセージを送信し、承諾を受けてください。<br>
※交流の無い方へいきなりリンク申請を送るのは、失礼になる場合もあります。十分に確認して、リンク申請をおこなってください。

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="left" valign="middle">

<div class="padding_s">

写真

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:413px" class="bg_02" align="left" valign="middle">

<div class="padding_s">

<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_member.c_member_id})">
<img src="({t_img_url filename=$target_member.image_filename w=76 h=76 noimg=no_image})" class="pict"></a>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle">

<div class="padding_s">

送信先

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:421px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_member.c_member_id})">({$target_member.nickname})</a>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:574px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle">

<div class="padding_s">

メッセージ (任意)

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

<textarea class="text" name="body" rows="5" cols="40" style="width:410px;">({$form.body})</textarea>

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_03" align="center" valign="middle" colspan="3">

<div class="padding_w_m">

<table border="0" cellspacing="0" cellpadding="0" style="width:200px;height:20px;">
<tr>
<td>

<div align="center" style="text-align:center;">

<input type="submit" class="submit" value="確認画面">

</div>

</td>
</tr>
</table>

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：フレンド追加＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:566px;" class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>

</form>
<!-- ******ここまで：フレンド追加****** -->
<!-- ******************************************** -->

<img src="./skin/dummy.gif" alt="" class="v_spacer_l">


({***************************})
({**ここまで：メインコンテンツ**})
({***************************})
({ext_include file="inc_layoutcolumn_bottom_270px_165px_175px_720px.tpl"})
({ext_include file="inc_footer.tpl"})
