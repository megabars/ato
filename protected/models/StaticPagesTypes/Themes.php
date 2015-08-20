<?php
/**
 * author: Mikhail Matveev
 * Date: 01.12.14 
 */

class Themes extends StaticPage {

    public function init(){
        parent::init();

        $this->type_id = RecordType::THEMES;
    }

}