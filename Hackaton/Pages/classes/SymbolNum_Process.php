<?php

class SymbolNum_Process extends Post_Process
{
	public $params;
	public function Define_Object($Code)
	{
		$Object = strlen($Code);
		Decode_Params($Object);
	}
	public function Decode_Params($Object)
	{
		
	}
}
?>