<?php
class AO_Controller extends Load
{
	public function __construct()
	{
		$this->runing($this->modyles);
	}
	private function runing($modyles)
	{
		$this->load = $this;
		foreach($modyles as $name => $value_obj)
		{
			$name = strtolower($name);
			$this->$name = $value_obj;
		}
	}
}

?>