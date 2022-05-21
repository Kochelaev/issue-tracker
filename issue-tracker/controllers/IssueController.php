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
        $issueModel = new issue();
        $issues = $issueModel->getForPage($_GET['page'], $_GET['sort'], $perPage);

        $paginator = new Paginator($issueModel->getCount(), $_GET['page'], $perPage);
        Validator::pageExist($_GET['page'], $paginator->getPagesCount());

        $view = Auth::check() ? 'admin/issue/list.tpl' : 'issue/list.tpl';
        $this->smarty->assign('issues', $issues)
            ->assign('paginator', $paginator->getBootstrapLinks())
            ->display($view);
    }

    public function display()
    {
        $issueModel = new Issue();
        $issue = $issueModel->find(intval($_GET['id']));
        Validator::issueExist($issue);

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
        $request = (new Validator())->prepareIssueRequst()->getRequest();
        $request['updated_by'] = null;

        $issueModel = new Issue();
        $issueModel->insert($request);

        Route::redirect();
    }
}
