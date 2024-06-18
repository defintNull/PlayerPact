<?php
require_once realpath(__DIR__ . "/FDB.php");

class FChat
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
            $condition .= $key . "=\"" . $val . "\"";
            if ($i != count($arr) - 1) {
                $condition .= " AND ";
            }
            $i++;
        }
        return $db->load($table, $condition);
    }

    function loadElements(array $group, int $limit, int $offset, string $datetime)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $condition = "(";
        $i = 0;
        foreach ($group as $arr) {
            foreach ($arr as $key => $value) {
                $condition = $condition . $key . "=\"" . $value . "\"";
                if ($i != count($group) - 1) {
                    $condition .= " OR ";
                }
                $i++;
            }
        }
        $condition = $condition . ") ";
        $condition = $condition . "AND datetime<=\"" . $datetime . "\" ORDER BY id DESC LIMIT " . $limit . " OFFSET " . $offset;
        return $db->load($table, $condition);
    }

    function delete(array $arr)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);

        $condition = "";
        $i = 0;
        foreach($arr as $key => $val){
            $condition .= $key."=".$val;
            if($i < count($arr) - 1){ 
                $condition .= " AND ";
            }
            $i++;
        }
        return $db->delete($table, $condition);
    }

    function update($obj, array $arr)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);

        $condition = "";
        $i = 0;
        foreach ($arr as $key => $val) {
            $condition .= $key . "=\"" . $val . "\"";
            if ($i != count($arr) - 1) {
                $condition .= " AND ";
            }
            $i++;
        }

        $db->update($table, $obj, $condition);
    }

    function exists($obj)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        return $db->exists($table, $obj);
    }

}
