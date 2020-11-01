<?php

class User
{
	public $ID;
	public $FullName;
	public $School;
	public $Email;
	public $BirthDate;
	public $Status;
	public $Login;
	public $Password;
	
	public function Get_User_By_ID($id)
	{
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Users WHERE User_ID = ".$id))
		{
			$res->data_seek(0);
			$user = $res->fetch_row();
			$this->ID = $user[0];
			$this->FullName = $user[1];
			$this->School = $user[2];
			$this->Email = $user[3];
			$this->BirthDate = date_format(date_create($user[4]),'d.m.Y');
			$this->Status = $user[5];
			$this->Login = $user[6];
			$this->Password = $user[7];
			$res->close();
			return $this;
		}
		else return false;
	}
	
	public function Auth_User($Login, $Password)
	{
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Users WHERE Login = '".$Login."' AND Password = '".$Password."'"))
		{
			$res->data_seek(0);
			$user = $res->fetch_row();
			if (isset($user[0]))
				return $this->Get_User_By_ID($user[0]);
			else
				return false;
		}
		else 
			return false;
	}
}
?>