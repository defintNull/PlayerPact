<?php
require_once realpath(__DIR__ . "/FDB.php");


/**
 * Manage foundation layer for BanUser objects
 *
 * Manage the foundation layer of BanUser object implementing
 * the CRUD operations
 *
 * @package Playerpact\Foundation
 */
class FBannedUser
{

    /**
     * Store BanUser objects
     *
     * Store the object of type EBanUser in the corresponding table
     *
     * @param $obj The object to store
     *
     * @throws Excepiton if the store fails
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
     * Load BanUser attributes
     *
     * Load the object of type EBanUser from the corresponding table cycling
     * the array param to get the attributes and find the object
     *
     * @param array $arr Array with key=>value where key is the attribute
     *                         of the object and value its value
     *
     * @throws Excepiton if the load fails
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

    /**
     * Delete BanUser object
     *
     * Delete the object of type EBanUser in the corresponding tablecycling
     * the array param to get the attributes and delete the object
     *
     * @param array $arr Array with key=>value where key is the attribute
     *                         of the object and value its value
     *
     * @throws Excepiton if the delete fails
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

    /**
     * Update BanUser object
     *
     * Update the object of type EBanUser in the corresponding table
     *
     * @param $obj The updatet object to store
     * @param array $arr Array with key=>value where key is the attribute
     *                         of the object and value its value
     *
     * @throws Excepiton if the update fails
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
     * Check exsistance of BanUser object
     *
     * Check exsistance of the object of type EBanUser in the corresponding table
     *
     * @param $obj The object to check
     *
     * @throws Excepiton if the exists fails
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
