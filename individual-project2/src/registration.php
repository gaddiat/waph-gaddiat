<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Registration page</title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript">
    function displayTime() {
      document.getElementById('digit-clock').innerHTML = "Current time: " + new Date().toLocaleString();
    }
    setInterval(displayTime, 500);

    function validateForm() {
      var fullname = document.getElementById('fullname').value.trim();
      var email = document.getElementById('email').value.trim();
      var username = document.getElementById('username').value.trim();
      var password = document.getElementById('password').value;
      var confirmPassword = document.getElementById('confirmPassword').value;
      var errorElement = document.getElementById('error-message');

      // Client-side validation for password match
      if (password !== confirmPassword) {
        errorElement.textContent = "Passwords do not match";
        return false;
      }

      // Client-side validation for preventing XSS (Cross-Site Scripting)
      var htmlPattern = /<\/?[a-z][\s\S]*>/i; // Regex to detect HTML tags
      if (htmlPattern.test(fullname) || htmlPattern.test(email) || htmlPattern.test(username)) {
        errorElement.textContent = "Invalid characters detected";
        return false;
      }

      // Client-side validation for email format
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        errorElement.textContent = "Invalid email format";
        return false;
      }-

      // Clear error message if all validations pass
      errorElement.textContent = "";
      return true;
    }
  </script>
</head>
<body>
  <div class="container">
    <h1>Registration Form</h1>
    <div id="digit-clock"></div>
    <form action="addnewuser.php" method="POST" class="form login" onsubmit="return validateForm()">
      <input type="text" class="text_field" id="fullname" name="fullname" placeholder="Full Name" required><br>
      <input type="text" class="text_field" id="email" name="email" placeholder="Email" required><br>
      <input type="text" class="text_field" id="username" name="username" placeholder="Username" required><br>
      <input type="password" class="text_field" id="password" name="password" placeholder="Password" required><br>
      <input type="password" class="text_field" id="confirmPassword" placeholder="Confirm Password" required><br>
      <span class="error-message" id="error-message"></span>
      <button class="button" type="submit">Register</button>
    </form>
  </div>
</body>
</html>
