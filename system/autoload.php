<?php
class Autoload extends Load
{
	
	public $autoload_file;
	
	public function __construct()
	{
		$this->parse_autoload();
		$this->load_content();
	}
	private function load_content()
	{
		foreach($this->autoload_file as $name=>$list)
		{
			switch($name)
			{
				case 'libraries':
					$list_l = explode('|',$list);	
					if(empty($list_l) || empty($list_l[0])){break;}
					foreach($list_l as $key=>$names)
					{
						$this->library($names,true);
					}		
				break;
				case 'helpers':
					$list_h = explode('|',$list);
					if(empty($list_h) || empty($list_h[0])){break;}
					foreach($list_h as $key=>$names)
					{		     
						$this->helper($names);
					}
										
				break;
				case 'models':
					$list_m = explode('|',$list);
					if(empty($list_m) || empty($list_m[0])){break;}
					set_include_path(APPPATH.'models'.DS.';');
					foreach($list_m as $key=>$names)
					{
						$this->model($names,true);	
					}
										
				break;
			
				
			}			
		}
	}
	private function parse_autoload()
	{
		if(!file_exists(APPPATH.'config'.DS.'autoload'.EXT))
		{
			trigger_error('Не существует автозагрузочного файла...');
		}
		else
		{
			$autoload = array();
			require_once(APPPATH.'config'.DS.'autoload'.EXT);
			empty($autoload)?trigger_error('Оформите правильно файл автозагрузки...'):$this->autoload_file = $autoload;
			unset($autoload);
		}
	}
}

?>