<?php

require_once('vendor/autoload.php');

use App\Database;
use Phpmig\Adapter;
use Pimple\Container;
use josegonzalez\Dotenv\Loader;

(new Loader('.env'))->parse()->putenv();

$container = new Container();

$container['db'] = function () {
    
    $dbh = Database::getInstance()->getPdo();
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
};

$container['phpmig.adapter'] = function ($c) {
    return new Adapter\PDO\Sql($c['db'], 'migrations');
};

$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

return $container;






// return new ArrayObject(
//     [
//         [
//             'phpmig.migrations_path' => __DIR__ . DIRECTORY_SEPARATOR . 'migrations',
//             'phpmig.adapter'         => new Adapter\PDO\Sql($sql, 'migrations'),
//             'db'                     => $sql
//         ]
//     ]
// );
