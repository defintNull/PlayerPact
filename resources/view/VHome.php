<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");

    class VHome {
        private $smarty;
        private $params;

        public function loadParams(array $params) {
            $this->params = $params;
        }

        public function show() {
            $this->smarty = SmartyLoader::loadSmarty();
            foreach($this->params as $key => $val){
                $this->smarty->assign($key, $val);
            }
            $this->smarty->display("home.html");
        }
    }
?>