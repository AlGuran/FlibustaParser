<?php
namespace Base;

class Curl {
    
    /**
     * @desc Возвращает html код страницы
     * @param string $url URL страницы
     * @return string
     */
    public static function index($url)
    {
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec($ch); 
        curl_close($ch); 
        return $result;
    }
}