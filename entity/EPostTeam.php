<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPost.php");
    
    class EPostTeam extends EPost{

        private $nMaxPlayers;
        private $nPlayers;
        private $time;

        public function __construct($id, $iduser, $title, $description, $date, $nMaxPlayers, $nPlayers, $time) {
            parent::__construct($id,$iduser,$title,$description,$date);
            $this->nMaxPlayers = $nMaxPlayers;
            $this->nPlayers = $nPlayers;
            $this->time = $time;
        }

        public function getNMaxPlayers(){
            return $this->nMaxPlayers;
        }
        
        public function getNPlayers(){
            return $this->nPlayers;
        }

        public function getTime(){
            return $this->time;
        }

        public function getValues() {
            $v = parent::getValues();
            $v["nMaxPlayers"] = $this->nMaxPlayers;
            $v["nPlayers"] = $this->nPlayers;
            $v["time"] = $this->time;
            return $v;
        }
        
    }
?>