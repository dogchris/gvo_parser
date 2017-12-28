USE GVO_ADV;

CREATE TABLE IF NOT EXISTS `discovery_type` (
    `id` int(10) unsigned NOT NULL auto_increment COMMENT '自增id',
    `name_tc` varchar(50) NOT NULL DEFAULT '' COMMENT '发现物类型描述（繁体）',
    `name_sc` varchar(50) NOT NULL DEFAULT '' COMMENT '发现物类型描述（简体）',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='发现物类型列表' ;
