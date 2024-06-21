<?php

foreach (scandir(dirname(__FILE__)) as $filename) {
    if (strcmp($filename, "FDB.php") != 0) { // da vedere se funziona senza altrimenti aggiungere anche FInterface da escludere
        $path = dirname(__FILE__) . '/' . $filename;
        if (is_file($path)) {
            include_once $path;
        }
    }
}

class FPersistentManager
{
    public function query(string $query) {
        $entity = new FAdmin();
        return $entity->query($query);
        
    }

    function store($obj)
    {
        $FClass = self::classConvert($obj);
        $entity = new $FClass();
        try {
            return $entity->store($obj);
        } catch (Exception $e) {
            throw new Exception($e);
        }
        
    }

    function load($EClass, array $arr)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        try {
            return $entity->load($arr);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function loadElements(string $EClass, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElements($limit, $offset, $datetime);

        try {
            return $results;
        } catch (Exception $e) {
            throw new Exception($e);
        }
        
    }

    function loadElementsById(string $EClass, int $id, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElements($id, $limit, $offset, $datetime);
        
        try {
            return $results;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function loadElementsByGroup(string $EClass, array $group, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElements($group, $limit, $offset, $datetime);
        
        try {
            return $results;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function loadElementsByCondition(string $EClass, array $cond, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElementsByCondition($cond, $limit, $offset, $datetime);
        
        try {
            return $results;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function loadElementsLike(string $EClass, string $cond, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElementsLike($cond, $limit, $offset, $datetime);
        
        try {
            return $results;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function loadElementsLikeByCondition(string $EClass, string $search, array $cond, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElementsLikeByCondition($search, $cond, $limit, $offset, $datetime);
       
        try {
            return $results;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function delete($CClass, array $arr)
    {
        $FClass = "F" . substr($CClass, 1);
        $entity = new $FClass();

        try {
            $entity->delete($arr);
        } catch (Exception $e) {
            throw new Exception($e);
        }
        
    }

    function update($obj, array $condition)
    {
        $FClass = self::classConvert($obj);
        $entity = new $FClass();

        try {
            $entity->update($obj, $condition);
        } catch (Exception $e) {
            throw new Exception($e);
        }
        
    }

    function exists($obj)
    {
        $FClass = self::classConvert($obj);
        $entity = new $FClass();

        try {
            return $entity->exists($obj);
        } catch (Exception $e) {
            throw new Exception($e);
        }
        
    }

    private static function classConvert($obj): string
    {
        $EClass = get_class($obj);
        $FClass = "F" . substr($EClass, 1);
        return $FClass;
    }
}
