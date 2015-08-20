<?php

/**
 * Enum - Класс для работы всех сущностей типа "Gallery"
 * Class GalleryType
 */
class GalleryType extends Reference
{
    const PHOTO = 1;
    const VIDEO = 2;
    const AUDIO = 3;
    const FILE = 4;


    function __construct()
    {
        $this->list = array(
            self::PHOTO         => 'Фотогалерея',
            self::VIDEO         => 'Видеогалерея',
            self::AUDIO         => 'Аудиогалерея',
            self::FILE          => 'Галерея файлов',

        );

//        $this->class = array(
//            self::DEF       => 'StaticPage',
//            self::EVENT           => 'Event',
//            self::THEMES       => 'Themes',
//        );
    }
}