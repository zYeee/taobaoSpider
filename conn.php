<?php
    $conn=mysqli_connect("127.0.0.1","taobao","xinxizhuaqu");
    mysqli_query($conn,"set names 'utf8'");
    $database="taobao";
    mysqli_select_db($conn,$database);
	mysqli_query($conn,"SET AUTOCOMMIT=0");
?>
