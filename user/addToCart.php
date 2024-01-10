<?php /*
session_start();
//error_reporting(0);
include('../includes/connect.php');
include('../functions/functions.php');
if (!isset($_SESSION['User'])) {
  header('location:../login.php');
} else {

// Check if the cart is already initiated in the session or create a new cart array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Check if the item is already in the cart
    $existingItemKey = -1;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $itemId) {
            $existingItemKey = $key;
            break;
        }
    }

    if ($existingItemKey !== -1) {
        // Item exists in cart, increase quantity
        $_SESSION['cart'][$existingItemKey]['quantity'] += 1;
    } else {
        // Item not found, retrieve it from the database
        $stmt = $conn->prepare("SELECT id, name, price FROM your_table WHERE id = ?");
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $itemToAdd = [
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'quantity' => 1
            ];
            $_SESSION['cart'][] = $itemToAdd;
        } else {
            echo "Item not found";
            exit; // Stop further execution
        }

        $stmt->close();
    }

        echo "success";
    } else {
        echo "Invalid request";
    }
} */




session_start();

// Include your database connection code here
include('../includes/connect.php');

// Check if the cart is already initiated in the session or create a new cart array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['id'])) {
    $item_id = $_POST['id'];

    // Check if the item is already in the cart
    $existingItemKey = -1;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $item_id) {
            $existingItemKey = $key;
            break;
        }
    }

    if ($existingItemKey !== -1) {
        // Item exists in cart, increase quantity
        $_SESSION['cart'][$existingItemKey]['quantity'] += 1;
    } else {
        // Item not found, retrieve it from the database
        $stmt = $conn->prepare("SELECT id, image, name, price FROM menu WHERE id = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $itemToAdd = [
                'id' => $row['id'],
                'image' => $row['image'],
                'name' => $row['name'],
                'price' => $row['price'],
                'quantity' => 1
            ];
            $_SESSION['cart'][] = $itemToAdd;
        } else {
            echo "Item not found";
            exit; // Stop further execution
        }

        $stmt->close();
    }

    echo "success";
} else {
    echo "Invalid request";
}

// Close the database connection
$conn->close();


?>
