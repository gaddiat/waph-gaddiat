<?php
	require "database.php";
	$username = $_POST['username'];
	$password = $_POST['password'];


	if (isset($_POST['username']) && isset($_POST['password'])) {
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $primaryemail = isset($_POST['email']) ? $_POST['email'] : '';

    $success = addNewUser($username, $password, $fullname, $primaryemail);

	    if ($success) {
	        echo "Registration Succeed";
	    } else {
	        echo "Registration Failed";
	    }
	} 
	else {
    echo "No username/password provided";
	}
?>

