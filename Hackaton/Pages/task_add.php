<?php
include "classes/autoload.php";
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
if (isset($_POST['disc_id']))
{
	$Disc_ID = $_POST['disc_id'];
	$Name = $_POST['Name'];
	$Legend = $_POST['Legend'];
	$Description = $_POST['Description'];
	$Time_Limit = $_POST['Time_Limit'];
	$Language = $_POST['Language'];
	$Entry_Code = $_POST['Entry_Code'];
	$Out_Code = $_POST['Out_Code'];
	$All_Check = "";
	if (isset($_POST['Checkers']))
	{
		$Checkers = $_POST['Checkers'];
		foreach ($Checkers as $checker)
		{
			$chek = json_decode($checker);
			$All_Check[] = $chek;
		}
		$All_Check = json_encode($All_Check);
	}
	$Post_Process = $_POST['ProcJson'];
	
	$con = DB_Connection::Get_Connection();
	$con->query("INSERT INTO `h_Tasks`(`Task_ID`, `Discipline_ID`, `Name`, `Legend`, `Description`, `Time_Limit`, `Language`, `Checkers`, `Rating`) VALUES (NULL,$Disc_ID,'$Name','$Legend','$Description',$Time_Limit,'$Language','".$All_Check."','$Post_Process')");
	header('Location: index.php?State='.$_SESSION['Status']);
}

?>