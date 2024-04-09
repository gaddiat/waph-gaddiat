<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login page</title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript">
      function displayTime() {
        document.getElementById('digit-clock').innerHTML = "Current time:" + new Date();
      }
      setInterval(displayTime, 500);

      function validateForm() {
      
      var username = document.getElementById('username').value.trim();
      var password = document.getElementById('password').value;
      var errorElement = document.getElementById('error-message');

      // Check if username is empty
        if (username === "") {
            errorElement.textContent = "Please enter your username.";
            return false; // Prevent form from submitting
        }

        // Check if password is empty
        if (password === "") {
            errorElement.textContent += (errorElement.textContent.length > 0 ? "\n" : "") + "Please enter your password.";
            return false; // Prevent form from submitting
        }
        
          // Clear error message if all validations pass
          errorElement.textContent = "";
          return true;
        }
  </script>
</head>
<body>
  <div class="container">
    <h1>login Page</h1>
    <div id="digit-clock"></div>
    <?php
      // PHP code to display visited time
      echo "Visited time: " . date("Y-m-d h:i:sa");
    ?>
    <form action="index.php" method="POST" class="form login" onsubmit="return validateForm()"><br>
      Username: <input type="text" class="text_field" name="username" /> <br>
      Password: <input type="password" class="text_field" name="password" /> <br>
      <span class="error-message" id="error-message"></span>
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      <button class="button" type="submit">Login</button>
    </form>
  </div>
</body>
</html>
