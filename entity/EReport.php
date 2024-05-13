<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EReport implements FInterface{

        private $id;
        private $description;
        private $date;
        private $time;
        
        public function getValues() {
            $v = array(
                "id" => $this->id,
                "description" => $this->description,
                "date" => $this->date,
                "time" => $this->time
            );
            return $v;
        }
    }
?>