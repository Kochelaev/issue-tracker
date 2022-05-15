<?php

namespace Controllers;

use Smarty;
use App\Auth;
use App\Cookier;


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
        $this->smarty->assign('Auth', Auth::class);
        if ($warning = Cookier::fetchWarning())
            $this->smarty->assign('warning', $warning);
    }
}
