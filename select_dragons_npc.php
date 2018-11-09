<?PHP
include("_checkauth.php");

$lobby_id = $_GET['id'];
$lobby_id = intval($lobby_id);
if( !is_int($lobby_id) ) die("data error!");
$sql = "SELECT * FROM lobby_npc WHERE id=$lobby_id";
$res = mysqli_query($db,$sql) or die( mysqli_error() );
$res = mysqli_fetch_array($res);
if( empty($res['id'] ) ) die("data response error!");
$enemy_lobby_info = $res;
$sql = "UPDATE lobby_npc SET stage=1 WHERE id=$lobby_id";
$res = mysqli_query($db,$sql) or die( mysqli_error() );

$sql = "SELECT * FROM enemy WHERE id=".$enemy_lobby_info['npcid'];
$enemy_info = mysqli_query($db,$sql) or die( mysqli_error() );
$enemy_info = mysqli_fetch_array($enemy_info);

$enemy_name = $enemy_info['enemy_name'];
$enemy_lvl = $enemy_info['lvl'];
$enemy_hp = $enemy_info['hp'];
$enemy_style = $enemy_info['style'];
$enemy_dmg = $enemy_info['dmg'];

$dir = "img/enemy/";
$src = $dir.$enemy_info['enemy_img'];
$enemy_style_ico = strtolower($enemy_style).".png";

include("head.php"); 
echo "<body><table class=gametable><tr><td>";
include("headinterface.php");

echo "<br><center>Противники</center><br>";
echo "<table border=0 align=center><tr>";
for( $i = 0; $i < $enemy_lobby_info['countnpc']; $i++){
	echo "<td><center>";
		echo "<img src='$src' width=200px><br>";
		echo "<b>$enemy_name</b><br>";
		echo "Уровень: <b>$enemy_lvl</b><br>";
		echo "Стихия: <img src='img/dragonstyles/$enemy_style_ico' width=16px><b>$enemy_style</b><br>";
		echo "Урон: <b>$enemy_dmg</b><br>";
		echo "Здоровье: <b>$enemy_hp</b><br>";
	echo "</center></td>";
}
echo "</tr></table><br><center>[Выберете драконов!]</center><br>";

$sql = "SELECT * FROM dragons WHERE user_id=$id";
$dragons_info = mysqli_query($db,$sql);
//$dragons_info = $mysqli_fetch_array($dragons_info);
echo "<table border=0 align=center><tr>";
for( $i=0; $i<$enemy_lobby_info['count_dragons']; $i++){
	echo "<td><center>";
		echo "<img src='img/selectdragon.png' width=250px id='dragon_pic_$i' onClick='selectdragons($i)'><br>";
		echo "<font id='dragon_name_$i'></font>";
	echo "</center></rd>";
}
echo "</tr></table>";
?>

<div id='mydragons' class='dragons_select_box'>
	<center><input type='button' onclick='$("#mydragons").css("left","-8000")' value='Отмена' align=center></center>
	<table border=0 align=center>
		<?PHP
			$tr_i = 0;
			while($dragon = mysqli_fetch_array($dragons_info)){
				if($tr_i == 0) echo "<tr>";
				
					echo "<td>";
						$dragon_id = $dragon['id'];
						$dragon_class_id = $dragon['dragon_class'];
						$sql = "SELECT * FROM dragonsclasses WHERE id=$dragon_class_id";
						$dragon_class_info = mysqli_query($db,$sql) or die( mysqli_error($db) );
						$dragon_class_info = mysqli_fetch_array($dragon_class_info);
						$img = $dragon_class_info['dragon_small'];
						$dragon_name = $dragon_class_info['name'];
						echo "<img src='img/dragons/$img' width=150px onclick='selectdragon($dragon_id,\"img/dragons/$img\",\"$dragon_name\")'><br>";
						echo $dragon_name;
					
					echo "</td>";
				
				if($tr_i == 0) echo "</tr>";
				$tr_i++;
				if($tr_i == 4) $tr_i = 0;
			}
	
		?>
	</table>
	
</div>
<center>
<form action='initbatle.php' method='post' align=center>
		<input type='hidden' hidden name='lobby' value='<?PHP echo $lobby_id; ?>'>
		<input type='hidden' hidden name='dragon1' id='hdragon1' value='-1'>
		<input type='hidden' hidden name='dragon2' id='hdragon2' value='-1'>
		<input type='hidden' hidden name='dragon3' id='hdragon3' value='-1'>
		<input type='hidden' hidden name='dragon4' id='hdragon4' value='-1'>
		<input type='hidden' hidden name='dragon5' id='hdragon5' value='-1'>
		<input type='submit' value='Начать бой'>
</form>
</center>
</td></tr></table>
</body>