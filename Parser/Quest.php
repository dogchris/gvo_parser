<?php

namespace Parser;

use Downloader\Quest as QuestDownloader;

class Quest extends Base
{
    protected $pageType = 'quest';

    public function run()
    {
        echo "This function can not be used in this class!";
    }

    public function parseQuest($questId)
    {
        $downloader = new QuestDownloader();
        $file       = $downloader->download($questId);
        $data       = $this->parseFile($file);
        $this->formatData($data);
    }

    /**
     * fix the bug in source file
     * @param $fileName
     * @return \DOMDocument
     */
    protected function loadFile($fileName)
    {
        $html = file_get_contents($this->sourceDir . $fileName);
        $html = $this->pre . $html;
        $html = str_replace('<br>', "\n", $html);
        $html = str_replace('</BODY>', "\n", $html);
        $html = str_replace('</HTML>', "\n", $html);
        $dom  = new \DOMDocument('1.0', 'UTF-8');
        $dom->loadHTML($html);

        return $dom;
    }

    protected function formatData($data)
    {
        print_r($data);
    }
}