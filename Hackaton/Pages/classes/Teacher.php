<?php
class Teacher extends User
{
	public $Disciplines;
	public function Get_Teacher_By_ID($id)
	{
		$this->Get_User_By_ID($id);
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Disciplines WHERE Teacher_ID = ".$this->ID))
		{
			for($i = 0; $i < $res->num_rows; $i++) 
			{
                $res->data_seek($i);
                $disc = $res->fetch_row();
                $Discipline = new Discipline();
                $Discipline = $Discipline->Get_Discipline_By_ID($disc[0]);
				$Discipline->Teacher = $this;
				$this->Disciplines[] = $Discipline;
			}
			$res->close();
		}
		return $this;
	}
}
?>