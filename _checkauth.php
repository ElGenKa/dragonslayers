<?PHP
	$ERRREPORT = 1;
	if( $ERRREPORT == 1){
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
	}else{
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
	}
	$hash = $_COOKIE["hash"];

	//print_r($hash);
	if(empty($hash)) exit("Вы не авторизированны! <br><a href='index.php'>Главная</a>");
	include ("_core.php");
	$result = mysqli_query($db,"SELECT * FROM users WHERE auth_hash='$hash'");
	$myrow = mysqli_fetch_array($result);
	$id = $myrow['id'];
	$login = $myrow['login'];
	$name = $myrow['user_name'];
	$help_steep = $myrow['help_steep'];
	$incubator = $myrow['incubator'];
	$isadmin = $myrow['isadmin'];
	$userlocation = $myrow['inlocation'];
	if (empty($id)) {
		exit ("Вы не авторизированны! <br><a href='index.php'>Главная</a>");
    }
	
?>