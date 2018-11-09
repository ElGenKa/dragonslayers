<?PHP
include("_checkauth.php");
$lobby = intval($_POST['lobby']);
$dragons[] = intval($_POST['dragon1']);
$dragons[] = intval($_POST['dragon2']);
$dragons[] = intval($_POST['dragon3']);
$dragons[] = intval($_POST['dragon4']);
$dragons[] = intval($_POST['dragon5']);

for($i=0; $i<count($dragons);$i++){
	if (is_int($dragons[$i])){
		
		if ($dragons[$i] != -1){
			$selectid = $dragons[$i];
			$sql = "SELECT * FROM dragons WHERE id = $selectid";
			$definfo = mysqli_query($db, $sql);
			$definfo = mysqli_fetch_array($definfo);
			$class_dragon_id = $definfo['dragon_class'];
		
			$sql = "SELECT * FROM dragonsclasses WHERE id = $class_dragon_id";
			$classinfo = mysqli_query($db, $sql);
			$classinfo = mysqli_fetch_array($classinfo);
		
			$dragon_sub_class_id = $definfo['subclass'];
			$sql = "SELECT * FROM dragonssubclass WHERE id = $dragon_sub_class_id";
			$subclassinfo = mysqli_query($db, $sql);
			$subclassinfo = mysqli_fetch_array($subclassinfo);
			
			$orignalid = $dragons[$i];
			
			$dragon_hp = $definfo['hp'] + $classinfo['hp'] + $subclassinfo['hp'];
			$dragon_dmg_phis = $definfo['dmg_phis'] + $classinfo['dmg_phis'] + $subclassinfo['dmg_phis'];
			$dragon_dmg_fire = $definfo['dmg_fire'] + $classinfo['dmg_fire'] + $subclassinfo['dmg_fire'];
			$dragon_dmg_water = $definfo['dmg_water'] + $classinfo['dmg_water'] + $subclassinfo['dmg_water'];
			$dragon_dmg_earth = $definfo['dmg_earth'] + $classinfo['dmg_earth'] + $subclassinfo['dmg_earth'];
			$dragon_dmg_wind = $definfo['dmg_wind'] + $classinfo['dmg_wind'] + $subclassinfo['dmg_wind'];
			$dragon_dmg_ice = $definfo['dmg_ice'] + $classinfo['dmg_ice'] + $subclassinfo['dmg_ice'];
			$dragon_dmg_thunder = $definfo['dmg_thunder'] + $classinfo['dmg_thunder'] + $subclassinfo['dmg_thunder'];
			$dragon_dmg_poison = $definfo['dmg_poison'] + $classinfo['dmg_poison'] + $subclassinfo['dmg_poison'];
			$dragon_dmg_dark = $definfo['dmg_dark'] + $classinfo['dmg_dark'] + $subclassinfo['dmg_dark'];
			$dragon_dmg_light = $definfo['dmg_light'] + $classinfo['dmg_light'] + $subclassinfo['dmg_light'];
			
			$dragon_def_phis = $definfo['def_phis'] + $classinfo['def_phis'] + $subclassinfo['def_phis'];
			$dragon_def_fire = $definfo['def_fire'] + $classinfo['def_fire'] + $subclassinfo['def_fire'];
			$dragon_def_water = $definfo['def_water'] + $classinfo['def_water'] + $subclassinfo['def_water'];
			$dragon_def_earth = $definfo['def_earth'] + $classinfo['def_earth'] + $subclassinfo['def_earth'];
			$dragon_def_wind = $definfo['def_wind'] + $classinfo['def_wind'] + $subclassinfo['def_wind'];
			$dragon_def_ice = $definfo['def_ice'] + $classinfo['def_ice'] + $subclassinfo['def_ice'];
			$dragon_def_thunder = $definfo['def_thunder'] + $classinfo['def_thunder'] + $subclassinfo['def_thunder'];
			$dragon_def_poison = $definfo['def_poison'] + $classinfo['def_poison'] + $subclassinfo['def_poison'];
			$dragon_def_dark = $definfo['def_dark'] + $classinfo['def_dark'] + $subclassinfo['def_dark'];
			$dragon_def_light = $definfo['def_light'] + $classinfo['def_light'] + $subclassinfo['def_light'];
			
			$sql = "INSERT INTO dragonsbatle (user_id, orignalid, hp, dmg_phis, dmg_fire, dmg_water, dmg_earth, dmg_wind, dmg_ice, dmg_thunder, dmg_poison, dmg_dark, dmg_light, def_phis, def_fire, def_water, def_earth, def_wind, def_ice, def_thunder, def_poison, def_dark, def_light) VALUES ($id, $orignalid, $dragon_hp, $dragon_dmg_phis, $dragon_dmg_fire, $dragon_dmg_water, $dragon_dmg_earth, $dragon_dmg_wind, $dragon_dmg_ice, $dragon_dmg_thunder, $dragon_dmg_poison, $dragon_dmg_dark, $dragon_dmg_light, $dragon_def_phis, $dragon_def_fire, $dragon_def_water, $dragon_def_earth, $dragon_def_wind, $dragon_def_ice, $dragon_def_thunder, $dragon_def_poison, $dragon_def_dark, $dragon_def_light)";
			
			mysqli_query($db, $sql) or die("INSERT DATA ERROR!!!");
			$lastid =  mysqli_insert_id($db);
		}
		
		$dragonlist .= ($dragons[$i] == -1) ? 0 : $lastid;
		$dragonlist .= ($i == count($dragons)-1) ? "" : ",";
	}else{
		die("POST DATA ERROR!!!");
	}
}
if( !is_int($lobby) ) dir("POST DATA ERROR!!!");
$sql = "UPDATE lobby_npc SET dragonsids = '$dragonlist' WHERE id = $lobby";
mysqli_query($db,$sql) or die("MYSQL UPDATE ERROR!!!");

$sql = "SELECT countnpc, npcid FROM lobby_npc WHERE id = $lobby";
$res = mysqli_query($db,$sql) or die("MYSQL GET DATA ERROR!!!");
$res = mysqli_fetch_array($res);

$npcid = $res['npcid'];
$enemy_info = mysqli_query($db,"SELECT * FROM enemy WHERE id='$npcid'") or die( mysqli_error() );
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

$speedmax = $enemy_info['speedmax'];
$speedsteep = $enemy_info['speedsteep'];
$style_def = $enemy_info['style_def'];

for($i = 0; $i<$res['countnpc']; $i++){
	$money = rand($money_min, $money_max);
	$exp = rand($exp_min, $exp_max);
	$sql = "INSERT INTO enemy_batle (dmg, hp, def, speed, speedsteep, enemyclassid, mmoney, exp) VALUES ($enemy_dmg, $enemy_hp, $style_def, $speedmax, $speedsteep, $npcid, $money, $exp)";
	mysqli_query($db,$sql) or die(mysqli_error());
	$npcidl = mysqli_insert_id($db);
	$npcids .= ($i == $res['countnpc']-1) ? "$npcidl" : "$npcidl,";
}

$sql = "UPDATE lobby_npc SET npcids = '$npcids' WHERE id = $lobby";
mysqli_query($db,$sql) or die("MYSQL UPDATE ERROR!!!");

header("Location: npcbatle.php?id=$lobby");
?>