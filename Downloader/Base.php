<?php

namespace Downloader;

abstract class Base
{
    protected $pre = "<?xml encoding='UTF-8'>";
    protected $seedFile;
    protected $dom;

    public function __construct()
    {
        $html = $this->pre . file_get_contents($this->seedFile);
        $html = str_replace('<br>', "\n", $html);

        $this->dom = new \DOMDocument('1.0', 'UTF-8');
        $this->dom->loadHTML($html);
    }
}