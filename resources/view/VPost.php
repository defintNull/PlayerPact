<?php

    require realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");
    require realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");

    class VPost {
        private $smarty;
        private $authenticated = false;

        public function __construct() {
            session_start();
            $this->smarty = SmartyLoader::loadSmarty();
            
            //$_SESSION["username"] = "pippo";
            if(isset($_SESSION["username"])){
                $this->authenticated = true;
                $username = $_SESSION["username"];
            }
            else{
                $username = "";
            }

            $this->smarty->assign("authenticated", $this->authenticated);
            $this->smarty->assign("username", $username);
            $this->smarty->display("poststandard.html");
        }

        public static function getData($type,$offset, $limit) {

            $normaltypes = array("standard","team","sell");
            $usertypes = array("standard","team","sell","interestlist");
            $modtypes = array(""); //add types
            $admintypes = array(""); // add types

            $session = USession::getInstance();
            $offset = (int)$offset;
            $limit  = (int)$limit;

            if(in_array($type,$usertypes) && $session->load("usertype")=="user") {
                /*
                Creare istanza controllore
                chiamare metodo di richiesta a db
                return results
                */
                $results = null;
                

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

?>