<?php

require_once('../autoload.php');
// require_once('../vendor/autoload.php');

use App\Route;
// use App\Database;

Route::findActionForURI('Home', 'main');

// $db = Database::getInstance();

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'issue-tracker-mysql',
    'database'  => 'tracker',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
]);

$capsule->bootEloquent();

// Register a new user
Sentinel::register([
    'email'    => 'us1er11441',
    'password' => 'ass1w1ord',
]);


