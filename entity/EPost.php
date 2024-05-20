<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EPost implements FInterface{
        
        private $id;
        private $iduser;
        private $title;
        private $description;
        private $date;

        public function __construct($id,$iduser,$title,$description,$date) {
            $this->id = $id;
            $this->iduser = $iduser;
            $this->title = $title;
            $this->description = $description;
            $this->date= $date;
        }

        public function getId() {
            return $this->id;
        }

        public function getIdUser() {
            return $this->iduser;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getDateTime() {
            return $this->date;
        }

        public function getValues() {
            $v = array(
                "id" => $this->id,
                'iduser' => $this->iduser,
                "title" => $this->title,
                "description" => $this->description,
                "date" => $this->date
            );
            return $v;
        }
    }
?>