<?php

class DB_Connection
{
	public static function Get_Connection()
	{
		$Host = 'localhost';
		$User = 'root';
		$Password = '5B0tfOjg';
		$Database ='root';
		
		$Connection = mysqli_connect($Host, $User, $Password, $Database);
		return $Connection;
	}
}
?>