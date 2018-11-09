<?PHP

include("_checkauth.php");
include("head.php"); 
echo "<body><table class=gametable><tr><td>";
include("headinterface.php");
	$capchastep = $_GET['steep'];
	echo "<center>";
	if( $capchastep == '1' ){
		$action = $_GET['action'];
		$npcid = $_GET['npcid'];
		$symbols = array(0,1,2,3,4,5,6,7,8,9);
		$count = 6;
		for($i = 0; $i<$count; $i++){
			$rnd = rand(0,count($symbols)-1);
			$code = $code.$symbols[$rnd];
			$img = $img."<img src='img/capcha/$rnd.png'>";
		}

		$sql = "INSERT INTO capcha (userid, code, status) VALUES ($id, $code, 0)";
		$res = mysqli_query($db,$sql);
		$capid = mysqli_insert_id($db);
		echo "Подтвердите, что вы не робот!<br>";
		echo $img;
		echo "<br><form action='capcha.php' method='GET'>
					 <input type='hidden' hidden name='steep' value=2>
					 <input type='hidden' hidden name='capchaid' value=$capid>
					 <input type='hidden' hidden name='action' value=$action>
					 <input type='hidden' hidden name='npcid' value=$npcid>
					 <input type='text' name='code'><br>
					 <input type='submit' value='Я не робот!'>
				  </form>";
	}elseif ($capchastep == '2'){
		$get_code = $_GET['code'];
		$capcha_id = $_GET['capchaid'];
		$action = $_GET['action'];
		$npcid = $_GET['npcid'];
		$sql = "SELECT id FROM capcha WHERE id='$capcha_id' and code='$get_code'";
		$res = mysqli_query($db,$sql);
		$res = mysqli_fetch_array($res);
		
		if (!empty($res['id'])) {
			$sql = "UPDATE capcha SET status=1 WHERE id='$capcha_id'";
			$res = mysqli_query($db,$sql);
			//mysqli_fetch_array($sql);
			
			echo "<b><font color=green>Код введен правильно</font></b><br>";
			if( $action == 'npcwar' ){
				echo "<a href='npsstartbatle.php?steep=2&capcha=$capcha_id&action=$action&npcid=$npcid'>Продолжить</a>";		
			}
		}else{
			$sql = "UPDATE capcha SET status=2 WHERE id='$capcha_id'";
			$res = mysqli_query($db,$sql);
			mysqli_fetch_array($sql);
			echo "<font color=red><b>Ошибка! Код введен не верно, попробуйте еще раз.</b></font><br>";
			echo "<a href='capcha.php?steep=1&action=$action&npcid=$npcid'>Повторить попытку</a>";
		}
	}
	echo "</center>";


?>

</td></tr></table>
</body>