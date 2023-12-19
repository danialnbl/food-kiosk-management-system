<!DOCTYPE html>
<html>
<head>
    <title>Sketchpad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- connect css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style2.scss">

<?php
// // Database connection parameters
// $servername = "localhost:3307";
// $username = "root";
// $password = '';
// $database = "miniproject";

// // Create a connection to the database
// $conn = new mysqli($servername, $username, $password, $database);

// // Check the connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

include './includes/connect.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST['username'];
//     $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

//     $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("ss", $username, $password);

//     if ($stmt->execute()) {
//         echo "Registration successful!";
// 		header("Location: login.php");
// 		exit;
//     } else {
//         echo "Error: " . $stmt->error;
//     }
// }
?>
<!-- HTML form for user registration -->
</head>
<body>
<img src="assets/img/logo.png" alt="Vendor" width="180" height="100">
<div class="form">
    <div class="container">
        <h1 class="title"><i>Customer Registration Form</i></h1>
        <form action="" method="post" name="registration">
            Email:  <input type="text" name="email" placeholder="Email" required />
            Username:  <input type="text" name="username" placeholder="Username" required />
            Password:  <input type="password" name="password" placeholder="Password" required />    
            <input name="submit" type="submit" value="Submit"/>
            <a href="registration.php">
            </a>
         </form>
         <a href="registration.php"><button>Back</button></a>
    </div>
</div>
</form>
</body>
</html>