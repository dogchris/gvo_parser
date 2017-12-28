USE GVO_ADV;

CREATE TABLE IF NOT EXISTS `city` (
    `id` int(10) unsigned NOT NULL auto_increment COMMENT '自增id',
    `name_tc` varchar(50) NOT NULL DEFAULT '' COMMENT '城市描述（繁体）',
    `name_sc` varchar(50) NOT NULL DEFAULT '' COMMENT '城市描述（简体）',
    `cordinate_x` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '横坐标',
    `cordinate_y` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '纵坐标',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='城市列表' ;
