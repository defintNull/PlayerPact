<?php
    class EText {

        private $id;
        private $description;
        private $date;
        private $time;

        public function getValues() {
            $v = array(
                "description" => $this->description,
                "date" => $this->date,
                "time" => $this->time
            );
            return $v;
        }
    }
?>
