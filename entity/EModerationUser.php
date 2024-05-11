<?php
    class EModerationUser extends EModeration {
        
        private $banTime;

        public function getValues() {
            $v = parent::getValues();
            $v["banTime"] = $this->banTime;
            return $v;
        }

    }
?>