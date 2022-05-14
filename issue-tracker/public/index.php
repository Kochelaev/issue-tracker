<?php

require_once '../vendor/autoload.php';

use App\Route;
use App\Auth;
use Models\Issue;
use josegonzalez\Dotenv\Loader;

(new Loader('../.env'))->parse()->putenv();

Route::findActionForURI('Home', 'main');

$issue = new Issue();
echo "<pre>";
$data = [
    'email' => 'user@mail.ru',
    'title' => 'title',
    'description' => 'description',
];
$issue->insert($data);

// Auth::register([
//     'email'    => 'auth2',
//     'password' => '123',
// ]);
