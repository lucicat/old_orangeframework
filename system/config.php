<?php
class Config extends Load
{
	private static $config_file = false;
	
	public function __construct()
	{
		
	}
	
	public function load_conf_file()
	{
		if(!file_exists(APPPATH.'config'.DS.'config'.EXT))
		{
			trigger_error('Отсутствует конфигурационный файл...(');
		}
		else
		{
			$config = array();
			require_once(APPPATH.'config'.DS.'config'.EXT);
			if(count($config)>0)
			{
				self::$config_file = $config;
				unset($config);
			}
			else
			{
				trigger_error('Неправильно оформлен файл конфигурации');
			}
		}
	}
	
	public function confFile($act='')
	{
		
		if(isset(self::$config_file))
		{
			if(empty($act))
			{
				return self::$config_file;
			}
			else
			{
				return self::$config_file[$act];
			}
		}
		else
		{
			return false;
		}
	}
	
	
}
?>