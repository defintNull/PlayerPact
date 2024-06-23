<?php
require_once realpath(__DIR__ . "/FDB.php");

/**
 * Manage foundation layer for PostStandard objects
 *
 * Manage the foundation layer of PostStandard object implementing
 * the CRUD operations and a method for multiple load with
 * offset and limit
 *
 * @package Playerpact\Foundation
 */
class FPostStandard
{

    /**
     * Store PostStandard objects
     *
     * Store the object of type EPostStandard in the corresponding table
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
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);

        try {
            return $db->store($table, $obj);
        } catch(Exception $e) {
            throw new Exception($e);
        }
        
    }

    /**
     * Load PostStandard attributes
     *
     * Load the object of type EPostStandard from the corresponding table cycling
     * the array param to get the attributes and find the object
     *
     * @param array $arr Array with key=>value where key is the attribute
     *                         of the object and value its value
     *
     * @throws Exception if the load fails
     * 
     * @return array
     * 
     */
    function load(array $arr)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $condition = "";
        $i = 0;
        foreach ($arr as $key => $val) {
            $condition .= $key . "=" . $val;
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

    /**
     * Load multiple PostStandard attributes
     *
     * Load multiple objects of type EPostStandard from the corresponding table
     * using the search param 
     *
     * @param string $search Used in the query to find post with title LIKE param
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
    function loadElementsLike(string $search, int $limit, int $offset, string $datetime)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $condition = "datetime<=\"" . $datetime ."\" AND title LIKE \"%".$search."%\" ORDER BY id DESC LIMIT " . $limit . " OFFSET " . $offset;
        
        try {
            return $db->load($table, $condition);
        } catch(Exception $e) {
            throw new Exception($e);
        }
        
    }

    /**
     * Load multiple PostStandard attributes
     *
     * Load multiple objects of type EPostStandard from the corresponding table cycling
     * the array param to get the attributes and find the object
     *
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
    function loadElementsByCondition(array $cond, int $limit, int $offset, string $datetime)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);
        $condition = "";
        foreach($cond as $key => $val){
            $condition .= $key."=".$val." AND ";
        }
        $condition .= "datetime<=\"" . $datetime . "\" ORDER BY id DESC LIMIT " . $limit . " OFFSET " . $offset;
        
        try {
            return $db->load($table, $condition);
        } catch(Exception $e) {
            throw new Exception($e);
        }
        
    }

    /**
     * Delete PostStandard object
     *
     * Delete the object of type EPostStandard in the corresponding tablecycling
     * the array param to get the attributes and delete the object
     *
     * @param array $arr Array with key=>value where key is the attribute
     *                         of the object and value its value
     *
     * @throws Exception if the delete fails
     * 
     * @return int
     * 
     */
    function delete(array $arr)
    {
        $db = FDB::getInstance();
        $table = substr(__CLASS__, 1);

        $condition = "";
        $i = 0;
        foreach($arr as $key => $val){
            $condition .= $key. "=\"" . $val . "\"";
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

    /**
     * Update PostStandard object
     *
     * Update the object of type EPostStandard in the corresponding table
     *
     * @param $obj The updatet object to store
     * @param array $arr Array with key=>value where key is the attribute
     *                         of the object and value its value
     *
     * @throws Exception if the update fails
     * 
     * @return void
     * 
     */
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

    /**
     * Check exsistance of PostStandard object
     *
     * Check exsistance of the object of type EPostStandard in the corresponding table
     *
     * @param $obj The object to check
     *
     * @throws Exception if the exists fails
     * 
     * @return bool
     * 
     */
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

}
