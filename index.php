<?php

$time_start = microtime();
define('PS',PATH_SEPARATOR);
define('DS',DIRECTORY_SEPARATOR);
//определение папки корня сайта
define('DIR_PATH_HOME',realpath(__DIR__).DS);

//выбирается какое расширение будет использоваться 
define('EXT','.php');
//определение переменых где указываются папки в которых находятся системные файлы или файлы приложения
$application = 'application';
$system	 = 'system';
$models_path = $application.DS.'models';
$views_path  = $application.DS.'views';
$controllers_path = $application.DS.'controllers';
error_reporting(E_ALL|E_STRICT);
function chek_path($name)
{
	if(is_dir(DIR_PATH_HOME.$name)){
		return DIR_PATH_HOME.$name;
	}
	else{
		echo "path error, [$name]";
	}
}
	$application = chek_path($application);
	$system = chek_path($system);
	$models_path = chek_path($models_path);
	$views_path = chek_path($views_path);
	$controllers_path = chek_path($controllers_path);

						
define('SYSPATH',realpath($system).DS);	
define('APPPATH',realpath($application).DS);
define('MODLPATH',realpath($models_path).DS);
define('VIEWPATH',realpath($views_path).DS);
define('CNTRPATH',realpath($controllers_path).DS);
unset($application);
unset($system);
unset($models_path);
unset($views_path);
unset($controllers_path);

include(SYSPATH.'core'.EXT);	






$time_end = microtime();
echo $time_start-$time_end;

?>