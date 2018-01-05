<?php

namespace Parser;

use Downloader\Quest as QuestDownloader;

class Quest extends Base
{
    protected $pageType  = 'quest';

    public function run()
    {
        echo "This function can not be used in this class!";
    }

    public function parseQuest($questId)
    {
        $downloader = new QuestDownloader();
        $file = $downloader->download($questId);
        $data = $this->parseFile($file);
        $this->formatData($data);
    }

    protected function formatData($data)
    {
        print_r($data);
    }
}