<?php

namespace Parser;

class DiscoveryList extends Base
{
    protected $sourceDir = BASE_DIR . '/Source/DiscoveryList/';

    public function run()
    {
        $fileList = $this->getFileList();

        foreach ($fileList as $file) {
            $this->parse($file);
        }
    }

    protected function parse($file)
    {
        $nodes = $this->loadFile($file)->getElementsByTagName('table');
        foreach ($nodes as $node) {
            $attr = $node->getAttribute('id');
            switch ($attr) {
                case 'ctl00_CP1_GridView發現物':
                    $discoveryList = $this->getDiscoveryList($node);
                    break;
                default:
            }
        }

        return $discoveryList;
    }

    protected function getDiscoveryList($node)
    {
        $trNodes = $node->getElementsByTagName('tr');

        $discoveryList = array();

        $questList = array();
        foreach ($trNodes as $trNode) {
            $discoveryInfo = array();

            $spanNodes = $trNode->getElementsByTagName('span');
            foreach ($spanNodes as $spanNode) {
                $attr  = $spanNode->getAttribute('id');
                $value = trim($spanNode->nodeValue);

                if (preg_match('/ctl00_CP1_GridView發現物_\S+LName/', $attr)) {
                    $discoveryInfo['name'] = $value;
                }
                if (preg_match('/ctl00_CP1_GridView發現物_\S+L1/', $attr)) {
                    preg_match('/\S+(\d)/', $value, $matches);
                    $discoveryInfo['discovery_level'] = $matches[1];
                }
                if (preg_match('/ctl00_CP1_GridView發現物_\S+Label7/', $attr)) {
                    $discoveryInfo['discovery_desc'] = $value;
                }
                if (preg_match('/ctl00_CP1_GridView發現物_\S+Label3/', $attr)) {
                    $discoveryInfo['discovery_experience'] = $value;
                }
                if (preg_match('/ctl00_CP1_GridView發現物_\S+Label8/', $attr)) {
                    $discoveryInfo['card_experience'] = $value;
                }
            }

            $tableNodes = $trNode->getElementsByTagName('table');
            foreach ($tableNodes as $tableNode) {
                $aNodes = $tableNode->getElementsByTagName('a');
                foreach ($aNodes as $aNode) {
                    $href = $aNode->getAttribute('href');
                    if (preg_match('/adv_missionDetail.aspx\?MID=(\d+)/', $href, $matches)) {
                        $questId                      = $matches[1];
                        $discoveryInfo['quest_ids'][] = $questId;

                        preg_match('/\S+-(\S+)/', $aNode->nodeValue, $matches);
                        $questList[$questId] = $matches[1];
                    }
                }
            }

            if (empty($discoveryInfo['name'])) {
                continue;
            }

        }
        print_r($questList);
        exit;
        print_r($discoveryInfo);
        exit;
    }
}