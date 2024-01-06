<?php
session_start();
//error_reporting(0);
include('../includes/connect.php');
include('../functions/functions.php');
if (!isset($_SESSION['User'])) {
  header('location:../login.php');
} else {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu</title>
    <?php include('../includes/headsettings.php'); ?>
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <style>
        .menu-item {
            margin-bottom: 15px;
        }

        .menu-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <?php include('../includes/sidebar.php'); ?>
        <div class="layout-page">
          <?php include('../includes/header.php'); ?>
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="card">
              <?php 

if (isset($_GET['id'])) {
  $kiosk_id = $_GET['id'];

  // Query to retrieve menu items for the specified kiosk_id
  $sql = "SELECT * FROM menu WHERE KioskID = $kiosk_id";
  $result = $conn->query($sql);
  $subtotal = 0;

  if ($result->num_rows > 0) {
    // Displaying menu items
    echo "<div class='row'>";
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class='col-md-4 menu-item'>
            <a href='#' class='list-group-item list-group-item-action'>
                <img src="data:image/jpeg;base64,<?= base64_encode($row['ItemImage']) ?>" class="img-thumbnail menu-image" alt="Menu Item Image">
                <h5 class='mb-1'><?= $row["ItemName"] ?></h5>
                <p class='mb-1'><strong>Price:</strong> RM<?= $row["ItemPrice"] ?></p>
                Quantity: <input type="number">
            </a>
        </div>
        <?php
            }
            echo "</div>";
        } else {
            echo "No menu items available for this kiosk.";
        }
    } else {
        echo "Kiosk ID not found.";
    }
    
    // Close the connection
    $conn->close();
         ?>
                
              </div>

            </div>
            <!-- / Content -->
          </div>
        </div>
      </div>
    </div>
<?php } ?>