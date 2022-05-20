<?php

namespace Controllers;

use App\Auth;
use App\Paginator;
use App\Route;
use App\Validator;
use Models\Issue;

class IssueController extends BaseController
{
    public function list()
    {
        $perPage = getenv('PER_PAGE');
        $model = new issue();
        $issues = $model->getForPage($_GET['page'], $_GET['sort'], $perPage);

        $paginator = new Paginator($model->getCount(), $_GET['page'], $perPage);
        if (($paginator->getPagesCount()) < ($_GET['page']) || $_GET['page'] < 0)
            throw new \Exception('нет такой страницы');                                 //может стоило делегировать проверки отдельному классу?

        $view = Auth::check()? 'admin/issue/list.tpl': 'issue/list.tpl';            
        $this->smarty->assign('issues', $issues)
            ->assign('paginator', $paginator->getBootstrapLinks())
            ->display($view);
    }

    public function display()
    {
        $model = new Issue();
        $issue = $model->find(intval($_GET['id']));

        if (empty($issue))
            throw new \Exception('нет такой задачи');

        $this->smarty->assign('issue', $issue)
            ->display('issue/display.tpl');
    }

    public function addForm()
    {
        $this->smarty->display('issue/addform.tpl');
    }

    public function post()
    {
        Validator::CheckPostMethod();
        $request = (new Validator())->prepareRequst()->getRequest();
        $request['updated_by'] = null;

        $issue = new Issue();
        $issue->insert($request);

        Route::redirect();
    }
}
