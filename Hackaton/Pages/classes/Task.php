<?php

class Task
{
	public $ID;
	public $Discipline;
	public $Name;
	public $Legend;
	public $Description;
	public $Time_Limit;
	public $Deadline;
	public $Language;
	public $Checkers;
	
	public function Solve($Code)
	{
		$Task_Try = new Task_Try();
		$Task_Try->Try_Date = date('Y-m-d H:i:s');
		$Task_Try->Task = $this;
		$Task_Try->Code = $Code;
		$CompileRes = $this->CompileAndCheck($Code);
		if ($CompileRes->Result != "1")
		{
			$Task_Try->Rating = 0;
			if (isset($CompileRes->Errors))
			{
				$Task_Try->Comment ="Ошибка компиляции в коде";
				$Task_Try->Status = "Задача не решена";
			}
			else
			{
				$Task_Try->Comment ="Полученное значение не совпадает с требуемым";
				$Task_Try->Status = "Задача не решена";
			}
			return $Task_Try;
		}
		
		$Check_Result = $this->Check_Checkers($Code);
		foreach ($Check_Result as $ChkRes)
		{
			$s = "";
			if ($ChkRes!="")
				$s.= $ChkRes;
		}
		if ($s != "")
		{
			$Task_Try->Comment = $s;
			$Task_Try->Status = "Решение не верно";
			$Task_Try->Rating = 0;
			return $Task_Try;
		}
		$Task_Try->Comment = "";
		$Task_Try->Status = "Задача решена верно";
		$Task_Try->Rating = 100;
		return $Task_Try;
	}
	
	public function CompileAndCheck($Code)
	{
		switch ($this->Language)
		{
			case "PHP":
				$Num = 8;break;
		}
		
		$FullCode = '<'.'?php '.preg_replace("/(\*\d\*)/um",$Code,file_get_contents('Task_Patterns/'.$this->ID.'.txt')).' ?'.'>';
		$params = array("LanguageChoice"=> $Num,
			    "Program"=> $FullCode,
			    "Input"=> "",
			    "CompilerArgs" => "");
		$myCurl = curl_init();
		curl_setopt_array($myCurl, array(
		    CURLOPT_URL => 'https://rextester.com/rundotnet/api',
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => http_build_query($params)
		));
		$response = curl_exec($myCurl);
		curl_close($myCurl);
		return json_decode($response);
	}
	
	public function Check_Checkers($Code)
	{
		$All_alright = array();
		if (isset($this->Checkers->WordPresence))
		{
			$Word_Checker = new Word_Checker();
			foreach ($this->Checkers->WordPresence as $WP)
			{
				$Word_Checker->Add_Presence_Element($WP[0], $WP[1], $WP[2]);
				$All_alright['WordPresence'] = $Word_Checker->Check_Code($Code, $this->Language);
			}
		}
		if (isset($this->Checkers->WordAbsence))
		{
			$Word_Checker = new Word_Checker();
			foreach ($this->Checkers->WordAbsence as $WA)
			{
				$Word_Checker->Add_Absence_Element($WA[0], $WA[1]);
			}
			$All_alright['WordAbsence'] = $Word_Checker->Check_Code($Code, $this->Language);
		}
		return $All_alright;
	}
	
	public function Get_Task_By_ID($ID)
	{
		$con = DB_Connection::Get_Connection();
		if ($res = $con->query("SELECT * FROM h_Tasks WHERE Task_ID = ".$ID))
		{
			$res->data_seek(0);
			$task = $res->fetch_row();
			$this->ID = $task[0];
			$this->Name = $task[2];
			$this->Legend = $task[3];
			$this->Description = $task[4];
			$this->Time_Limit = $task[5];
			$this->Language = $task[6];
			$this->Checkers = json_decode($task[7]);
			$this->Rating = json_decode($task[8]);
			$this->Discipline = new Discipline();
			$this->Discipline = $this->Discipline->Get_Discipline_By_ID($task[1]);
			$res->close();
			return $this;
		}
	}
}
?>