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

    function store($obj)
    {
        $FClass = self::classConvert($obj);
        $entity = new $FClass();
        return $entity->store($obj);
    }

    function load($EClass, array $arr)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        return $entity->load($arr);
    }

    function loadElements(string $EClass, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElements($limit, $offset, $datetime);
        return $results;
    }

    function loadElementsById(string $EClass, int $id, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElements($id, $limit, $offset, $datetime);
        return $results;
    }

    function loadElementsByGroup(string $EClass, array $group, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElements($group, $limit, $offset, $datetime);
        return $results;
    }

    function loadElementsByCondition(string $EClass, array $cond, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElementsByCondition($cond, $limit, $offset, $datetime);
        return $results;
    }

    function delete($CClass, array $arr)
    {
        $FClass = "F" . substr($CClass, 1);
        $entity = new $FClass();
        $entity->delete($arr);
    }

    function update($obj, array $condition)
    {
        $FClass = self::classConvert($obj);
        $entity = new $FClass();
        $entity->update($obj, $condition);
    }

    function exists($obj)
    {
        $FClass = self::classConvert($obj);
        $entity = new $FClass();
        return $entity->exists($obj);
    }

    private static function classConvert($obj): string
    {
        $EClass = get_class($obj);
        $FClass = "F" . substr($EClass, 1);
        return $FClass;
    }
}
?>