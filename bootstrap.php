<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php");
    use Smarty\Smarty;

    class SmartyLoader {
        static function loadSmarty(){
            $smarty = new Smarty();
            $smarty->setTemplateDir($_SERVER["DOCUMENT_ROOT"].'/resources/Smarty/templates/');
            $smarty->setCompileDir($_SERVER["DOCUMENT_ROOT"].'/resources/Smarty/templates_c/');
            $smarty->setConfigDir($_SERVER["DOCUMENT_ROOT"].'/resources/Smarty/configs/');
            $smarty->setCacheDir($_SERVER["DOCUMENT_ROOT"].'/resources/Smarty/cache/');
            return $smarty;
        }
    }

    $GLOBALS['DB_HOST'] = 'localhost';
    $GLOBALS['DB_USER_NAME'] = 'playerpact';
    $GLOBALS['DB_PASSWORD'] = '';
    $GLOBALS['DB_NAME'] = 'my_playerpact';
?>