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
                <h5 class="card-header">My Menu
                  <button type="button" style="float: right;" class="btn rounded-pill btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#add-meal">
                    <span class="tf-icons bx bx-plus"></span>
                  </button>
                </h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      $ret = mysqli_query(
                        $conn,
                        "SELECT * FROM menu"
                      );
                      while ($row = mysqli_fetch_array($ret)) {
                        $i++;
                      ?>
                        <tr id="<?php echo $row['MenuID'] ?>">
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $row['ItemName']; ?></td>
                          <td><?php echo $row['ItemDesc']; ?></td>
                          <td>RM <?php echo $row['ItemPrice']; ?></td>
                          <td><?php echo $row['Availability']; ?></td>
                          <td hidden><?php echo $row['Stock']; ?></td>
                          <td><img style="height: 100px; width: 100px;" src="data:image;base64,  <?php echo $row['ItemImage']  ?> " alt="Test"></td>
                          <td>
                            <form method="post">
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item opn" data-bs-toggle="modal" data-bs-target="#edit-menu" href="javascript:void(0);" data-id="<?php echo $row['MenuID']; ?>">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                  </a>
                                  <a class="dropdown-item del" data-id="<?php echo $row['MenuID']; ?>"><i class="bx bx-trash me-1"></i> Delete</a>
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

    <!-- Add Menu Modal -->
    <form method="post" enctype="multipart/form-data">
      <div class="modal fade" id="add-meal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">Add New Menu</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="menuName" class="form-label">Menu Name</label>
                  <input type="text" id="menuName" name="menuName" class="form-control" placeholder="Enter Name" value="" />
                </div>
                <div class="col mb-3">
                  <label for="menuAvailability" class="form-label">Availability</label>
                  <select class="form-select" id="menuAvailability" aria-label="Default select example" name="menuAvailability">
                    <option selected>Open this select menu</option>
                    <option id="menuAvailable" value="Available">Available</option>
                    <option id="menuNotAvailable" value="Not Available">Not Available</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="menuPrice" class="form-label">Price</label>
                  <input type="text" id="menuPrice" name="menuPrice" class="form-control" placeholder="Enter Price" value="" />
                </div>
                <div class="col mb-3">
                  <label for="menuStock" class="form-label">Stock</label>
                  <input type="text" id="menuStock" name="menuStock" class="form-control" placeholder="Enter Stock" value="" />
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="menuDesc" class="form-label">Menu Description</label>
                  <textarea type="text" id="menuDesc" name="menuDesc" class="form-control" placeholder="Enter Description" value="" rows="3"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="formFile" class="form-label">Menu Image (Cannot be edit after this)</label>
                  <input class="form-control" type="file" id="formFile" name="formFile" onchange="preview()">
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <img id="frame" src="" class="img-fluid" style="height: 200px;" />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" name="addBtn" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Edit Menu Modal -->
    <form method="post">
      <div class="modal fade" id="edit-menu" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">Edit New Menu</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="menuNameEdit" class="form-label">Menu Name</label>
                  <input type="text" id="menuNameEdit" class="form-control" placeholder="Enter Name" value="" />
                </div>
                <div class="col mb-3">
                  <label for="menuAvailability" class="form-label">Availability</label>
                  <select class="form-select" id="menuAvailabilityEdit" aria-label="Default select example" name="menuAvailability">
                    <option selected>Open this select menu</option>
                    <option id="menuAvailable" value="Available">Available</option>
                    <option id="menuNotAvailable" value="NotAvailable">Not Available</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="menuPriceEdit" class="form-label">Price</label>
                  <input type="text" id="menuPriceEdit" class="form-control" placeholder="Enter Price" value="" />
                </div>
                <div class="col mb-3">
                  <label for="menuStockEdit" class="form-label">Stock</label>
                  <input type="text" id="menuStockEdit" class="form-control" placeholder="Enter Stock" value="" />
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="menuDescEdit" class="form-label">Menu Description</label>
                  <textarea type="text" id="menuDescEdit" class="form-control" placeholder="Enter Description" value="" rows="3"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="formFile" class="form-label">Menu Image</label>
                  <input class="form-control" type="file" id="formFileEdit" onchange="preview()">
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <img id="frameEdit" src="" class="img-fluid" style="height: 200px;" />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <input type="hidden" name="id" id="id">
              <button type="submit" name="editBtn" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      </div>
    </form>
    <!-- / Layout wrapper -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script>
      var id;
      $(".opn").click(function() {
        id = $(this).data('id');
        var col = $("#".concat(id, " > td"));
        var unitVal = $("#menuAvailabilityEdit option").filter(function() {
          return $(this).html() == col[3].innerText;
        }).val()
        console.log(col[0].innerText);
        $("#id").val(id);
        $("#menuNameEdit").val(col[0].innerText);
        $("#menuDescEdit").val(col[1].innerText);
        $("#menuPriceEdit").val(col[2].innerText);
        $("#menuAvailabilityEdit").val(unitVal).change();
        $("#menuStockEdit").val(col[4].innerText);
        $("#frameEdit").val(col[4].innerText);
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



  <!-- CRUD Function -->
  <?php
  if (isset($_POST['addBtn'])) {

    $menuName = $_POST['menuName'];
    $menuAvailability = $_POST['menuAvailability'];
    $menuPrice = $_POST['menuPrice'];
    $menuStock = $_POST['menuStock'];
    $menuDesc = $_POST['menuDesc'];

    //declare variables
    $image = $_FILES['formFile']['tmp_name'];
    $name = $_FILES['formFile']['name'];
    $image = base64_encode(file_get_contents(addslashes($image)));

    $query = mysqli_query($conn, "INSERT INTO menu (KioskID, ItemName, ItemDesc, ItemPrice, Availability, Stock, ItemImage) VALUES (1,'$menuName', '$menuDesc','$menuPrice','$menuAvailability','$menuStock','$image')");

    if ($query) {
      echo '
           <script type="text/javascript">
                window.location.href="manage_menu.php";
            </script>
            ';
    } else {
      echo '
      <script type="text/javascript">
                window.location.href="manage_menu.php";
            </script>
           ';
    }

    // $image = $_FILES['formFile']['tmp_name'];
    // $name = $_FILES['formFile']['name'];
    // $image = file_get_contents(addslashes($image));

    // $query = mysqli_query($conn, "INSERT INTO image (ImageName, ImageBlob, MenuID) VALUES ('$name', '$image',1)");


  }

  //Retrieve image from database and display it on html webpage
  function displayImageFromDatabase()
  {
    //use global keyword to declare conn inside a function
    global $conn;
  }
  ?>
<?php } ?>