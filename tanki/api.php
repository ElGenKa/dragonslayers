<?PHP

	$ERRREPORT = 0;
	if( $ERRREPORT == 1){
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
	}else{
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
	}
	date_default_timezone_set('Etc/GMT-3');
	
	$db = mysqli_connect( "localhost", 'root', "912362Zxc!",  'tanki')or die("Нет соединения с БД");
	mysqli_set_charset($db, "utf8") or die("Не установлена кодировка соединения");

	$user_id = $_POST['id'];
	$user_lobby = $_POST['lobby'];
	$user_method = $_POST['method'];
	$user_data = $_POST['data'];
	$user_game_data = $_POST['game'];
	if(empty($user_method) ) $user_method = $_GET['method'];
	if(empty($user_data) ) $user_data = $_GET['data'];
	
	if($user_method == "NOID"){
		$user_data = explode(":",$user_data);
		$login = $user_data[0];
		$pass = $user_data[1];
		
		$check_login = mysqli_query($db, "SELECT * FRIM users WHERE login='$login'");
		$check_login = mysqli_fetch_array($check_login);
		if(empty($check_login['id'])){
			mysqli_query($db, "insert into users(uname, password, wins, loss, exp, mmoney) VALUES ('$login', '$pass', 0, 0, 0, 0)");
			$id = mysqli_insert_id($db);
			$array['job'] = 'success';
			$array['id'] = $id;
		}else{
			$array['job'] = 'badlogin';
		}
		$array = json_encode($array);
		echo $array;
	}
	
	if($user_method == "auth"){
		$user_data = explode(":",$user_data);
		$login = $user_data[0];
		$pass = $user_data[1];
		//mysqli_query($db, "insert into users(uname, pass, wins, loss, exp, mmoney) VALUES ('$user_data', $pass, 0, 0, 0, 0)");
		//$id = mysqli_insert_id($db);
		
		$res = mysqli_query($db, "SELECT * FROM users WHERE uname='$login' and password='$pass'");
		$res = mysqli_fetch_array($res);
		
		if(!empty($res['id'])){
			$array['job'] = 'success';
			$array['id'] = $res['id'];
		}else{
			$array['job'] = 'badlogin';
		}
		$array = json_encode($array);
		echo $array;
	}
	
	if($user_method == "createlobby"){
		mysqli_query($db, "insert into lobby(player1id, player2id, player1ready, player2ready, startingin) VALUES ('$user_id', -1, 0, 0, -1)");
		$id = mysqli_insert_id($db);
		$array['job'] = 'success';
		$array['id'] = $id;
		$array = json_encode($array);
		echo $array;
	}
	
	if($user_method == "getinfolobbys"){
		
		$res = mysqli_query($db,"SELECT * FROM lobby");
		while($data_res = mysqli_fetch_array($res)){
			$data['id'] = $data_res['id'];
			
			$data['pl1'] = $data_res['player1id'];
			$data['pl2'] = $data_res['player2id'];
			$user1 = mysqli_query($db,"SELECT * FROM users WHERE id='".$data_res['player1id']."'");
			$user1_res = mysqli_fetch_array($user1);
			$data['pl1name'] = $user1_res['uname'];
			if($data_res['player2id'] != -1){
				$user2 = mysqli_query($db,"SELECT * FROM users WHERE id='".$data_res['player2id']."'");
				$user2_res = mysqli_fetch_array($user2);
				$data['pl2name'] = $user2_res['uname'];
			}else{
				$data['pl2name'] = 'Ожидается...';
			}
			
			$data['name'] = "Комната №".$data_res['id']." Игрок 1: ". $data['pl1name'] . " Игрок 2: " . $data['pl2name'];
			//$res = mysqli_query($db,"SELECT * FROM lobby");
			
			$lobbylist[] = $data;
		}
		
		$array['job'] = 'success';
		$array['data'] = $lobbylist;
		$array = json_encode($array);
		echo $array;
		
	}
	
	if($user_method == "getinfolobby"){
		$button = $_POST['button_ready'];
		$pl = $_POST['color'];
		
		if($button == true) $button = 1;
		else $button = 0;
		
		if($pl == 1){
			mysqli_query($db,"UPDATE lobby SET player1ready='$button' WHERE id='$user_data'");
		}else{
			mysqli_query($db,"UPDATE lobby SET player2ready='$button' WHERE id='$user_data'");
		}
		
		$res = mysqli_query($db,"SELECT * FROM lobby WHERE id='$user_data'");
		$res = mysqli_fetch_array($res);
		
		$res = mysqli_query($db, "SELECT * FROM lobby WHERE id='$user_data'");
		$res = mysqli_fetch_array($res);
		
		$array['player1id'] = $res['player1id'];
		if($res['player1id'] != -1){
			$id_u = $res['player1id'];
			$id_u1 = $id_u;
			$res_player1 = mysqli_query($db,"SELECT * FROM users WHERE id='$id_u'");
			$res_player1 = mysqli_fetch_array($res_player1);
			$array['player1'] = $res_player1['uname'];	
		}else{
			$array['player1'] = 'Ожидается...';
		}
		$array['player2id'] = $res['player2id'];
		if($res['player2id'] != -1){
			$id_u = $res['player2id'];
			$id_u2 = $id_u;
			$res_player2 = mysqli_query($db,"SELECT * FROM users WHERE id='$id_u'");
			$res_player2 = mysqli_fetch_array($res_player2);
			$array['player2'] = $res_player2['uname'];
		}else{
			$array['player2'] = 'Ожидается...';
		}
		
		if($res['player1ready'] == 1 and $res['player2ready'] == 1){
			mysqli_query($db, "UPDATE lobby SET startingin='1' WHERE id='$user_data'");
			$array['start'] = 1;
			mysqli_query($db, "INSERT INTO batle (id, player1id, player2id) VALUES ($user_data, $id_u1, $id_u2)");
		}else $array['start'] = 0;
		
		$array['job'] = 'success';
		$array = json_encode($array);
		echo $array;
		
	}
	
	if($user_method == "joinlobby"){
		$res = mysqli_query($db,"SELECT * FROM lobby WHERE id='$user_data'");
		$res = mysqli_fetch_array($res);
		
		if($res['player2id'] == -1){
			mysqli_query($db,"UPDATE lobby SET player2id='$user_id' WHERE id='$user_data'");
			$array['join'] = 'success';
		}
		
		$array['job'] = 'success';
		$array = json_encode($array);
		echo $array;
	}
	
	if($_GET['CHECK'] == 1){
		echo "1:";
		$x = 5;
		$y = 5;
		$tr = 5;
		$hr = 5;
		$bx = 5;
		$by = 5;
		$br = 5;
		$hp = 5;
		$sp = 5;
		
		mysqli_query($db,"UPDATE batle SET player2x='$x', player2y='$y', player2_tank_rot='$tr', player2_head_rot='$hr', player2_ball_x='$bx', player2_ball_y='$by', player2_ball_rot='$br', player2_speed='$sp', player2_hp='$hp' WHERE id='30'");
		
		$res = mysqli_query($db,"SELECT * FROM batle WHERE id='30'");
		
		
		
		$res = mysqli_fetch_array($res);
		$res['job'] = 'success';
		$array = json_encode($res);
		echo $array;
	}
	
	if($user_method == "datasinc"){
		
		$x = $_POST['x'];
		$y = $_POST['y'];
		$tr = $_POST['tr'];
		$hr = $_POST['hr'];
		$bx = $_POST['bx'];
		$by = $_POST['by'];
		$br = $_POST['br'];
		$hp = $_POST['hp'];
		$sp = $_POST['sp'];
		
		if($_POST['color']==2){
			mysqli_query($db,"UPDATE batle SET player2x='$x', player2y='$y', player2_tank_rot='$tr', player2_head_rot='$hr', player2_ball_x='$bx', player2_ball_y='$by', player2_ball_rot='$br', player2_speed='$sp', player2_hp='$hp' WHERE id='$user_data'") or $error = mysqli_error();
		}else{
			mysqli_query($db,"UPDATE batle SET player1x='$x', player1y='$y', player1_tank_rot='$tr', player1_head_rot='$hr', player1_ball_x='$bx', player1_ball_y='$by', player1_ball_rot='$br', player1_speed='$sp', player1_hp='$hp' WHERE id='$user_data'") or $error = mysqli_error();
		}
		
		
		$res = mysqli_query($db,"SELECT * FROM batle WHERE id='$user_data'");
		
		$res = mysqli_fetch_array($res);
		$res['error'] = $error;
		$res['job'] = 'success';
		$array = json_encode($res);
		echo $array;
	}

?>