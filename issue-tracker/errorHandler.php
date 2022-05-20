<?php

set_error_handler(function ($errno, $errstr) {
    if ($errno === E_WARNING) {
        trigger_error($errstr, E_ERROR);
        throw new Exception('E_WARNING: что то пошло не так!');
        return true;
    } else return false;
});
