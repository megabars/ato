<?php

/**
 * Ковертируем размер файлов в человеческий вид
 * Class Filesize
 */
class Filesize
{
    static public function format_size($size) {
        $units = explode(' ','B KB MB GB TB PB');
        $mod = 1024;

        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
        }

        $endIndex = strpos($size, ".")+3;

        return substr( $size, 0, $endIndex).' '.$units[$i];
    }
}