<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EPost implements FInterface{
        
        private $id;
        private $title;
        private $description;
        private $date;

        public function getValues() {
            $v = array(
                "id" => $this->id,
                "title" => $this->title,
                "description" => $this->description,
                "date" => $this->date
            );
            return $v;
        }

    }
?>