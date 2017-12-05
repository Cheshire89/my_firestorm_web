<?php 

session_start();

date_default_timezone_set('America/Denver');

//error_reporting(E_ALL);
error_reporting(E_ERROR);

ini_set('display_errors', 1);
ini_set('log_errors','On');
ini_set ('error_log' , './php_error.log' );

$host = $_SERVER['HTTP_HOST'];

//print($host);
//a2plcpnl0562.prod.iad2.secureserver.net:2083

switch($host) {
    case "23.239.222.27":
    case "www.myfirestorm.com":
    case "myfirestorm.com":
        define("DBSERVER", "localhost");
        define("DBUSER", "myfirest_main");
        define("DBPASS", "I4igrR.6%y!K");
        define("DBNAME", "myfirest_main");
        break;
    case "coloradowebsite.design":
    case "www.coloradowebsite.design":
    case "www.coloradoweb.design":
    case "coloradoweb.design":
        define("DBSERVER", "localhost");
        define("DBUSER", "myfirestorm");
        define("DBPASS", "I4igrR.6%y!K");
        define("DBNAME", "myfs_db");
        break;
    default:
        define("DBSERVER", "127.0.0.1");
        define("DBUSER", "Cheshire89");
        define("DBPASS", "Sasha446");
        define("DBNAME", "mfsdb");
}

function __autoload($class){
	require_once('classes/class.'.$class.'.php');
}

?>