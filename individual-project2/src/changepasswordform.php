<?php
require "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are filled
    if (isset($_POST['username']) && isset($_POST['current_password']) && isset($_POST['new_password'])) {
        // Fetch the user's current password from the database
        $stmt = $mysqli->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $current_password_from_database = $row['password'];

            // Check if the entered current password matches the one in the database
            if (md5($_POST['current_password']) == $current_password_from_database) {
                // Update password
                if (updatePassword($_POST['username'], $_POST['new_password'])) {
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
        <input type="text" name="username"><br>
        <label>Current Password:</label><br>
        <input type="password" name="current_password"><br>
        <label>New Password:</label><br>
        <input type="password" name="new_password"><br><br>
        <input type="submit" value="Change Password">
    </form>
</body>
</html>
