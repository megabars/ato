<?php

class PublicType extends Reference {

    function __construct(){

        $this->list = array(
            '' => 'Показать все',
            1 => 'Да',
            0 => 'Нет',
        );
    }
}