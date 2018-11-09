<?PHP

	include("_checkauth.php");
	
	include("head.php"); 
	echo "<body><table class=gametable><tr><td>";
	include("headinterface.php");
	
	
	$result = mysqli_query($db,"SELECT * FROM inventory WHERE userid='$id' and type='Egg'");
	
	while ($row = mysqli_fetch_array($result)) {
	
		$yegs_datd[0] = $row['id'];
		$yegs_datd[1] = $row['name'];
		$yegs_datd[2] = $row['type'];
		$yegs_datd[3] = $row['userid'];
		$yegs_datd[4] = $row['itemid'];
		$yegs_datd[5] = $row['dateget'];
		$yegs[] = $yegs_datd;
		
	}
	//echo "<br><pre>";
	//print_r($yegs);
	//echo "</pre><br>";
	$ibr = 0;
	echo "<br><center>[ ИНВЕНТАРЬ ]</center> <br>";
	if(count($yegs) == 0){
		echo "В вашем инвентаре отсутствуют яйца.";
	}
	for( $i=0; $i<count($yegs); $i++){

		$result_a = mysqli_query($db,"SELECT * FROM items WHERE id='".$yegs[$i][4]."'");
		
		//$yegs[$i][4]
		
		$row_a = mysqli_fetch_array($result_a);

		echo "<div class='itemdragon'>";
		echo "<center><img src='img/itemico/".$row_a[4]."'><br>";
		echo $row_a[1];
		$iid = $row_a[0];
		if( $incubator == 0 ) echo "<br><a href='loadincubator.php?id=$iid'>Положить в инкубатор</a>";
		echo "</center></div>";

		$ibr++;
		
		if( $ibr == 3) {
			echo "<br>";
			$ibr = 0;
		}
		
	}
	
	if( !empty($_GET['showdragon'])){
		$class_id = $_GET['showdragon'];
		$result = mysqli_query($db,"SELECT dragon_small, alt_name FROM dragonsclasses WHERE id='$class_id'");
		$result = mysqli_fetch_array($result);
		$art = $result[0];
		$name = $result[1];
		echo "<br>";
		echo "Поздравлеяем! вы получили <b>$name</b>!<br>";
		echo "<img src='img/dragons/dragon_fire.png'>";
		echo "<br><br>";
	}
	
	if( $help_steep == 2 ){
		?>
			<br><b>Биатрис</b> - Наставник новичков<br>
			Поздравляю! Теперь у тебя есть свой собственный дракон!<br>
			Кстати, каждые 4 часа ты можешь бесплатно получать бонусы от гильдии драконов!<br>
			Драконы, которых можно получить из бонусов - случайны!<br>
			Если ты везунчик, то сможешь получить там самых редких драконов совершенно бесплатно!<br>
			Также там можно получить деньги и опыт.<br>
			А теперь пора получить твой первый бонус!<br>
			<a href='get_bonus.php'>Получить бонус</a> 
		<?PHP
	}
	
	echo "<br><center>[ ИНКУБАТОР ]</center><br>";
	if( $incubator == 0 ) {
		echo "Инкубатор пуст.";
		$jsstart = 0;
	}else{
		$jsstart = 1;
		$result = mysqli_query($db,"SELECT * FROM incubation WHERE id='$incubator'");
		$row = mysqli_fetch_array($result);
		$class_id = $row[1];
		$result = mysqli_query($db,"SELECT alt_name FROM dragonsclasses WHERE id='$class_id'");
		$row_two = mysqli_fetch_array($result);
		$alt_name = $row_two[0];
		$start_time = $row[2];
		$end_time = $row[3];
		$mictime_this = microtime_float();
		$curent_time = floor($end_time - $mictime_this);
		if( $curent_time > 0 ){
			echo "<font id='alltextinc'>В инкубаторе есть яйцо <b>$alt_name</b><br>";
			echo "До конца инкубации <font id='timeinc'>$curent_time</font> сек.</font>";
		}else{
			echo "Инкубация завершилась!<br>";
			//echo "<font color=red>здесь должна быть кнопка, но скрипт пока не готов :)</font>";
			echo "<a href='getincubator.php'>Получить дракона</a>";
		}
	}
	
	

?>
</td></tr></table>
</body>

<script language='JavaScript'>
	//var bonustime = <?PHP echo $array['nextbonus']; ?>;
	//var thisstart = <?PHP if(empty($array['getbonus']))echo "1"; else echo "0"; ?>;
	var jsstart = <?PHP echo $jsstart; ?>;
	var altname = <?PHP echo "'".$alt_name."'"; ?>;
	var curenttime = <?PHP echo $curent_time; ?>;
	
	function timer2_timeout(){
		curenttime = curenttime - 1;
		inctime.innerHTML = curenttime;
		if ( curenttime == 0){
			alltextinc.innerHTML = "Инкубация завершилась!<br><a href='getincubator.php'>Получить дракона</a>";
		}else{
			setTimeout( timer2_timeout, 1000 );
		}
	}
	
	if( jsstart == 1 ){
		var inctime = document.getElementById('timeinc');
		var alltextinc = document.getElementById('alltextinc');
		setTimeout( timer2_timeout, 1000 );
	}
</script>