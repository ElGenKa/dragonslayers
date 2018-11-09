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