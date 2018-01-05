<?php

namespace Downloader;

class Quest
{
    public function download($questId, $forceDownload = false)
    {
        $outputFileName = "{$questId}.html";
        $filePath       = BASE_DIR . '/Source/Quest/' . $outputFileName;

        if (!file_exists($filePath) || $forceDownload) {
            $url = WEB_ROOT . "adv_missionDetail.aspx?MID={$questId}";
            echo "get file from url {$url}\n";
            $htmlContent = file_get_contents($url);
            echo "write file to {$filePath}\n";
            file_put_contents($filePath, $htmlContent);
        }

        return $filePath;
    }
}