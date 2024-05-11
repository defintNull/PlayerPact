<?php

use Dotenv\Parser\Value;

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
                    $sql .= ",";
                }
                $counter++;
            }
            $sql .= ") VALUES (";

            $counter = 0;
            foreach($values as $attrib=>$data) {
                $sql .= $data;
                if($counter < count($values)-1) {
                    $sql .= ",";
                }
                $counter++;
            }
            $sql .= ")";
            echo $sql;
            $sth = $this->db->prepare($sql);
            $sth->execute();

            $this->db->commit();
        }

        function load(string $class, int $id) : array{

            $sql = "SELECT * FROM ". self::$tables[$class] ." WHERE id=". $id;
            
            $sth = $this->db->prepare($sql);
            $sth->execute();

            $result = $sth->fetch(PDO::FETCH_ASSOC);
            
            return $result;
        }

        function delete() {

        }

        function update() {

        }

        function exists() {
            
        }
    }
?>