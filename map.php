<?PHP

include("_checkauth.php");

if( !empty($_GET['go'])){
	$togo = $_GET['go'];
	$sql = "UPDATE users set inlocation = $togo WHERE id = $id";
	mysqli_query($db,$sql);
	$userlocation = $togo;
}

if ( $help_steep < 3 ){
	header('Location: game.php');
}

include("head.php"); 
echo "<body><table class=gametable><tr><td>";
include("headinterface.php");
$result = mysqli_query($db,"SELECT * FROM gamemap WHERE id='$userlocation'");
$res = mysqli_fetch_array($result);

$sitename = $res['name'];
$sitealtname = $res['altname'];
$gomap = $res['gomap'];
$shop = $res['shopid'];
$arena = $res['arenaid'];
$tp = $res['teleportid'];
$enemy = $res['enemyid'];
$bg = $res['bgimg'];
$rec = $res['reclvl'];
?>

<center>
	<img src='img/<?PHP echo $bg; ?>' width=600px>
</center>

<?PHP

if( $help_steep >= 3 ){
	
	echo "Сейчас ты находишься в $sitealtname<br>";
	echo "Доступны перемещения в:<br>";
	if( is_int($gomap) ){
		$gomapone = mysqli_query($db,"SELECT * FROM gamemap WHERE id='$gomap'");
		$gomapone = mysqli_fetch_array($gomapone);
		$togoid = $gomapone['id'];
		$togoname = $gomapone['name'];
		echo "<a href='map.php?go=$togoid'>$togoname</a><br>";
	}else{
		//explode()
		$gomap = explode(",",$gomap);
		for( $i=0; $i<count($gomap);$i++){
			
			$gomapone = mysqli_query($db,"SELECT * FROM gamemap WHERE id='".$gomap[$i]."'");
			$gomapone = mysqli_fetch_array($gomapone);
			$togoid = $gomapone['id'];
			$togoname = $gomapone['name'];
			echo "<a href='map.php?go=$togoid'>$togoname</a><br>";
			
		}
	}
	$enemy = explode(",",$enemy);
	//$enemy
	$msg_send = false;
	
	for( $i=0; $i<count($enemy);$i++){
		if($enemy[$i] != 0){
			if( $enemy > 0 and $msg_send == false) {
				echo "<font color=red><b>Противники:</b></font><br>";
				$msg_send = true;
			}
			$enemy_info = mysqli_query($db,"SELECT * FROM enemy WHERE id='".$enemy[$i]."'");
			$enemy_info = mysqli_fetch_array($enemy_info);
			$toenemy = $enemy_info['id'];
			$enemyname = $enemy_info['enemy_alt_name'];
			$dir = "img/enemy/";
			$src = $dir.$enemy_info['enemy_ico'];
			echo "<a href='preparation.php?go=$toenemy'><b>$enemyname</b></a> <img src='$src' width=20px><br>";
		}
	}
	
	
	
}else{
	echo "В начале пройди обучение!<br>";
}

?>

</td></tr></table>
</body>