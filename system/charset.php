<?php
class Charset extends Config
{
	public function __construct()
	{
		$this->set_charset();
	}
	
	private function set_charset()
	{
		$file_conf = $this->confFile();
		if(!empty($file_conf['charset']))
		{
			
		}
		else
		{
			
		}
			
	}
	
	
	
	
}
?>