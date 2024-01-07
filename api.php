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

//Get Menu List
if ($_GET['getMenu']) {

    $vendorID = $_POST['test'];

    $sql = "SELECT * from menu WHERE KioskID= $vendorID";
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

//Get Sales
if ($_GET['getSales']) {

    $vendorID = $_POST['test'];

    $sql = "SELECT SUM(OrderTotalPrice) SumTotalPrice, DATE_FORMAT(OrderDate, '%M') OrderMonth from onlineorder INNER JOIN orderlist ON onlineorder.OrderID = orderlist.OrderID INNER JOIN menu ON orderlist.MenuID = menu.MenuID WHERE onlineorder.KioskID= $vendorID GROUP BY MONTH(OrderDate)";
    $result = $conn->query($sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);


    foreach ($result as $row) {
        $OrderTotal[] = $row['SumTotalPrice'];
        $OrderDate[] = $row['OrderMonth'];
        $totalSales = array_sum($OrderTotal);
    }

    echo json_encode([
        "OrderTotal" => $OrderTotal,
        "OrderDate" => $OrderDate,
        "totalSales" => "RM " . $totalSales,
    ],JSON_NUMERIC_CHECK );
    die;
}

// Approve vendor
if ($_GET['postVendorStatus']) {
    $vendorID = $_POST['test'];
    $dateNow = date("Y-m-d");

    $query = mysqli_query($conn, "UPDATE vendor SET ApprovalStatus = 'Approved', ApprovalDate = '$dateNow' WHERE VendorID = '$vendorID'");

    die;
}
