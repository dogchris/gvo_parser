<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 2018/1/2
 * Time: 20:41
 */

namespace Parser;


class QuestList extends Base
{
    private $cityList = array();

    protected $sourceDir = BASE_DIR . '/Source/QuestList/';
    protected $pageType  = 'quest_list';

    public function run()
    {
        $fileList = $this->getFileList();

        foreach ($fileList as $file) {
            $this->parseFile($file);
        }
    }

    protected function parseFile($file)
    {
        $node = $this->loadFile($file)->documentElement;
        $data = $this->parse($node);
        print_r($data);exit;
        print_r(get_class($data));
        exit;
    }

    /*
protected function getQuestList($node)
{
    $trNodes = $node->getElementsByTagName('tr');

    $questList = array();
    foreach ($trNodes as $trNode) {
        $questInfo = array();
        $spanRes = $this->parseNode($trNode, 'span');
        if (!empty($spanRes)) {
            print_r($spanRes);
        }
    }

    $questList = array();
    foreach ($trNodes as $trNode) {
        $questInfo = array();
        $spanNodes = $trNode->getElementsByTagName('span');
        foreach ($spanNodes as $spanNode) {
            $id    = $spanNode->getAttribute('id');
            $value = trim($spanNode->nodeValue);

            if (preg_match('/ctl00_CP1_G1_ctl\S+_LS(\d)/', $id, $matches)) {
                $questInfo['skill_level_' . $matches[1]] = $value;
            }
            if (preg_match('/ctl00_CP1_G1_ctl\S+_L1/', $id)) {
                $questInfo['deposit'] = str_replace(',', '', $value);
            }
            if (preg_match('/ctl00_CP1_G1_ctl\S+_L2/', $id)) {
                $questInfo['bonus'] = str_replace(',', '', $value);
            }
            if (preg_match('/ctl00_CP1_G1_ctl\S+_L3/', $id)) {
                preg_match('/限(\d+)天/', $value, $matches);
                $questInfo['time_limit'] = $matches[1];
            }
            if (preg_match('/ctl00_CP1_G1_ctl\S+_Label3/', $id)) {
                $questInfo['experience'] = str_replace(',', '', $value);
            }
            if (preg_match('/ctl00_CP1_G1_ctl\S+_Label4/', $id)) {
                $questInfo['reputation'] = str_replace(',', '', $value);
            }
            if (preg_match('/ctl00_CP1_G1_ctl\S+_Label1/', $id)) {
                $questInfo['note'] = str_replace('<br>', "\n", $value);
            }
            if (preg_match('/ctl00_CP1_G1_ctl\S+_Label2/', $id)) {
                preg_match('/(\d)★/', $value, $matches);
                $questInfo['discovery_difficulty'] = $matches[1];
            }
            if (preg_match('/ctl00_CP1_G1_ctl\S+_LabelItem/', $id)) {
                $questInfo['item'] = str_replace('<br>', "\n", $value);
            }
        }
        if (isset($questInfo['item'])) {
            print_r($questInfo);
            exit;
        }
        // if (!empty($questInfo)) {
        //     print_r($questInfo);
        //     exit;
        // }
    }
    }
    */
}