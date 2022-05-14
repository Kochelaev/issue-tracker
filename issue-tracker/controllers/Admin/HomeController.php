<?php

namespace Controllers\Admin;

use Controllers\BaseController;

class HomeController extends BaseController
{

    public function main()
    {
        echo "ADMIN";
        
        $this->smarty->display('index.tpl');
    }
    
    public function actionNews()
    {

    }
}