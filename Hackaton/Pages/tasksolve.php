<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include "classes/autoload.php";
session_start();
$Student_Task = new Student_Task();
if (isset($_GET['task_id']))
{
	$Student_Task->Get_StTask_By_ID($_GET['task_id']);
	$Task = $Student_Task->Task;
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
    	<script type="text/javascript">
    		function timer(seconds) 
    		{
		        var seconds = seconds;
		        var minutes = seconds - seconds%60;
		        var seconds_timer_id = setInterval(function() {
		            if (seconds > 0) {
		                seconds --;
		                var minutes = (seconds - seconds%60)/60;
		                var showseconds = seconds%60;
		                if (showseconds < 10) {
		                    showseconds = "0" + showseconds;
		                }
		                document.getElementById('seconds').innerHTML = showseconds;
		                document.getElementById('minutes').innerHTML = minutes;
		            } else {
		                location="task.php?time_over&task_id="+document.getElementById('task_id').value;    
		            }
		        }, 1000);
		    };
    	</script>
    </head>
	<body>
		<form action="task.php" method="post">
		<?= '<h2>Задание: '.$Task->Name.'</h2>'?><br>
		<?= 'Описание: '.$Task->Description?><br>
		Осталось времени: <span id="minutes">--</span>:<span id="seconds">--</span><br>
		<?= 'Язык: '.$Task->Language?><br>
		<h3>Ответ:</h3>
		<div style="font-family: Consolas,monaco,monospace;">
		<?php
		$f = fopen('Task_Patterns/'.$Task->ID.'.txt','r');
		$s = "";
		while(!feof($f))
		{
			$s .= fgets($f)."<br>";
		}
		echo preg_replace("/(\*\d\*)/um",'<textarea id="Code" name="Code"></textarea>',$s);
		?>
		</div>
		<?="<input type='hidden' id='task_id' name='task_id' value=".$Task->ID.">" ?>
		<?= '<input type="submit" value="Завершить">'?>
		</form>
	</body>
		<?php if ($Task->Time_Limit >0)
		{
			echo '<script type="text/javascript">
			timer('.($Task->Time_Limit*60).')
			</script>';
		}
		?>
</html>