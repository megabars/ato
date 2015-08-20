<?php
/**
 * Created by PhpStorm.
 * User: mikhail
 * Date: 27.02.15
 * Time: 18:15
 */

class SocialType extends Reference{

    const TWITTER = 'twitter';
    const VK = 'vk';
    const FB = 'fb';

    const TWITTER_NAME = 'Твиттер';
    const VK_NAME = 'Вконтакте';
    const FB_NAME = 'Фейсбук';

    function __construct()
    {
        $this->list = array(
            self::TWITTER => self::TWITTER_NAME,
            self::VK => self::VK_NAME,
            self::FB => self::FB_NAME,
        );
    }
}