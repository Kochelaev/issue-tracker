<?php

require_once '../vendor/autoload.php';

use App\Route;
use josegonzalez\Dotenv\Loader;

(new Loader('../.env'))->parse()->putenv();

Route::findActionForURI('Issue', 'list');
