<?php

    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");

    class VLogin {
        private $smarty;
        private $params;

        public function __construct() {
            $this->smarty = SmartyLoader::loadSmarty();
        }

        public function loadParams(array $params) {
            $this->params = $params;
        }

        public function show(string $check="true") {
            $this->smarty->assign("check",$check);
            $this->smarty->display("login.html");
        }

        public function registration($params) {
            $this->loadParams($params);
            foreach($this->params as $key => $val){
                $this->smarty->assign($key, $val);
            }
            $this->smarty->display("registration.html");
        }
    }
?>