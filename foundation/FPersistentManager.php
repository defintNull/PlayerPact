<?php

foreach (scandir(dirname(__FILE__)) as $filename) {
    if (strcmp($filename, "FDB.php") != 0) {
        $path = dirname(__FILE__) . '/' . $filename;
        if (is_file($path)) {
            include_once $path;
        }
    }
}

/**
 * Manage relations with the foundation block
 *
 * Provide an interface for external function and method to access persistence 
 * and manage relations with the foundation block determining how to handle
 * the request from external function and method
 *
 * @package Playerpact\Foundation
 */
class FPersistentManager
{
    public function query(string $query) {
        $entity = new FAdmin();
        return $entity->query($query);
        
    }

    /**
     * Store objects
     *
     * Store the object given by param
     *
     * @param $obj The object to store
     *
     * @throws Exception if the store fails
     * 
     * @return int
     * 
     */
    function store($obj)
    {
        $FClass = self::classConvert($obj);
        $entity = new $FClass();
        try {
            return $entity->store($obj);
        } catch (Exception $e) {
            return 0;
        }
        
    }

    /**
     * Load object attributes
     *
     * Load the object attributes from the corresponding table cycling
     * the array param to get the attributes and find the object
     *
     * @param $EClass The class of the object to load
     * @param array $arr Array with key=>value where key is the attribute
     *                         of the object and value its value
     *
     * @throws Exception if the load fails
     * 
     * @return array
     * 
     */
    function load($EClass, array $arr)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        try {
            return $entity->load($arr);
        } catch (Exception $e) {
            return array();
        }
    }

    /**
     * Load multiple object attributes
     *
     * Load multiple objects attributes from the corresponding table
     *
     * @param $EClass The class of the object to load
     * @param int $limit The limit of results returned by the query
     * @param int $offset The offset for the query
     * @param string $datetime The datetime for the query to define from when
     *                                      loading the chats
     *
     * @throws Exception if the load fails
     * 
     * @return array
     * 
     */
    function loadElements(string $EClass, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElements($limit, $offset, $datetime);

        try {
            return $results;
        } catch (Exception $e) {
            return array();
        }
        
    }

    /**
     * Load multiple object attributes
     *
     * Load multiple objects attributes from the corresponding table using
     * the id given
     *
     * @param $EClass The class of the object to load
     * @param int $id The id to use during the research
     * @param int $limit The limit of results returned by the query
     * @param int $offset The offset for the query
     * @param string $datetime The datetime for the query to define from when
     *                                      loading the chats
     *
     * @throws Exception if the load fails
     * 
     * @return array
     * 
     */
    function loadElementsById(string $EClass, int $id, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElements($id, $limit, $offset, $datetime);
        
        try {
            return $results;
        } catch (Exception $e) {
            return array();
        }
    }

    /**
     * Load multiple object attributes
     *
     * Load multiple objects attributes from the corresponding table using
     * the group given
     *
     * @param $EClass The class of the object to load
     * @param array $group The group to use during the research
     * @param int $limit The limit of results returned by the query
     * @param int $offset The offset for the query
     * @param string $datetime The datetime for the query to define from when
     *                                      loading the chats
     *
     * @throws Exception if the load fails
     * 
     * @return array
     * 
     */
    function loadElementsByGroup(string $EClass, array $group, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElements($group, $limit, $offset, $datetime);
        
        try {
            return $results;
        } catch (Exception $e) {
            return array();
        }
    }

    /**
     * Load multiple object attributes
     *
     * Load multiple objects attributes from the corresponding table cycling
     * the array param to get the attributes and find the object
     *
     * @param $EClass The class of the object to load
     * @param array $cond Array of key=>value where key is 
     *                         the attribute of the object and value its value
     * @param int $limit The limit of results returned by the query
     * @param int $offset The offset for the query
     * @param string $datetime The datetime for the query to define from when
     *                                      loading the chats
     *
     * @throws Exception if the load fails
     * 
     * @return array
     * 
     */
    function loadElementsByCondition(string $EClass, array $cond, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElementsByCondition($cond, $limit, $offset, $datetime);
        
        try {
            return $results;
        } catch (Exception $e) {
            return array();
        }
    }

    /**
     * Load multiple object attributes
     *
     * Load multiple objects attributes from the corresponding table
     * using the search param 
     *
     * @param $EClass The class of the object to load
     * @param string $cond Used in the query to find post with title LIKE param
     * @param int $limit The limit of results returned by the query
     * @param int $offset The offset for the query
     * @param string $datetime The datetime for the query to define from when
     *                                      loading the chats
     *
     * @throws Exception if the load fails
     * 
     * @return array
     * 
     */
    function loadElementsLike(string $EClass, string $cond, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElementsLike($cond, $limit, $offset, $datetime);
        
        try {
            return $results;
        } catch (Exception $e) {
            return array();
        }
    }

    /**
     * Load multiple object attributes
     *
     * Load multiple objects attributes from the corresponding table 
     * Using the search param and cycling the array param to get
     * the attributes and find the object
     *
     * @param $EClass The class of the object to load
     * @param string $search Used in the query to find post with title LIKE param
     * @param array $cond Array of key=>value where key is 
     *                         the attribute of the object and value its value
     * @param int $limit The limit of results returned by the query
     * @param int $offset The offset for the query
     * @param string $datetime The datetime for the query to define from when
     *                                      loading the chats
     *
     * @throws Exception if the load fails
     * 
     * @return array
     * 
     */
    function loadElementsLikeByCondition(string $EClass, string $search, array $cond, int $limit, int $offset, string $datetime)
    {
        $FClass = "F" . substr($EClass, 1);
        $entity = new $FClass();
        $results = $entity->loadElementsLikeByCondition($search, $cond, $limit, $offset, $datetime);
       
        try {
            return $results;
        } catch (Exception $e) {
            return array();
        }
    }

    /**
     * Delete objects
     *
     * Delete the object from the corresponding table
     *
     * @param $EClass The class of the object to delete
     * @param array $arr Array of key=>value where key is 
     *                         the attribute of the object and value its value
     * 
     * @return null|array
     * 
     */
    function delete($CClass, array $arr)
    {
        $FClass = "F" . substr($CClass, 1);
        $entity = new $FClass();

        try {
            $entity->delete($arr);
        } catch (Exception $e) {
            return array();
        }
        
    }

    /**
     * Update objects
     *
     * Update the object from the corresponding table
     *
     * @param $obj The object o update
     * @param array $condition Array of key=>value where key is 
     *                         the attribute of the object and value its value
     * 
     * @return null|array
     * 
     */
    function update($obj, array $condition)
    {
        $FClass = self::classConvert($obj);
        $entity = new $FClass();

        try {
            $entity->update($obj, $condition);
        } catch (Exception $e) {
            return array();
        }
        
    }

    /**
     * Check object exsistence
     *
     * Check object exsistence from the corresponding table
     *
     * @param $obj The object to check
     *
     * @return null|array
     * 
     */
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

    /**
     * Convert entity class of object into their respective foundation class
     *
     * Convert entity class of object into their respective foundation class
     *
     * @param $obj The object to determine his respective foundation class
     * 
     * @return string
     * 
     */
    private static function classConvert($obj): string
    {
        $EClass = get_class($obj);
        $FClass = "F" . substr($EClass, 1);
        return $FClass;
    }
}
