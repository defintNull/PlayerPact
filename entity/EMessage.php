<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EText.php");
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EMessage extends EText implements FInterface{
        private $id;
        private $idchat;
        private $iduser;
        private $description;
        private $datetime;

        public function __construct(int $id,int $idchat,int $iduser,string $description,string $datetime) {
            $this->id = $id;
            $this->idchat = $idchat;
            $this->iduser = $iduser;
            $this->description = $description;
            $this->datetime = $datetime;
        }

        public function getId() {
            return $this->id;
        }

        public function getIdChat() {
            return $this->idchat;
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

        public function getValues(){
            $v = array(
                "id" => $this->id,
                "idchat" => $this->idchat,
                "iduser" => $this->iduser,
                "description" => $this->description,
                "datetime" => $this->datetime

            );
            return $v;
        }
    }
?>