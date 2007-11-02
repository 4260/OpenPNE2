/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `c_config_color` (
  `c_config_color_id` int(11) NOT NULL auto_increment,
  `color_0` char(6) NOT NULL default '',
  `color_1` char(6) NOT NULL default '',
  `color_2` char(6) NOT NULL default '',
  `color_3` char(6) NOT NULL default '',
  `color_4` char(6) NOT NULL default '',
  `color_5` char(6) NOT NULL default '',
  `color_6` char(6) NOT NULL default '',
  `color_7` char(6) NOT NULL default '',
  `color_8` char(6) NOT NULL default '',
  `color_9` char(6) NOT NULL default '',
  `color_10` char(6) NOT NULL default '',
  `color_11` char(6) NOT NULL default '',
  `color_12` char(6) NOT NULL default '',
  `color_13` char(6) NOT NULL default '',
  `color_14` char(6) NOT NULL default '',
  `color_15` char(6) NOT NULL default '',
  `color_16` char(6) NOT NULL default '',
  `color_17` char(6) NOT NULL default '',
  `color_18` char(6) NOT NULL default '',
  `color_19` char(6) NOT NULL default '',
  `color_20` char(6) NOT NULL default '',
  `color_21` char(6) NOT NULL default '',
  `color_22` char(6) NOT NULL default '',
  `color_23` char(6) NOT NULL default '',
  `color_24` char(6) NOT NULL default '',
  `color_25` char(6) NOT NULL default '',
  `color_26` char(6) NOT NULL default '',
  `color_27` char(6) NOT NULL default '',
  `color_28` char(6) NOT NULL default '',
  `color_29` char(6) NOT NULL default '',
  `color_30` char(6) NOT NULL default '',
  `color_31` char(6) NOT NULL default '',
  `color_32` char(6) NOT NULL default '',
  `color_33` char(6) NOT NULL default '',
  `color_34` char(6) NOT NULL default '',
  `color_35` char(6) NOT NULL default '',
  `color_36` char(6) NOT NULL default '',
  `color_37` char(6) NOT NULL default '',
  `color_38` char(6) NOT NULL default '',
  `color_39` char(6) NOT NULL default '',
  `color_40` char(6) NOT NULL default '',
  `color_41` char(6) NOT NULL default '',
  `color_42` char(6) NOT NULL default '',
  `color_43` char(6) NOT NULL default '',
  `color_44` char(6) NOT NULL default '',
  `color_45` char(6) NOT NULL default '',
  `color_46` char(6) NOT NULL default '',
  `color_47` char(6) NOT NULL default '',
  `color_48` char(6) NOT NULL default '',
  `color_49` char(6) NOT NULL default '',
  `color_50` char(6) NOT NULL default '',
  `caption` char(32) NOT NULL default '',
  PRIMARY KEY  (`c_config_color_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `c_config_color_ktai` (
  `c_config_color_ktai_id` int(11) NOT NULL auto_increment,
  `color_0` char(6) NOT NULL default '',
  `color_1` char(6) NOT NULL default '',
  `color_2` char(6) NOT NULL default '',
  `color_3` char(6) NOT NULL default '',
  `color_4` char(6) NOT NULL default '',
  `color_5` char(6) NOT NULL default '',
  `color_6` char(6) NOT NULL default '',
  `color_7` char(6) NOT NULL default '',
  `color_8` char(6) NOT NULL default '',
  `color_9` char(6) NOT NULL default '',
  `color_10` char(6) NOT NULL default '',
  `color_11` char(6) NOT NULL default '',
  `color_12` char(6) NOT NULL default '',
  `color_13` char(6) NOT NULL default '',
  `color_14` char(6) NOT NULL default '',
  `color_15` char(6) NOT NULL default '',
  `color_16` char(6) NOT NULL default '',
  `color_17` char(6) NOT NULL default '',
  `color_18` char(6) NOT NULL default '',
  `color_19` char(6) NOT NULL default '',
  `color_20` char(6) NOT NULL default '',
  `color_21` char(6) NOT NULL default '',
  `color_22` char(6) NOT NULL default '',
  `color_23` char(6) NOT NULL default '',
  `color_24` char(6) NOT NULL default '',
  `color_25` char(6) NOT NULL default '',
  `color_26` char(6) NOT NULL default '',
  `color_27` char(6) NOT NULL default '',
  `color_28` char(6) NOT NULL default '',
  `color_29` char(6) NOT NULL default '',
  `color_30` char(6) NOT NULL default '',
  `color_31` char(6) NOT NULL default '',
  `color_32` char(6) NOT NULL default '',
  `color_33` char(6) NOT NULL default '',
  `color_34` char(6) NOT NULL default '',
  `color_35` char(6) NOT NULL default '',
  `color_36` char(6) NOT NULL default '',
  `color_37` char(6) NOT NULL default '',
  `color_38` char(6) NOT NULL default '',
  `color_39` char(6) NOT NULL default '',
  `color_40` char(6) NOT NULL default '',
  `color_41` char(6) NOT NULL default '',
  `color_42` char(6) NOT NULL default '',
  `color_43` char(6) NOT NULL default '',
  `color_44` char(6) NOT NULL default '',
  `color_45` char(6) NOT NULL default '',
  `color_46` char(6) NOT NULL default '',
  `color_47` char(6) NOT NULL default '',
  `color_48` char(6) NOT NULL default '',
  `color_49` char(6) NOT NULL default '',
  `color_50` char(6) NOT NULL default '',
  `caption` char(32) NOT NULL default '',
  PRIMARY KEY  (`c_config_color_ktai_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO c_config_color (color_0, color_1, color_2, color_3, color_4, color_5, color_6, color_7, color_8, color_9, color_10, color_11, color_12, color_13, color_14, color_15, color_16, color_17, color_18, caption)
 SELECT symbol, border_01, border_07, border_10, bg_00, bg_01, bg_02, bg_03, bg_04, bg_05, bg_06, bg_07, bg_08, bg_09, bg_10, bg_11, bg_12, bg_13, bg_14, caption
   FROM c_sns_config ORDER BY c_sns_config_id;

INSERT INTO c_config_color_ktai (c_config_color_ktai_id, color_0, color_1, color_2, color_3, color_4, color_5, color_6, color_7, color_8, color_9, color_10, color_11, color_12, color_13, color_14, color_15, color_16, color_17, color_18, color_19, color_20, color_21, color_22, caption)
 SELECT 1, 'FFFFFF', bg_01, bg_02, bg_03, bg_04, bg_05, bg_06, bg_07, bg_08, bg_09, bg_10, border_01, border_02, border_03, font_01, font_02, font_03, font_04, font_05, font_06, font_07, font_08, font_09, '現在の設定'
   FROM c_sns_config_ktai WHERE key_name = 'current';

INSERT INTO c_config_color_ktai (color_0, color_1, color_2, color_3, color_4, color_5, color_6, color_7, color_8, color_9, color_10, color_11, color_12, color_13, color_14, color_15, color_16, color_17, color_18, color_19, color_20, color_21, color_22, caption)
 SELECT bg_02, bg_01, bg_02, bg_03, bg_04, bg_05, bg_06, bg_07, bg_08, bg_09, bg_10, border_01, border_02, border_03, font_01, font_02, font_03, font_04, font_05, font_06, font_07, font_08, font_09, 'デフォルト'
   FROM c_sns_config_ktai WHERE key_name <> 'current';

DROP TABLE IF EXISTS `c_sns_config`;
DROP TABLE IF EXISTS `c_sns_config_ktai`;
