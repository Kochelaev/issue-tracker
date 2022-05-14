<?php

namespace Controllers;

use Smarty;

abstract class BaseController
{
    protected $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('../views/');
        $this->smarty->setCompileDir('../compile/');
        $this->smarty->setConfigDir('../configs/');
        $this->smarty->setCacheDir('../cache/');
    }
}
