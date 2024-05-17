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
                return $e->getCode();
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

        function store(string $class, $entity) {
            try {

                $this->db->beginTransaction();

                $sql = "INSERT INTO ". self::$tables[$class]." (";
            
                $counter = 0;
                $values = $entity->getValues();
                foreach($values as $attrib=>$data) {
                    if(!strcmp(strtolower($attrib),"id")) {
                        $sql .= $attrib;
                    }
                    if($counter < count($values)-1) {
                        $sql .= ", ";
                    }
                    $counter++;
                }
                $sql .= ") VALUES (";

                $counter = 0;
                foreach($values as $attrib=>$data) {
                    if(!strcmp(strtolower($attrib),"id")) {
                        $sql .= "\"". $data. "\"";
                    }
                    if($counter < count($values)-1) {
                        $sql .= ", ";
                    }
                    $counter++;
                }
                $sql .= ")";
                
                $sth = $this->db->prepare($sql);
                $sth->execute();

                $this->db->commit();

            }catch (PDOException $e) {
                return $e->getCode();
            }
        }

        function load(string $class, string $condition) {
            try {
                $this->db->beginTransaction();

                $sql = "SELECT * FROM ". self::$tables[$class] ." WHERE " . $condition;

                $sth = $this->db->prepare($sql);
                $sth->execute();
                $results = [];
                while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
                    $results[] = $result;
                }
                
                $this->db->commit();
                return $results;

            } catch (PDOException $e) {
                return $e->getCode();
            }
        }

        function delete(string $class, string $condition) {
            
            try {

                $this->db->beginTransaction();

                $sql = "DELETE FROM " .self::$tables[$class] . " WHERE ". $condition;

                $sth = $this->db->prepare($sql);
                $sth->execute();

                $this->db->commit();

            } catch (PDOException $e) {
                return $e->getCode();
            }
        }

        function update(string $class, $entity, string $condition) {
            
            try {

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

            } catch (PDOException $e) {
                return $e->getCode();
            }
        }

        function exists(string $class, $entity) {
            
            try {

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

            } catch (PDOException $e) {
                return $e->getCode();
            }
        }

        function getItemCount($class) {
            try {

                $this->db->beginTransaction();

                $sql = "SELECT COUNT(*) FROM ". self::$tables[$class];
                
                $sth = $this->db->prepare($sql);
                $sth->execute();
                $results = [];
                while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
                    $results[] = $result;
                }
                
                $this->db->commit();
                
                return $results;

            } catch (PDOException $e) {
                return $e->getCode();
            }
        }
    }
?>