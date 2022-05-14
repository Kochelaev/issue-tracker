<?php

namespace App;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

class Auth extends Singleton
{
    //стоит ли инкапсулировать? похоже что стоит, иначе рискуем вызвать destruct
    private $capsule;

    protected function __construct()
    {
        $GLOBALS['capsule'] = new Capsule;
        $GLOBALS['capsule']->addConnection([     // вставь getEnv
            'driver'    => 'mysql',
            'host'      => 'issue-tracker-mysql',
            'database'  => 'tracker',
            'username'  => 'root',
            'password'  => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);
        $GLOBALS['capsule']->bootEloquent();
    }

    public static function __callStatic($method, $args)
    {
        self::getInstance();
        return forward_static_call_array(array('Sentinel', $method), $args);
        // не факт что работает.
    }
}
