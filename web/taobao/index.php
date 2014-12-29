<?php
	session_start();
	require_once("conn.php");
	if($_POST['password']){
		$password=md5($_POST['password']);
		$query="select count(*) from user where pwd='$password'";
		$rs=mysqli_query($conn,$query);
		$row=mysqli_fetch_row($rs);
		if($row[0]==1){
			$_SESSION['login']="OK";
			header("Location:taobao.php");
		}
	}
?>
<html>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>登录(Login)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/supersized.css">
        <link rel="stylesheet" href="assets/css/style.css">


    </head>

    <body>

        <div class="page-container">
            <h1>登录(Login)</h1>
            <form action="" method="post">
                <input type="password" name="password" class="password" placeholder="请输入您的用户密码！">
                <button type="submit" class="submit_button">登录</button>
                <div class="error"><span>+</span></div>
            </form>
        </div>
		
        <!-- Javascript -->
        <script src="assets/js/jquery-1.8.2.min.js" ></script>
        <script src="assets/js/supersized.3.2.7.min.js" ></script>
        <script src="assets/js/supersized-init.js" ></script>

    </body>

</html>

