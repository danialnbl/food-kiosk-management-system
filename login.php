<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <?php include('includes/headsettings.php'); ?>

  <!-- connect css -->
<link rel="stylesheet" type="text/css" href="assets/css/style2.scss">
  <!-- HTML form for user login -->
</head>

<body>
  <a href="index.php">
    <img src="assets/img/logo.png" alt="Vendor" width="180" height="100">
  </a>
  <div class="form">
    <h1 class="title"><i>Food Kiosk Management System</i></h1>
    <div class="container">
      <p>Login to your Account</p>
      <form action="functions/submitLogin.php" method="post" name="login" id="login">
        Your Username: <input type="text" name="username" placeholder="Username" required />
        Your Password: <input type="password" name="password" placeholder="Password" required />
        <input name="submit" type="submit" value="Login" />
      </form>
      <p><a href='registration.php'>Don't have an account?</a></p>
      <p><a href='forgot.php'>Forgot Password?</a></p>
    </div>
  </div>
</body>

</html>