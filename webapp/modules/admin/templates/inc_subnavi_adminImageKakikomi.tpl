<div class="subNavi">
({strip})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_image')})">アップロード画像リスト</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_image')})">画像アップロード・削除</a>&nbsp;|&nbsp;
({if $smarty.const.OPENPNE_USE_FILEUPLOAD})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_file')})">アップロードファイルリスト</a>&nbsp;|&nbsp;
({/if})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('diary_list')})">日記管理</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('diary_comment_list')})">日記コメント管理</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('commu_list')})">コミュニティ管理</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('topic_list')})">トピック・イベント管理</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('topic_comment_list')})">トピック・イベントのコメント管理</a>&nbsp;|&nbsp;
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('review_list')})">レビュー管理</a>&nbsp;|&nbsp;
({/strip})
</div>
