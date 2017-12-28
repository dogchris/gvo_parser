<?php

namespace Db;

class Mysql
{
    private $db;

    private $host   = "localhost";
    private $user   = "dol";
    private $pwd    = "123456";
    private $dbName = "GVO_ADV";

    public function __construct()
    {
        $this->db = new \mysqli($this->host, $this->user, $this->pwd, $this->dbName);
        if ($this->db->connect_errno) {
            printf("Connect failed: %s\n", $this->db->connect_error);
            exit();
        }

        $this->db->query("SET NAMES utf8");
    }

    /**
     * only used by the table has primary key `id`
     * @param $sql
     * @return array
     */
    public function queryFetchAssoc($sql)
    {
        $res       = array();
        $resultObj = $this->db->query($sql);

        while ($row = $resultObj->fetch_assoc()) {
            $res[$row['id']] = $row;
        }

        return $res;
    }

    function queryAndFetchAll($sql)
    {
        $res       = array();
        $resultObj = $this->db->query($sql);

        while ($row = $resultObj->fetch_assoc()) {
            $res[] = $row;
        }

        return $res;
    }

    function queryAndFetchOne($sql)
    {
        $resultObj = $this->db->query($sql);
        $row       = $resultObj->fetch_assoc();

        return array_shift($row);
    }

    function insertBySetList(array $setList, $table)
    {
        $sql            = "insert into `{$table}` set ";
        $setClauseArray = array();
        foreach ($setList as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $this->db->escape_string($value) . "'";
            }
            $setClauseArray[] = "`{$key}` = {$value}";
        }
        $sql .= implode(', ', $setClauseArray);

        $this->db->query($sql);
        $insertId = $this->db->insert_id;

        return $insertId;
    }

    function updateByIdAndSetList($id, array $setList, $table)
    {
        $sql            = "update `{$table}` set ";
        $setClauseArray = array();
        foreach ($setList as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $this->db->escape_string($value) . "'";
            }
            $setClauseArray[] = "`{$key}` = {$value}";
        }
        $sql .= implode(', ', $setClauseArray);
        $sql .= " where `id` = {$id}";
        $this->db->query($sql);
    }
}