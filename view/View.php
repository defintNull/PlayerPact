<?php

/**
 * Load parameters for smarty
 *
 * Load parameters for smarty passed with array key=>value
 *
 * @package Playerpact\View
 */
class View
{
    protected $smarty;
    protected $params;

    /**
     * Load smarty instance
     *
     * Load smarty instance
     *
     */
    public function __construct()
    {
        $this->smarty = SmartyLoader::loadSmarty();
    }

    /**
     * Assign smarty parameters
     *
     * Assign smarty parameters cycling the array key=>value
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    protected function assignSmartyParams(array $params)
    {
        foreach ($params as $key => $val) {
            $this->smarty->assign($key, $val);
        }
    }
}
