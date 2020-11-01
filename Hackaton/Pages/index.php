<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include "classes/autoload.php";
session_start();
if ($_SESSION['Auth'] && $_SESSION['Status'] == 'Ученик')
{
	header('Location: student_cabinet.php');
}
else if ($_SESSION['Auth'] && $_SESSION['Status'] == 'Учитель')
{
	header('Location: teacher_cabinet.php');
}
else
{
	header('Location: log_in.php');
}
?>