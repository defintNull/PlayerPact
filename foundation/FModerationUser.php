<?php
    require_once realpath(__DIR__."/FDB.php");
    
    class FModerationUser {
        
        function store($obj) {
            $db = FDB::getInstance();
            $table = substr(__CLASS__,1);
            $db->store($table,$obj);
        }

        function load(string $col, array $arr) {
            $db = FDB::getInstance();
            $table = substr(__CLASS__,1);
            $condition = "";
            $i = 0;
            foreach($arr as $key => $val){
                $condition .= $key."=".$val;
                if($i != count($arr) - 2){
                    $condition .= " AND ";
                }
                $i++;
            }
            return $db->load($table,$condition);
        }

        function delete(string $condition) {
            $db = FDB::getInstance();
            $table = substr(__CLASS__,1);
            $db->load($table,$condition);
        }

        function update($obj,string $condition) {
            $db = FDB::getInstance();
            $table = substr(__CLASS__,1);
            $db->update($table,$obj,$condition);
        }

        function exists($obj) {
            $db = FDB::getInstance();
            $table = substr(__CLASS__,1);
            return $db->exists($table,$obj);
        }

    }
?>