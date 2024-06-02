<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPost.php");
    
    class EPostTeam extends EPost{

        private $nMaxPlayer;
        private $nPlayers;
        private $time;

        public function __construct($id, $iduser, $title, $description, $date, $nMaxPlayer, $nPlayers, $time) {
            parent::__construct($id,$iduser,$title,$description,$date);
            $this->nMaxPlayer = $nMaxPlayer;
            $this->nPlayers = $nPlayers;
            $this->time = $time;
        }

        public function getNMaxPlayer(){
            return $this->nMaxPlayer;
        }
        
        public function getNPlayers(){
            return $this->nPlayers;
        }

        public function getTime(){
            return $this->time;
        }

        public function getValues() {
            $v = parent::getValues();
            $v["nMaxPlayer"] = $this->nMaxPlayer;
            $v["nPlayers"] = $this->nPlayers;
            $v["time"] = $this->time;
            return $v;
        }
        
    }
?>