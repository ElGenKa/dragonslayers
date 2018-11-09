<?php
	
    if (isset($_POST['login_r'])) { 
		$login = $_POST['login_r']; 
		if ($login == '') unset($login); 
	} 
    if (isset($_POST['password_r'])) { 
		$password=$_POST['password_r']; 
		if ($password =='') unset($password); 
	}

	if (empty($login) or empty($password)) {
		exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля! <br><a href='index.php'>Вернуться</a>");
    }
	
	if( strlen($login)<6 or strlen($password)<6 ){
		exit ("Логин и пароль должны быть минимум 6 символов! <br><a href='index.php'>Вернуться</a>");
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
		exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин. <br><a href='index.php'>Вернуться</a>");
    }

    $result2 = mysqli_query ($db,"INSERT INTO users (login,password) VALUES('$login','$password')");
	$id = $id=mysqli_insert_id($db);
    if ($result2=='TRUE'){
		//echo "Вы успешно зарегистрированы! Теперь вы можете войти в игру. <br><a href='index.php'>Начать игру!</a>";
		$hash = date("H:i:s").$login;
		$hash = md5($hash);			
		setcookie("hash", $hash);
		mysqli_query($db,"UPDATE users set auth_hash = '$hash' WHERE id = $id") or die("Системная ошибка. <br><a href='index.php'>Вернуться</a>");
		header('Location: game.php');
		
    }else{
		echo "Ошибка! Вы не зарегистрированы. Системная ошибка. <br><a href='index.php'>Вернуться</a>";
    }
?>