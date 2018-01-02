<?php

namespace Lib;

use Db\Mdb;
use Db\Mysql;

class City
{
    private $table = 'city';

    public function initCity()
    {
        $mdb = new Mdb();
        $sql = 'select ID, "中文", "繁体" from city';
        $res = $mdb->query($sql);

        $mysql = new Mysql();
        foreach ($res as $row) {
            $insert = array(
                'id'      => $row['ID'],
                'name_tc' => $row['繁体'],
                'name_sc' => $row['中文'],
            );
            $mysql->insertBySetList($insert, $this->table);
        }
    }

    public function initCord()
    {
        $mdb = new Mdb();
        $sql = 'select ID, "坐标" from city';
        $res = $mdb->query($sql);

        $mysql = new Mysql();
        foreach ($res as $row) {
            $coordinateArr = explode(',', $row['坐标']);

            $update = array(
                'id'           => $row['ID'],
                'coordinate_x' => $coordinateArr[0],
                'coordinate_y' => $coordinateArr[1],
            );
            $mysql->updateByIdAndSetList($update['id'], $update, $this->table);
        }
    }

    public function getCityIdByName($name)
    {
        $mysql = new Mysql();

        $name = trim($name);
        $sql  = "select `id` from `{$this->table}` where `name_tc` = '{$name}'";
        $res  = $mysql->queryAndFetchOne($sql);

        if (isset($res['id'])) {
            return $res['id'];
        }

        $sql = "select `id` from `{$this->table}` where `name_sc` = '{$name}'";
        $res = $mysql->queryAndFetchOne($sql);

        return $res['id'] ?? 0;
    }
}