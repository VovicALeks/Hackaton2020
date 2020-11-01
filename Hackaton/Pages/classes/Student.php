<?php

class Student extends User
{
	public $StudentTasks;
	public $Class;
	
	public function Get_Student_By_ID($id)
	{
		$this->Get_User_By_ID($id);
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Users WHERE User_ID = ".$this->ID))
		{
            $res->data_seek(0);
            $user = $res->fetch_row();
            $this->Class = $user[8];
            $res->close();
		}
		$this->Get_Student_Tasks();
		return $this;
	}
	
	public function Get_Disciplines()
	{
		$Disciplines = array();
		foreach ($this->StudentTasks as $st)
		{
			$Disciplines[$st->Task->Discipline->Name] = $st->Task->Discipline;
		}
		return $Disciplines;
	}
	public function Get_Student_Tasks()
	{
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Student_Tasks WHERE Student_ID = ".$this->ID))
		{
			for($i = 0; $i < $res->num_rows; $i++) 
			{
                $res->data_seek($i);
                $task = $res->fetch_row();
                $Task = new Student_Task();
                $Task = $Task->Get_StTask_By_Id($task[0]);
                $Task->Student = $this;
	            $this->StudentTasks[] = $Task;
			}
	        $res->close();
		}
	}
	
	public function Get_Task_By_ID($ID)
	{
		foreach ($this->StudentTasks as $ST)
		{
			if ($ST->ID == $ID)
			{
				return $ST;
			}
		}
	}
}

?>