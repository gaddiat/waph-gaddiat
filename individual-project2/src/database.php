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

function checklogin_mysql($username, $password) {
        global $mysqli;
        if($mysqli->connect_errno){
            printf("Database connection failed: %s\n", $mysqli->connect_errno);
            exit();
        }
        $prepared_sql = "SELECT * FROM users WHERE username=? AND password = md5(?)";
        $stmt = $mysqli->prepare($prepared_sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows ==1)
            return TRUE;
        return FALSE;
    }

function updatePassword($username, $newPassword) {
    global $mysqli;
    
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    $hashed_password = md5($newPassword);

    $prepared_sql = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $mysqli->prepare($prepared_sql);
    $stmt->bind_param("ss", $hashed_password, $username);
    
    if ($stmt->execute()) {
        $stmt->close();
        $mysqli->close();
        return true;
    } else {
        $stmt->close();
        $mysqli->close();
        return false;
    }
}

function updateUserProfile($username, $fullname, $primaryemail) {
    global $mysqli;
    
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    $prepared_sql = "UPDATE users SET fullname = ?, primaryemail = ? WHERE username = ?";
    $stmt = $mysqli->prepare($prepared_sql);
    $stmt->bind_param("sss", $fullname, $primaryemail, $username);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

?>
