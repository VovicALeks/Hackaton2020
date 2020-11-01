<?php
class Word_Checker extends Checker
{
	protected $Presence_Elements;
	protected $Absence_Elements;
	
	public function Add_Presence_Element($element, $type, $count)
	{
		$this->Presence_Elements[] = array('element'=>$element,'type'=> $type,'count'=> $count);
	}
	public function Add_Absence_Element($element, $type)
	{
		$this->Absence_Elements[] = array('element'=>$element,'type'=> $type);
	}
	
	public function CheckPhp($Code)
	{
		$Presence = "";
		if (isset($this->Presence_Elements))
		{
			foreach ($this->Presence_Elements as $pres_el)
			{
				switch ($pres_el['type'])
				{
					case "FunctionOrKey":
						if (preg_match_all('/('.$pres_el['element'].'){1}\s*\({1}.*\){1}/um', $Code) != $pres_el['count'])
						{
							$Presence.= "Элемент ".$pres_el['element']." отсутствует в коде или его количество превышает допустимое. ";
						}
						break;
				}
			}
		}
		$Absence = "";
		if (isset($this->Absence_Elements))
		{
			foreach ($this->Absence_Elements as $abs_el)
			{
				switch ($abs_el['type'])
				{
					case "FunctionOrKey":
						if (preg_match_all('/('.$abs_el['element'].'){1}\s*\({1}.*\){1}/um', $Code) != 0)
						{
							$Absence.= "Элемент ".$pres_el['element']." присутствует в коде, но запрещён в использовании. ";
						}
						break;
				}
			}
		}
		if ($Absence != "")
			return $Absence;
		if ($Presence != "")
			return $Presence;
		else
			return "";
	}
	
	public function Check_Code($Code, $Lang)
	{
		switch ($Lang)
		{
			case "PHP":
				$res = $this->CheckPhp($Code);
				break;
		}
		return $res;
	}
	
	
}
?>