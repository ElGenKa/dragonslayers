<?PHP

	include("_checkauth.php");
	
	$method = $_POST['method'];
	
	if( $method == 'set_name' and $myrow['user_name'] == "false" ){
	
		$select = mysqli_query($db,"SELECT * FROM users WHERE user_name = '$name'") or die("Системная ошибка. <br><a href='index.php'>Вернуться</a>");
		$select = mysqli_fetch_array($select);
		if( !empty($select['id']) ){
		
			$name = $_POST['my_name'];
			if(!empty($name) and strlen($name)>6){
				$name = stripslashes($name);
				$name = htmlspecialchars($name);
				mysqli_query($db,"UPDATE users set user_name = '$name' WHERE id = $id") or die("Системная ошибка. <br><a href='index.php'>Вернуться</a>");
				header('Location: game.php');
			}else{
				header('Location: game.php');
			}
		}else{
			Header('Location: game.php?helperror=1');
		}
	
	}elseif( $method == 'get_yeg' and $myrow['help_steep'] == 0 ){
		$dateget = date("d F Y H:i:s");
		mysqli_query ($db,"INSERT INTO inventory (itemid,userid,type,dateget,name) VALUES ('1','$id','Egg','$dateget','Личное имя предмета')")or die("Системная ошибка. <br><a href='index.php'>Вернуться</a>");
		mysqli_query ($db,"UPDATE users set help_steep = '1' WHERE id = '$id'") or die("Системная ошибка. <br><a href='index.php'>Вернуться</a>");
		header('Location: incubator.php');
		
	}
	
?>