<?php
header ('Content-Type: text/html; charset=utf-8');
require './App/Base/Engi.php';

spl_autoload_register ('\\Base\\Engi::load');

\Base\Engi::root (realpath (dirname (__FILE__)) . '/');
\Base\Engi::addPath ('App/');

//error_reporting (0);
//ini_set ('display_startup_errors',0);
//ini_set ('display_errors',0);

