<?php
	
set_include_path(SYSPATH);

require_once("functions.php");
require_once("load.php");

clear_uri();



$LOAD = new Load();

$CONF = $LOAD->load_class('config');
$CONF->load_conf_file();

if($CONF->confFile('db'))
{
	$LOAD->load_class('dbquery','db_classes'.DS,false);
	$DB = $LOAD->load_class('dbclass','db_classes'.DS,false,1);
}
$LOAD->load_class('autoload');

$LOAD->load_class('charset');

$XSS = $LOAD->load_class('security');


//$LOAD->load_class('input',true);

/*
load_class('session');
*/
$URI = $LOAD->load_class('uri');

$controller = $LOAD->load_class('ao_controller',false,0);

$CHEK_CLASS = $LOAD->load_class('cheked_class_method');

$model = $LOAD->load_class('ao_model','',3);

$LOAD->load_class('run');


?>