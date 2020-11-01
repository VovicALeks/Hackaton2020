<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include "classes/autoload.php";
session_start();
$Student_Task = new Student_Task();
if (isset($_GET['task_id']))
{
	$Student_Task = $Student_Task->Get_StTask_By_Id($_GET['task_id']);
}
if(isset($_GET['time_over']))
{
	$Try = $Student_Task->Task->Solve("");
	$Try->Comment = "Время вышло";
	$Student_Task->Save_Try($Try);
}
if (isset($_POST['Code']))
{
	$Student_Task = $Student_Task->Get_StTask_By_Id($_POST['task_id']);
	$Try = $Student_Task->Task->Solve($_POST['Code']);
	$Student_Task->Save_Try($Try);
}
$Tries_Count = 0;
if (isset($Student_Task->Tries_Mas))
	$Tries_Count = count($Student_Task->Tries_Mas);
?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8">
    	<style>
    		td {border-style:solid;}
    	</style>
    </head>
	<body>
		<h2>Задание:</h2>
		<?= 'Название: '.$Student_Task->Task->Name?><br>
		<?= 'Описание: '.$Student_Task->Task->Description?><br>
		<?= 'Лимит времени: '.$Student_Task->Task->Time_Limit.' мин'?><br>
		<?= 'Язык: '.$Student_Task->Task->Language ?><br>
		<?= 'Крайняя дата сдачи: '.$Student_Task->DeadLine?><br>
		<?= 'Использовано попыток: '.$Tries_Count.' из '.$Student_Task->Tries ?><br>
		<?php
		if ($Tries_Count < $Student_Task->Tries && 
		strtotime(date('d.m.Y H:m:s')) <=strtotime($Student_Task->DeadLine) &&
		$Student_Task->Status != "Закрыто")
			echo '<a href="tasksolve.php?task_id='.$Student_Task->Task->ID.'">Выполнить</a>'
		?>
		<a href="index.php?State=<?=$_SESSION['Status']?>">Вернуться</a>
		<?php if (isset($Student_Task->Tries_Mas)):?>
		<table cellspacing="0">
			<tr>
				<td>Дата попытки</td>
				<td>Статус</td>
				<td>Оценка</td>
				<td>Комментарий</td>
			</tr>
		<?php foreach ($Student_Task->Tries_Mas as $try):?>
		<tr>
			<td><?= $try->Try_Date?></td>
			<td><?= $try->Status?></td>
			<td><?= $try->Rating?></td>
			<td><?= $try->Comment?></td>
		</tr>
		<?php endforeach;?>
		</table>
		<?php endif;?>
	</body>
</html>