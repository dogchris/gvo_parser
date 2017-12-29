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

        foreach ($trNodes as $trNode) {
            $spanNodes     = $trNode->getElementsByTagName('span');
            $discoveryInfo = array();
            foreach ($spanNodes as $spanNode) {
                $attr  = $spanNode->getAttribute('id');
                $value = trim($spanNode->nodeValue);
                echo $value."\n";

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
            if (empty($discoveryInfo['name'])) {
                continue;
            }
            print_r($discoveryInfo);exit;
        }
    }
}