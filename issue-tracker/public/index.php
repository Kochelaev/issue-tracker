<?php

require_once '../vendor/autoload.php';

use App\Route;
use App\Auth;
use Models\Issue;
use josegonzalez\Dotenv\Loader;

(new Loader('../.env'))->parse()->putenv();




Route::findActionForURI('Issue', 'list');

// $issue = new Issue();
echo "<pre>";
print_r($_SERVER);
// print_r(
// $issue->getForPage()
// );
// Auth::register([
//     'email'    => 'auth2',
//     'password' => '123',
// ]);
