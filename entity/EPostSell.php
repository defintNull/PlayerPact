<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPost.php");
    
    class EPostSell extends EPost {
        
        private $price;
        private $image;

        public function __construct($id, $userId, $title, $description, $date, $price, $image) {
            parent::__construct($id,$userId,$title,$description,$date);
            $this->price = $price;
            $this->image = $image;
        }

        public function getPrice(){
            return $this->price;
        }
        
        public function getImage(){
            return $this->image;
        }

        public function getValues() {
            $v = parent::getValues();
            $v["price"] = $this->price;
            $v["image"] = $this->image;
            return $v;
        }
    }
?>