<html>

	<?PHP
	include ("_core.php"); 
	include("head.php"); 
	?>
	
	<body id='mainform' hidden>
		
		<table id='maintable' align=center class='gametable'>
		
			<tr>
			
				<td><center><h3><b>Вход</b></h3></center></td>
				
			</tr>
			<tr>
				<td>
				
					<center>
						<h3>Главная страница немного сломана и информация на ней не достоверня .-.</h3>
						<h3>Хотя все равно это некому читать...</h3>
						<form name="f1" action='auth.php' method='POST' id='f_auth'>
							<input type='text' name='login' placeholder="Логин"><br>
							<input type='password' name='password' placeholder="Пароль"><br>
							<input type='submit' value='Вход'><br><br>
							<a onClick='userrepass()' class='abutton'>Забыл пароль</a><br>
							<a onClick='userregister()' class='abutton'>У меня нет аккаунта</a>
						</form>
					
					</center>
				
				</td>
			</tr>
			
		
		</table>
		
		<table id='f_register' hidden align=center class='gametable'>
			<!--<img src='img/1.jpg'>-->
			<tr>
			
				<td><center><h3><b>Регистрация</b></h3></center></td>
				
			</tr>
			<tr>
				<td>
				
					<center>
						<form name="f1" action='reg.php' method='POST'>
							<input type='text' name='login_r' placeholder="Логин"><br>
							<input type='password' name='password_r' placeholder="Пароль"><br>
							<input type='submit' value='Зарегестрироваться'><br><br>
							<a onClick='gomain()' class='abutton'>Отмета</a><br>
							Внимание! Длинна логина и пароля должна быть не менее 6 символов.
						</form>
					</center>
				
				</td>
			</tr>
		</table>
		
		<table id='f_repass' hidden align=center class='gametable'>
			<!--<img src='img/1.jpg'>-->
		</table>
		
	</body>
	
	<div class=gametable>
		<center>
	
		<b>Версия:</b> 0.1 Pre beta<br>
		<b>Последнее обновление:</b> 05.06.2017 05:00:00<br>
		<b>Последний вайп:</b> 03.04.2017 01:35:00<br><br>
		<b>Готовность движка:</b> 45%<br>
		<b>Готовность артов:</b> 0%<br>
		<b>Готовность дизайна:</b> 17%<br>
		<b>Готовность графики:</b> 3%<br>
		<b>Готовность лора:</b> 2%<br>
		<b>Готовность мира:</b> 5%<br>
		<b>Зарегестрированно пользователей:</b> 
		<?PHP
			$sql = "SELECT COUNT(*) FROM users";
			$res = mysqli_query($db,$sql);
			$users = mysqli_fetch_array($res);
			echo $users[0];
		?>
		
		<br><br>
		<h4>Обновление <b>0.1 Pre beta</b></h4>
		<table border=1 width=600px>
			<tr>
				<td valign=top><b>Добавлено:</b></td>
					<td>
						Новые драконы<br>
						Новые противники<br>
						Новые локации<br>
						Боевая система<br>
						Магазин<br>
						Зелья здоровья<br>
						Дроп с монстров (в будущем для крафтов)<br>
						Панель администрирования (бета)<br>
						Кнопка выхода из игры (в настройках)<br>
					</td>
			</tr>
			<tr>
				<td valign=top><b>Изменено:</b></td>
					<td>
						Уменьшена прозрачность выбора дракона<br>
						Увеличин размер выбираемых драконов<br>
						Уменьшено количество денег и кристаллов за бонус<br>
						Дракнам теперь нужно восстанавливать здоровье перед битвами<br>
					</td>
			</tr>
			<tr>
				<td valign=top><b>Удалено:</b></td>
				<td>
					-
				</td>
			</tr>
			<tr>
				<td valign=top><b>Исправленно:</b></td>
				<td>
					Время на таймере теперь в форматы чч:мм:сс<br>
				</td>
			</tr>
			<tr>
				<td valign=top><b>В следующем обновлении:</b></td>
				<td>
					Крафты<br>
					Задания<br>
					Данжы<br>
					Слияния драконов<br>
					Повышение уровенй драконов<br>
				</td>
			</tr>
		</table>
		
		<h4>Разработчики:</h4>
		<table border=1 width=600px>
		<tr>
			<td><b>Программист/основатель проекта: </b></td><td><a href='https://vk.com/id10947798'>Иванов Денис</a></td>
		</tr>
		<tr>
			<td><b>Художник: </b></td><td><a href=''>Мария</a></td>
		</tr>
		<tr>
			<td><b>Системный администратор: </b></td><td><a href='https://vk.com/id9674902'>Сергей Скворцов</a></td>
		</tr>
		<tr>
			<td><b>Гейм дизайнер: </b></td><td><a href='https://vk.com/id62302365'>Василий Миронов</a></td>
		</tr>
		</table>
		
		<br>
		Спонсор(ы) проекта:<br>
		<a href='https://vk.com/id9674902'>Сергей Скворцов</a><br>
		
		
		
		<br>Серверное время: <?PHP
		echo date("d F Y H:i:s"); 
		?>
	
		</center>
	</div>

</html>

<script language="JavaScript">

	function userauth(){
		
	}
	
	function userrepass(){
		
	}
	
	function userregister(){
		document.getElementById('f_register').hidden = false;	
		document.getElementById('maintable').hidden = true;	
	}
	
	function gomain(){
		document.getElementById('f_register').hidden = true;
		document.getElementById('f_repass').hidden = true;
		document.getElementById('f_game').hidden = true;
		document.getElementById('maintable').hidden = false;	
	}

	//содержимое загрузилось...
	document.getElementById('mainform').hidden = false;	
	
</script>