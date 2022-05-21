<?php

use App\Auth;
use Phpmig\Migration\Migration;

class CreateSentinelTables extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = file_get_contents('vendor/cartalyst/sentinel/schema/mysql-5.6+.sql');
        $container = $this->getContainer();
        $container['db']->query($sql);

        Auth::register(array(
            'email'    => 'admin',
            'password' => '123',
        ));

        Auth::register(array(
            'email'    => 'Василий',
            'password' => '321',
        ));
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS 
            activations,
            persistences,
            reminders,
            roles,
            role_users,
            throttle,
            users;
        ";

        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
