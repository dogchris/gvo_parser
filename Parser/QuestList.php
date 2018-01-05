<?php

namespace Parser;

class QuestList extends Base
{
    private $cityList = array();

    protected $sourceDir = BASE_DIR . '/Source/QuestList/';
    protected $pageType  = 'quest_list';

    protected function formatData($data)
    {

    }
}