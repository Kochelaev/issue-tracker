<?php

namespace App;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

class Auth extends Singleton
{
    protected function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([     // вставь getEnv
            'driver'    => 'mysql',
            'host'      => 'issue-tracker-mysql',
            'database'  => 'tracker',
            'username'  => 'root',
            'password'  => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);
        $capsule->bootEloquent();
        Sentinel::disableCheckpoints();
    }

    public static function __callStatic($method, $args)
    {
        self::getInstance();
        return forward_static_call_array(array(Sentinel::class, $method), $args);
    }
}
