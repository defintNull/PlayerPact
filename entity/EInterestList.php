<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EInterestList implements FInterface {
        
        private $id;
        private $userId;
        private $postSellId;

        public function __construct($userId, $postSellId) {
            $this->id = 0;
            $this->userId = $userId;
            $this->postSellId = $postSellId;
        }

        public function getValues() {
            $v = array(
                "id" => $this->id,
                "userId" => $this->userId,
                "postSellId" => $this->postSellId
            );
            return $v;
        }

    }
?>