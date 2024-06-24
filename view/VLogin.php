<?php

require_once realpath(__DIR__."/../view/View.php");

/**
 * Manage View layer of Login sections
 *
 * Manage the View layer of Login sections configuring Smarty
 * and passing parameters for the html template
 *
 * @package Playerpact\View
 */
class VLogin extends View
{
    /**
     * Show Login section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function show(string $check = "true", $date = "")
    {
        $this->smarty->assign("check", $check);
        $this->smarty->assign("banDate", $date);
        $this->smarty->display("login/login.html");
    }

    /**
     * Show Registration section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function registration($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("login/registration.html");
    }
}
