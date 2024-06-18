<?php
require realpath($_SERVER["DOCUMENT_ROOT"] . "/envloader.php");

class FDB
{
    private static $instance;
    private static array $tables = array(
        "Admin" => "admin",
        "Chat" => "chat",
        "ChatUser" => "chatuser",
        "Comment" => "comment",
        "InterestList" => "interestlist",
        "Message" => "message",
        "Mod" => "mod",
        "ModerationComment" => "moderationcomment",
        "ModerationPost" => "moderationpost",
        "ModerationUser" => "moderationuser",
        "Participation" => "participation",
        "PostSale" => "postsale",
        "PostStandard" => "poststandard",
        "PostTeam" => "postteam",
        "Report" => "report",
        "User" => "user",
        "Profile" => "profile"
    );

    private $db;

    private function __construct()
    {

        try {
            $this->db = new PDO("mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"], $_ENV["DB_USER_NAME"], $_ENV["DB_PASSWORD"]);
        } catch (PDOException $e) {
            return $e->getCode();
        }

    }

    static function getInstance(): FDB
    {
        if (self::$instance == null) {
            self::$instance = new FDB();
        }
        return self::$instance;
    }

    function query()
    {

    }

    function close()
    {
        self::$instance == null;
    }

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
            //echo $sql;
            $sth->execute();

            $id = $this->db->lastInsertId();

            $this->db->commit();

            return $id;
        } catch (PDOException $e) {
            return $e;
        }
    }

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
            //echo var_dump($results);
            return $results;

        } catch (PDOException $e) {
            return $e;
        }
    }

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
            //return false;
            return $e;
        }
    }

    function update(string $class, $entity, string $condition)
    {
        try {
            $this->db->beginTransaction();

            $sql = "UPDATE " . self::$tables[$class] . " SET ";

            $counter = 0;
            $values = $entity->getValues();
            foreach ($values as $attrib => $data) {
                $data = addslashes($data);
                //echo $data."\n\n";
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
            return $e;
        }
    }

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
            return $e;
        }
    }

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
            return $e->getCode();
        }
    }
}
