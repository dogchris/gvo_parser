<?php

$baseDir = dirname(dirname(__FILE__));
$without = array(dirname(__FILE__));

$requireList = getAllPhpFiles($baseDir, $without);

foreach ($requireList as $file) {
    require_once($file);
}

function getAllPhpFiles($dir, $without = array()) {
    $list = array();
    $scanRes = scandir($dir);
    foreach ($scanRes as $k => $v) {
        if (preg_match('/^\.\S*$/', $v)) {
            unset($scanRes[$k]);
            continue;
        }
        $path = "{$dir}/$v";
        if (in_array($path, $without)) {
            continue;
        }
        if (is_dir($path)) {
            $list = array_merge($list, getAllPhpFiles($path));
        } else {
            if (preg_match('/^\S+.php$/', $v)) {
                $list[] = $path;
            }
        }
    }

    return $list;
}
