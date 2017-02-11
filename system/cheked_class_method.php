<?php
class Cheked_Class_Method extends Uri
{
	public $refl_contr;
	public function __construct()
	{
		parent::__construct();
		$this->chek_load_class();
		$this->chek_method();
		
	}
	private function chek_load_class()
	{
		if(!file_exists(CNTRPATH.$this->controller.EXT)){
			   trigger_error('К сожалению контроллер не найден:(...печалька');
			   }
		else{
			include_once(CNTRPATH.$this->controller.EXT);
			try{class_exists($this->controller);
				return true;
				}
			catch(Exception $e){
				trigger_error('Не задан класс в контроллере:(');
				}	
			}	   
	}
	private function chek_method()
	{
		if(method_exists($this->controller,'__construct')===false)
		{
			   trigger_error('упс! оформите правильно свой класс..');
		}
		else
		{
			try
			{
			$contr = new ReflectionClass($this->controller);
			}
			catch(Exception $e)
			{
				$e->getMessage();
			}
			$this->refl_contr = $contr;
			if($contr->hasMethod($this->action)===true)
			{
				$meth = $contr->getMethod($this->action);
				if($meth==true)
				{
						if($meth->isPublic())
						{
							return true;
						}
						else
						{
							array_unshift($this->params,$this->action);
							$this->action = false;
						}	
				}
			}
			else
			{
				array_unshift($this->params,$this->action);
				$this->action = false;
			}	
		}	   
	}
}
?>