<?PHP


	include("_checkauth.php");
	
	$array = get_user_info($db,$hash);
	
	if( $incubator != 0 and $array['inc_end'] < microtime_float() ){
		$result = mysqli_query($db,"SELECT * FROM incubation WHERE id='$incubator'");
		$result = mysqli_fetch_array($result);
		
		$item_id = $result[1];
		$result = mysqli_query($db,"SELECT * FROM items WHERE id='$item_id'");
		$result = mysqli_fetch_array($result);
		
		$dragon_class = $result[5];
		
		mysqli_query($db,"INSERT INTO dragons (user_id,dragon_class) values ($id,$dragon_class)") or die( mysqli_error() );
		
		mysqli_query($db,"DELETE FROM incubation WHERE id = '$incubator'") or die( mysqli_error() );
		mysqli_query($db,"UPDATE users set incubator = '0' WHERE id = '$id'")or die( mysqli_error() );
		
		if( $help_steep == 1 ){
			mysqli_query($db,"UPDATE users set help_steep = '2' WHERE id = '$id'")or die( mysqli_error() );
		}
		
		header("Location: incubator.php?showdragon=$dragon_class");
	}else{
		header('Location: incubator.php');
	}


?>