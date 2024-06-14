<?php
require_once realpath(__DIR__ . "/FDB.php");

class FComment
{

    function store($obj)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        return $db->store($table, $obj);
    }

    function load(array $arr)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $condition = "";
        $i = 0;
        foreach ($arr as $key => $val) {
            $condition .= $key . "=" . $val;
            if ($i != count($arr) - 1) {
                $condition .= " AND ";
            }
            $i++;
        }
        return $db->load($table, $condition);
    }

    function loadElements(int $postId, int $limit, int $offset, string $datetime)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $condition = "postStandardId=\"" . $postId . "\" AND datetime<=\"" . $datetime . "\" ORDER BY id DESC LIMIT " . $limit . " OFFSET " . $offset;
        return $db->load($table, $condition);
    }

    function delete(string $condition)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $db->load($table, $condition);
    }

    function update($obj, string $condition)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $db->update($table, $obj, $condition);
    }

    function exists($obj)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        return $db->exists($table, $obj);
    }

}
?>