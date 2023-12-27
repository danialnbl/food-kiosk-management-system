<?php

function getVendorUsername($session)
{
    global $conn;

    $sql = "SELECT VendorName FROM vendor WHERE VendorName = $session";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    return $row['VendorName'];
}

function getUsername($session)
{
    global $conn;

    $sql = "SELECT * FROM user WHERE userName = '$session'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    return $row['userName'];
    // return $_SESSION['User'];
}

?>