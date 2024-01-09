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
        <title>Make Order</title>
         <?php include('../includes/headsettings.php'); ?>
         <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
      <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
        <style>
        .menu-item {
            margin-bottom: 15px;
            height: 100%;
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
              <div class="col-md-8">
                  <?php 

                      // Check if kiosk_id parameter is set in the URL
                      if (isset($_GET['id'])) {
                          $kiosk_id = $_GET['id'];

                          // Query to retrieve menu items for the specified kiosk_id
                          $sql = "SELECT *
                                  FROM menu WHERE KioskID = $kiosk_id";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                              // Displaying cart
                              echo "<div class='row'>";
                              while ($row = $result->fetch_assoc()) {
                              echo "<div class='col-md-4 menu-item'>";
                              echo "<a href='#' class='list-group-item list-group-item-action'>";
                              echo '<img src="data:image;base64,'.$row['ItemImage'].'" class="img-thumbnail menu-image" alt="Menu Item Image">';
                              echo "<h5 class='mb-1'>" . $row["ItemName"] . "</h5>";
                              echo "<p class='mb-1'>" . $row["ItemDesc"] . "</p>" . "<br>";
                              echo "<h6 class='mb-1'><strong>Price:</strong> RM" . $row["ItemPrice"] . "</h6>";
                              echo "<div class='text-center'>";
                              echo "<button class='add_cart btn btn-primary' data-id='{$row["MenuID"]}'>Add to Cart</button>";
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
                          echo "Select Kiosk first.";
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

    <script>
    $(document).ready(function() {
        $('.add_cart').click(function() {
            var MenuID = $(this).data('id');

            $.ajax({
                url: 'addToCart.php',
                method: 'POST',
                data: { id: MenuID },
                success: function(response) {
                    alert('Item added to cart!');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to add item to cart.');
                }
            });
        });
    });
</script>
        
</body>
</html>
<?php } ?>
