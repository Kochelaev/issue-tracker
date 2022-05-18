<?php

namespace Controllers\Admin;

use App\Auth;
use Controllers\BaseController;
use Models\Issue;

class IssueController extends BaseController
{
    public function __construct()
    {
        if (Auth::guest()) throw new \Error('У Вас недостаточно прав');
    }

    public function updateForm()
    {
        $arr = [
            'email' => 'test@mail.ru',
            'name'  => 'Васиииилий',
            'ordered_by' 
        ];
        $issue = new Issue();
        print_r($issue->update($_GET['id'], $arr));
    }

    public function update() 
    {
        echo __METHOD__;
    }
}