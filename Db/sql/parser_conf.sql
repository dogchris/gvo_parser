USE GVO_ADV;

CREATE TABLE IF NOT EXISTS `parser_conf` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT '自增id',
  `parent` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '父节点id',
  `page_type` varchar(127) NOT NULL DEFAULT '' COMMENT '页面类型',
  `tag_name` varchar(255) NOT NULL DEFAULT '' COMMENT '标签名称',
  `pattern` varchar(255) NOT NULL DEFAULT '' COMMENT '正则模板',
  `key` varchar(127) NOT NULL DEFAULT '' COMMENT '输出数组的key',
  `attr` varchar(127) NOT NULL DEFAULT '' COMMENT '待解析的属性名称',
  `v_type` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '值的类型，0字符串，1数组，2节点对象，3节点对象数组',
  `v_attr` varchar(127) NOT NULL DEFAULT '' COMMENT '获取值的属性名称',
  `v_filter_type` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '值的解析类型，0不处理，1正则替换，2正则匹配',
  `v_pattern` varchar(255) NOT NULL DEFAULT '' COMMENT '正则模板',
  `v_replace` varchar(255) NOT NULL DEFAULT '' COMMENT '替换值',
  `v_match_key` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '正则匹配下标',
  PRIMARY KEY (`id`),
  KEY `key_parent`(`parent`),
  UNIQUE KEY `uk_pattern` (`page_type`, `parent`, `key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='解析器配置' ;
