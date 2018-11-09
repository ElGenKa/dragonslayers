<?PHP

	include("_checkauth.php");
	if ( $help_steep < 2 ){
		header('Location: game.php');
	}
	if($help_steep >= 2){
		$array = get_user_info($db,$hash);
		
		if($array['getbonus'] == true){
			
			if( $array['exp'] > 0){
				$coff = 1 + $array['exp'] / 2000;
			}else{
				$coff = 1;
			}
			
			$money = floor(100 * $coff) + $array['money'];
			$cristall = (1 + floor($coff)) + $array['cristall'];
			//mysqli_query($db,"UPDATE users set money = '$money', cristall = '$cristall' WHERE id = '$id'")or die( mysqli_error() );
			$money_end = $money;
			$cristall_end = $cristall;
			$next = microtime_float() + $bonus_time_val;
			mysqli_query($db,"UPDATE users set getlastbonus = '$next' WHERE id = '$id'")or die( mysqli_error() );
			//$sql = true;
			
			if($help_steep == 2){
				mysqli_query($db,"UPDATE users set help_steep = '3' WHERE id = '$id'")or die( mysqli_error() );
				$help_steep = 3;
			}
			$get_ok = true;
		}else{
			$get_ok = false;
			$ok = "time";
		}
	}else{
		$get_ok = false;
		$ok = "help";
	}
	
	include("head.php"); 
	echo "<body><table class=gametable><tr><td>";
	include("headinterface.php");
	
	if($get_ok == true){
		$money = floor(100 * $coff);
		$cristall = (1 + floor($coff));
		mysqli_query($db,"UPDATE users set money = '$money_end', cristall = '$cristall_end' WHERE id = '$id'")or die( mysqli_error() );
		echo "Ваш бонус получен!<br>Деньги: <b><font color=green>$money</font></b><br>Алмазы: <b><font color=blue>$cristall</font></b><br>Яйцо дракона: <b>в разработке.</b>";
		echo "<script Language='JavaScript'>animnumber($money_end, '#money'); animnumber($cristall_end, '#cristall')</script>";
	}else{
		if($ok == "time"){
			echo "Время получения бонуса еще не пришло.";
		}
		if($ok == "help"){
			echo "Не-не-не, давай в начале обучение проходи.";
		}
	}
	
	if($help_steep == 3){
		?>
			<br><b>Биатрис</b> - Наставник новичков<br>
			Неплохо, не правда ли?<br>
			Кстати, количество денег и алмазов ты получаешь в зависимости от своего опыта!<br>
			Чем больше у тебя опыта, тем больше бонус ты будешь получать.<br>
			Гильдия драконов любит поощрять упорных приручателей!<br>
			А теперь давай откроем инвентарь, там тебя ждет твой первый дракон!<br>
			<a href='inventory.php'>Инвентарь</a> 
		<?PHP
	}
?>

</td></tr></table>
</body>
</html>