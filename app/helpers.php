<?php


/**
 * Функции помощи
 */

if (! function_exists('toDateFormat')) {

    function toDateFormat(string $date)
    {
        $date = new \Carbon\Carbon($date);
        return $date->format('d.m.Y');
    }
}


