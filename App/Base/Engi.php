<?php
namespace Base;
class Engi {

    const FOREIGN_KEY_DELIMITER = '__';
    protected static $_pathes    = [

    ];

    protected static $_root;

    /**
     * @desc Возвращает значени, присвоенное $_root (записывается полный путь к рабочей папке)
     * @return string
     */
    public static function root ()
    {
        if (func_num_args () == 1){
            self::$_root = func_get_arg (0);
        }
        return self::$_root;
    }

    /**
     * @desc Добавляет путь для поиска классов из папки проекта
     * @param string $path
     * @return void
     */
    public static function addPath ($path)
    {
        self::$_pathes [$path] = $path;
    }

    /**
     * @desc Удаояет путь для поиска классов из папки проекта
     * @param string $path
     * @return void
     */
    public static function removePath ($path)
    {
        if (isset (self::$_pathes [$path])){
            unset (self::$_pathes [$path]);
        }
    }

    /**
     * @desc Формирует путь к классу из его названия
     * @param string $path название класса
     * @param string $extension расширение файла
     * @return string
     */
    public static function path ($path,$extension = '.php')
    {
        $result = str_replace (['_', '\\'], '/', $path);

        if (empty ($result)){
            return $result;
        }

        if (empty ($extension)){
            return $result;
        }

        if (substr ($result, -1) == '/'){
            return $result;
        }
        
        return $result . $extension;
    }

    /**
     * @desc Функция автозагрузки классов
     * @param string $class название класса
     * @return void
     */
    public static function load ($class)
    {
        $path = \Base\Engi::path ($class);

        foreach (self::$_pathes as $v){
            $file = \Base\Engi::root () . $v . $path;
            
            if (is_file ($file)){
                require_once $file;
                return;
            }
        }
    }

}
