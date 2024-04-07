<?php
$mysqli = new mysqli('localhost', 'a', '1234', 'ip2');
	
if($mysqli->connect_errno) {
    printf("Database connection failed: %s\n", $mysqli->connect_error);
    return FALSE;
}

function addnewuser($username, $password, $fullname, $primaryemail) {
    global $mysqli;
    // Hash the password
    $hashed_password = md5($password);
    
    $prepared_sql = "INSERT INTO users (username, password, fullname, primaryemail) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($prepared_sql);
    $stmt->bind_param("ssss", $username, $hashed_password, $fullname, $primaryemail); // Bind the hashed password
    if ($stmt->execute()) return TRUE;
    return FALSE;
}

?>
