<?php
class View
{
    protected $smarty;
    protected $params;

    public function __construct()
    {
        $this->smarty = SmartyLoader::loadSmarty();
    }

    protected function assignSmartyParams(array $params)
    {
        foreach ($params as $key => $val) {
            $this->smarty->assign($key, $val);
        }
    }
}
?>