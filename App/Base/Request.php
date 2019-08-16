<?php
namespace Base;

class Request
{
    /**
     * @desc Получить текущий хост.
     * @return Ambigous <string, NULL>
     */
    public static function host ()
    {
        return $_SERVER ['HTTP_HOST'] ?? null;
    }

    /**
     * @desc Получение параметра GET.
     * @param string $name Имя параметра
     * @param mixed $default Значение по умолчанию
     * @return mixed
     */
    public static function get ($name, $default = false)
    {
        return $_GET [$name] ?? $default;
    }

    /**
     * @desc Проверяет, что скрипт был вызван через консоль.
     * @return boolean true, если скрипт был вызван из командной строки,
     * иначе - false.
     */
    public static function isConsole ()
    {
        return isset ($_SERVER ['argv'], $_SERVER ['argc']);
    }

    /**
     * @desc Проверяет, переданы ли GET параметры.
     * @return boolean
     */
    public static function isGet ()
    {
        return !empty ($_GET);
    }

    /**
     * @desc Проверяет, что это был POST запрос
     * @return boolean
     */
    public static function isPost ()
    {
        return (isset ($_SERVER ['REQUEST_METHOD']) && $_SERVER ['REQUEST_METHOD'] == 'POST');
    }

    /**
     * @desc Возвращает часть адреса.
     * @param boolean $without_get если TRUE, то возвращает часть URI до знака "?", иначе весь URI
     * @return string
     */
    public static function uri ($without_get = true)
    {
        if (!isset ($_SERVER ['REQUEST_URI'])){
            return '/';
        }

        $url = $_SERVER ['REQUEST_URI'];

        if ($without_get){
            $p = strpos ($url, '?');
            if ($p !== false){
                return substr ($url, 0, $p);
            }
        }
        return $url;
    }

    /**
     * @desc Возвращает часть запроса GET
     * @return string Часть URI после знака "?"
     */
    public static function stringGet ()
    {
        if (!isset ($_SERVER ['REQUEST_URI'])){
            return '';
        }

        $url = $_SERVER ['REQUEST_URI'];
        $p = strpos ($url, '?');

        if ($p !== false){
            return substr ($url, $p + 1);
        }

        return '';
    }
}
