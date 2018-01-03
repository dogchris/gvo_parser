<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 2018/1/2
 * Time: 20:41
 */

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