<?php

/**
 * Основной класс для работы всех enums
 * Class Reference
 */
abstract class Reference
{
    public $list;

    static protected $instances = array();

    protected function __construct()
    {
        $this->list = array();
    }

    public function asString($index)
    {
        if (!$this->isValid($index))
            return '';

        return $this->list[$index];
    }

    public function asIndex($value)
    {
        $value = MB_Helper::mb_ucfirst(mb_convert_case($value, MB_CASE_LOWER, 'utf-8'));

        return (int)array_search($value, $this->list);
    }

    public function isValid($index)
    {
        return array_key_exists($index, $this->list);
    }

    /**
     * Возвращает объект данного класса
     * @param null $class_name
     * @return Reference
     */
    final public static function instance($class_name = null)
    {
        !is_null($class_name) or $class_name = get_called_class();

        if (!isset(self::$instances[$class_name]))
            self::$instances[$class_name] = new $class_name();

        return self::$instances[$class_name];
    }
}