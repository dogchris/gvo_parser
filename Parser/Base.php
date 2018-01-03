<?php

namespace Parser;

use Db\Mysql;

abstract class Base
{
    protected $pre = "<?xml encoding='UTF-8'>";
    protected $pageType;
    protected $sourceDir;

    // 值类型定义
    const VALUE_TYPE_STRING   = 0;    // 字符串
    const VALUE_TYPE_ARRAY    = 1;    // 数组
    const VALUE_TYPE_ONE_NODE = 2;    // 节点对象
    const VALUE_TYPE_NODES    = 3;    // 节点对象数组

    // 值得解析类型
    const VALUE_FILTER_TYPE_ORIGIN      = 0;    // 原始值
    const VALUE_FILTER_TYPE_REG_REPLACE = 1;    // 正则替换
    const VALUE_FILTER_TYPE_REG_MATCH   = 2;    // 正则匹配

    public function run()
    {
        $fileList = $this->getFileList();

        foreach ($fileList as $file) {
            $data = $this->parseFile($file);
            print_r($data);exit;
            $this->formatData($data);
        }
    }

    protected function formatData($data)
    {
    }

    protected function parseFile($file)
    {
        $node = $this->loadFile($file)->documentElement;
        return $data = $this->parse($node);
    }

    protected function loadFile($fileName)
    {
        $html = file_get_contents($this->sourceDir . $fileName);
        $html = $this->pre . $html;
        $html = str_replace('<br>', "\n", $html);
        $dom  = new \DOMDocument('1.0', 'UTF-8');
        $dom->loadHTML($html);

        return $dom;
    }

    protected function getFileList()
    {
        $fileList = scandir($this->sourceDir);
        $fileList = array_diff($fileList, array('.', '..'));

        return $fileList;
    }

    protected function parse(\DOMElement $node, $parent = 0)
    {
        $configs = $this->getConf($parent);

        $res = array();
        foreach ($configs as $conf) {
            $tagNodes = $node->getElementsByTagName($conf['tag_name']);
            foreach ($tagNodes as $tagNode) {
                $attr  = $tagNode->getAttribute($conf['attr']);
                $value = $conf['v_attr'] ? $tagNode->getAttribute($conf['v_attr']) : $tagNode->nodeValue;

                if (preg_match("/{$conf['pattern']}/", $attr)) {
                    switch ($conf['v_type']) {
                        case self::VALUE_TYPE_STRING:
                            $res[$conf['key']] = $this->valueFilter($value, $conf);
                            break;
                        case self::VALUE_TYPE_ARRAY:
                            $res[$conf['key']][] = $this->valueFilter($value, $conf);
                            break;
                        case self::VALUE_TYPE_ONE_NODE:
                            $childRes = $this->parse($tagNode, $conf['id']);
                            if (!empty($childRes)) {
                                $res[$conf['key']] = $childRes;
                            }
                            break;
                        case self::VALUE_TYPE_NODES:
                            $childRes = $this->parse($tagNode, $conf['id']);
                            if (!empty($childRes)) {
                                $res[$conf['key']][] = $childRes;
                            }
                            break;
                        default:
                            $res[$conf['key']] = $this->valueFilter($value, $conf);
                    }
                }
            }
        }

        return $res;
    }

    /**
     * 值过滤
     * @param       $value
     * @param array $conf
     * @return mixed|string
     */
    private function valueFilter($value, array $conf)
    {
        $value = trim($value);
        if (!$value) {
            return $value;
        }
        switch ($conf['v_filter_type']) {
            case self::VALUE_FILTER_TYPE_REG_REPLACE:
                $ret = preg_replace("/{$conf['v_pattern']}/", $conf['v_replace'], $value);
                break;
            case self::VALUE_FILTER_TYPE_REG_MATCH:
                preg_match("/{$conf['v_pattern']}/", $value, $matches);
                $ret = $matches[$conf['v_match_key']];
                break;
            case self::VALUE_FILTER_TYPE_ORIGIN:
            default:
                $ret = $value;
        }

        return $ret;
    }

    /**
     * 获取当前节点的解析配置
     * @param int $parent
     * @return array
     */
    private function getConf($parent = 0)
    {
        $mysql = new Mysql();
        $sql   = "SELECT * FROM `parser_conf` WHERE `page_type` = '{$this->pageType}' AND `parent` = {$parent}";

        return $mysql->queryAndFetchAll($sql);
    }
}