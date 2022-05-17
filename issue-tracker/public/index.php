<?php

require_once '../vendor/autoload.php';

use App\Route;
use josegonzalez\Dotenv\Loader;

(new Loader('../.env'))->parse()->putenv();

// set_error_handler(function ($errno, $errstr) {
//     if ($errno === E_WARNING) {
//         trigger_error($errstr, E_ERROR);
//         throw new Error('E_WARNING!');
//         return true;
//     } else return false;
// });

// try {
//     ob_start();
    Route::findActionForURI('Issue', 'list');
// } catch (Error $t) {
//     ob_clean();
//     echo ('ой, вы что то сломали<br>');
//     die($t->getMessage());
// } finally {
//     restore_error_handler();
// }
