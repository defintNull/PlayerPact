<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EChatUser implements FInterface {

        private $id;
        private $chatId;
        private $userId;
        private $datetime;

        public function __construct(int $chatId,int $userId,string $datetime) {
            $this->id = 0;
            $this->chatId = $chatId;
            $this->userId = $userId;
            $this->datetime = $datetime;
        }

        public function getValues(){
            $v = array(
                "id" => $this->id,
                "chatId" => $this->chatId,
                "userId" => $this->userId,
                "datetime" => $this->datetime
            );
            return $v;
        }
    }
?>