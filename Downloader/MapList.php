<?php

namespace Downloader;

class MapList extends Base
{
    protected $seedFile = BASE_DIR . '/Source/MapList/2.html';

    public function run()
    {
        $nodes = $this->dom->getElementsByTagName('table');
        foreach ($nodes as $node) {
            $attr = $node->getAttribute('id');
            if ($attr == 'ctl00_CP1_DataList1') {
                $aNodes = $node->getElementsByTagName('a');
                foreach ($aNodes as $aNode) {
                    $attr = $aNode->getAttribute('id');
                    if (preg_match('/ctl00_CP1_DataList1_ctl\d+_HyperLink1/', $attr)) {
                        $url = $aNode->getAttribute('href');
                        preg_match('/Adv_Library\.aspx\?city=(\d+)/', $url, $matches);
                        $cityId = $matches[1];
                        $url    = WEB_ROOT . $url;

                        echo "get file from url {$url}\n";
                        $htmlContent = file_get_contents($url);
                        $outputFile  = BASE_DIR . '/Source/MapList/' . $cityId . '.html';

                        echo "write file to {$outputFile}\n";
                        file_put_contents($outputFile, $htmlContent);
                        sleep(1);
                    }
                }
            }
        }
    }
}