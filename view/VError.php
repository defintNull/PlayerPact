<?php

require_once realpath(__DIR__."/../view/View.php");

/**
 * Manage View layer of Error sections
 *
 * Manage the View layer of Error sections configuring Smarty
 * and passing parameters for the html template
 *
 * @package Playerpact\View
 */
class VError extends View
{
    /**
     * Show Error section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function show()
    {
        $this->smarty->display("error/404.html");
    }
}
