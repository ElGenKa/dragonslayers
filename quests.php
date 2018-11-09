<?PHP

include("_checkauth.php");

if ( $help_steep < 3 ){
	header('Location: game.php');
}

include("head.php"); 
echo "<body><table class=gametable><tr><td>";
include("headinterface.php");

?>


<?PHP


?>

</td></tr></table>
</body>