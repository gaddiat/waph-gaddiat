<?php
	
	
	session_set_cookie_params([
	    'lifetime' => 15*60,
	    'path' => '/',
	    'domain' => 'localhost',
	    'secure' => TRUE,
	    'httponly' => TRUE
	]);

	session_start(); 

	require "database.php";

	if (isset($_POST["username"]) and isset($_POST["password"])){
        $username = htmlspecialchars($_POST["username"]); // Sanitize input
        $password = htmlspecialchars($_POST["password"]); // Sanitize input

		if (checklogin($username,$password)) {
			$_SESSION['authenticated'] = TRUE;
			$_SESSION['username'] = $_POST["username"];
			$_SESSION['browser'] = $_SERVER["HTTP_USER_AGENT"];
		}else{
			session_destroy();
			echo "<script>alert('Invalid password/username');window.location='login.php';</script>";
			die();
		}
	}
	if (!isset($_SESSION['authenticated']) or $_SESSION['authenticated'] != TRUE) {
		session_destroy();
		echo "<script>alert('Nice try!! You have to login first!')</script>";
		header("Refresh: 0; url=login.php");
		die();
	}

	if ($_SESSION['browser'] != $_SERVER["HTTP_USER_AGENT"]) {
    session_destroy();
    echo "<script>alert('Alert! Alert ! Session hijacking is detected')</script>";
    header("Refresh: 0; url=login.php");
    die();
}

$userDetails = getUserDetails($username);
// Check if user details were found
if ($userDetails) {
    $name = htmlentities($userDetails['fullname']);
    $email = htmlentities($userDetails['primaryemail']);
} else {
    $name = "Unknown";
    $email = "Unknown";
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
        <p>Your Email: <?php echo $email; ?></p>
        <h2>Your Name <?php echo $name; ?>!</h2>
        <a class="btn" href="changepasswordform.php">Change Password</a> 
        <a class="btn" href="updateprofile.php">Edit Profile</a> 
        <a class="btn" href="logout.php">Logout</a>
    </div>
</body>
</html>