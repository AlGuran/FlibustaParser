<?php

require_once './bootstrap.php';

const SEPARATOR = '/';

$params = array();

foreach ($_SERVER ['argv'] as $i => $v){
    switch($i){
        case '0':
            break;
        case '1':
            if(strpos($v, SEPARATOR)){
                list($class,$action) = explode(SEPARATOR, $v);
            }else{
                $class = $v;
                $action = 'index';
            }
            break;
        default:
            list ($k,$v) = explode ("=",$v);
            if ($k && $v){
                $params [$k] = $v;
            }
    }
}

$class::$action($params);