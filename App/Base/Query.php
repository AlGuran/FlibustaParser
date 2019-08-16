<?php
namespace Base;

class Query {
    
    protected $_data;
    protected $_query;
    
    /**
     * @param string $sQuery
     * @param mixed $data
     * @return object
     */
    public function __construct ($sQuery, array $data = array ())
    {
        $this->_query = $sQuery;
        $this->_data = $data;
    }

    /**
     * @param string $sQuery
     * @param mixed $data
     * @return string
     */
    public static function instance ($sQuery, array $data = array ())
    {
        return new self ($sQuery, $data);
    }

    /**
     * @return mixed
     */
    public function getData ()
    {
        return $this->_data;
    }

    /**
     * @return string
     */
    public function getQuery ()
    {
        return $this->_query;
    }

    /**
     * @desc Заменяет параметры запроса на переданные значения
     * @return string
     */
    public function translate ()
    {
        foreach ($this->_data as $key => $value){
            $this->_query = str_replace('?'.$key, $this->_quote($value), $this->_query);
        }
        return $this->_query;
    }
    
    /**
     * @desc Обработка параметров для запроса
     * @param mixed $value
     * @return mixed
     */
    protected function _quote ($value)
    {
        if (is_array($value)){
            return \pg_escape_string (implode(',', $value));
        }
        if (is_null ($value)){
            return 'NULL';
        }
        if(is_string ($value)){
            return "'". \pg_escape_string ($value) . "'";
        }
        if (is_int ($value) || is_float ($value)){
            return $value;
        }
        return '';

    }

    /**
     * @return string
     */
    function __toString() {
        return $this->translate ();
    }
}
