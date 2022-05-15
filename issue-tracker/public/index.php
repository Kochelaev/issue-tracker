<?php

require_once '../vendor/autoload.php';

use App\Route;
use josegonzalez\Dotenv\Loader;

(new Loader('../.env'))->parse()->putenv();

$foo = 'foo';
unset($foo);
print_r($foo);

Route::findActionForURI('Issue', 'list');

