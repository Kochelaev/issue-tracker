<?php

namespace Controllers;

use App\Auth;
use App\Paginator;
use App\Route;
use Models\Issue;
use Error;      // перенеси

class IssueController extends BaseController
{
    public function list()
    {
        $model = new issue();
        $issues = $model->getForPage($_GET['page'], $_GET['sort']);
        $paginator = new Paginator($model->getCount(), $_GET['page'], getenv('PER_PAGE'));
        if (($paginator->getPagesCount()) < ($_GET['page']) || $_GET['page'] < 0)
            throw new Error('нет такой страницы');      //желательно делегировать проверку какому-либо классу 
        $this->smarty->assign('issues', $issues)
            ->assign('paginator', $paginator->getBootstrapLinks())
            ->display('issue/list.tpl');
    }

    public function display()
    {
        $model = new Issue();
        if (!$issue = $model->find(intval($_GET['id'])))
            throw new Error('нет такой задачи');    //желательно делегировать проверку какому-либо классу 
        $this->smarty->assign('issue', $issue);
        $this->smarty->display('issue/display.tpl');
    }

    public function addForm()
    {
        $this->smarty->display('issue/addform.tpl');
    }

    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $issue = new Issue();
            $issue->insert($_POST);
        } else throw new Error('тут нужен метод POST');
        Route::redirect();
    }
}
