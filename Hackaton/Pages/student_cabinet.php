<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include "classes/autoload.php";
session_start();
$User = new User();
if ($_SESSION['Auth'] && $_SESSION['Status'] == 'Ученик')
{
	$Student = new Student();
	$Student = $Student->Get_Student_By_ID($_SESSION['User_ID']);
	$Task_Count = 0;
	if (isset($Student->StudentTasks))
	{
		$Task_Count = count($Student->StudentTasks);
	}
}
else
{
	header('Location: log_in.php');
}
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
		<h2>Информация об ученике:</h2>
		<?= 'ФИО: '.$Student->FullName?><br>
		<?= 'Образовательное учреждение: '.$Student->School?><br>
		<?= 'Email: '.$Student->Email?><br>
		<?= 'Дата рождения: '.$Student->BirthDate?><br>
		<?= 'Класс: '.$Student->Class?><br>
		<?= 'Всего заданий: '.$Task_Count?><br>
		<a href="log_in.php?log_out">Выйти из системы</a>
		<h2>Дисциплины и задания</h2>
		<?php if ($Task_Count != 0):?>
		<table cellspacing="0">
			<?php $Disciplines = $Student->Get_Disciplines();
			foreach ($Disciplines as $Disc):?>
				<tr><td colspan='9'><h3><?=$Disc->Name?></h3></td></tr>
				<tr>
				<td>Название</td>
				<td>Статус</td>
				<td>Язык</td>
				<td>Крайняя дата сдачи</td>
				<td>Лимит времени</td>
				<td>Попыток использовано</td>
				<td>Тип оценки</td>
				<td>Общая оценка</td>
				<td>Выполнить</td></tr>
				<?php 
				foreach ($Student->StudentTasks as $ST):?>
				<?php 
				$Tries_Count = 0;
				if (isset($ST->Tries_Mas))
					$Tries_Count = count($ST->Tries_Mas);
				if ($ST->Task->Discipline->ID == $Disc->ID):?>
					<tr><td><?=$ST->Task->Name ?></td>
					<td><?=$ST->Status ?></td>
					<td><?=$ST->Task->Language ?></td>
					<td><?=$ST->DeadLine ?></td>
					<td><?=$ST->Task->Time_Limit .' мин'?></td>
					<td><?=$Tries_Count.' из '.$ST->Tries ?></td>
					<td><?=$ST->Rating_Type?></td>
					<td><?=$ST->Get_Rating()?></td>
					<td><a href='task.php?task_id=<?=$ST->ID ?>'>Просмотр</a></td></tr>
					<?php endif;?>
				<?php endforeach;?>
			<?php endforeach;?>
		</table>
		<?php endif;?>
	</body>
</html>