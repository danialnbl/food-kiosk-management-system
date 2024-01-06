<?php
session_start();
include('includes/connect.php');
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     // Code to handle GET request   

// }

if ($_GET['getMenu']) {

    $sql = "SELECT * from menu";
    $result = $conn->query($sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);


    foreach ($result as $row) {
        $itemName[] = $row['ItemName'];
        $Stock[] = $row['Stock'];
        $totalMenu = count($itemName);
    }

    echo json_encode([
        "itemName" => $itemName,
        "StockValue" => $Stock,
        "totalMenu" => $totalMenu,
    ],JSON_NUMERIC_CHECK );
    die;
}

if ($_GET['postVendorStatus']) {
    $vendorID = $_POST['test'];
    $dateNow = date("Y-m-d");

    $query = mysqli_query($conn, "UPDATE vendor SET ApprovalStatus = 'Approved', ApprovalDate = '$dateNow' WHERE VendorID = '$vendorID'");

    die;
}
