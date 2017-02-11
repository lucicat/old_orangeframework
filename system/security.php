<?php
class Security extends Config
{
	public function __construct()
	{
		$this->the_clean();
	}
	public function the_clean()
	{
		$file_conf = $this->confFile();
		if($file_conf['global_xss_clean'] == true)
		{
			clear_data();
		}
	}
	
}
?>