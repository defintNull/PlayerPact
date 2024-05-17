<?php
    include_once realpath(__DIR__."/FDB.php");
    
    class FReport {
        
        function store($obj) {
            $db = FDB::getInstance();
            $table = substr(__CLASS__,1);
            $db->store($table,$obj);
        }

        function load(string $condition) {
            $db = FDB::getInstance();
            $table = substr(__CLASS__,1);
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