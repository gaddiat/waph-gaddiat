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

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            text-align: center;
            padding-top: 50px;
            margin: 0;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .login-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: #fff;
            background-color: salmon;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .login-link:hover {
            background-color: #ff8080; /* Lighter shade of salmon on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="login.php" class="login-link">Login here</a>
    </div>
</body>
</html>

