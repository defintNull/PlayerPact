<?php

require_once realpath(__DIR__ . "/../envloader.php");

/**
 * Manage foundation layer of DB
 *
 * Manage connection, table-class conversion, CRUD method
 * and method for multiple loads
 *
 * @package Playerpact\Foundation
 */
class FDB
{
    private static $instance;
    private static array $tables = array(
        "Admin" => "admin",
        "BannedUser" => "banneduser",
        "Chat" => "chat",
        "ChatUser" => "chatuser",
        "Comment" => "comment",
        "InterestList" => "interestlist",
        "Message" => "message",
        "Moderator" => "moderator",
        "ModerationResult" => "moderationresult",
        "Participation" => "participation",
        "PostSale" => "postsale",
        "PostStandard" => "poststandard",
        "PostTeam" => "postteam",
        "PostUser" => "postuser",
        "Profile" => "profile",
        "Report" => "report",
        "User" => "user"
    );

    private $db;

    /**
     * Private constructor for the PDO db istance
     *
     * Create the new PDO instance with the connection to the DB
     *
     * @throws Exception if the creation fails
     * 
     */
    private function __construct()
    {

        try {
            $this->db = new PDO("mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"], $_ENV["DB_USER_NAME"], $_ENV["DB_PASSWORD"]);
        } catch (PDOException $e) {
            throw new Exception($e);
        }

    }

    /**
     * Static method to get db istance
     *
     * Return istance of the PDO connection to the DB
     * 
     * @return object
     * 
     */
    static function getInstance(): FDB
    {
        if (self::$instance == null) {
            self::$instance = new FDB();
        }
        return self::$instance;
    }

    /**
     * Execute directly a query
     *
     * Execute directly a query using the param given
     *
     * @param $query The query to execute
     *
     * @throws Exception if the query fails
     * 
     * @return array|string
     * 
     */
    function query(string $query)
    {
        try {
            $this->db->beginTransaction();

            $sql = $query;
            $sth = $this->db->prepare($sql);
            $sth->execute();
            $results = [];
            while ($result = $sth->fetch(PDO::FETCH_ASSOC)) {
                $results[] = $result;
            }

            $this->db->commit();
            return $results;

        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    /**
     * Discard the PDO DB instace
     *
     * Discard the PDO DB instace
     * 
     * @return void
     * 
     */
    function close()
    {
        self::$instance == null;
    }


    /**
     * Store Object
     *
     * Store the object of class $class in the corresponding table
     *
     * @param string $class The class(without E) of the object to store
     * @param $entity The object to store
     *
     * @throws Exception if the store fails
     * 
     * @return int
     * 
     */
    function store(string $class, $entity)
    {
        try {

            $this->db->beginTransaction();

            $sql = "INSERT INTO " . self::$tables[$class] . " (";

            $counter = 0;
            $values = $entity->getValues();
            foreach ($values as $attrib => $data) {
                $sql .= $attrib;
                if ($counter < count($values) - 1) {
                    $sql .= ", ";
                }
                $counter++;
            }
            $sql .= ") VALUES (";

            $counter = 0;
            foreach ($values as $attrib => $data) {
                if (strcmp(strtolower($attrib), "id") == 0) {
                    $sql .= "NULL";
                } else {
                    $sql .= "\"" . $data . "\"";
                }
                if ($counter < count($values) - 1) {
                    $sql .= ", ";
                }
                $counter++;
            }
            $sql .= ")";

            $sth = $this->db->prepare($sql);
            $sth->execute();

            $id = $this->db->lastInsertId();

            $this->db->commit();

            return $id;
        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    /**
     * Load Object attributes
     *
     * Load the object of class $class form the corresponding table
     *
     * @param string $class The class(without E) of the object to load
     * @param string $condition The condition used to load the object
     *
     * @throws Exception if the load fails
     * 
     * @return array|string
     * 
     */
    function load(string $class, string $condition)
    {
        try {
            $this->db->beginTransaction();

            $sql = "SELECT * FROM " . self::$tables[$class] . " WHERE " . $condition;
            $sth = $this->db->prepare($sql);
            $sth->execute();
            $results = [];
            while ($result = $sth->fetch(PDO::FETCH_ASSOC)) {
                $results[] = $result;
            }

            $this->db->commit();
            return $results;

        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    /**
     * Delete Object
     *
     * Delete the object of class $class form the corresponding table
     *
     * @param string $class The class(without E) of the object to delete
     * @param string $condition The condition used to delete the object
     *
     * @throws Exception if the delete fails
     * 
     * @return bool
     * 
     */
    function delete(string $class, string $condition)
    {
        try {
            $this->db->beginTransaction();

            $sql = "DELETE FROM " . self::$tables[$class] . " WHERE " . $condition;

            $sth = $this->db->prepare($sql);
            $sth->execute();

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    /**
     * Update Object
     *
     * Update the object of class $class in the corresponding table
     *
     * @param string $class The class(without E) of the object to delete
     * @param $entity The object to update
     * @param string $condition The condition used to update the object
     *
     * @throws Exception if the delete fails
     * 
     */
    function update(string $class, $entity, string $condition)
    {
        try {
            $this->db->beginTransaction();

            $sql = "UPDATE " . self::$tables[$class] . " SET ";

            $counter = 0;
            $values = $entity->getValues();
            foreach ($values as $attrib => $data) {
                $data = addslashes($data);
                $sql .= $attrib . "=" . "\"" . $data . "\"";
                if ($counter < count($values) - 1) {
                    $sql .= ", ";
                }
                $counter++;
            }
            $sql .= " WHERE " . $condition;

            $sth = $this->db->prepare($sql);
            $sth->execute();

            $this->db->commit();

        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    /**
     * Check Object exsistence
     *
     * Check Object exsistence in the corresponding table
     *
     * @param string $class The class(without E) of the object to delete
     * @param $entity The object to check
     *
     * @throws Exception if the delete fails
     * 
     * @return bool
     * 
     */
    function exists(string $class, $entity)
    {
        try {

            $this->db->beginTransaction();

            $sql = "SELECT * FROM " . self::$tables[$class] . " WHERE (";

            $counter = 0;
            $values = $entity->getValues();
            foreach ($values as $attrib => $data) {
                $sql .= $attrib . "=" . "\"" . $data . "\"";
                if ($counter < count($values) - 1) {
                    $sql .= " AND ";
                }
                $counter++;
            }
            $sql .= ")";

            echo $sql;

            $sth = $this->db->prepare($sql);
            $sth->execute();
            $result = $sth->fetch();

            $this->db->commit();

            if ($result == false) {
                return false;
            } else {
                return true;
            }

        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    /**
     * Count elements of a table
     *
     * Count elements of a table given by param
     *
     * @param $class The class(without E) to determine the table to count
     *
     * @throws Exception if the query fails
     * 
     * @return string
     * 
     */
    function getItemCount($class)
    {
        try {

            $this->db->beginTransaction();

            $sql = "SELECT COUNT(*) FROM " . self::$tables[$class];

            $sth = $this->db->prepare($sql);
            $sth->execute();
            $results = [];
            while ($result = $sth->fetch(PDO::FETCH_ASSOC)) {
                $results[] = $result;
            }

            $this->db->commit();

            return $results;

        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }
}
