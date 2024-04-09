<?php
$mysqli = new mysqli('localhost', 'a', '1234', 'ip2');
	
if($mysqli->connect_errno) {
    printf("Database connection failed: %s\n", $mysqli->connect_error);
    return FALSE;
}


function addNewUser($username, $password, $fullname, $primaryEmail) {
    global $mysqli;
    
    // Basic validation checks
    if (empty($username) || empty($password) || empty($fullname) || empty($primaryEmail)) {
        return false; // Ensures that no field is empty
    }
    
    if (!filter_var($primaryEmail, FILTER_VALIDATE_EMAIL)) {
        return false; // Ensures the email is in a valid format
    }
    
    // Here you can add additional validation as needed, e.g., minimum lengths
    if (strlen($password) < 8) {
        return false; // Password must be at least 8 characters
    }

    // Hash the password using a more secure method
    $hashedPassword = md5($password);
    
    $preparedSql = "INSERT INTO users (username, password, fullname, primaryEmail) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($preparedSql);
    if (!$stmt) {
        return false; // Could not prepare the statement
    }
    
    $stmt->bind_param("ssss", $username, $hashedPassword, $fullname, $primaryEmail); // Bind the variables
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function checklogin($username, $password) {
        global $mysqli;
        if($mysqli->connect_errno){
            printf("Database connection failed: %s\n", $mysqli->connect_errno);
            exit();
        }

        if (empty($username) || empty($password)) {
        return false; // Return false if username or password is empty
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

// Function to fetch user details by username
function getUserDetails($username) {
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT fullname, primaryemail FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $userDetails = $result->fetch_assoc();
    $stmt->close();
    return $userDetails;
}

?>
