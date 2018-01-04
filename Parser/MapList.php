<?php
/**
 * Created by PhpStorm.
 * User: chenran
 * Date: 2018/1/2
 * Time: 20:41
 */

namespace Parser;

class MapList extends Base
{
    private $cityList = array();

    protected $sourceDir = BASE_DIR . '/Source/MapList/';
    protected $pageType  = 'map_list';

    protected function formatData($data)
    {

    }
}