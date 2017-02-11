<?php
class URI
{
	private	$uri = false,
	 		$route = false;
	 
	public 	$get_query = false,
			$controller = false,
			$action = false,
			$params = false;
				
				
	public function __construct()
	{
		$this->uri = $_SERVER['REQUEST_URI'];
		$this->parse_uri();
		$this->parse_route_file();
	}			
		  	
	private function parse_uri()
	{
		if($this->uri)
		{
			$uri_razd = parse_url($this->uri);
			$this->uri = $uri_razd['path'];
			isset($uri_razd['query'])? $this->get_query = $uri_razd['query']: $this->get_query = false; 
				unset($uri_razd);
			$mass_razd_query = explode('/',$this->uri);
				$mass_uri = array_clear($mass_razd_query);
					
					$this->controller = array_shift($mass_uri);
					$this->action 	= array_shift($mass_uri);
					$this->params	= $mass_uri;
						unset($mass_uri);
			
		}
	}
	private function parse_route_file()
	{
		if(!file_exists(APPPATH.'config'.DS.'routes'.EXT)){
			trigger_error('Что за фигня? где файл "route.php"? исправляй давай))',E_USER_NOTICE);
			}
		else{
			$route = array();
			include(APPPATH.'config'.DS.'routes'.EXT);
			$this->route = $route;
				unset($route);
			if(!empty($this->route)){
					if($this->controller==false){
						$this->controller = $this->route['default_controller'];
						if($this->action==false){
							$this->action = $this->route['default_action'];
							}
						return;	
						}
					else{
						if($this->action==false or $this->action==$this->route['default_action']){
							$this->action = $this->route['default_action'];
							return;
							}
						}	
					
					$str_uri = $this->controller.'/'.$this->action.'/'.implode('/',$this->params);
					foreach($this->route as $key=>$value)
					{
						strpos($str_uri,$key) === false ? $pos = 'error': $pos = strlen($key);
						if($pos!=='error'){
							if($key===$str_uri){
								$this->uri = $value;
								$this->parse_uri();
								}
							else{
								$this->uri = $value;
								$this->parse_uri();
								$this->params = array_merge($this->params,
													array_clear(
														explode('/',
															  substr($str_uri,
																   strlen($key),
																   strlen($str_uri)-strlen($key)))));
								}	
							
						}	
					}
					
					
				
				}
			else{
				trigger_error('Почему нет роут массива?О_о ай яй яй..');
				exit;
				}	
			}	
		
	}
	
	
}
?>