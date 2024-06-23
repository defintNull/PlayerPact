<?php
require_once realpath(__DIR__."/../view/VError.php");

/**
 * Manage the showing of the error pages
 *
 * Manages the call to the VError view methods to show error pages.
 *
 * @package Playerpact\Controllers
 */
class CError
{
    /**
     * Show error 404 page
     *
     * Shows error 404 page calling VError->show.
     * 
     */
    public function e404()
    {
        $view = new VError();
        $view->show();
    }
}
