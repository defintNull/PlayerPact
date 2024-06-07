<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EChatUser implements FInterface {

        private $id;
        private $idchat;
        private $iduser;
        private $datetime;

        public function __construct($id = 0,int $idchat,int $iduser,string $datetime) {
            $this->id = $id;
            $this->idchat = $idchat;
            $this->iduser = $iduser;
            $this->datetime = $datetime;
        }

        public function getValues(){
            $v = array(
                "id" => $this->id,
                "idchat" => $this->idchat,
                "iduser" => $this->iduser,
                "datetime" => $this->datetime
            );
            return $v;
        }
    }
?>