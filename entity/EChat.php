<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EChat implements FInterface {

        private $id;
        private $postId;
        private $postType;
        private $datetime;

        public function __construct(int $id = 0, int $postId, string $postType,string $datetime) {
            $this->id = $id;
            $this->postId = $postId;
            $this->postType = $postType;
            $this->datetime = $datetime;
        }

        public function getId() {
            return $this->id;
        }

        public function getPostId() {
            return $this->postId;
        }

        public function getPostType() {
            return $this->postType;
        }

        public function getDateTime() {
            return $this->datetime;
        }

        public function getValues(){
            $v = array(
                "id" => $this->id,
                "postId" => $this->postId,
                "postType" => $this->postType,
                "datetime" => $this->datetime
            );
            return $v;
        }
        
    }
?>