<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EInterestList implements FInterface {
        
        private $id;
        private $userId;
        private $sellPostId;

        public function __construct($userId, $sellPostId) {
            $this->id = 0;
            $this->userId = $userId;
            $this->sellPostId = $sellPostId;            
        }

        public function getValues() {
            $v = array(
                "id" => $this->id,
                "userId" => $this->userId,
                "sellPostId" => $this->sellPostId
            );
            return $v;
        }

    }
?>