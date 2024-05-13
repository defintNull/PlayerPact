<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPost.php");
    
    class EPostTeam extends EPost{

        private $nMaxPlayers;
        private $nPlayers;
        private $time;

        public function getValues() {
            $v = parent::getValues();
            $v["nMaxPlayers"] = $this->nMaxPlayers;
            $v["nPlayers"] = $this->nPlayers;
            $v["time"] = $this->time;
            return $v;
        }
        
    }
?>