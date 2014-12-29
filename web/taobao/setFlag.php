<?php
	require_once("conn.php");
	$cat=$_GET['cat'];
	$itemid=$_GET['itemid'];
	$query="update `$cat` set isFlag=true where itemid = '$itemid'";
	mysqli_query($conn,$query);
?>
