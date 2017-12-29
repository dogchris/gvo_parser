<?php

namespace Parser;

abstract class Base
{
    protected $pre = "<?xml encoding='UTF-8'>";
    protected $sourceDir;

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
}