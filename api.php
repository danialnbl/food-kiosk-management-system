<?php

include('includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {     
    $vendorID = $_POST['test'];
    $dateNow = date("Y-m-d");

    $query = mysqli_query($conn, "UPDATE vendor SET ApprovalStatus = 'Approved', ApprovalDate = '$dateNow' WHERE VendorID = '$vendorID'");
    

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {     
    // Code to handle GET request   
}

// if($_GET['postVendorStatus']){

    
//     die;
// }
    

?>