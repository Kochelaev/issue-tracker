<?php

namespace Controllers;

use App\Auth;
use App\Paginator;
use Controllers\BaseController;
use Models\Issue;
use Error;

class IssueController extends BaseController
{
    public function list()
    {
        $model = new issue();
        $issues = $model->getForPage($_GET['page'], $_GET['sort']);
        $paginator = new Paginator($model->getCount(), $_GET['page'], getenv('PER_PAGE'));
        if (($paginator->getPagesCount()) < ($_GET['page']) || $_GET['page'] < 0 )
            throw new Error('нет такой страницы');      //желательно делегировать проверку какому-либо классу 
        $this->smarty->assign('paginator', $paginator->getBootstrapLinks());
        $this->smarty->assign('issues', $issues);
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