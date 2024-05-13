<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EChat implements FInterface {

        private $id;

        public function getValues(){
            $v = array(
                "id" => $this->id
            );
            return $v;
        }
        
    }
?>