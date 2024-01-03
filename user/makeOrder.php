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
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Display Kiosk</title>
         <?php include('../includes/headsettings.php'); ?>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            <?php 

                // Check if kiosk_id parameter is set in the URL
                if (isset($_GET['id'])) {
                    $kiosk_id = $_GET['id'];

                    // Query to retrieve menu items for the specified kiosk_id
                    $sql = "SELECT * FROM menu WHERE KioskID = $kiosk_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Displaying menu items
                        echo "<div class='row'>";
                        while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4 menu-item'>";
                        echo "<a href='#' class='list-group-item list-group-item-action'>";
                        echo '<img src="data:image;base64,'.$row['ItemImage'].'" class="img-thumbnail menu-image" alt="Menu Item Image">';
                        echo "<h5 class='mb-1'>" . $row["ItemName"] . "</h5>";
                        echo "<p class='mb-1'><strong>Price:</strong> RM" . $row["ItemPrice"] . "</p>";
                        echo "<div class='text-center'>"; 
                        echo "<a href='cart.php?id=" . $row["MenuID"] . "' class='btn btn-primary'>Add to Cart</a>";
                        // Add more item details as needed based on your menu structure
                        echo "</div>";
                        echo "</a>";
                        
                        echo "</div>";
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
            <!-- / Content -->
          </div>
        </div>
      </div>
    </div>
   
        
    </body>
</html>
<?php } ?>
