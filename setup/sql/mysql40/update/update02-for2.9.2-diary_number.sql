ALTER TABLE `c_diary_comment` ADD COLUMN `number` int(11) NOT NULL default '0';

CREATE TABLE `tmp_c_diary_comment` (
  `c_diary_comment_id` int(11) NOT NULL auto_increment,
  `number` int(11) NOT NULL default '0',
  PRIMARY KEY  (`c_diary_comment_id`)
) TYPE=MyISAM;

INSERT INTO tmp_c_diary_comment
(c_diary_comment_id,
number)
(SELECT
dc1.c_diary_comment_id,
count(*) AS number
 FROM c_diary_comment AS dc1,c_diary_comment AS dc2
WHERE dc1.c_diary_id =dc2.c_diary_id
 AND dc1.c_diary_comment_id >= dc2.c_diary_comment_id
GROUP BY dc1.c_diary_comment_id
);

UPDATE c_diary_comment AS dc1,tmp_c_diary_comment AS dc2
 SET dc1.number=dc2.number
 WHERE dc1.c_diary_comment_id = dc2.c_diary_comment_id;

DROP TABLE tmp_c_diary_comment;