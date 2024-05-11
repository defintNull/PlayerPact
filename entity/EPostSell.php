<?php
    class EPostSell extends EPost {
        
        private $price;
        private $image;
        
        public function getValues() {
            $v = parent::getValues();
            $v["price"] = $this->price;
            $v["image"] = $this->image;
            return $v;
        }
    }
?>