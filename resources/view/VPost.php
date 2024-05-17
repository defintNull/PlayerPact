<?php

    require realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");
    require realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");
    require realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");
    require realpath($_SERVER["DOCUMENT_ROOT"]."/controllers/CPost.php");

    class VPost {
        private $smarty;
        private $authenticated = false;

        public function __construct() {
            $session = USession::getInstance();
            $session->start();
            
            $this->smarty = SmartyLoader::loadSmarty();
            
            $session->set("user", new EUser(1, "gg", "pippo", "J", "S", "2000-05-05", "email", "no"));
            $user = $session->load("user");
            if(isset($user)) {
                $this->authenticated = true;
                $username = $user->getValues()["username"];
            }
            else{
                $username = "";
            }

            $this->smarty->assign("authenticated", $this->authenticated);
            $this->smarty->assign("username", $username);
            $this->smarty->display("poststandard.html");
        }

        public static function getData($type, $offset, $limit) {

            $normaltypes = array("PostStandard","PostTeam","PostSell");
            $usertypes = array("PostStandard","PostTeam","PostSell","InterestList");
            $modtypes = array("Report", "User"); //add types
            $admintypes = array(""); // add types

            $session = USession::getInstance();
            $offset = (int)$offset;
            $limit  = (int)$limit;

            if(in_array($type,$usertypes) && get_class($session->load("user"))=="EUser") {
                /*
                Creare istanza controllore
                chiamare metodo di richiesta a db
                return results
                */
                $cPost = new CPost();
                $results = $cPost->loadFromDB($type, $offset, $limit);

            } elseif(in_array($type,$modtypes) && $session->load("usertype")=="mod") {
                
                /*
                Creare istanza controllore
                chiamare metodo di richiesta a db
                return results
                */
                $results = null;

            } elseif(in_array($type,$admintypes) && $session->load("usertype")=="admin") {
                
                /*
                Creare istanza controllore
                chiamare metodo di richiesta a db
                return results
                */
                $results = null;

            } elseif(in_array($type,$normaltypes)) {
                

                /*
                Creare istanza controllore
                chiamare metodo di richiesta a db
                return results
                */
                $results = null;
                return $results;
            } else {
                //bad gateway
            }
            return $results;

        }

        public static function getCount() {
            return 0;
        }


    }
    $a = new VPost();
    //print_r($a->getData("PostStandard", 0, 10));
?>