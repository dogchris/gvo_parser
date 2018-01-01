USE GVO_ADV;

CREATE TABLE IF NOT EXISTS `discovery` (
    `id` int(10) unsigned NOT NULL auto_increment COMMENT '自增id',
    `name_tc` varchar(255) NOT NULL DEFAULT '' COMMENT '发现物名称（繁体）',
    `name_sc` varchar(255) NOT NULL DEFAULT '' COMMENT '发现物名称（简体）',
    `type_id` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '发现物类型',
    `level` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '发现物等级',
    `experience` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '发现物经验',
    `card_type` varchar(50) NOT NULL DEFAULT '' COMMENT '卡片类型',
    `card_level` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '卡片等级',
    `card_experience` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '卡片经验',
    `quest_ids` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '对应任务id',
    `desc_tc` varchar(1023) NOT NULL DEFAULT '' COMMENT '发现物描述（繁体）',
    `desc_sc` varchar(1023) NOT NULL DEFAULT '' COMMENT '发现物描述（简体）',
    PRIMARY KEY (`id`),
    KEY `idx_type_id`(`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='发现物表';
