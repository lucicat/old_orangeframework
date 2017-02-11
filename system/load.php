<?php
class Load
{
	public $modyles = array();

	private function runing_var_start($params)
	{
		$type = gettype($params);
			if($type==='array')
			{	
				foreach($params as $index => $var)
				{
					$GLOBALS[$index] = $var;
				}
				return true;
			}
			return false;
	}
	private function runing_var_stop($params,$id)
	{
			if($id==='true')
			{	
				foreach($params as $index => $var)
				{
					unset($GLOBALS[$index]);
				}
				return true;
			}
			return false;
	}

	private function runing_class($name,$params='',$action='')
	{
		switch(true)
			{
				case empty($params) && $action == false:
				if(class_exists($name))
				{
					return new $name;
				}
				break;
				
				case !empty($params) && $action == false:
				if(class_exists($name))
				{
					return new $name($params);
				}
				break;
				
				case empty($params) && $action == true:
					if(!isset($this->modyles[$name]))
					{
						return $this->modyles[$name] = new $name;
					}
					else
					{
						return $this->modyles[$name];
					}
				break;
				case !empty($params) && $action == true:
					if(!isset($this->modyles[$name]))
					{
						return $this->modyles[$name] = new $name($params);
					}
					else
					{
						return $this->modyles[$name];
					}
				break;
			}
	}
	private function l_f_pathArray($name,$path,$privileges='',$params='')
	{
		foreach($path as $id=>$way)
			{
				if(!file_exists($way.$name.EXT))
				{
					unset($path[$id]);
					continue;
				}
			}
			if(!empty($path))
			{
				if(array_key_exists($privileges,$path)){
					$path = $path[$privileges];}
				else
				{
					$path = implode(PS,$path);
				}
				set_include_path($path);
				require_once($name.EXT);
				return true;
			}
			else
			{
				trigger_error('не существует файла');
			}
	}
	private function l_f_pathString($name,$path)
	{
		if(file_exists($path.$name.EXT))
		{
			set_include_path($path);
			require_once($name.EXT);
			return true;
		}
		else
		{
			trigger_error("не существует файла[$name]");
		}	
	}
	public function load_file($name,$path='',$privileges='')
	{
		if(is_array($path))
		{
			$this->l_f_pathArray($name,$path,$privileges);	
		}
		elseif(is_string($path))
		{
			$this->l_f_pathString($name,$path);	
		}
		elseif(!$path)
		{
			if(file_exists(APPPATH.$name.EXT))
			{
				require_once(APPPATH.$name.EXT);
				return true;
			}
			else
			{
				trigger_error("не существует файла[$name]");
			}
		}
	}
	
	public function load_class($name='',$path='',$params='',$action='')
	{
		if(empty($name))trigger_error('не заданно имя класса!');
		$this->load_file($name,SYSPATH.$path);
		return $this->runing_class($name,$params,$action);
	}
	
	public function model($name='',$params='',$action='')
	{
		if(empty($name))trigger_error('не заданно имя модели!');
		$this->load_file($name,MODLPATH);
		return $this->runing_class($name,$params,$action);
	}
	
	public function library($name='',$params='',$action='')
	{
		if(empty($name))trigger_error('не заданно имя библиотеки!');
		
		$sys_lib_path = SYSPATH.'libraries'.DS;
		$app_lib_path =  APPPATH.'libraries'.DS;
		
		$this->load_file($name,array($app_lib_path,$sys_lib_path),1);	
		return $this->runing_class($name,$params,$action);
	}	

	public function view($name='',$params='',$parser='')
	{
		if(empty($name))trigger_error('не заданно имя вида!');
		if(!empty($params)){$id = $this->runing_var_start($params);}
		$this->load_file($name,VIEWPATH,0);
		if(!empty($params)){$this->runing_var_stop($params,$id);}
	}
	public function helper($name='',$params='')
	{
		if(empty($name))trigger_error('не заданно имя хелпера!');
		if(!empty($params)){$id = $this->runing_var_start($params);}
		$this->load_file($name,array(SYSPATH.'helpers'.DS,APPPATH.'helpers'.DS),1);
		if(!empty($params)){$this->runing_var_stop($params,$id);}
	}
}

?>