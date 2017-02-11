<?php
class Controller extends AO_Controller
{
	function __construct()
	{
		parent::__construct();
		echo'привет чувак! ты читаешь это, а это значит, что оно работает!!)<br>';
		echo'this is load library! - ';
		$this->load->library('my_xss_library');
		echo'<br>';
		echo'this is load model! - ';
		$this->load->model('my_model');
		echo'<br>';
		echo'this is load helper! - ';
		$this->load->helper('my_testhelper');
		echo'<br>';
		echo'this is load view! - ';
		$var['name'] = 'petia';
		$this->load->view('vasya',$var);
	
		
	}
	
	function action()
	{
				
	}
}
?>