<?php
require_once realpath(__DIR__ . "/FDB.php");

class FBannedUser
{

    function store($obj)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        return $db->store($table, $obj);
    }

    // Funziona
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

    // Funziona
    function delete(array $arr)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);

        $condition = "";
        $i = 0;
        foreach($arr as $key => $val){
            $condition .= $key . "=\"" . $val . "\"";
            if($i < count($arr) - 1){ 
                $condition .= " AND ";
            }
            $i++;
        }
        echo $condition;
        return $db->delete($table, $condition);
    }

    // Funziona
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
