<?php

class DB_Connection
{
	public static function Get_Connection()
	{
		$Host = 'localhost';
		$User = 'f90457uj_velikiy';
		$Password = '5B0tfOjg';
		$Database ='f90457uj_velikiy';
		
		$Connection = mysqli_connect($Host, $User, $Password, $Database);
		return $Connection;
	}
}
?>