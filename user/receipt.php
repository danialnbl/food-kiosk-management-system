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
    <title>Checkout page</title>
    <?php include('../includes/headsettings.php'); ?>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include('../includes/sidebar.php'); ?>
            <div class="layout-page">
                <?php include('../includes/header.php'); ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="table-responsive text-nowrap">
                            <table classs="table">
                                <!-- HERE ORDER receipt -->
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



  </body>
  </html>