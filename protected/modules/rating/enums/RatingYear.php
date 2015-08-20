<?php
/**
 * Created by PhpStorm.
 * User: mikhail
 * Date: 27.02.15
 * Time: 18:15
 */

class RatingYear extends Reference{


    function __construct()
    {
        $this->list = array(
            2013 => 2013,
            2014 => 2014,
            2015 => 2015,
        );
    }
}