<?php
class DBClass extends DBQuery
{
	private $db_conf_file = false;
	
	public function __construct()
	{
		$this->load_db_conf();
		$this->parse_db_conf();
	}
	private function load_db_conf()
	{
		$db = array();
		$this->load_file('dbconfig',APPPATH.'config'.DS);
		$this->db_conf_file = $db;
		unset($db);
		
	}
	private function parse_db_conf()
	{
		switch(true)
		{
			case !empty($this->db_conf_file['user'])&&
				 !empty($this->db_conf_file['pass'])&&
				 !empty($this->db_conf_file['host'])&&
				 !empty($this->db_conf_file['db_name'])&&
				 !empty($this->db_conf_file['db']):
				{
					$this->select_db($this->db_conf_file['user'],
									 $this->db_conf_file['pass'],
									 $this->db_conf_file['host'],
									 $this->db_conf_file['db_name'],
									 $this->db_conf_file['db']);
				}
		}
	}
	
	private function select_db($user,$pass,$host,$db_name,$db)
	{
		switch($db)
		{
			case 'mysql':
			  try
			  {
				$this->db_connection = new PDO("mysql:host=$host;dbname=$db_name",$user,$pass);	
			  }
			catch(PDOException $e)
			  {
				print_r($e->getMessage());
			  }
			break;
			case 'sqlite':
			try
			{
			 $this->db_connection = new PDO('sqlite:'.SYSPATH.'db'.DS.$db_name);	
			}
			catch(PDOException $e)
			{
			  print_r($e->getMessage());
			}
			break;
		}
	}
	public function close_db()
	{
		
	}
}

?>