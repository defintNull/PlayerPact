<?php

    require realpath($_SERVER["DOCUMENT_ROOT"]."/envloader.php");

    class FDB {
        private static $instance;
        private static array $tables = array(
            "Admin"=>"admin",
            "Chat"=>"chat",
            "ChatUser"=>"chatuser",
            "Comment"=>"comment",
            "Message"=>"message",
            "Mod"=>"mod",
            "ModerationComment"=>"moderationcomment",
            "ModerationPost"=>"moderationpost",
            "ModerationUser"=>"moderationuser",
            "PostSell"=>"postsell",
            "PostStandard"=>"poststandard",
            "PostTeam"=>"postteam",
            "Report"=>"report",
            "User"=>"user");

        private $db;

        private function __construct() {

            try{
                $this->db = new PDO("mysql:host=".$_ENV["DB_HOST"].";dbname=".$_ENV["DB_NAME"],$_ENV["DB_USER_NAME"],$_ENV["DB_PASSWORD"]);
            } catch(PDOException $e) {
                echo "Errore: ". $e->getMessage();
            }

        }

        static function getInstance() : FDB {
            if(self::$instance == null) {
                self::$instance = new FDB();
            }
            return self::$instance;
        }

        function query() {

        }

        function close() {
            self::$instance == null;
        }

        function store(string $class, $entity) : void{
            $this->db->beginTransaction();

            $sql = "INSERT INTO ". self::$tables[$class]." (";
            
            $counter = 0;
            $values = $entity->getValues();
            foreach($values as $attrib=>$data) {
                $sql .= $attrib;
                if($counter < count($values)-1) {
                    $sql .= ", ";
                }
                $counter++;
            }
            $sql .= ") VALUES (";

            $counter = 0;
            foreach($values as $attrib=>$data) {
                $sql .= "\"". $data. "\"";
                if($counter < count($values)-1) {
                    $sql .= ", ";
                }
                $counter++;
            }
            $sql .= ")";
            
            $sth = $this->db->prepare($sql);
            $sth->execute();

            $this->db->commit();
        }

        function load(string $class, string $condition) : array{
            $this->db->beginTransaction();

            $sql = "SELECT * FROM ". self::$tables[$class] ." WHERE " . $condition;
            
            $sth = $this->db->prepare($sql);
            $sth->execute();

            $result = $sth->fetch(PDO::FETCH_ASSOC);

            $this->db->commit();
            
            return $result;
        }

        function delete(string $class, string $condition) : void {
            $this->db->beginTransaction();

            $sql = "DELETE FROM " .self::$tables[$class] . " WHERE ". $condition;

            $sth = $this->db->prepare($sql);
            $sth->execute();

            $this->db->commit();
        }

        function update(string $class, $entity, string $condition) : void{
            $this->db->beginTransaction();

            $sql = "UPDATE ". self::$tables[$class] ." SET ";

            $counter = 0;
            $values = $entity->getValues();
            foreach($values as $attrib=>$data) {
                $sql .= $attrib . "="."\"". $data . "\"";
                if($counter < count($values)-1) {
                    $sql .= ", ";
                }
                $counter++;
            }
            $sql .= " WHERE " . $condition;

            $sth = $this->db->prepare($sql);
            $sth->execute();

            $this->db->commit();
        }

        function exists(string $class, $entity) : bool{
            $this->db->beginTransaction();

            $sql = "SELECT * FROM ". self::$tables[$class] ." WHERE (";

            $counter = 0;
            $values = $entity->getValues();
            foreach($values as $attrib=>$data) {
                $sql .= $attrib . "="."\"". $data . "\"";
                if($counter < count($values)-1) {
                    $sql .= " AND ";
                }
                $counter++;
            }
            $sql .= ")";
            
            $sth = $this->db->prepare($sql);
            $sth->execute();
            $result = $sth->fetch();

            $this->db->commit();

            if($result == false) {
                return false;
            } else {
                return true;
            }
        }
    }
?>