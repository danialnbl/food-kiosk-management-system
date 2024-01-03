<?php
session_start();
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <div class="layout-page">
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="card">
                <h5 class="card-header">My Order
                  <button type="button" style="float: right;" class="btn rounded-pill btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#add-meal">
                    <span class="tf-icons bx bx-plus"></span>
                  </button>
                </h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th>Vendor</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price (RM)</th>
                        <th>Quantity</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      $ret = mysqli_query(
                        $conn,
                        "SELECT MenuID, Image, Name, Price FROM menu"
                      );
                      while ($row = mysqli_fetch_array($ret)) {
                        $i++;
                      ?>
                        <tr id="<?php echo $row['MenuID'] ?>">
                          <th scope="row"><?php echo $i; ?></th>
                          <td><img style="height: 100px; width: 100px;" src="data:image;base64,  <?php echo $row['ItemImage']  ?> " alt="Test"></td>
                          <td><?php echo $row['ItemName']; ?></td>
                          <td><?php echo $row['ItemPrice']; ?></td>
                          <td><!--quantity --></td>
                          
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div>
                    <tr>
                        <td> Total Payment </td>
                        <td> <!-- price sini --> </td>
                    </tr>
                    <tr>
                        <td>Points earned</td>
                        <td> <!-- point sini --> </td>
                    </tr>
                    <button type="button" name="cnfmBtn" class="btn btn-primary">COnfirm Order</button>
                    <button type="button" class="btn btn-outline-secondary"> Cancel </button>
                </div>
              </div>

            </div>
            <!-- / Content -->
          </div>
        </div>
      </div>
    </div>
    <?php
    function displayImageFromDatabase()
  {
    //use global keyword to declare conn inside a function
    global $conn;
  }
  ?>
