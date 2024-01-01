<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- connect css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style2.scss">
    <!-- Favicon -->
    <link rel="icon" href="https://umpsa.edu.my/themes/pana/favicon.ico" />
<?php

include './includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $phoneNum = $_POST['phoneNum'];

    $sql = "INSERT INTO user (UserName, Password, Email, FullName, NumPhone, UserType) VALUES (?, ?, ?, ?, ?, 'Customer')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $password, $email,$fullName,$phoneNum);

    if ($stmt->execute()) {
        echo "Registration successful!";
		header("Location: login.php");
		exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!-- HTML form for user registration -->
</head>
<body>
<a href="index.php">
    <img src="assets/img/logo.png" alt="Vendor" width="180" height="100">
</a>
<div class="form">
    <div class="container">
        <h1 class="title"><i>Customer Registration Form</i></h1>
        <form action="" method="post" name="registration">
            Email:  <input type="text" name="email" placeholder="Email" required />
            Username:  <input type="text" name="username" placeholder="Username" required />
            Password:  <input type="password" name="password" placeholder="Password" required />
            Full Name: <input type="text" name="fullName" placeholder="Full Name" required />
            Phone Number: <input type="text" name="phoneNum" placeholder="Phone Number" required />
            <input name="submit" type="submit" value="Submit"/>
         </form>
         <a href="registration.php"><button>Back</button></a>
    </div>
</div>
</form>
</body>
</html>