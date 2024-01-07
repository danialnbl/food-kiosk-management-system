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
    <title>Manage Order</title>
    <?php include('../includes/headsettings.php'); ?>
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
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
                <h5 class="card-header">Online Orders List
                </h5>
                <div class="table-responsive text-nowrap">
                  <table id="menuTable" class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Order Item</th>
                        <th>Order Date</th>
                        <th>Order Time</th>
                        <th>Quantity</th>
                        <th>Total Price (RM)</th>
                        <th>QR</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $KioskID = $_SESSION['KioskID'];
                      $i = 0;
                      $ret = mysqli_query(
                        $conn,
                        "SELECT * FROM onlineorder INNER JOIN orderlist ON onlineorder.OrderID = orderlist.OrderID INNER JOIN menu ON orderlist.MenuID = menu.MenuID INNER JOIN user ON onlineorder.UserID = user.UserID WHERE onlineorder.KioskID = $KioskID"
                      );
                      while ($row = mysqli_fetch_array($ret)) {
                        $i++;
                      ?>
                        <tr id="<?php echo $row['OrderID'] ?>">
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $row['FullName'] ?></td>
                          <td><?php echo $row['ItemName'] ?></td>
                          <td><?php echo date('d/m/Y', strtotime($row['OrderDate'])); ?></td>
                          <td><?php echo $row['OrderTime'] ?></td>
                          <td><?php echo $row['Quantity'] ?></td>
                          <td><?php echo $row['OrderTotalPrice'] ?></td>
                          <td><img style="height: 100px; width: 100px;" src="data:image;base64,   " alt="TestQR"></td>
                          <td>
                            <form method="post">
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item opn" data-bs-toggle="modal" data-bs-target="#edit-menu" href="javascript:void(0);" data-id="<?php echo $row['OrderID']; ?>">
                                    <i class="bx bx-show me-1"></i>
                                    View More
                                  </a>
                                  <!-- <a class="dropdown-item opn" data-bs-toggle="modal" data-bs-target="#edit-menu" href="javascript:void(0);" data-id="<?php echo $row['OrderID']; ?>">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                  </a> -->
                                  <a class="dropdown-item del" data-id="<?php echo $row['OrderID']; ?>" href="javascript:void(0);"><i class="bx bxs-x-square me-1"></i> Cancel Order</a>
                                </div>
                              </div>
                            </form>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
            <!-- / Content -->
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Menu Modal -->
    <form method="post">
      <div class="modal fade" id="edit-menu" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">View Order</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col mb-6">
                  <label for="customerName" class="form-label">Customer Name</label>
                  <input type="text" id="customerName" name="customerName" class="form-control" placeholder="" value="" readonly/>
                </div>
                <div class="col mb-6">
                  <label for="menuOrdered" class="form-label">Menu Ordered</label>
                  <input type="text" id="menuOrdered" name="menuOrdered" class="form-control" placeholder="" value="" readonly/>
                </div>
              </div>
              <div class="row">
              <div class="col mb-6">
                  <label for="OrderTime" class="form-label">Order Time</label>
                  <input type="text" id="OrderTime" name="OrderTime" class="form-control" placeholder="" value="" readonly/>
                </div>
                <div class="col mb-3">
                  <label for="orderQuantity" class="form-label">Quantity</label>
                  <input type="text" id="orderQuantity" name="orderQuantity" class="form-control" placeholder="" value="" readonly/>
                </div>
              </div>
              <div class="row">
              <div class="col mb-6">
                  <label for="OrderTotalPrice" class="form-label">Order Total Price (RM)</label>
                  <input type="text" id="OrderTotalPrice" name="OrderTotalPrice" class="form-control" placeholder="" value="" readonly/>
                </div>
                <div class="col mb-3">
                  <label for="orderStatus" class="form-label">Order Status</label>
                  <select class="form-select" id="orderStatus" aria-label="Default select example" name="orderStatus">
                    <option selected>Open this select menu</option>
                    <option id="OrderPreparing" value="Preparing">Preparing</option>
                    <option id="OrderCompleted" value="Completed">Completed</option>
                  </select>
                </div>
              </div>
              <input hidden type="text" id="menuIDEdit" name="menuIDEdit" class="form-control" placeholder="" value="" />         
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" name="editBtn" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      </div>
    </form>
    <!-- / Layout wrapper -->
    <script>
      var id;
      $(".opn").click(function() {
        id = $(this).data('id');

        $.post('../api.php?getOrder=1', {
          test: id
        }, function (res) {
        console.log(res)
        $("#customerName").val(res.CustomerName);
        $("#menuOrdered").val(res.ItemName);
        $("#OrderTime").val(res.OrderTime);
        $("#orderQuantity").val(res.Quantity);
        $("#OrderTotalPrice").val(res.OrderTotalAmount);

        var unitVal = $("#orderStatus option").filter(function() {
          return $(this).html() == res.orderStatus;
        }).val()

        $("#orderStatus").val(unitVal).change();
        
    }, 'json')
        
         $("#id").val(id);
        
        // $("#menuDescEdit").val(col[1].innerText);
        // $("#menuPriceEdit").val(col[2].innerText);
        // $("#menuAvailabilityEdit").val(unitVal).change();
        // $("#menuStockEdit").val(col[4].innerText);
        // $("#frameEdit").val(col[4].innerText);
        // $("#menuIDEdit").val(id);
      });

      $(".del").click(function() {
        id = $(this).data('id');
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          con: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.replace("manage_menu.php?mode=delete&id=" + id);
          }
        });
      });

      $(document).ready(function() {
        $('#menuTable').dataTable({
          dom: '<"custom-length"f><t><p>',

          // Callback function to handle the DataTable initialization
          initComplete: function(settings, json) {
            $('.custom-length').css('margin-right', '25px'); // Adjust the margin value as needed
          }
        });
      });

      function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
      }

      function clearImage() {
        document.getElementById('formFile').value = null;
        frame.src = "";
      }
    </script>
    <script src="../assets/js/dashboards-analytics.js"></script>
  </body>

  </html>

  <!-- QR Library -->
  <?php 
  require_once '../assets/vendor/phpqrcode/qrlib.php'; 
  ?>

  <!-- CRUD Function -->
  <?php
  if (isset($_POST['addBtn'])) {

    $menuName = $_POST['menuName'];
    $menuAvailability = $_POST['menuAvailability'];
    $menuPrice = $_POST['menuPrice'];
    $menuStock = $_POST['menuStock'];
    $menuDesc = $_POST['menuDesc'];

    $Uid = $_SESSION['User'];

    //declare variables
    $image = $_FILES['formFile']['tmp_name'];
    $name = $_FILES['formFile']['name'];
    $image = base64_encode(file_get_contents(addslashes($image)));

    //QR
    $pathQr = '../assets/img/qr/';
    $qrCode = $pathQr.time().".png";
    QRcode :: png($menuName . "uid=" . $Uid,$qrCode,'H',4,4 );
    $qrImage = base64_encode(file_get_contents(addslashes($qrCode)));

    $query = mysqli_query($conn, "INSERT INTO menu (KioskID, ItemName, ItemDesc, ItemPrice, Availability, Stock, ItemImage, MenuQR) VALUES ($KioskID,'$menuName', '$menuDesc','$menuPrice','$menuAvailability','$menuStock','$image','$qrImage')");

    if ($query) {
      echo '
      <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire({
          title: "Menu Added!",
          icon: "success",
          timer: 2000,
          showConfirmButton: false,
        }).then(function() {
          window.location.href="manage_menu.php";
        });
      });

      </script>
            ';
    } else {
      echo '
      <script type="text/javascript">
              $(document).ready(function(){
                Swal.fire({
                  title: "Something went wrong! 😢",
                  text: "Please try again",
                  icon: "error",
                  timer: 2000,
                  showConfirmButton: false,
                }).then(function() {
                  window.location.href="manage_menu.php";
                });
              });
            </script>
           ';
    }
  }

  if (isset($_POST['editBtn'])) {

    $menuName = $_POST['menuNameEdit'];
    $menuAvailability = $_POST['menuAvailabilityEdit'];
    $menuPrice = $_POST['menuPriceEdit'];
    $menuStock = $_POST['menuStockEdit'];
    $menuDesc = $_POST['menuDescEdit'];
    $uid = $_POST['menuIDEdit'];

    //declare variables
    // $image = $_FILES['formFile']['tmp_name'];
    // $name = $_FILES['formFile']['name'];
    // $image = base64_encode(file_get_contents(addslashes($image)));

    $query = mysqli_query($conn, "UPDATE menu SET ItemName = '$menuName', ItemDesc = '$menuDesc', ItemPrice = '$menuPrice', Availability = '$menuAvailability', Stock = '$menuStock' WHERE MenuID = '$uid'");

    if ($query) {
      echo '
      <script type="text/javascript">
      $(document).ready(function(){
        Swal.fire({
          title: "Menu Updated!",
          icon: "success",
          timer: 2000,
          showConfirmButton: false,
        }).then(function() {
          window.location.href="manage_menu.php";
        });
      });

      </script>
            ';
    } else {
      echo '
      <script type="text/javascript">
              $(document).ready(function(){
                Swal.fire({
                  title: "Something went wrong! 😢",
                  text: "Please try again",
                  icon: "error",
                  timer: 2000,
                  showConfirmButton: false,
                }).then(function() {
                  window.location.href="manage_menu.php";
                });
              });
            </script>
           ';
    }
  }

  // Delete Function
  if (isset($_GET['mode'])) {
    if ($_GET['mode'] == "delete") {
      $id = $_GET['id'];
      $query = "DELETE from `menu` WHERE `MenuID` = $id";
      $result = mysqli_query($conn, $query);

      if ($result) {
        echo '<script type="text/javascript">
              Swal.fire({
                title: "Deleted!",
                text: "Your menu has been deleted.",
                icon: "success",
                confirmButtonText: "OK"
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href="manage_menu.php";
                }
              });
            </script>';
      } else {
        echo '
            <script type="text/javascript">
            $(document).ready(function() {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                confirmButtonText: "Back"
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href="manage_menu.php";
                  }
                });
              });
            </script>
            ';
      }
    }
  }

  //Retrieve image from database and display it on html webpage
  function displayImageFromDatabase()
  {
    //use global keyword to declare conn inside a function
    global $conn;
  }
  ?>
<?php } ?>