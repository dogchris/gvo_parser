<?php

require_once 'base.php';

use Downloader\DiscoveryList;

$downloader = new DiscoveryList();
$downloader->run();
