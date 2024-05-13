<?php

    foreach (scandir(dirname(__FILE__)) as $filename) {
        if(!strcmp($filename,"FDB.php")) {
            $path = dirname(__FILE__) . '/' . $filename;
            if (is_file($path)) {
                require $path;
            }
        }
        
    }

    class FPersistentManager {

        function store($obj) {
            $FClass = self::classConvert($obj);
            $entity = new $FClass();
            $entity->store($obj);
        }

        function load($EClass,string $condition) {
            $FClass = "F".substr($EClass,1); 
            $entity = new $FClass();
            $entity->load($condition);
        }

        function delete($EClass,string $condition) {
            $FClass = "F".substr($EClass,1); 
            $entity = new $FClass();
            $entity->delete($condition);
        }

        function update($obj,string $condition) {
            $FClass = self::classConvert($obj);
            $entity = new $FClass();
            $entity->update($obj,$condition);
        }

        function exists($obj) {
            $FClass = self::classConvert($obj);
            $entity = new $FClass();
            $entity->exist($obj);
        }

        private static function classConvert($obj) : string {
            $EClass = get_class($obj);
            $FClass = "F".substr($EClass,1);
            return $FClass;
        }
        
    }
?>