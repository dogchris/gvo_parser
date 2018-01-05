<?php

require_once 'base.php';

use Parser\Quest;

$questId = $argv[1] ?? '';

if (!preg_match('/^[1-9][0-9]*$/', $questId)) {
    echo "please input quest id.\n";
    exit;
}

$parser = new Quest();
$parser->parseQuest($questId);
