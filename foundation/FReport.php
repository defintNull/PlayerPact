<?php
require_once realpath(__DIR__ . "/FDB.php");

class FReport
{

    // Funziona
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

        try {
            return $db->load($table, $condition);
        } catch(Exception $e) {
            throw new Exception($e);
        }
        
    }

    //Funziona
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

        try {
            return $db->delete($table, $condition);
        } catch(Exception $e) {
            throw new Exception($e);
        }
        
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

        try {
            $db->update($table, $obj, $condition);
        } catch(Exception $e) {
            throw new Exception($e);
        }
        
    }

    function exists($obj)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);

        try {
            return $db->exists($table, $obj);
        } catch(Exception $e) {
            throw new Exception($e);
        }
        
    }

    function loadElements(int $limit, int $offset, string $datetime)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $condition = "1=1 ORDER BY id DESC LIMIT " . $limit . " OFFSET " . $offset;
        
        try {
            return $db->load($table, $condition);
        } catch(Exception $e) {
            throw new Exception($e);
        }
        
    }

    function loadElementsByCondition(array $cond, int $limit, int $offset, string $datetime)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $condition = "";
        foreach($cond as $key => $val){
            $condition .= $key . "=\"" . $val . "\""." AND ";
        }
        $condition .= "datetime<=\"" . $datetime . "\" ORDER BY id DESC LIMIT " . $limit . " OFFSET " . $offset;
        
        try {
            return $db->load($table, $condition);
        } catch(Exception $e) {
            throw new Exception($e);
        }
        
    }

    function loadElementsLikeByCondition(string $search, array $cond, int $limit, int $offset, string $datetime)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $condition = "";
        foreach($cond as $key => $val){
            $condition .= $key . "=\"" . $val . "\""." AND ";
        }
        $condition = "datetime<=\"" . $datetime ."\" AND id LIKE \"".$search."%\" ORDER BY id DESC LIMIT " . $limit . " OFFSET " . $offset;
        
        try {
            return $db->load($table, $condition);
        } catch(Exception $e) {
            throw new Exception($e);
        }
        
    }
}
