<?php

    foreach (scandir(dirname(__FILE__)) as $filename) {
        if(strcmp($filename,"FDB.php") != 0) { // da vedere se funziona senza altrimenti aggiungere anche FInterface da escludere
            $path = dirname(__FILE__) . '/' . $filename;
            if (is_file($path)) {
                include_once $path;
            }
        }
    }

    class FPersistentManager {

        function store($obj) {
            $FClass = self::classConvert($obj);
            $entity = new $FClass();
            $entity->store($obj);
        }

        function load($EClass, array $arr) {
            $FClass = "F".substr($EClass,1); 
            $entity = new $FClass();
            return $entity->load($arr);
        }

        function loadPosts(string $EClass,int $limit,int $offset,string $datetime) {
            $FClass = "F".substr($EClass,1); 
            $entity = new $FClass();
            $results = $entity->loadElements($limit,$offset,$datetime);
            return $results;
        }

        function loadPost(string $EClass,int $id) {
            $FClass = "F".substr($EClass,1); 
            $entity = new $FClass();
            $results = $entity->loadById($id);
            return $results[0];
        }

        function delete($CClass, string $condition) {
            $FClass = "F".substr($CClass,1); 
            $entity = new $FClass();
            $entity->delete($condition);
        }

        function update($obj, string $condition) {
            $FClass = self::classConvert($obj);
            $entity = new $FClass();
            $entity->update($obj,$condition);
        }

        function exists($obj) {
            $FClass = self::classConvert($obj);
            $entity = new $FClass();
            return $entity->exist($obj);
        }

        private static function classConvert($obj) : string {
            $EClass = get_class($obj);
            $FClass = "F".substr($EClass,1);
            return $FClass;
        }   
    }    
?>