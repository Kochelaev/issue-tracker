<?php

namespace Controllers;

use Models\Issue;
use Controllers\BaseController;
use App\Auth;

class IssueController extends BaseController
{
    public function list()
    {
        // echo "user voshel <pre>"; print_r(Auth::check());
        // echo "</pre>";
        $model = new issue();
        $issues = $model->getForPage($_GET['page']);
        $this->smarty->assign('issues', $issues);//->assign('warning', 'warning!');
        $this->smarty->display('issue/list.tpl');
    }

    public function display()
    {
        echo __METHOD__;
    }
    
    public function addForm()
    {
        echo __METHOD__;
    }

    public function post()
    {
        echo __METHOD__;
    }
}