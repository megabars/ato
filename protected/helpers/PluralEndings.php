<?php

class PluralEndings
{
    public static function getEnding($count, $first, $second, $third)
    {
        $symbols = abs($count) % 100;
        $module = $count % 10;

        if ($symbols > 10 && $symbols < 20)
            return $third;

        if ($module > 1 && $module < 5)
            return $second;

        if ($module == 1)
            return $first;

        return $third;
    }
}