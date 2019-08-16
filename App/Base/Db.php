<?php
namespace Base;

require_once __DIR__.'/../../Config/db_cfg.php';

class Db {
    
    protected static $_instance = null;
    
    /**
     * @desc Возвращает ресурс соединения с базой
     * @return resource
     */
    public static function instance ()
    {
        if (self::$_instance)
        {
            return self::$_instance;
        }

        $connection_string = "host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASSWORD."";
        try
        {
            self::$_instance = \pg_connect ($connection_string);
        }
        catch (\Exception $e)
        {
           die ("BD connect error!: " . $e->getMessage() . "<br/>");
        }
        return self::instance ();
    }
    
    /**
     * @desc Возвращает ресурс результата запроса
     * @param string $query SQL запрос к базе
     * @return resource
     */
    public static function query ($query)
    {
        $result     = \pg_query (self::instance (), $query);
        if ($result === FALSE)
        {
            $error = \pg_last_error (self::instance ());
            throw new \Exception ("\n" . $query->translate () . "\n" . $error . "\n");
        }
        return $result;
    }
    
    /**
     * @desc Возвращает ассоциативный массив результата запроса
     * @param resource $result ресурс результата запроса
     * @return mixed
     */
    public static function _assoc($result){
        while ($row = pg_fetch_assoc($result)) {
            $data[] = $row;
        }
        
        return $data;
    }
    
    /**
     * @desc Возвращает первую запись результата запроса
     * @param resource $result ресурс результата запроса
     * @return mixed
     */
    public static function _result($result){
        $data = pg_fetch_result($result, 0, 0);
        
        return $data;
    }
}