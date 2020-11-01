<?php

class Discipline
{
	public $ID;
	public $Name;
	public $Teacher;
	public $Teacher_ID;
	public $Tasks;
	
	public function Get_Discipline_By_ID($id)
	{
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Disciplines WHERE Discipline_ID = ".$id))
		{
			$res->data_seek(0);
			$disc = $res->fetch_row();
			$this->ID = $disc[0];
			$this->Name = $disc[1];
			$this->Teacher_ID = $disc[2];
			$res->close();
			return $this;
		}
		else return false;
	}
	public function Set_Teacher()
	{
		$Teacher = new Teacher();
		$Teacher = $Teacher->Get_Teacher_By_ID($this->Teacher_ID);
	}
	public function Set_Tasks()
	{
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Tasks WHERE Discipline_ID = ".$this->ID))
		{
			for($i = 0; $i < $res->num_rows; $i++) 
			{
                $res->data_seek($i);
                $task = $res->fetch_row();
                $Task = new Task();
                $Task = $Task->Get_Task_By_ID($task[0]);
                $Task->Discipline = $this;
                $this->Tasks[] = $Task;
			}
		}
	}
}
?>