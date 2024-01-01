<?php
session_start();

require_once('../includes/connect.php');

if(isset($_POST['submit']))
    {
       if($_POST['userType'] == "Vendor")
       {
            $query="select * from vendor where VendorEmail='".$_POST['username']."' and VendorPassword='".$_POST['password']."'";
            $result=mysqli_query($conn,$query);

            if(mysqli_fetch_assoc($result))
            {
                $_SESSION['User']=$_POST['username'];
                $_SESSION['Role']=1;
                header("location:../Kiosk/kiosk_dashboard.php");
            }
            else
            {
                header("location:../wrongDetails.php?Invalid= Please Enter Correct User Name and Password ");
            }
       }
       else if($_POST['userType'] == "Customer")
       {
            $query="select * from user where UserName='".$_POST['username']."' and Password='".$_POST['password']."'";
            $result=mysqli_query($conn,$query);

            if(mysqli_fetch_assoc($result))
            {
                $_SESSION['User']=$_POST['username'];
                $_SESSION['Role']=2;
                header("location:../Kiosk/kiosk_dashboard.php");
            }
            else
            {
                header("location:../wrongDetails.php?Invalid= Please Enter Correct User Name and Password ");
            }
       }
    }
    else
    {
        echo 'Not Working Now Guys';
    }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     $sql = "SELECT ID, password FROM login WHERE username = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("s", $username);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows === 1) {
//         $user = $result->fetch_assoc();

//         if (password_verify($password, $user['password'])) {
//             $_SESSION['ID'] = $user['ID'];
//             header("Location: home.php");
//             exit();
//         } else {
//             echo "Invalid password.";
//         }
//     } else {
//         echo "User not found.";
//     }
// }
?>
