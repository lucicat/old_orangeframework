<?php
class Run extends Cheked_class_method
{
	public function __construct()
	{
		parent::__construct();
		$this->run();
	}
	
	private function _cheked_param($action)
	{
		$count_meth_param = count($this->refl_contr->getMethod($action)->getParameters());
		if(count($this->params)<$count_meth_param)
			{
				$params = array_pad($this->params,
							  		$count_meth_param,false);
			}
			
			else
			{
				$params = array_slice($this->params,0,$count_meth_param);	
			}
		return $params;	
	}
	
	private function run()
	{
		
		if($this->action != false)
		{
			$params = $this->_cheked_param('action');
			$params_constr = $this->_cheked_param('__construct');
		}
		else
		{
			$params = $this->_cheked_param('__construct');
		}
			
		if($this->action == false)
		{
			$this->refl_contr->newInstanceArgs($params);
		}
		else
		{	
		
			call_user_func_array(array(
							 	$this->refl_contr->newInstanceArgs($params_constr),
							  	$this->action),
							   		$params);
		}
		
		
	}
	

	
	
}
?>