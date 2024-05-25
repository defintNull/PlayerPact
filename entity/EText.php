<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EText implements FInterface{

        private $id;
        private $idpoststandard;
        private $iduser;
        private $description;
        private $datetime;

        public function __construct(int $id,int $idpoststandard,int $iduser,string $description,string $datetime) {
            $this->id = $id;
            $this->idpoststandard = $idpoststandard;
            $this->iduser = $iduser;
            $this->description = $description;
            $this->datetime = $datetime;
        }

        public function getId() {
            return $this->id;
        }
        
        public function getIdPostStandard() {
            return $this->idpoststandard;
        }

        public function getIdUser() {
            return $this->iduser;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getDateTime() {
            return $this->datetime;
        }

        public function getValues() {
            $v = array(
                "id" => $this->id,
                "idpoststandard" => $this->idpoststandard,
                "iduser" => $this->iduser,
                "description" => $this->description,
                "datetime" => $this->datetime
            );
            return $v;
        }
    }
?>
