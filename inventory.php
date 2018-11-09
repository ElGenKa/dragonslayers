<?PHP

include("_checkauth.php");

if ( $help_steep < 3 ){
	header('Location: game.php');
}

include("head.php"); 
echo "<body><table class=gametable><tr><td>";
include("headinterface.php");
$res = mysqli_query($db,"SELECT * FROM inventory WHERE userid='$id'");

if( $help_steep == 3 ){
	?>
	<br>
	<b>Биатрис</b> - Наставник новичков<br>
	Ну вот, это твой инвентарь<br>
	Здесь ты можешь просмотреть свои вещи и драконов<br>
	Кстати, о драконах.<br>
	У каждого дракона больше количесвто характеристик<br>
	Первое значение характеристики - это базовый показатель<br>
	Каждый показатель можно улучшать за опыт дракона<br>
	Опыт можно получить разными путями:<br>
	Бои на арене<br>
	Прохождение подземелий<br>
	Бои с рядовыми противниками<br>
	Прохождение башни испытаний<br>
	Выполнение заданий<br>
	И многое другое!<br>
	Но учти, для каждого нового поднятия уровня будет требоваться больше опыта!<br>
	А теперь давай взглянем на карту и попробуем сразиться с нашим первым противником!<br>
	<a href=map.php>Карта</a>
	<br>
	<?PHP
}

echo "<center>[Инвентарь]</center><br>";
while ($data = mysqli_fetch_array($res)) {
	echo $data[0];
	echo "<br>";
}

$res = mysqli_query($db,"SELECT * FROM dragons where user_id='$id'");

echo "<br>";
echo "<center>[Драконы]</center><br>";
while ($data = mysqli_fetch_array($res)) {
	$classid = $data[2];
	$res_two = mysqli_query($db,"SELECT * FROM dragonsclasses where id='$classid'");
	$res_two = mysqli_fetch_array($res_two);
	$drsub = $data['subclass'];
	$res_three = mysqli_query($db,"SELECT * FROM dragonssubclass where id='$drsub'");
	$res_three = mysqli_fetch_array($res_three);
	
	$img = $res_two['dragon_small'];
	echo "<div class='iteminv'>";
		echo "<table border=0>";
			echo "<tr>";
				echo "<td class=itm>";
					echo "<img src=img/dragons/$img width=95px><br>";
					
				echo "</td>";
		
				echo "<td class=itm>";
					echo "Имя: <b>". $res_two['name']."</b><br>";
					echo "Здоровье: ". $res_two['hp']." + <font color=green>".$data['hp']."</font><br>";
					echo "Физический урон: ". $res_two['dmg_phis']." + <font color=green>".$data['dmg_phis'] . " + " . $res_three['dmg_phis'] ."</font><br>";
					switch($res_two['style']){
						case "Fire": echo "Урон огнем: ". $res_two['dmg_fire'] ."  <font color=green> + ". $data['dmg_fire'] . " + " . $res_three['dmg_fire'] ."</font><br>"; break;
					}
					echo "Опыт: ".$data['exp'];
				echo "</td>";
				
				echo "<td class=itm>";
					
					$dragon_age = $data['dragonage'];
					if ( $dragon_age == 0 ) $age = "младенец";
					if ( $dragon_age == 1 ) $age = "зрелый";
					if ( $dragon_age == 3 ) $age = "взрослый";
					
					if( $data['itemid_1'] == 0 ) $item1 = "пусто";
					if( $data['itemid_2'] == 0 ) $item2 = "пусто";
					if( $data['itemid_3'] == 0 ) $item3 = "пусто";
					
					echo "Возраст: <b>" . $age . "</b><br>";
					echo "Доп. класс: ".$res_three['name']."<br>";
					echo "Предмет 1: <b>" . $item1 . "</b><br>";
					echo "Предмет 2: <b>" . $item2 . "</b><br>";
					echo "Предмет 3: <b>" . $item3 . "</b><br>";
					
				echo "</td>";
		
				echo "<td class=itm>";
					echo "Физическая защита: ". $res_two['def_phis'] ." + <font color=green> ". $data['def_phis'] . " + " . $res_three['def_phis'] ."</font><br>";
					echo "Защита от огня: ". $res_two['def_fire'] ." + <font color=green> ". $data['def_fire'] . " + " . $res_three['def_fire'] ."</font><br>";
					echo "Защита от воды: ". $res_two['def_water'] ." + <font color=green> ". $data['def_water'] . " + " . $res_three['def_water'] ."</font><br>";
					echo "Защита от земли: ". $res_two['def_earth'] ." + <font color=green> ". $data['def_earth'] . " + " . $res_three['def_earth'] ."</font><br>";
					echo "Зажита от ветра: ". $res_two['def_wind'] ." + <font color=green> ". $data['def_wind'] . " + " . $res_three['def_wind'] ."</font><br>";
					
				echo "</td>";
				
				echo "<td class=itm>";
					
					echo "Защита от льда: ". $res_two['def_ice'] ." + <font color=green> ". $data['def_ice'] . " + " . $res_three['def_ice'] ."</font><br>";
					echo "Защита от грома: ". $res_two['def_thunder'] ." + <font color=green> ". $data['def_thunder'] . " + " . $res_three['def_thunder'] ."</font><br>";
					echo "Защита от яда: ". $res_two['def_poison'] ." + <font color=green> ". $data['def_poison'] . " + " . $res_three['def_poison'] ."</font><br>";
					echo "Защита от тьмы: ". $res_two['def_dark'] ." + <font color=green> ". $data['def_dark'] . " + " . $res_three['def_dark'] ."</font><br>";
					echo "Защита от света: ". $res_two['def_light'] ." + <font color=green> ". $data['def_light'] . " + " . $res_three['def_light'] ."</font><br>";
				echo "</td>";
				
			echo "</tr>";
			echo "<tr>";
				
				echo "<td>";
					$dr_id = $data['id'];
					echo "<a href='dragoninfo.php?id=$dr_id'>Подробнее</a>";
				echo "</td>";
				
				echo "<td colspan=4 class=itm>";
					
					echo "Доступные умения: ";
						
						$dragon_class_id = $res_two['id'];
						$res_five = mysqli_query($db,"SELECT * FROM dragonspells where dragonid='$dragon_class_id' and dragonage >= '$dragon_age'");
						while($spellsinfo = mysqli_fetch_array($res_five)){
							$sp_id = $spellsinfo['id'];
							$title = $spellsinfo['spell_title'];
							echo "<img src='img/spells/$sp_id.png' title='$title'>";
						}
					
				echo "</td>";
				
			echo "</tr>";
		echo "</table>";
	echo "</div><br>";
}

?>

</td></tr></table>
</body>
</html>