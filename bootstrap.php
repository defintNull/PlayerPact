<?php
    require_once realpath(__DIR__."/vendor/autoload.php");
    use Smarty\Smarty;

    class SmartyLoader {
        static function loadSmarty(){
            $smarty = new Smarty();
            $smarty->setTemplateDir(__DIR__.'/resources/Smarty/templates/');
            $smarty->setCompileDir(__DIR__.'/resources/Smarty/templates_c/');
            $smarty->setConfigDir(__DIR__.'/resources/Smarty/configs/');
            $smarty->setCacheDir(__DIR__.'/resources/Smarty/cache/');
            return $smarty;
        }
    }

    $GLOBALS['DB_HOST'] = 'localhost';
    $GLOBALS['DB_USER_NAME'] = 'playerpact';
    $GLOBALS['DB_PASSWORD'] = '';
    $GLOBALS['DB_NAME'] = 'my_playerpact';
?>