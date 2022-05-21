<?php

namespace App;

class Cookier
{
    public static function setWarning(string $warning): void
    {
        @setcookie('warning', $warning, time() + 2, '/');
    }

    public static function fetchWarning()
    {
        $warning = $_COOKIE['warning'];
        
        @setcookie('warning', null, -1, '/');
        return $warning;
    }
}
