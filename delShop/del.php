<?php
	require_once("conn.php");
	$dels=file_get_contents("del");
	$dels=explode("\n",$dels);
	foreach($dels as $del){
		if($del=="")
			break;
		$query="delete from `50012825` where nick='$del'";
		echo $query."\n";
		mysqli_query($conn,$query);
	}
?>
