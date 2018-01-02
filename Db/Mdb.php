<?php

namespace Db;

class Mdb
{
    private $db;

    private $dbName = "ship";
    private $user   = "";
    private $pwd    = "";

    public function __construct()
    {
        // $this->db = \odbc_connect("ship", "", "");
        $this->db = \odbc_connect($this->dbName, $this->user, $this->pwd);
    }

    public function query($sql)
    {
        $list = array();

        $res = \odbc_exec($this->db, $sql);
        while ($row = \odbc_fetch_array($res)) {
            $list[] = $row;

        }

        return $list;
    }

}