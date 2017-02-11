<?php
	
	function clear_uri()
	{
		if(preg_match('/[%]+/',$_SERVER['REQUEST_URI'])==true)
		{trigger_error('не существует контроллера');}
		
		$_SERVER['REQUEST_URI'] = preg_replace('/[-`~!#%$^&*()_=+\\\\|\\\[\\]{};:"\',<>?]+/', '', $_SERVER['REQUEST_URI']);
		
	} 
	function clear_data()
	{
		switch(true)
		{
			case isset($_GET):
				foreach($_GET as $key=>$value)
				{
					$_GET[$key] = strip_tags($value);
				}
			
			case isset($_COOKIE):
				foreach($_COOKIE as $key=>$value)
				{
					$_COOKIE[$key] = strip_tags($value);
				}
			
			case isset($_POST):
				foreach($_POST as $key=>$value)
				{
					$_POST[$key] = htmlspecialchars($value);
				}
			
		}
			
		
	}

	function errorHendler($errno,$errstr,$errfile,$errline)
	{
		switch($errno)
		{
			case E_USER_ERROR:
				echo "My error [$errno] $errstr<br>";
				echo "Fatal error on line $errline in file $errfile";
				exit(1);
			break;
			case E_USER_WARNING:
				echo "My warning [$errno] $errstr";
			break;
			case E_USER_NOTICE:
				if($errno==1024)
				{
					echo "My notice [$errno] $errstr";
					exit;
				}
				else
				{
					echo "My notice [$errno] $errstr";
				}
				
			break;
			default:
				echo "Ошибка нейзвестного типа:<br>
				номер[$errno] $errline $errfile $errstr";
			break;
		}
	}
	set_error_handler("errorHendler");
	
	
	function array_clear($mass)
	{
		if(gettype($mass)=="array")
		{
			foreach($mass as $key=>$value)
			{
				if(empty($value)){
					unset($mass[$key]);
					continue;}
			}
			return $mass;
		}
		else
		{
			 trigger_error("передаваемое значение не массив!!!", E_USER_ERROR);
		}
	}


?>