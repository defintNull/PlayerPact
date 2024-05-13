<?php
    class FPersistentManager {

        function store($obj) {
            $FClass = self::classConvert($obj);
            $entity = new $FClass();
            $entity->store($obj);
        }

        function load($EClass,$condition) {
            $FClass = "F".substr($EClass,1); 
            $entity = new $FClass();
            $entity->load($condition);
        }

        function delete($EClass,$condition) {
            $FClass = "F".substr($EClass,1); 
            $entity = new $FClass();
            $entity->delete($condition);
        }

        function update($obj,$condition) {
            $FClass = self::classConvert($obj);
            $entity = new $FClass();
            $entity->update($obj);
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