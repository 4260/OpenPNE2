({ext_include file="inc_header.tpl"})
({ext_include file="inc_layoutcolumn_top_720px.tpl"})
({***************************})
({**ここから：メインコンテンツ**})
({***************************})

<img src="./skin/dummy.gif" alt="" class="v_spacer_l">

<!-- ******************************************** -->
<!-- ******ここから：削除確認****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:580px;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:566px;" class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="center">
<!-- *ここから：削除確認＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:566px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:528px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">本当に削除しますか？</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:566px;">
({*********})
<tr>
<td style="width:566px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:564px;" class="bg_02" align="center" valign="middle">

<div class="padding_w_m">

<table border="0" cellspacing="0" cellpadding="2" style="width:200px;height:2em;">
<tr>

({t_form m=biz a=do_s_delete_shisetsu})
<input type="hidden" name="sessid" value="({$PHPSESSID})">
<input type="hidden" name="target_id" value="({$target_id})">

<td align="right">

<input type="submit" class="submit" value=" は い ">

</td>

</form>

({t_form m=biz a=page_s_list})

<td>

<input type="submit" class="submit" value="いいえ">

</td>

</form>

</tr>
</table>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" alt="" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：削除確認＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:566px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" alt="" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：削除確認****** -->
<!-- ******************************************** -->

<img src="./skin/dummy.gif" alt="" class="v_spacer_l">


({***************************})
({**ここまで：メインコンテンツ**})
({***************************})
({ext_include file="inc_layoutcolumn_bottom_270px_165px_175px_720px.tpl"})
({ext_include file="inc_footer.tpl"})
