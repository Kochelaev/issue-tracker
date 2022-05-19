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
        if (Auth::guest()) throw new \Error('У Вас недостаточно прав');
    }

    public function updateForm()
    {
        $model = new Issue();
        $issue = $model->find(intval($_GET['id']));
        if (empty($issue))
            throw new \Error('нет такой задачи');

        $this->smarty->assign('issue', $issue);
        $this->smarty->display('admin/updateform.tpl');
    }

    public function update()
    {
        Validator::CheckPostMethod();

        $request = (new Validator())->prepareRequst()->getRequest();
        $updateData = array_merge(
            $request,
            ['updated_by' => Auth::check()->id]
        );

        $issue = new Issue();
        if (empty($issue))
            throw new \Error('попытка изменить не существующую задачу');

        $issue->update($_GET['id'], $updateData);

        Route::redirect();
    }
}
