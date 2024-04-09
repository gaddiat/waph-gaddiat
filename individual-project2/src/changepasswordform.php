<?php
session_start();

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


// Generate and store CSRF token in the session if it doesn't exist
if (!isset($_SESSION['nocsrftoken'])) {
    $_SESSION['nocsrftoken'] = bin2hex(openssl_random_pseudo_bytes(32)); // Generate a random token
}

// Validate CSRF token on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token from form submission
    $tokenFromForm = $_POST['nocsrftoken'] ?? '';

    if (!hash_equals($_SESSION['nocsrftoken'], $tokenFromForm)) {
        // Invalid CSRF token: Handle the error (e.g., display an error message)
        die("CSRF Token Validation Failed.");
    }

    // Proceed with form processing (e.g., change password logic)
    require "database.php";

    if (isset($_POST['username'], $_POST['current_password'], $_POST['new_password'])) {
        $username = $_POST['username'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];

        $stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $current_password_from_database = $row['password'];

            if (md5($current_password) == $current_password_from_database) {
                // Update password securely using prepared statement
                $new_password_hash = md5($new_password); // This should be improved for better security (use password_hash)
                $update_stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE username = ?");
                $update_stmt->bind_param("ss", $new_password_hash, $username);
                
                if ($update_stmt->execute()) {
                    echo "Password updated successfully.";
                } else {
                    echo "Failed to update password.";
                }
            } else {
                echo "Current password is incorrect.";
            }
        } else {
            echo "User not found.";
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Change Password</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
        <label>Current Password:</label><br>
        <input type="password" name="current_password" required><br>
        <label>New Password:</label><br>
        <input type="password" name="new_password" required><br><br>
        <input type="hidden" name="nocsrftoken" value="<?php echo htmlspecialchars($_SESSION['nocsrftoken']); ?>">
        <input type="submit" value="Change Password">
    </form>
</body>
</html>
