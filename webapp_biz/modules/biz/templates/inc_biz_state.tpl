<!-- ********************************** -->
<!-- ******ここから：名前変更****** -->
({t_form m=biz a=do_h_home_edit_nickname})
<input type="hidden" name="sessid" value="({$PHPSESSID})">
({if $is_form})
<input type="text" class="text" name="nickname" value="({$c_member.nickname})" style="width:112px;text-align:center;">
<img src="./skin/dummy.gif" alt="dummy" class="v_spacer_s">
<input type="submit" class="submit" value="　名前変更　" style="width:112px;">
({/if})
</form>
<!-- ******ここまで：名前変更****** -->
<!-- ********************************** -->