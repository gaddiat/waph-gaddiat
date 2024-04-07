<?php
require "database.php";


// Retrieve user's current profile data
$username = ""; // Initialize variables to store current user's data
$fullname = "";
$primaryemail = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['fullname']) && isset($_POST['primaryemail'])) {
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $primaryemail = $_POST['primaryemail'];

        // Update user's profile
        if (updateUserProfile($username, $fullname, $primaryemail)) {
            echo "Profile updated successfully.";
        } else {
            echo "Failed to update profile.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Profile</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Username:</label><br>
        <input type="text" name="username" value="<?php echo $username; ?>" ><br>
        <label>Full Name:</label><br>
        <input type="text" name="fullname" value="<?php echo $fullname; ?>"><br>
        <label>Primary Email:</label><br>
        <input type="text" name="primaryemail" value="<?php echo $primaryemail; ?>"><br>
        <input type="submit" value="Update Profile">
    </form>
</body>
</html>