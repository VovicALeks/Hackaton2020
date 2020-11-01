<?php
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