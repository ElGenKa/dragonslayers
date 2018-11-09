<?PHP //5363236Zxc! root
global $bonus_time_val;
$bonus_time_val = 14400;
date_default_timezone_set('Etc/GMT-3');
$db = mysqli_connect( "localhost", 'root', "912362Zxc!",  'dragonslayers')or die("Нет соединения с БД");
mysqli_set_charset($db, "utf8") or die("Не установлена кодировка соединения");

function sqlupdaue(){
	
	
	
}

function sqlinsert(){
	
	
	
}

function sqlselect(){
	
	
	
}

function microtime_float(){
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function get_user_info($db,$hash){
	date_default_timezone_set('Etc/GMT-3');
	global $bonus_time_val;
	$result = mysqli_query($db,"SELECT * FROM users WHERE auth_hash='$hash'");
	$myrow = mysqli_fetch_array($result);
	$array['money'] = $myrow['money'];
	$array['cristall'] = $myrow['cristall'];
	$array['exp'] = $myrow['exp'];
	$array['bonus'] = $myrow['getlastbonus'];
	
	if ($myrow['incubator']!=0){
		$inc = $myrow['incubator'];
		$res = mysqli_query($db,"SELECT * FROM incubation WHERE id='$inc'");
		$res = mysqli_fetch_array($res);
		$array['inc_end'] = $res[3];
	}
	
	$this_time = microtime_float();
	$this_time = $this_time - $array['bonus'];
	$this_time = $this_time * -1;
	if( $this_time <= 0 ) $array['getbonus'] = true;
	else {
		$array['getbonus'] = false;
		$array['nextbonus'] = floor($this_time);
	}
	
	return $array;
}

?>