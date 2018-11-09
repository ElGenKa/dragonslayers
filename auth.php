<?php
	
    if (isset($_POST['login'])) { 
		$login = $_POST['login']; 
		if ($login == '') unset($login); 
	} 
    if (isset($_POST['password'])) { 
		$password=$_POST['password']; 
		if ($password =='') unset($password); 
	}

	if (empty($login) or empty($password)) {
		exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля! <br><a href='index.php'>Вернуться</a>");
    }

    $login = stripslashes($login);
    $login = htmlspecialchars($login);
	$password = stripslashes($password);
    $password = htmlspecialchars($password);

    $login = trim($login);
    $password = trim($password);
	
	include ("_core.php");
	
	$result = mysqli_query($db,"SELECT * FROM users WHERE login='$login'");
	//print_r($result);
	
    $myrow = mysqli_fetch_array($result);
    if (!empty($myrow['id'])) {
		$id = $myrow['id'];
		
		if ($myrow['password'] == $password){
			error_reporting(true);
			$hash = date("H:i:s").$login;
			$hash = md5($hash);			
			setcookie("hash", $hash);
			$authdate = date("d F Y H:i:s");
			mysqli_query($db,"UPDATE users set auth_hash = '$hash', lastauth = '$authdate' WHERE id = $id") or die("Системная ошибка. <br><a href='index.php'>Вернуться</a>");
			header('Location: game.php');
			
		}else{
			
			exit ("Пароль не верен! <br><a href='index.php'>Вернуться</a>");
			
		}
		
	}else{
		
		exit ("Извините, такой пользователь не найден! <br><a href='index.php'>Вернуться</a>");
		
	}
	
?>