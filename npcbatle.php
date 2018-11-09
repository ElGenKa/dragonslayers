<?PHP
include("_checkauth.php");
$lobby = intval($_GET['id']);

$sql = "SELECT * FROM lobby_npc WHERE id = $lobby";
$res = mysqli_query($db, $sql);
$res = mysqli_fetch_array($res);

$npcs = explode(',', $res['npcids']);
$js = "<script language='JavaScript'>";
$js .= "var enemyinfo = [][];";
$table = "<table border=0 align=center><tr>";
for($i=0; $i<count($npcs)-1; $i++){
	$table .="<td>";
	$npc = $npcs[$i];
	$npcids[] = $npc;
	$sql = "SELECT * FROM enemy_batle WHERE id = $npc";
	$res = mysqli_query($db, $sql);
	$info = mysqli_fetch_array($res);
	
	$dmg = $info['dmg'];
	$hp = $info['hp'];
	$def = $info['def'];
	$speed = $info['speed'];
	$speedsteep = $info['speedsteep'];
	$money = $info['mmoney'];
	$exp = $info['exp'];
	$status = $info['status'];
	$class = $info['enemyclassid'];
	$sql_img = "SELECT enemy_img FROM enemy WHERE id = $class";
	$sql_img = mysqli_query($db, $sql_img);
	$sql_img = mysqli_fetch_array($sql_img);
	$sql_img = $sql_img[0];
	
	$table .= "<img src='img/enemy/$sql_img' width=200px><br>";
	$table .= "<div class='w3-light-grey w3-round-large' style='width: 200px'>";
	$table .= "<div id='hp_bar_$i' class='w3-container w3-red w3-round' style='width:100%'>$hp hp</div></div>";
	
	$table .= "<div class='w3-light-grey w3-round-large' style='width: 200px'>";
	$table .= "<div id='speed_bar_$i' class='w3-container w3-blue w3-round' style='width:100%'>$speed выносливлость</div></div>";
	
	$js .= "enemyinfo[$i]['id']= $npc;";
	$js .= "enemyinfo[$i]['dmg']= $dmg;";
	$js .= "enemyinfo[$i]['hp']= $hp;";
	$js .= "enemyinfo[$i]['starthp']= $hp;";
	$js .= "enemyinfo[$i]['speed']= $speed;";
	$js .= "enemyinfo[$i]['speedsteep']= $speedsteep;";
	$js .= "enemyinfo[$i]['money']= $money;";
	$js .= "enemyinfo[$i]['exp']= $exp;";
	$js .= "enemyinfo[$i]['status']= $status;";
	$table .= "</td>";
}
$js .= "</script>";
$table .="</tr></table>";
include("head.php"); 
echo "<body><table class=gametable><tr><td>";
include("headinterface.php");
echo $js;
echo "<script src='js/npcbatle.js'></script>";
echo '<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">';
echo "<center><font id='isplay' color=yellow>Подготовка...</font></center><br>";

echo $table;


?>

</td></tr></table>
</body>