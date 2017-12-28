<?php

namespace Downloader;

class QuestList extends Base
{
    protected $seedFile = BASE_DIR . '/Source/QuestList/2.html';

    public function run()
    {
        $nodes = $this->dom->getElementsByTagName('table');
        foreach ($nodes as $node) {
            $attr = $node->getAttribute('id');
            if ($attr == 'ctl00_CP1_DataList1') {
                $aNodes = $node->getElementsByTagName('a');
                foreach ($aNodes as $aNode) {
                    $attr = $aNode->getAttribute('id');
                    if (preg_match('/ctl00_CP1_DataList1_\S+HyperLink1/', $attr)) {
                        $cityId = $aNode->getAttribute('title');
                        $url    = WEB_ROOT . "adv_Mission.aspx?City={$cityId}&Kind=0";

                        echo "get file from url {$url}\n";
                        $htmlContent = file_get_contents($url);
                        $outputFile  = BASE_DIR . '/Source/QuestList/' . $cityId . '.html';

                        echo "write file to {$outputFile}\n";
                        file_put_contents($outputFile, $htmlContent);
                        sleep(1);
                    }
                }
            }
        }
    }
}