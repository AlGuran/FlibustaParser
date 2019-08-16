<?php
namespace Base;
class Engi {

    const FOREIGN_KEY_DELIMITER = '__';
    protected static $_pathes    = [

    ];

    protected static $_root;

    public static function root ()
    {
        if (func_num_args () == 1)
        {
            self::$_root = func_get_arg (0);
        }
        return self::$_root;
    }

    public static function addPath ($path)
    {
        self::$_pathes [$path] = $path;
    }

    public static function removePath ($path)
    {
        if (isset (self::$_pathes [$path]))
        {
            unset (self::$_pathes [$path]);
        }
    }

    public static function path ($path,$extension = '.php')
    {
        $result = str_replace (['_', '\\'], '/', $path);

        if (empty ($result))
        {
            return $result;
        }

        if (empty ($extension))
        {
            return $result;
        }

        if (substr ($result, -1) == '/')
        {
            return $result;
        }
        return $result . $extension;
    }

    public static function load ($class)
    {
        $path = \Base\Engi::path ($class);

        foreach (self::$_pathes as $v)
        {
            $file = \Base\Engi::root () . $v . $path;
            
            if (is_file ($file))
            {
                require_once $file;
                return;
            }
        }
    }

}
