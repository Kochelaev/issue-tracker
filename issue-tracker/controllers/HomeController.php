<?php

namespace Controllers;

use Models\Issue;

class HomeController extends BaseController
{

    public function main()
    {
        Issue::hello();
        $this->smarty->display('index.tpl');
    }
    
    public function actionNews()
    {

    }
}