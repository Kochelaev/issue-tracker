<?php

namespace Controllers;

use App\Auth;
use App\Cookier;
use App\Route;

class AuthController extends BaseController
{
    public function authform()
    {
        if (Auth::guest())
            $this->smarty->display('auth/authform.tpl');
        else Route::redirect();
    }

    public function login()
    {
        $credentials = [
            'email'    => $_POST['email'],
            'password' => $_POST['password'],
        ];
        if (Auth::forceAuthenticateAndRemember($credentials)) 
            Route::redirect();
        else {
            Cookier::setWarning('Неверный логин или пароль');
            Route::redirectBack();
        }
    }

    public function logout()
    {
        Auth::logout();
        Route::redirectBack();
    }
}
