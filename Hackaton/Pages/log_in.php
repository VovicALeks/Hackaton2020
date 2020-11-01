<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include "classes/autoload.php";
session_start();
$User = new User();
if (isset($_SESSION['Auth']))
{
	$User = $User->Get_User_By_ID($_SESSION['User_ID']);
}
else if (isset($_POST['login']))
{
	$res = $User->Auth_User($_POST['login'],$_POST['password']);
	if ($res != false)
	{
		$_SESSION['Auth'] = true;
		$_SESSION['Status'] = $res->Status;
		$_SESSION['User_ID'] = $res->ID; 
		header('Location: index.php?State='.$res->Status);
	}
	else
		$error = "Неверный логин/пароль";
}
if(isset($_GET['log_out']))
{
	unset($_SESSION['Auth']);
}
?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8">
		<script type="text/javascript">
			function ClassEnable()
			{
				if (document.getElementById('student').checked)
				{
					document.getElementById('userClass').style.visibility = "visible";
				}
				else
				{
					document.getElementById('userClass').style.visibility = "hidden";
				}
			};
		</script>
    </head>
	<body>
		<?php if (!isset($_SESSION['Auth'])): ?>
		<?php if(isset($error)) echo "<b>$error</b>"; ?>
		<form action="log_in.php" method="post">
			<h3>Вход в систему</h3>
			<p>Логин: <input type="text" name="login" required></p>
			<p>Пароль: <input type="password" name="password" required></p>
			<p><input type="submit" value="Войти в систему"></p>
		</form>
		<form action="log_in.php" method="post">
			<h3>Регистрация</h3>
			<p>Фамилия: <input type="text" name="SurName" required></p>
			<p>Имя: <input type="text" name="Name" required></p>
			<p>Отчество: <input type="text" name="Patronymic"></p>
			<p>Статус:</p>
			<label><input type="radio" id='student' name="Status" value="Ученик" checked onChange="ClassEnable()">Ученик</label>
			<label><input type="radio" name="Status" value="Учитель" onChange="ClassEnable()">Учитель</label>
			<p>Образовательное учреждение: <input type="text" name="School" required>
			<span id='userClass'> Класс: <input type="text"  name="School" required></span></p>
			<p>Адрес электронной почты: <input type="text" name="School" required></p>
			<p>Логин: <input type="text" name="login" required></p>
			<p>Пароль: <input type="password" name="password" required></p>
			<p><input type="submit" value="Зарегистрироваться"></p>
		</form>
		<?php endif;?>
		<?php if (isset($_SESSION['Auth'])):?>
		<p>Добро пожаловать, <?=$User->FullName?></p>
		<a href="index.php?State=<?=$User->Status?>">Перейти в личный кабинет</a>
		<a href="log_in.php?log_out">Выйти из системы</a>
		<?php endif;?>
	</body>
</html>
    	