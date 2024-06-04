<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EInterestList implements FInterface {
        
        private $id;
        private $userId;
        private $interestObjId;

        public function getValues() {
            $v = array(
                "id" => $this->id,
                "userId" => $this->userId,
                "interestObjId" => $this->interestObjId
            );
            return $v;
        }

    }
?>