<?php

$url = $argv[1];

if (empty($url)) {
    echo "请输入待下载的url\n";exit;
}

$html = file_get_contents($url);
echo $html;