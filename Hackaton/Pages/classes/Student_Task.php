<?php

class Student_Task
{
	public $ID;
	public $Student;
	public $Task;
	public $Status;
	public $DeadLine;
	public $Tries;
	public $Rating_Type;
	public $Tries_Mas;
	
	public function Save_Try($try)
	{
		$con = DB_Connection::Get_Connection();
		$con->query("INSERT INTO `h_Tries`(`Try_ID`, `St_Task_ID`, `Try_Date`, `Rating`, `Status`, `Code`, `Comment`) VALUES (NULL,".$this->ID.",'".$try->Try_Date."',".$try->Rating.",'".$try->Status."','".$try->Code."','".$try->Comment."')");
		$this->Get_StTask_By_Id($this->ID);
	}
	public function Get_StTask_By_Id($id)
	{
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Student_Tasks WHERE St_Task_ID = ".$id))
		{
			$res->data_seek(0);
			$st = $res->fetch_row();
			$this->ID = $st[0];
			$this->Status = $st[3];
			$this->DeadLine = date_format(date_create($st[4]),'d.m.Y');
			$this->Tries = $st[5];
			$this->Rating_Type = $st[6];
			$this->Task = new Task();
			$this->Task = $this->Task->Get_Task_By_ID($st[2]);
			$this->Get_Tries();
			return $this;
		}
		else return false;
	}
	
	public function Get_Tries()
	{
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Tries WHERE St_Task_ID = ".$this->ID))
		{
			unset($this->Tries_Mas);
			for($i = 0; $i < $res->num_rows; $i++) 
			{
                $res->data_seek($i);
                $try = $res->fetch_row();
                $Task_Try = new Task_Try();
                $Task_Try = $Task_Try->Get_Task_Try_By_ID($try[0]);
                $this->Tries_Mas[] = $Task_Try;
			}
		}
	}
	
	public function Get_Rating()
	{
		$Rating = 0;
		if (isset($this->Tries_Mas))
			switch ($this->Rating_Type)
			{
				case "Максимальный балл":
					foreach ($this->Tries_Mas as $try)
					{
						if ($try->Rating > $Rating) 
							$Rating = $try->Rating;
					}
					break;
				case "Средняя оценка":
					foreach ($this->Tries_Mas as $try)
					{
						$Rating += $try->Rating;
					}
					$Rating /= count($this->Tries_Mas);
					break;
			}
		return $Rating;
	}
}
?>