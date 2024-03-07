<?php

	$username = $_POST["username"];
	$password = $_POST["password"];
	
	//session_set_cookie_params(15*60,"/","192.168.33.128"TRUE,TRUE);
	/*session_set_cookie_params([
	    'lifetime' => 15*60,
	    'path' => '/',
	    'domain' => 'gaddiat.waph.io',
	    'secure' => TRUE,
	    'httponly' => TRUE
	]);

	session_start();   
*/
	if (isset($username) and isset($password)){

		//echo "Debug -> got username-->$username; and password -->$password";

		if (addnewuser($username,$password)) {

			echo "Registration Success!!";
		/*	$_SESSION['authenticated'] = TRUE;
			$_SESSION['username'] = $_POST["username"];
			$_SESSION['browser'] = $_SERVER["HTTP_USER_AGENT"];*/
		}else{
			echo "Registration Failed!!";
			/*session_destroy();
			echo "<script>alert('Invalid username/password');window.location='form.php';</script>";
			die();*/
		}
	}
	else {

		echo "No Username or Password!!";
	}
/*	if (!isset($_SESSION['authenticated']) or $_SESSION['authenticated'] != TRUE) {
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
}*/


	function addnewuser($username, $password) {
		$mysqli = new mysqli('localhost','gaddiat','1234','waph');
		if($mysqli->connect_errno){
			printf("Database connection failed: %s\n", $mysqli->connect_errno);
			return FALSE;
		}
		$sql = "INSERT INTO users (username,password) VALUES (?,md5(?));";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ss", $username, $password);
		//$stmt->execute();
		//$result = $stmt->get_result();
		if($stmt->execute())
			return TRUE;
		return FALSE;
  	}

?>
		
		<a href="logout.php">logout</a>