({$inc_html_header|smarty:nodefaults})
<body>
({ext_include file="inc_extension_pagelayout_top.tpl"})
<table class="mainframe" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="container inc_page_header">
({$inc_page_header|smarty:nodefaults})
</td>
</tr>
<tr>
<td class="container inc_navi">
({$inc_navi|smarty:nodefaults})
</td>
</tr>
<tr>
<td class="container main_content">
<table class="container" border="0" cellspacing="0" cellpadding="0">({*BEGIN:container*})
<tr>
<td style="width:5px;"><img src="./skin/dummy.gif" style="width:5px;" class="dummy"></td>
<td class="left_content_175" align="center" valign="top">
({***********************************})
({**��������F���C���R���e���c(��)*******})
({***********************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- *********************************************** -->
<!-- ******��������F���b�Z�[�W�{�b�N�X�����j���[****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:165px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:151px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_02" align="center">
<!-- *��������F���b�Z�[�W�{�b�N�X�����j���[�����e* -->
({*��������Fheader*})
<!-- ���� -->
({*�����܂ŁFheader*})
({*��������Fbody*})
<!-- ��������F����e -->
<table border="0" cellspacing="0" cellpadding="0" style="width:151px;">
<tr>
({if $box != "inbox"})
<td align="left" style="width:151px;padding:3px;" class="bg_02 border_10">
({else})
<td align="left" style="width:151px;padding:3px;" class="bg_09 border_10">
({/if})
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=inbox">��M���b�Z�[�W</a>
</td>
</tr>
<tr>
({if $box != "outbox"})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_02 border_10">
({else})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_09 border_10">
({/if})
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=outbox">���M�σ��b�Z�[�W</a>
</td>
</tr>
<tr>
({if $box != "savebox"})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_02 border_10">
({else})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_09 border_10">
({/if})
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=savebox">������</a>
</td>
</tr>
<tr>
({if $box != "trash"})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_02 border_10">
({else})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_09 border_10">
({/if})
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=trash">���ݔ�</a>
</td>
</tr>
</table>
<!-- �����܂ŁF����e -->
({*�����܂ŁFbody*})
({*��������Ffooter*})
<!-- ���� -->
({*�����܂ŁFfooter*})
<!-- *�����܂ŁF���b�Z�[�W�{�b�N�X�����j���[�������e* -->
</td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******�����܂ŁF���b�Z�[�W�{�b�N�X�����j���[****** -->
<!-- *********************************************** -->

({********************************})
({**�����܂ŁF���C���R���e���c�i���j**})
({********************************})
</td>
<td style="width:5px;"><img src="./skin/dummy.gif" style="width:5px;" class="dummy"></td>
<td class="right_content_535" align="center" valign="top">
({********************************})
({**��������F���C���R���e���c�i�E�j**})
({********************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- **************************** -->
<!-- ******��������F���b�Z�[�W�\����****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:520px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:506px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="center">
<!-- *��������F���b�Z�[�W�\���������e* -->
({*��������Fheader*})
<!-- ��������F���^�C�g�� -->
<table border="0" cellspacing="0" cellpadding="0" style="width:506px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:468px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">���b�Z�[�W�̏ڍ�</span></td>
</tr>
</table>
<!-- �����܂ŁF���^�C�g�� -->
({*�����܂ŁFheader*})
({*��������Fbody*})
<!-- ��������F����e -->
<table border="0" cellspacing="0" cellpadding="0" style="width:504px;">
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="6"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" rowspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:110px;" align="center" rowspan="5" class="bg_03">

<div class="padding_s">

<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({if $c_message.is_received})({$c_message.c_member_id_from})({else})({$c_message.c_member_id_to})({/if})">
<img src="({t_img_url filename=$c_message.image_filename_disp w=120 h=120 noimg=no_image})"></a>

</div>

</td>
<td style="width:1px;" class="bg_01" rowspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:63px;" class="bg_05" align="right">

<div class="padding_s">

({if $c_message.is_received})
���o�l :
({else})
�� �� :
({/if})

</div>

</td>
<td style="width:330px;" class="bg_05" align="left">

<div class="padding_s">

({if $c_message.is_received})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_message.c_member_id_from})">({$c_message.c_member_nickname_from})</a>
({else})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_message.c_member_id_to})">({$c_message.c_member_nickname_to})</a>
({/if})

</div>

</td>
<td style="width:1px;" class="bg_01" rowspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="2"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_05" align="right">

<div class="padding_s">

���@�t :

</div>

</td>
<td class="bg_05" align="left">

<div class="padding_s">

({$c_message.r_datetime|date_format:"%Y�N%m��%d�� %H:%M"})

</div>

</td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="2"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_05" align="right">

<div class="padding_s">

���@�� :

</div>

</td>
<td class="bg_05" align="left">

<div class="padding_s">

({$c_message.subject})

</div>

</td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="6"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td align="left" valign="top" colspan="6" class="bg_02">
<div class="padding_w_m">

({if $c_message.image_filename_1})
<a href="({t_img_url filename=$c_message.image_filename_1})" target="_blank">
<img src="({t_img_url filename=$c_message.image_filename_1 w=120 h=120})"></a>
({/if})

({if $c_message.image_filename_2})
<a href="({t_img_url filename=$c_message.image_filename_2})" target="_blank">
<img src="({t_img_url filename=$c_message.image_filename_2 w=120 h=120})"></a>
({/if})

({if $c_message.image_filename_3})
<a href="({t_img_url filename=$c_message.image_filename_3})" target="_blank">
<img src="({t_img_url filename=$c_message.image_filename_3 w=120 h=120})"></a>
({/if})
({if $c_message.image_filename_1||$c_message.image_filename_2||$c_message.image_filename_3})
<br><br>
({/if})

({$c_message.body|t_url2a|nl2br})

</div>

</td>
</tr>
({*********})
</table>
<!-- �����܂ŁF����e -->
({*�����܂ŁFbody*})
({*��������Ffooter*})
<!-- ��������F�R�}���h�H -->
<table border="0" cellspacing="0" cellpadding="0" class="border_01" style="width: 504px;">
<tr>
<td style="width:340px;height:2em;" class="bg_03" align="left">

<div class="padding_s">

({t_form m=pc a=do_h_message_box_delete_message})
<input type="hidden" name="sessid" value="({$PHPSESSID})">
<input type="hidden" name="c_message_id[]" value=({$c_message.c_message_id})>
<input type="hidden" name="box" value="({$box})">

({if $box == 'trash'})
<input type="submit" class="submit" name="move" value="���ɖ߂�">
({/if})
<input type="submit" class="submit" name="remove" value="�� ��">

</form>

</div>

</td>
<td style="width:164px;" class="bg_03" align="right">

<div class="padding_s">

({if $box == 'inbox' || !$box })
({t_form m=pc a=page_f_message_send})
<input type="hidden" name="target_c_message_id" value="({$c_message.c_message_id})">
<input type="hidden" name="jyusin_c_message_id" value="({$jyusin_c_message_id})">
<input type="hidden" name="target_c_member_id" value="({$c_message.c_member_id_from})">
<input name="hensin2" type="submit" class="submit" value="�@�ԐM����@">
</form>
({/if})

</div>

</td>
</tr>
</table>
<!-- �����܂ŁF�R�}���h�H -->
({*�����܂ŁFfooter*})
<!-- *�����܂ŁF���b�Z�[�W�\�����������e* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******�����܂ŁF���b�Z�[�W�\����****** -->
<!-- **************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

({********************************})
({**�����܂ŁF���C���R���e���c�i�E�j**})
({********************************})
</td>
</tr>
</table>({*END:container*})
</td>
</tr>
<tr>
<td class="container inc_page_footer">
({$inc_page_footer|smarty:nodefaults})
</td>
</tr>
</table>
({ext_include file="inc_extension_pagelayout_bottom.tpl"})
</body>
</html>
