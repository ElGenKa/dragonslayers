<?PHP

	include("_checkauth.php");
	$steep = $_GET['steep'];
	if ( $steep == 1 ){
		$npcid = $_GET['npcid'];
		header("Location: capcha.php?steep=1&action=npcwar&npcid=$npcid");
	}elseif ($steep == 2){
		$capcha = $_GET['capcha'];
		$npcid = $_GET['npcid'];
		
		$sql = "SELECT id FROM capcha WHERE id='$capcha' and userid='$id' and status=1";
		$res = mysqli_query($db,$sql);
		$res = mysqli_fetch_array($res);
		//print_r($res);
		if (!empty($res['id'])) {
			$sql = "UPDATE capcha SET status=2 WHERE id='$capcha'";
			mysqli_query($db,$sql) or die( mysqli_error() );
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
			
			$enemy_rand = rand($count_min,$count_max);
			
			$sql = "INSERT INTO lobby_npc (user_id, status, stage, corent_exp, corent_gold, countnpc, npcid, count_dragons) VALUES ($id, 0, 0, 0, 0, $enemy_rand, $npcid, 3)";
			$res = mysqli_query($db,$sql) or die( mysqli_error() );
			$lobby_id = mysqli_insert_id($db);
			//print_r($lobby_id);
			
			header("Location: select_dragons_npc.php?id=$lobby_id");
		}
	}


?>