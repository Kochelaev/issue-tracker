<?php

require_once '../vendor/autoload.php';
require_once '../errorHandler.php';

use App\Route;
use App\Cookier;
use josegonzalez\Dotenv\Loader;

(new Loader('../.env'))->parse()->putenv();

ob_start();

// try {
    Route::findActionForURI('Issue', 'list');
// } catch (Exception $e) {
//     ob_clean();
//     Cookier::setWarning($e->getMessage());
//     Route::redirect();
// }
