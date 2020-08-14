<?php


namespace App\Utils;


class Helpers
{
    public static function convertHourToMinute(String $hour): string
    {
        $array = explode(":", $hour);
        $minutes = ($array[0] * 60) + $array[1];

        return $minutes;
    }
}
