<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Remittance System</title>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    <div class="login form">
      <header>Login</header>

      <form action="tools/checklogin.php" method="post">
        <input name="username" type="text" placeholder="Enter your username" required>
        <input name="password" type="password" placeholder="Enter your password" required>

        <input type="submit" class="button" value="Login">
      </form>

      <!-- REGISTER LINK -->
      <div class="link">
        Don’t have an account?
        <a href="register.php">Register</a>
      </div>

    </div>
  </div>

</body>
</html>
