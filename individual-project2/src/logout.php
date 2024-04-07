<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    	<br>
        <p> You are logout! </p>
		<a href="login.php">Login again</a>
    </div>
</body>
</html>