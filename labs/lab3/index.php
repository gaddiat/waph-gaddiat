<?php
	session_start();    
	if (checklogin_mysql($_POST["username"],$_POST["password"])) {
?>
	<h2> Welcome <?php echo $_POST['username']; ?> !</h2>
<?php		
	}else{
		echo "<script>alert('Invalid username/password');window.location='form.php';</script>";
		die();
	}
	function checklogin_mysql($username, $password) {
		$mysqli = new mysqli('localhost','gaddiat','1234','waph');
		if($mysqli->connect_errno){
			printf("Database connection failed: %s\n", $mysqli->connect_errno);
			exit();
		}
		$sql = "SELECT * FROM users WHERE username='" .$username ."' ";
		$sql = $sql . "AND password =md5('" . $password . "')";
		$result = $mysqli->query($sql);
		if($result->num_rows ==1)
			return TRUE;
		return FALSE;
  	}
?>
