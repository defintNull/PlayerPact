<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");

    class EParticipation implements FInterface{
        private $id;
        private $userId;
        private $teamPostId;

        public function __construct($userId, $teamPostId) {
            $this->id = 0;
            $this->userId = $userId;
            $this->teamPostId = $teamPostId;
        }

        public function getValues() {
            $v = array(
                "id" => $this->id,
                "userId" => $this->userId,
                "teamPostId" => $this->teamPostId
            );
            return $v;
        }
        
    }
?>