({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSNSConfig.tpl"})

({assign var="page_name" value="SNS設定"})
({ext_include file="inc_tree_adminSNSConfig.tpl"})
</div>

({*ここまで:navi*})

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2>SNS設定</h2>
<div class="contents">
<p class="caution" id="c01">※「設定変更する」ボタンを押すと設定が反映されます</p>
<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('update_c_admin_config','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<table class="basicType2">
<tr class="cell01">
<th colspan="2">SNS名</th>
<td><input class="basic" name="SNS_NAME" type="text" value="({$smarty.const.SNS_NAME})" size="30" /></td>
</tr>
<tr class="cell02">
<th colspan="2">ページタイトル</th>
<td>
<span class="info">HTMLのtitle要素の内容になります</span><br />
<input class="basic" name="SNS_TITLE" type="text" value="({$smarty.const.SNS_TITLE})" size="30" /><br />
<span class="caution">※省略時はSNS名が使用されます</span>
</td>
</tr>
<tr class="cell03">
<th colspan="2">管理用メールアドレス</th>
<td>
<span class="info">ユーザに送られるメールのFromに設定されます</span><br />
<input class="basic" name="ADMIN_EMAIL" type="text" value="({$smarty.const.ADMIN_EMAIL})" size="40" /></td>
</tr>
<tr class="cell04">
<th colspan="2">招待制/オープン制</th>
<td>
<input class="basicRadio" name="IS_CLOSED_SNS" id="IS_CLOSED_SNS_1" type="radio" value="1"({if $smarty.const.IS_CLOSED_SNS}) checked="checked"({/if}) /><label for="IS_CLOSED_SNS_1">招待制</label>　<span class="caution">（※参加者の招待がなければ登録できません）</span><br />
<input class="basicRadio" name="IS_CLOSED_SNS" id="IS_CLOSED_SNS_0" type="radio" value="0"({if !$smarty.const.IS_CLOSED_SNS}) checked="checked"({/if}) /><label for="IS_CLOSED_SNS_0">オープン制</label>　<span class="caution">（※参加者の招待なしでも登録できます）</span>
</td>
</tr>
<tr class="cell05">
<th colspan="2">ユーザ招待可否</th>
<td>
<select class="basic" name="IS_USER_INVITE">
<option value="1"({if $smarty.const.IS_USER_INVITE}) selected="selected"({/if})>招待可にする</option>
<option value="0"({if !$smarty.const.IS_USER_INVITE}) selected="selected"({/if})>招待不可にする</option>
</select>
</td>
</tr>
<tr class="cell06">
<th colspan="2">PC版使用設定</th>
<td>
<select class="basic" name="OPENPNE_ENABLE_PC">
<option value="1"({if $smarty.const.OPENPNE_ENABLE_PC}) selected="selected"({/if})>使用可にする</option>
<option value="0"({if !$smarty.const.OPENPNE_ENABLE_PC}) selected="selected"({/if})>使用不可にする</option>
</select><br />
<span class="caution">※使用不可にするとPCで表示できなくなります</span>
</td>
</tr>
<tr class="cell07">
<th colspan="2">携帯版使用設定</th>
<td>
<select class="basic" name="OPENPNE_ENABLE_KTAI">
<option value="1"({if $smarty.const.OPENPNE_ENABLE_KTAI}) selected="selected"({/if})>使用可にする</option>
<option value="0"({if !$smarty.const.OPENPNE_ENABLE_KTAI}) selected="selected"({/if})>使用不可にする</option>
</select><br />
<span class="caution">※使用不可にすると携帯で表示できなくなります</span>
</td>
</tr>
<tr class="cell08">
<th colspan="2">登録の可否</th>
<td>
<input class="basicRadio" name="OPENPNE_REGIST_FROM" id="OPENPNE_REGIST_FROM_PCKTAI" type="radio" value="({$smarty.const.OPENPNE_REGIST_FROM_PCKTAI})"({if $smarty.const.OPENPNE_REGIST_FROM == $smarty.const.OPENPNE_REGIST_FROM_PCKTAI}) checked="checked"({/if}) /><label for="OPENPNE_REGIST_FROM_PCKTAI">PC・携帯両方から登録可</label><br />
<input class="basicRadio" name="OPENPNE_REGIST_FROM" id="OPENPNE_REGIST_FROM_PC" type="radio" value="({$smarty.const.OPENPNE_REGIST_FROM_PC})"({if $smarty.const.OPENPNE_REGIST_FROM == $smarty.const.OPENPNE_REGIST_FROM_PC}) checked="checked"({/if}) /><label for="OPENPNE_REGIST_FROM_PC">PCからのみ登録可</label><br />
<input class="basicRadio" name="OPENPNE_REGIST_FROM" id="OPENPNE_REGIST_FROM_KTAI" type="radio" value="({$smarty.const.OPENPNE_REGIST_FROM_KTAI})"({if $smarty.const.OPENPNE_REGIST_FROM == $smarty.const.OPENPNE_REGIST_FROM_KTAI}) checked="checked"({/if}) /><label for="OPENPNE_REGIST_FROM_KTAI">携帯からのみ登録可</label><br />
<input class="basicRadio" name="OPENPNE_REGIST_FROM" id="OPENPNE_REGIST_FROM_NONE" type="radio" value="({$smarty.const.OPENPNE_REGIST_FROM_NONE})"({if $smarty.const.OPENPNE_REGIST_FROM == $smarty.const.OPENPNE_REGIST_FROM_NONE}) checked="checked"({/if}) /><label for="OPENPNE_REGIST_FROM_NONE">登録一時停止</label><span class="caution">※停止にすると新規入会を受け付けなくなります</span>
</td>
</tr>
<tr class="cell27">
<th colspan="2">端末IDの取得設定</th>
<td>
<input class="basicRadio" name="IS_GET_EASY_ACCESS_ID" id="IS_GET_EASY_ACCESS_ID_2" type="radio" value="2"({if $smarty.const.IS_GET_EASY_ACCESS_ID == 2}) checked="checked"({/if}) /><label for="IS_GET_EASY_ACCESS_ID_2">携帯登録時に端末IDを取得する(必須)</label><br />
<input class="basicRadio" name="IS_GET_EASY_ACCESS_ID" id="IS_GET_EASY_ACCESS_ID_1" type="radio" value="1"({if $smarty.const.IS_GET_EASY_ACCESS_ID == 1}) checked="checked"({/if}) /><label for="IS_GET_EASY_ACCESS_ID_1">携帯登録時に端末IDを取得する(任意)</label><br />
<input class="basicRadio" name="IS_GET_EASY_ACCESS_ID" id="IS_GET_EASY_ACCESS_ID_0" type="radio" value="0"({if $smarty.const.IS_GET_EASY_ACCESS_ID == 0}) checked="checked"({/if}) /><label for="IS_GET_EASY_ACCESS_ID_0">携帯登録時に端末IDを取得しない</label>
</td>
</tr>
<tr class="cell09">
<th colspan="2">AmazonアソシエイトID</th>
<td><input class="basic" name="AMAZON_AFFID" type="text" value="({$smarty.const.AMAZON_AFFID})" size="30" /><br /><span class="caution">※空にするとレビュー機能が正常に動作しません</span></td>
</tr>
<tr class="cell10">
<th colspan="2">外部ログインページURL</th>
<td>
<span class="info">ログアウトした場合やログインに失敗した場合、ここで指定したURLに遷移します</span><br />
<input class="basic" name="LOGIN_URL_PC" type="text" value="({$smarty.const.LOGIN_URL_PC})" size="50" /><br />
<span class="caution">※ここで指定するページには<a href="#form">ログインフォーム</a>を置いておく必要があります</span><br />
<span class="caution">※通常のログインページを使用する場合は空欄にしておきます</span></td>
</tr>
<tr class="cell11">
<th colspan="2">通常ログインページ表示設定</th>
<td>
<span class="info">外部ログインページURLを指定している場合に、通常のログインページを表示するかどうかを設定します</span><br />
<select class="basic" name="DISPLAY_LOGIN">
<option value="1"({if $smarty.const.DISPLAY_LOGIN}) selected="selected"({/if})>通常のログインページも表示する</option>
<option value="0"({if !$smarty.const.DISPLAY_LOGIN}) selected="selected"({/if})>外部ログインページへリダイレクトする</option>
</select></td>
</tr>
<tr class="cell12">
<th colspan="2">PC版ホーム週間スケジュール</th>
<td><select class="basic" name="DISPLAY_SCHEDULE_HOME">
<option value="1"({if $smarty.const.DISPLAY_SCHEDULE_HOME}) selected="selected"({/if})>表示する</option>
<option value="0"({if !$smarty.const.DISPLAY_SCHEDULE_HOME}) selected="selected"({/if})>表示しない</option>
</select></td>
</tr>
<tr class="cell13">
<th colspan="2">PC版ホーム検索バー</th>
<td><select class="basic" name="DISPLAY_SEARCH_HOME">
<option value="1"({if $smarty.const.DISPLAY_SEARCH_HOME}) selected="selected"({/if})>表示する</option>
<option value="0"({if !$smarty.const.DISPLAY_SEARCH_HOME}) selected="selected"({/if})>表示しない</option>
</select></td>
</tr>
<tr class="cell14">
<th colspan="2">Flashリスト表示</th>
<td><select class="basic" name="OPENPNE_USE_FLASH_LIST">
<option value="1"({if $smarty.const.OPENPNE_USE_FLASH_LIST}) selected="selected"({/if})>Flash版</option>
<option value="0"({if !$smarty.const.OPENPNE_USE_FLASH_LIST}) selected="selected"({/if})>通常HTML版</option>
</select></td>
</tr>
<tr class="cell15">
<th colspan="2">メニューロールオーバー</th>
<td><select class="basic" name="OPENPNE_ENABLE_ROLLOVER">
<option value="1"({if $smarty.const.OPENPNE_ENABLE_ROLLOVER}) selected="selected"({/if})>使用する</option>
<option value="0"({if !$smarty.const.OPENPNE_ENABLE_ROLLOVER}) selected="selected"({/if})>使用しない</option>
</select></td>
</tr>
<tr class="cell16">
<th colspan="2">デイリーニュース受信頻度の設定</th>
<td>
<span class="info">「毎日」「受信しない」以外の選択肢に設定したときの受信頻度を設定します</span><br />
<input class="basicRadio" name="DAILY_NEWS_DAY[]" id="DAILY_NEWS_DAY_mon" type="checkbox" value="月"({if in_array("月", $DAILY_NEWS_DAY)}) checked="checked"({/if}) /><label for="DAILY_NEWS_DAY_mon">月</label>&nbsp;
<input class="basicRadio" name="DAILY_NEWS_DAY[]" id="DAILY_NEWS_DAY_tue" type="checkbox" value="火"({if in_array("火", $DAILY_NEWS_DAY)}) checked="checked"({/if}) /><label for="DAILY_NEWS_DAY_tue">火</label>&nbsp;
<input class="basicRadio" name="DAILY_NEWS_DAY[]" id="DAILY_NEWS_DAY_wed" type="checkbox" value="水"({if in_array("水", $DAILY_NEWS_DAY)}) checked="checked"({/if}) /><label for="DAILY_NEWS_DAY_wed">水</label>&nbsp;
<input class="basicRadio" name="DAILY_NEWS_DAY[]" id="DAILY_NEWS_DAY_thu" type="checkbox" value="木"({if in_array("木", $DAILY_NEWS_DAY)}) checked="checked"({/if}) /><label for="DAILY_NEWS_DAY_thu">木</label>&nbsp;
<input class="basicRadio" name="DAILY_NEWS_DAY[]" id="DAILY_NEWS_DAY_fri" type="checkbox" value="金"({if in_array("金", $DAILY_NEWS_DAY)}) checked="checked"({/if}) /><label for="DAILY_NEWS_DAY_fri">金</label>&nbsp;
<input class="basicRadio" name="DAILY_NEWS_DAY[]" id="DAILY_NEWS_DAY_sat" type="checkbox" value="土"({if in_array("土", $DAILY_NEWS_DAY)}) checked="checked"({/if}) /><label for="DAILY_NEWS_DAY_sat">土</label>&nbsp;
<input class="basicRadio" name="DAILY_NEWS_DAY[]" id="DAILY_NEWS_DAY_sun" type="checkbox" value="日"({if in_array("日", $DAILY_NEWS_DAY)}) checked="checked"({/if}) /><label for="DAILY_NEWS_DAY_sun">日</label>
</td>
</tr>
<tr class="cell17">
<th colspan="2">お気に入りフィード使用設定</th>
<td>
<span class="info">お気に入りに登録しているメンバーの最新情報をPC版ホームに表示するかどうかを設定します</span><br />
<select class="basic" name="USE_BOOKMARK_FEED">
<option value="1"({if $smarty.const.USE_BOOKMARK_FEED}) selected="selected"({/if})>使用する</option>
<option value="0"({if !$smarty.const.USE_BOOKMARK_FEED}) selected="selected"({/if})>使用しない</option>
</select></td>
</tr>
<tr class="cell18">
<th colspan="2">忍び足機能使用設定</th>
<td>
<span class="info">忍び足機能(ユーザによるあしあとを残すかどうかの設定)を有効にするかどうかを設定します</span><br />
<select class="basic" name="USE_SHINOBIASHI">
<option value="1"({if $smarty.const.USE_SHINOBIASHI}) selected="selected"({/if})>使用する</option>
<option value="0"({if !$smarty.const.USE_SHINOBIASHI}) selected="selected"({/if})>使用しない</option>
</select></td>
</tr>
<tr class="cell19">
<th colspan="2">日記カテゴリ機能使用設定</th>
<td>
<span class="info">※日記のカテゴリ機能を有効にするかどうかを設定します</span><br />
<select class="basic" name="USE_DIARY_CATEGORY">
<option value="1"({if $smarty.const.USE_DIARY_CATEGORY}) selected="selected"({/if})>使用する</option>
<option value="0"({if !$smarty.const.USE_DIARY_CATEGORY}) selected="selected"({/if})>使用しない</option>
</select></td>
</tr>

<tr class="cell20">
<th colspan="2">cmdタグ使用設定</th>
<td>
<span class="info">独自タグ cmd をユーザが使えるようにするかどうかを設定します</span><br />
<select class="basic" name="OPENPNE_USE_CMD_TAG">
<option value="1"({if $smarty.const.OPENPNE_USE_CMD_TAG}) selected="selected"({/if})>使用する</option>
<option value="0"({if !$smarty.const.OPENPNE_USE_CMD_TAG}) selected="selected"({/if})>使用しない</option>
</select></td>
</tr>
<tr class="cell28">
<th colspan="2">ポイント表示設定</th>
<td>
<span class="info">ポイントをh_home等に表示するかどうかを設定します</span><br />
<select class="basic" name="OPENPNE_DISP_POINT">
<option value="1"({if $smarty.const.OPENPNE_DISP_POINT}) selected="selected"({/if})>表示する</option>
<option value="0"({if !$smarty.const.OPENPNE_DISP_POINT}) selected="selected"({/if})>表示しない</option>
</select></td>
</tr>
<tr class="cell29">
<th colspan="2">ランク表示設定</th>
<td>
<span class="info">ランクをh_home等に表示するかどうかを設定します</span><br />
<select class="basic" name="OPENPNE_DISP_RANK">
<option value="1"({if $smarty.const.OPENPNE_DISP_RANK}) selected="selected"({/if})>表示する</option>
<option value="0"({if !$smarty.const.OPENPNE_DISP_RANK}) selected="selected"({/if})>表示しない</option>
</select></td>
</tr>
<tr class="cell21">
<th colspan="2">ログイン制限</th>
<td>
<input class="basicRadio" name="LOGIN_CHECK_ENABLE" type="radio" value="0"({if !$smarty.const.LOGIN_CHECK_ENABLE}) checked="checked"({/if}) />制限しない<br />
<input class="basicRadio" name="LOGIN_CHECK_ENABLE" type="radio" value="1"({if $smarty.const.LOGIN_CHECK_ENABLE}) checked="checked"({/if}) />制限する<br />
<input class="basic" name="LOGIN_CHECK_TIME" type="text" value="({$smarty.const.LOGIN_CHECK_TIME})" size="5" />分間に
<input class="basic" name="LOGIN_CHECK_NUM" type="text" value="({$smarty.const.LOGIN_CHECK_NUM})" size="8" />回ログインに失敗したら
<input class="basic" name="LOGIN_REJECT_TIME" type="text" value="({$smarty.const.LOGIN_REJECT_TIME})" size="5" />分間同一IPからのログインを制限する
</td>
</tr>
<tr class="cell22A">
<th rowspan="3">メール</th>
<th>キャッチコピー</th>
<td>
<span class="info">SNSメンバーに送られるメールの署名に使用します</span><br />
<input class="basic" name="CATCH_COPY" type="text" value="({$smarty.const.CATCH_COPY})" size="30" />
</td>
</tr>
<tr class="cell22B">
<th>運営会社</th>
<td>
<span class="info">SNSメンバーに送られるメールの署名に使用します</span><br />
<input class="basic" name="OPERATION_COMPANY" type="text" value="({$smarty.const.OPERATION_COMPANY})" size="30" /></td>
</tr>
<tr class="cell22C">
<th>Copyright</th>
<td>
<span class="info">SNSメンバーに送られるメールの署名に使用します</span><br />
<input class="basic" name="COPYRIGHT" type="text" value="({$smarty.const.COPYRIGHT})" size="30" /></td>
</tr>
<tr class="cell23A">
<th rowspan="4">フレンド名称</th>
<th>フレンド</th>
<td>
<span class="info">SNS内「フレンド」を他の名称に設定します</span><br />
<input class="basic" name="WORD_FRIEND" type="text" value="({$smarty.const.WORD_FRIEND})" size="30" />
</td>
</tr>
<tr class="cell23B">
<th>マイフレンド</th>
<td>
<span class="info">SNS内「フレンド」を他の名称に設定します</span><br />
<input class="basic" name="WORD_MY_FRIEND" type="text" value="({$smarty.const.WORD_MY_FRIEND})" size="30" />
</td>
</tr>
<tr class="cell23C">
<th>ﾌﾚﾝﾄﾞ(携帯)</th>
<td>
<span class="info">SNS内「フレンド」を他の名称に設定します</span><br />
<input class="basic" name="WORD_FRIEND_HALF" type="text" value="({$smarty.const.WORD_FRIEND_HALF})" size="30" />
</td>
</tr>
<tr class="cell23D">
<th>ﾏｲﾌﾚﾝﾄﾞ(携帯)</th>
<td>
<span class="info">SNS内「フレンド」を他の名称に設定します</span><br />
<input class="basic" name="WORD_MY_FRIEND_HALF" type="text" value="({$smarty.const.WORD_MY_FRIEND_HALF})" size="30" />
</td>
</tr>
<tr class="cell24">
<th colspan="2">アフィリエイト用タグ</th>
<td>
<span class="info">PC版登録完了ページに挿入されます</span><br />
<textarea class="basic" name="AFFILIATE_TAG" cols="60" rows="3">({$smarty.const.AFFILIATE_TAG})</textarea>
<dl class="caution">
	({literal})
	<dt>【記入例】</dt>
	<dd>&lt;img src="https://px.a8.net/cgi-bin/a8fly/sales?pid=s0001&amp;so=<strong>({$ID})</strong>&amp;si=000.000.A8&amp;ts=<strong>({$DATETIME})</strong>"&nbsp;width="1" height="1"&gt;</dd>
	<dt>【タグ内で利用可能な変数】</dt>
	<dd>({$ID})：メンバーID<br />({$DATETIME})：日時（YYYYMMDDHHMMSS形式）</dd>
	({/literal})
</dl>
</td>
</tr>
<tr class="cell25">
<th colspan="2">Yahoo天気／Googleの使用欄</th>
<td>
<span class="info">外部サービスを使用するかどうかを設定します</span><br />
<select class="basic" name="USE_EXTRA_SERVICE">
<option value="1"({if $smarty.const.USE_EXTRA_SERVICE}) selected="selected"({/if})>使用する</option>
<option value="0"({if !$smarty.const.USE_EXTRA_SERVICE}) selected="selected"({/if})>使用しない</option>
</select></td>
</tr>
<tr class="cell26">
<th colspan="2">BIZ使用設定</th>
<td>
<span class="info">BIZを使用するかどうかを設定します</span><br />
<select class="basic" name="USE_BIZ_DIR">
<option value="1"({if $smarty.const.USE_BIZ_DIR}) selected="selected"({/if})>使用する</option>
<option value="0"({if !$smarty.const.USE_BIZ_DIR}) selected="selected"({/if})>使用しない</option>
</select></td>
</tr>

<tr class="cell28">
<th colspan="2">退会者のデータ</th>
<td>
<span class="info">退会者のデータを管理者のメールアドレスに転送するかどうかを設定します</span><br />
<select class="basic" name="SEND_USER_DATA">
<option value="1"({if $smarty.const.SEND_USER_DATA}) selected="selected"({/if})>転送する</option>
<option value="0"({if !$smarty.const.SEND_USER_DATA}) selected="selected"({/if})>転送しない</option>
</select></td>
</tr>

</table>
<p class="textBtn"><input type="submit" value="設定変更する"></p>
</form>
</div>({*/div class="contents"*})

<h2 id="ttl02"><a name="form">外部ログインフォーム用HTML</a></h2>
<div class="contents">
<p class="info">通常のログインページ以外の外部ログインページを設定する場合は、以下のHTMLを使ってログイン用フォームを作成してください。</p>
({capture name=html_form})
<form action="({$smarty.const.OPENPNE_URL})" method="post">
<input type="hidden" name="m" value="pc" />
<input type="hidden" name="a" value="do_o_login" />
<dl class="sampleHtml">
<dt><label for="username"><strong class="item">メールアドレス</strong></label></dt>
<dd><input type="text" name="username" id="username" value="" tabindex="1"></dd>
<dt><label for="password"><strong class="item">パスワード</strong></label></dt>
<dd><input type="password" name="password" id="password" tabindex="2"></dd>
<dd><input type="checkbox" name="is_save" id="is_save" value="1" tabindex="3"><label for="is_save">次回から自動的にログイン</label></dd>
<dd><input type="submit" value="ログイン" tabindex="4"></dd>
</dl>
</form>
({/capture})

<dl class="sampleHtml">
<dt><strong class="item">ログインフォーム</strong></dt>
<dd><textarea cols="84" rows="14" readonly="readonly">({$smarty.capture.html_form})</textarea></dd>
</dl>

({capture name=html_password})
<a href="({t_url _html=0 _absolute=1 m=pc a=page_o_password_query})">パスワードを忘れた方はこちらへ</a>({/capture})

<dl class="sampleHtml">
<dt><strong class="item">パスワード再発行ページへのリンク</strong></dt>
<dd><textarea cols="84" rows="3" readonly="readonly">({$smarty.capture.html_password})</textarea></dd>
</dl>

({if !$smarty.const.IS_CLOSED_SNS})
({capture name=html_regist})
<a href="({t_url _html=0 _absolute=1 m=pc a=page_o_public_invite})">新規登録</a>({/capture})

<dl class="sampleHtml">
<dt><strong class="item">新規登録ページへのリンク</strong></dt>
<dd><textarea cols="84" rows="3" readonly="readonly">({$smarty.capture.html_regist})</textarea></dd>
</dl>

({/if})
({$inc_footer|smarty:nodefaults})
