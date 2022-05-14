<?php



require_once '../vendor/autoload.php';

// spl_autoload_register(function ($classname) {
//     require_once('../' . str_replace("\\", "/", "$classname.php"));
// });

(new josegonzalez\Dotenv\Loader('../.env'))
    ->parse()->putenv();
