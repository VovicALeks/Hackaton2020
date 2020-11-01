<?php
include "classes/autoload.php";
session_start();
$User = new User();
if ($_SESSION['Auth'] && $_SESSION['Status'] == 'Учитель')
{
	$Teacher = new Teacher();
	$Teacher = $Teacher->Get_Teacher_By_ID($_SESSION['User_ID']);
	$Disciplines_Count = 0;
	if (isset($Teacher->Disciplines))
	{
		$Disciplines_Count = count($Teacher->Disciplines);
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
		<h2>Информация об учителе (страница не доработана):</h2>
		<?= 'ФИО: '.$Teacher->FullName?><br>
		<?= 'Образовательное учреждение: '.$Teacher->School?><br>
		<?= 'Email: '.$Teacher->Email?><br>
		<?= 'Дата рождения: '.$Teacher->BirthDate?><br>
		<a href="log_in.php?log_out">Выйти из системы</a>
		<h2>Дисциплины и задания</h2>
		<?php if ($Disciplines_Count != 0):?>
		<table cellspacing="0">
			<?php $Disciplines = $Teacher->Disciplines;
			foreach ($Disciplines as $Disc):?>
				<tr><td colspan='3'><h3><?=$Disc->Name?></h3></td>
				<td colspan='4'><a href="task_form.php?add&disc_id=<?=$Disc->ID?>">Добавить задачу</a></td></tr>
				<tr>
				<td>Название</td>
				<td>Язык</td>
				<td>Лимит времени</td>
				<td colspan='4'></td>
				</tr>
				<?php 
				$Disc->Set_Tasks();
				foreach ($Disc->Tasks as $ST):?>
				<?php 
				$Tries_Count = 0;
				if (isset($ST->Tries_Mas))
					$Tries_Count = count($ST->Tries_Mas);?>
					<tr><td><?=$ST->Name ?></td>
					<td><?=$ST->Language ?></td>
					<td><?=$ST->Time_Limit .' мин'?></td>
					<td><a>Просмотр</a></td>
					<td><a>Редактировать</a></td>
					<td><a>Удалить</a></td>
					<td><a>Ученики</a></td></tr>
				<?php endforeach;?>
			<?php endforeach;?>
		</table>
		<?php endif;?>
	</body>
</html>