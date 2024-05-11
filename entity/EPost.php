<?php
    class EPost {
        
        private $id;
        private $title;
        private $description;
        private $date;

        public function getValues() {
            $v = array(
                "title" => $this->title,
                "description" => $this->description,
                "date" => $this->date
            );
            return $v;
        }

    }
?>