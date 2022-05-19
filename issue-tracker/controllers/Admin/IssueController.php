<?php

namespace Controllers\Admin;

use App\Auth;
use App\Route;
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
            throw new \Error('нет такой задачи');    //желательно делегировать проверку какому-либо классу 
        $this->smarty->assign('issue', $issue);
        $this->smarty->display('admin/updateform.tpl');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $updateData = array_merge(
                $_POST,
                ['updated_by' => Auth::check()->id]
            );    
        } else throw new \Error('тут нужен метод POST');
        $issue = new Issue();
        $issue->update($_GET['id'], $updateData);
        Route::redirect();
    }
}
