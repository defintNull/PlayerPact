<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EChat implements FInterface {

        private $id;
        private $idpostteam;
        private $idpostsell;
        private $datetime;

        public function __construct(int $id, $idpostteam, $idpostsell,string $datetime) {
            $this->id = $id;
            $this->idpostteam = $idpostteam;
            $this->idpostsell = $idpostsell;
            $this->datetime = $datetime;
        }

        public function getId() {
            return $this->id;
        }

        public function getIdPostTeam() {
            return $this->idpostteam;
        }

        public function getIdPostSell() {
            return $this->idpostsell;
        }

        public function getDateTime() {
            return $this->datetime;
        }

        public function getValues(){
            $v = array(
                "id" => $this->id,
                "idpostteam" => $this->idpostteam,
                "idpostsell" => $this->idpostsell,
                "datetime" => $this->datetime
            );
            return $v;
        }
        
    }
?>