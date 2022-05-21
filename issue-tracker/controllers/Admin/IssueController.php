<?php

namespace Controllers\Admin;

use App\Auth;
use App\Route;
use App\Validator;
use Controllers\BaseController;
use Models\Issue;

class IssueController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if (Auth::guest()) throw new \Exception('У Вас недостаточно прав');
    }

    public function updateForm()
    {
        $model = new Issue();
        $issue = $model->find(intval($_GET['id']));
        Validator::issueExist($issue);

        $this->smarty->assign('issue', $issue);
        $this->smarty->display('admin/issue/updateform.tpl');
    }

    public function update()
    {
        Validator::CheckPostMethod();

        $request = (new Validator())->prepareIssueRequst()->getRequest();
        $updateData = array_merge(
            $request,
            ['updated_by' => Auth::check()->id],
        );

        $issueModel = new Issue();
        $issue = $issueModel->find($_GET['id']);
        Validator::issueExist($issue);

        $issueModel->update($_GET['id'], $updateData);

        Route::redirect();
    }
}
