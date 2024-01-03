<?php

function getVendorUsername($session)
{
    global $conn;

    $sql = "SELECT VendorName FROM vendor WHERE VendorID = '$session'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    return $row['VendorName'];
}

function getUsername($session)
{
    global $conn;

    $sql = "SELECT * FROM user WHERE UserID = '$session'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    return $row['UserName'];
    // return $_SESSION['User'];
}

?>