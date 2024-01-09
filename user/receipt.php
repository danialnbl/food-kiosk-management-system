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
    <title>Checkout Page</title>
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
            <div class="content-wrapper content">
              <div class="container-xxl flex-grow-1 container-p-y">
                  <div class="row">
                      <div class="col-md-8 mb-3 mb-md-0">
                          <div class="card">
                              <h5 class="card-header">Your Receipt</h5>
                              <div class="card-body">
                                  <?php if (!empty($_SESSION['cart'])): ?>
                                      <table class="table">
                                          <tbody>
                                              <?php foreach ($_SESSION['cart'] as $index => $item): 
                                                $totalPrice = 0;
                                                $itemTotalPrice = $item['price'] * $item['quantity'];
                                                $totalPrice += $itemTotalPrice;?>
                                                  <tr>
                                                      <td colspan="2">
                                                        <?php
                                                        // Display image retrieved from the session (assuming it's in BLOB format)
                                                        echo '<img src="data:image;base64,' . $item['image'] . '" class="img-thumbnail" alt="Item Image">';
                                                        ?>
                                                      </td>
                                                      <td><?= $item['name'] ?></td>
                                                      <td colspan="2">RM <?= $item['price'] * $item['quantity'] ?></td>
                                                      
                                                  </tr>
                                                  <tr>
                                                    <td><?= $item['quantity'] ?></td>
                                                  </tr>
                                              <?php endforeach; ?>
                                          </tbody>
                                      </table>
                                  <?php else: ?>
                                      <p>You have not order yet.</p>
                                  <?php endif; ?>
                              </div>
                          </div>
                      </div>



                      <!-- Left side of page -->
                      <div class="col-md-4">
                          <div class="card">
                              <h5 class="card-header"></h5>
                              <div class="card-body">
                                  <div class="d-flex justify-content-between mb-3">
                                      <p class="m-0"><strong>Total Payment:</strong></p>
                                      <p class="m-0 text-end"><strong><?= $totalPrice ?></strong></p>
                                  </div>
                                        <?php
                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            $selectedPaymentMethod = $_POST["payment_method"];
                                        
                                            echo "<p class='m-0'><strong>Points Earned:</strong></p>";
                                            echo "<p class='m-0 text-end'><strong><?= $index + 1 ?></strong></p>";
                                            echo "<p class='m-0'><strong>Payment Method:</strong></p>";
                                            echo "<p>" . $selectedPaymentMethod;
                                            echo "<div class='d-flex justify-content-between mb-3'>";
                                            echo "<p class='m-0'><strong>QR Order:</strong></p>";
                                            // QR here
                                            echo "</div>";
                                            echo "<div class='d-grid'>";
                                            echo "<button type='submit' class='btn btn-success mb-2'>Order Received</button>";
                                            echo "</div>";
                                            }
                                        ?>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>

      </div>

    </div>
    
  </div>
  
    
</body>
</html>
<?php } ?>