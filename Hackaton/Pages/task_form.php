<?php
include "classes/autoload.php";
session_start();
$User = new User();
if ($_SESSION['Auth'] && $_SESSION['Status'] == 'Учитель')
{
	$Teacher = new Teacher();
	$Teacher = $Teacher->Get_Teacher_By_ID($_SESSION['User_ID']);
}
else
{
	header('Location: log_in.php');
}
if(isset($_GET['add']))
{
	$Discipline = new Discipline();
	$Discipline = $Discipline->Get_Discipline_By_ID($_GET['disc_id']);
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
		<a href="index.php?State=<?=$_SESSION['Status']?>">Вернуться</a>
		<?php if(isset($_GET['add'])):?>
		<h2>Добавить задачу (страница не доработана):</h2>
		<form action="task_add.php" method="post">
		<?= 'Дисциплина: '.$Discipline->Name?> <input type="hidden" name="disc_id" value="<?=$Discipline->ID?>"><br>
		<?= 'Название задачи: '?><input type="text" name="Name" required><br>
		<?= 'Легенда: '?><input type="text" name="Legend"><br>
		<?= 'Описание:'?><br>
		<textarea name="Description" required>
			
		</textarea><br>
		<?= 'Ограничение по времени: '?><input type="number" name="Time_Limit" required> мин<br>
		<?= 'Язык: '?>
		<select name="Language" required>
			<option value="PHP" selected>PHP</option>
			<option value="C#">C#</option>
		</select><br>
		
		<?= 'Входной код: '?><br>
		<textarea name="Entry_Code" style="font-family: Consolas,monaco,monospace;">
			
		</textarea><br>
		<?= 'Выходной код: '?><br>
		<textarea name="Out_Code" style="font-family: Consolas,monaco,monospace;">
			
		</textarea><br>
		<p>Ограничения кода:</p>
		<input type='button' onClick="Add_Checker()"  value="Добавить ограничение:">
		<select id="Checker_Type">
			<option value="WordPresence" id ="WordPresence" selected>Наличие функции/метода/ключевого слова</option>
			<option value="WordAbsence" id = "WordAbsence">Запрет на использование функции/метода/ключевого слова</option>
		</select>
		<div id="Checker_Params" style="color:blue"></div>
		Ограничения (<input type='button' onClick="RemoveCheckers();" value="Очистить список">):
		<div id="Checkers"> 
			
		</div>
		<p>Автоматическое оценивание решения:</p>
		<select id="Criteria_Type">
			<option value="SymbNum" >Количество символов</option>
			<option value="None" selected>Нет</option>
		</select>
		<div id="PostProc_Params">
			<input type="hidden" id="ProcJson" name="ProcJson" value="">
			<input type='button' onClick="Add_Criteria();" value="Добавить критерий"><br>
			100 баллов: <input type="number" name="PostPr" id='100' value="5" onchange="ResetProc();" required><br>
		</div>
		<input type="submit" value="Создать">
		<?php endif;?>
		</form>
	</body>
	<script type="text/javascript">
		function ResetProc()
		{
			var els = document.getElementsByName("PostPr");
			var Process = document.getElementById('Criteria_Type');
			for (let criteria_type of Process.children)
			{
				if (criteria_type.selected == true)
				{
					var chosen_type = criteria_type;
				}
			}
			var params = new Array();
			for (let element of els)
			{
				params.push([element.id, element.value]);
			}
			document.getElementById('ProcJson').value = JSON.stringify([chosen_type.value,params]); 
		}
		function Add_Criteria()
		{
			var rate = prompt('Количество баллов');
			document.getElementById('PostProc_Params').innerHTML += rate+ ' баллов: <input type="number" name="PostPr" id="'+rate+'" onchange="ResetProc();" required><br>';
		}
		function Add_Checker()
		{
			var checker = document.getElementById('Checker_Type');
			for (let checker_type of checker.children)
			{
				if (checker_type.selected == true)
				{
					var chosen_type = checker_type;
				}
			}
			switch (chosen_type.value)
			{
				case 'WordPresence':
					params = [
						['name','Имя функции'],
						['count','Количество использований']]; break;
				case 'WordAbsence':
					params = [
						['name','Имя функции']];break;
			}
			var checkParams = new Array();
			var viewStr = chosen_type.innerHTML+" (";
			for (let param of params)
			{
				var p = prompt(param[1]);
				checkParams.push(p);
				viewStr = viewStr + param[1] + ":" + p + "; ";
			}
			var checker = [	chosen_type.value , checkParams];
			var jsonChecker = JSON.stringify(checker);
			document.getElementById('Checkers').innerHTML = document.getElementById('Checkers').innerHTML + viewStr.slice(0, -2)+') <input type="hidden" name="Checkers[]" value='+jsonChecker+'><br>';
		}
		
		
		function RemoveCheckers()
		{
			document.getElementById('Checkers').innerHTML = "";
		}
	</script>
</html>