<?PHP

	include("_checkauth.php");
	
	$getitid = $_GET['id'];
	$res = mysqli_query($db,"SELECT * FROM inventory WHERE userid='$id' and itemid = '$getitid'");
	$res = mysqli_fetch_array($res);
	if( count($res) > 0 ) {
		$iid = $res[0];
		$uid = $res[4];
		mysqli_query($db,"DELETE FROM inventory WHERE id = '$iid'") or die( mysqli_error() );
		$res1 = mysqli_query($db,"SELECT * FROM items WHERE id='$uid'")or die( mysqli_error() );
		$res1 = mysqli_fetch_array($res1);
		//$cid = $res1[3];
		//$res2 = mysqli_query($db,"SELECT * FROM itemclass WHERE id='$cid'")or die( mysqli_error() );
		//$res2 = mysqli_fetch_array($res2);
		$usid = $res1[5];
		$res3 = mysqli_query($db,"SELECT * FROM dragonsclasses WHERE id='$usid'")or die( mysqli_error() );
		$res3 = mysqli_fetch_array($res3);
		$sec = $res3['secspawn'];
		if($help_steep == 1) $sec = 10;
		$mictime_start = microtime_float();
		$mictime_end = $mictime_start + $sec;
		$incid = $res1[0];
		mysqli_query($db,"INSERT INTO incubation (itemid,starttime,endtime) VALUES ($incid,$mictime_start,$mictime_end)")or die( mysqli_error() );
		$kundeid=mysqli_insert_id($db);
		mysqli_query($db,"UPDATE users set incubator = '$kundeid' WHERE id = '$id'")or die( mysqli_error() );
		header('Location: incubator.php');
	}else{
		echo "Хммм... Пахнет взломом или внутреигровой ошибкой =____=";
	}
	
?>