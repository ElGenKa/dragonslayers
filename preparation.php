<?PHP

include("_checkauth.php");
include("head.php"); 
echo "<body><table class=gametable><tr><td>";
include("headinterface.php");


	$enemy_id = $_GET['go'];
	$enemy_info = mysqli_query($db,"SELECT * FROM enemy WHERE id='".$enemy_id."'");
	$enemy_info = mysqli_fetch_array($enemy_info);
	$count = $enemy_info['enemy_count'];
	$count = explode('-',$count);
	$count_min = $count[0];
	$count_max = $count[1];
	$enemy_name = $enemy_info['enemy_name'];
	$enemy_alt_name = $enemy_info['enemy_alt_name'];
	$enemy_lvl = $enemy_info['lvl'];
	$enemy_hp = $enemy_info['hp'];
	$enemy_style = $enemy_info['style'];
	$enemy_dmg = $enemy_info['dmg'];
	$enemy_exp = $enemy_info['get_exp'];
	$enemy_money = $enemy_info['get_money'];
	
	$enemy_exp = explode("-",$enemy_exp);
	$exp_min = $enemy_exp[0];
	$exp_max = $enemy_exp[1];
	
	$enemy_money = explode("-",$enemy_money);
	$money_min = $enemy_money[0];
	$money_max = $enemy_money[1];
	
	$dir = "img/enemy/";
	$src = $dir.$enemy_info['enemy_img'];
	
	$enemy_style_ico = strtolower($enemy_style).".png";
	
	echo "<img src='$src' width=250px><br>";
	
	echo "Противкник: <b>$enemy_name</b><br>";
	echo "Численность от <b>$count_min</b> до <b>$count_max</b><br>";
	echo "Уровень: <b>$enemy_lvl</b><br>";
	echo "Стихия: <img src='img/dragonstyles/$enemy_style_ico' width=16px><b>$enemy_style</b><br>";
	echo "Урон: <b>$enemy_dmg</b><br>";
	echo "Здоровье: <b>$enemy_hp</b><br>";
	echo "Получаемый опыт от <b>$exp_min</b> до <b>$exp_max</b><br>";
	echo "Получаемое золото от <b>$money_min</b> до <b>$money_max</b><br>";
	echo "<a href='npsstartbatle.php?steep=1&npcid=$enemy_id'>Напасть!</a>"

?>
</td></tr></table>
</body>