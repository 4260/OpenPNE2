({strip})
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<title>({$title})</title>
({if $is_softbank})
<style type="text/css">
*{font-size:small;}
</style>
({elseif $is_au})
<style type="text/css">
*{font-size:xx-small;}
</style>
({/if})
({$inc_ktai_html_head|smarty:nodefaults})
</head>
<body text="#({$ktai_color_config.font_01})" bgcolor="#({$ktai_color_config.bg_01})" link="#({$ktai_color_config.font_02})" alink="#({$ktai_color_config.font_03})" vlink="#({$ktai_color_config.font_04})">
({/strip})
({$inc_ktai_header|smarty:nodefaults})
