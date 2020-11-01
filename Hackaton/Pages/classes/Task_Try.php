<?php

class Task_Try
{
	public $ID;
	public $St_Task;
	public $Try_Date;
	public $Rating;
	public $Status;
	public $Code;
	public $Comment;
	public function Get_Task_Try_By_ID($id)
	{
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Tries WHERE Try_ID = ".$id))
		{
			$res->data_seek(0);
			$try = $res->fetch_row();
			$this->ID = $try[0];
			$this->Try_Date = date_format(date_create($try[2]),'d.m.Y H:i:s');
			$this->Rating = $try[3];
			$this->Status = $try[4];
			$this->Code = $try[5];
			$this->Comment = $try[6];
			$res->close();
			return $this;
		}
		else return false;
	}
}
?>