<?php
	
	//session_set_cookie_params(15*60,"/","192.168.33.128"TRUE,TRUE);
	session_set_cookie_params([
	    'lifetime' => 15*60,
	    'path' => '/',
	    'domain' => 'waph-team3.minifacebook.com',
	    'secure' => TRUE,
	    'httponly' => TRUE
	]);

	session_start();  

	require "database.php";
	if (isset($_POST["username"]) and isset($_POST["password"])){
		if (checklogin_mysql($_POST["username"],$_POST["password"])) {
			$_SESSION['authenticated'] = TRUE;
			$_SESSION['username'] = $_POST["username"];
			$_SESSION['browser'] = $_SERVER["HTTP_USER_AGENT"];
		}else{
			session_destroy();
			echo "<script>alert('Invalid username/password');window.location='form.php';</script>";
			die();
		}
	}
	if (!isset($_SESSION['authenticated']) or $_SESSION['authenticated'] != TRUE) {
		session_destroy();
		echo "<script>alert('You have not loggedin,please login first!')</script>";
		header("Refresh: 0; url=form.php");
		die();
	}

	if ($_SESSION['browser'] != $_SERVER["HTTP_USER_AGENT"]) {
    session_destroy();
    echo "<script>alert('Session hijacking is detected')</script>";
    header("Refresh: 0; url=form.php");
    die();
}


?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</h2>
        <a class="btn" href="changepasswordform.php">Change Password</a> 
        <a class="btn" href="updateprofile.php">Edit Profile</a> 
        <a class="btn" href="logout.php">Logout</a>
    </div>
</body>
</html>