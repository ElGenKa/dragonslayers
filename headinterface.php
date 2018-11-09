<?PHP

$array = get_user_info($db,$hash);

?>
<center>
	
	<table border=1>
		<tr>
			<td>
				<center>
					<img src="img/money.png" width=20px>
					<font id='money'><?PHP echo $array['money']; ?></font>
				</center>
			</td>
			<td>
				<center>
					<img src="img/diamond.png" width=20px>
					<font id='cristall'><?PHP echo $array['cristall']; ?></font>
				</center>
			</td>
			<td>
				<center>
					<img src="img/exp.png" width=20px>
					<font id='exp'><?PHP echo $array['exp']; ?></font>
				</center>
			</td>
		</tr>
	</table>
	<nav class="cl-effect-1">
	<table border=1>
		<tr>
			<td>
				<a href='inventory.php'>Инвентарь</a>
			</td>
			<td>
				<a href='incubator.php'>Инкубатор</a>
			</td>
			<td>
				<a href='map.php'>Карта</a>
			</td>
			<td>
				<a href='quests.php'>Задания</a>
			</td>
			<td>
				<?PHP
				
					if( $array['getbonus'] == true ) echo "<a href='get_bonus.php'>Получить бонус</a>";
					else{
						echo "<font id='alltextbonus'>До следующего бонуса: <font id='timebonus'>". $array['nextbonus'] ."с.</fonr></font>";
					}
				
					//echo "<script language='JavaScript'>";
					//echo "document.getElementById('timebonus')";
				?>
			</td>
			<td>
				<a href='settings.php'>Настройки</a>
			</td>
		</tr>
		<tr>
			<td colspan=6>
				<center>Серверное время: <?PHP echo date("d F Y H:i:s"); ?> </center>
			</td>
		</tr>
		
	</table>
	</nav>
	<?PHP
		if ($incubator != 0)
			if( $array['inc_end'] < microtime_float() ) 
				echo "<font color=green>Инкубация закончена</font>";
	?>
</center>

<script language='JavaScript'>
	var bonustime = <?PHP echo $array['nextbonus']; ?>;
	var thisstart = <?PHP if(empty($array['getbonus']))echo "1"; else echo "0"; ?>;
	
	function num(val){
        val = Math.floor(val);
        return val < 10 ? '0' + val : val;
    }
	
	function tohms(){
		var sec = bonustime
          , hours = sec / 3600  % 24
          , minutes = sec / 60 % 60
          , seconds = sec % 60
        ;
		return num(hours) + ":" + num(minutes) + ":" + num(seconds);
	}
	
	function timer1_timeout(){
		bonustime = bonustime - 1;
		texttime.innerHTML = tohms();
		if ( bonustime == 0){
			alltext.innerHTML = "<a href='get_bonus.php'>Получить бонус</a>";
		}else{
			setTimeout( timer1_timeout, 1000 );
		}
	}
	
	if( thisstart == 1 ){
		var texttime = document.getElementById('timebonus');
		var alltext = document.getElementById('alltextbonus');
		setTimeout( timer1_timeout, 1000 );
	}
</script>