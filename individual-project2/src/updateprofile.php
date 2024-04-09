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

// Retrieve user's current profile data
$username = ""; // Initialize variables to store current user's data
$fullname = "";
$primaryemail = "";


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



require "database.php";

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
        <input type="hidden" name="nocsrftoken" value="<?php echo htmlspecialchars($_SESSION['nocsrftoken']); ?>">
        <input type="submit" value="Update Profile">
    </form>
</body>
</html>