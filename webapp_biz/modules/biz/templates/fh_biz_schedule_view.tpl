({ext_include file="inc_header.tpl" INC_HEADER_is_no_alert=true})
({ext_include file="inc_layoutcolumn_top_720px.tpl"})
({***************************})
({**��������F���C���R���e���c**})
({***************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ********************************** -->
<!-- ******��������F�\���ҏW����****** -->

<table border="0" cellspacing="0" cellpadding="0" style="width:640px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:626px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="center">
<!-- *��������F�\���ҏW���遄���e* -->
({*��������Fheader*})
<!-- ��������F���^�C�g�� -->
<table border="0" cellspacing="0" cellpadding="0" style="width:626px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="./skin/content_header_1.gif" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:588px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">�\��̏ڍ�</span></td>
</tr>
</table>
<!-- �����܂ŁF���^�C�g�� -->
({*�����܂ŁFheader*})
({*��������Fbody*})
<!-- ��������F����e -->
<!-- ��������F����e�����\��\�� -->
<table border="0" cellspacing="0" cellpadding="0" style="width:626px;" class="border_01">
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:120px;" class="bg_05" align="center" valign="middle">

<div style="padding:4px 3px;">

�^�C�g��

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:501px;" class="bg_02" align="left" valign="middle">

<div style="padding:4px 3px;">

({$schedule.title})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

����

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

({if $schedule.rep_type_loc})
	���T ({$schedule.rep_type_loc})�j��
({else})
	({$schedule.begin_date})
({/if})

({$schedule.begin_time}) ({if $schedule.begin_time})�`({/if})

({if $schedule.begin_date != $schedule.finish_date})
	({$schedule.finish_date})
({/if})

({$schedule.finish_time}) 

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({if $schedule.rep_first})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

�J�n��

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

({$repeat_begin_date|date_format:"%Y�N%m��%d��"})

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

����

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

({$repeat_term})�T��

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/if})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

���e

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

({$schedule.value|nl2br})

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">
�o�^��
</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">
	<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$schedule.c_member_id})">({$schedule.writer_name})</a>	<br>
</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">
({if $schedule.biz_group_id})
�O���[�v
({else})
�Q����
({/if})
</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">
({if $schedule.biz_group_id})
	<a href="({t_url m=biz a=page_g_home})&amp;target_c_commu_id=({$schedule.biz_group_id})">({$schedule.biz_group_name})</a><br>
({elseif $target_c_member_id})
	<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_c_member_id})">({$schedule.target_c_member_nickname})</a>	<br>
({else})
	<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$schedule.c_member_id})">({$schedule.writer_name})</a>	<br>
({/if})
</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

�Q����
</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">
({if $schedule.public_flag == "public"})
�S���Ɍ��J
({elseif $schedule.public_flag == "group"})
�O���[�v�܂Ō��J
({elseif $schedule.public_flag == "private"})
���J���Ȃ�
({/if})
</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

���J�͈�

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

({if $schedule.public_flag == 'private'})
�Q���҂݂̂Ɍ��J
({else})
�S�̂Ɍ��J
({/if})

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="center" colspan="3">

<img src="./skin/dummy.gif" class="v_spacer_m">

<table border="0" cellspacing="0" cellpadding="0">
<tr>

<td class="padding_ss" align="left">

({t_form _method=get m=biz a=page_fh_biz_schedule_calendar})
<input type="hidden" name="target_id" value="({$target_c_member_id})">
<input type="hidden" name="year" value="({$schedule.begin_date|date_format:'%Y'})">
<input type="hidden" name="month" value="({$schedule.begin_date|date_format:'%m'})">
<input value="���ԃJ�����_�[��\������" type="submit" class="submit">
</form>

</td>

<td class="padding_ss" align="center">

({t_form m=biz a=page_fh_biz_schedule_edit})
<input type="hidden" name="rep_type" value="({$schedule.rep_type})">
<input type="hidden" name="begin_date" value="({$schedule.begin_date})">
<input type="hidden" name="begin_time" value="({$schedule.begin_time})">
<input type="hidden" name="finish_date" value="({$schedule.finish_date})">
<input type="hidden" name="finish_time" value="({$schedule.finish_time})">
<input type="hidden" name="title" value="({$schedule.title})">
<input type="hidden" name="value" value="({$schedule.value})">
<input type="hidden" name="members" value="({$jmembers_enc})">
<input type="hidden" name="schedule_id" value="({$schedule_id})">
<input type="hidden" name="target_id" value="({$target_c_member_id})">

<input value="�C������" type="submit" class="submit">
</form>

</td>

<td class="padding_ss" align="left">

({t_form m=biz a=page_h_biz_schedule_delete})
<input type="hidden" name="sessid" value="({$PHPSESSID})">
<input type="hidden" name="schedule_id" value="({$schedule_id})">
<input value="�폜����" type="submit" class="submit">

</td>
</tr>
({if $schedule.rep_first})
<tr>
<td class="padding_ss" align="center" colspan="2">

<input value="1" type="checkbox" name="is_rep" checked class="no_bg">�ق��̌J��Ԃ��\����ꏏ�ɍ폜����

</td>
</tr>
({/if})
</form>
</table>

<img src="./skin/dummy.gif" class="v_spacer_m">

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- �����܂ŁF����e�����\��\�� -->
<!-- �����܂ŁF����e -->
({*�����܂ŁFbody*})
({*��������Ffooter*})
<!-- ���� -->
({*�����܂ŁFfooter*})
<!-- *�����܂ŁF�\���ҏW���遄�����e* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>

<!--/form-->
<!-- ******�����܂ŁF�\���ҏW����****** -->
<!-- ********************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

({***************************})
({**�����܂ŁF���C���R���e���c**})
({***************************})
({ext_include file="inc_layoutcolumn_bottom_270px_165px_175px_720px.tpl"})
({ext_include file="inc_footer.tpl"})
