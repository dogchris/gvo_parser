<?php

namespace Downloader;

class DiscoveryList extends Base
{
    protected $seedFile = BASE_DIR . '/Source/DiscoveryList/1.html';

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
                        $href = $aNode->getAttribute('href');
                        preg_match('/Adv_Discover\.aspx\?Type=(\d+)/', $href, $matches);
                        $outputFileName = "{$matches[1]}.html";
                        $url            = WEB_ROOT . $href;

                        echo "get file from url {$url}\n";
                        $htmlContent = file_get_contents($url);
                        $outputFile  = BASE_DIR . '/Source/DiscoveryList/' . $outputFileName;
                        echo "write file to {$outputFile}\n";
                        file_put_contents($outputFile, $htmlContent);

                        sleep(1);
                    }
                }
            }
        }
    }
}