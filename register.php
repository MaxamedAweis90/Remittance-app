<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Remittance System</title>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    <div class="login form">
      <header>Register</header>

      <form action="tools/register.php" method="post">
        <input name="fullname" type="text" placeholder="Full Name" required>
        <input name="email" type="email" placeholder="Email Address" required>
        <input name="password" type="password" placeholder="Password" required>
        <input name="confirm_password" type="password" placeholder="Confirm Password" required>
        <input type="submit" class="button" value="Create Account">
      </form>

      <!-- LOGIN LINK -->
      <div class="link">
        Already have an account?
        <a href="login.php">Login</a>
      </div>

    </div>
  </div>

</body>
</html>
