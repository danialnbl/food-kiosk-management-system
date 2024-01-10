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
        <title>Dashboard</title>
        <?php include('../includes/headsettings.php'); ?>
        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                            <div class="row">
                                <div class="col-lg-12 col-md-4 order-1">
                                    <div class="row">
                                        <div class="col-lg-12 mb-4 order-0">
                                            <div class="card">
                                                <div class="d-flex align-items-end row">
                                                    <div class="col-sm-7">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary">Welcome to Food Kiosk Faculty of Computing
                                                                <?php
                                                                $userID = $_SESSION['User'];
                                                                $username = getUsername($userID);

                                                                echo "$username";

                                                                ?>
                                                                ! 🎉</h5>
                                                            <?php
                                                            echo '<input id="userID" value="' . $userID . '" hidden>';
                                                            ?>

                                                            <p class="mb-4">
                                                                First <b>we eat</b>, then we do <b>everything else</b>.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5 text-center text-sm-left">
                                                        <div class="card-body pb-0 px-0 px-md-4">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Report -->
                                        <div class="col-4 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                            <div class="card-title">
                                                                <h5 class="text-nowrap mb-2">Collected Points</h5>
                                                                <span class="badge bg-label-warning rounded-pill">Year 2024</span>
                                                            </div>
                                                            <div id="collectedPoints"></div>
                                                            <div class="mt-sm-auto">
                                                                <!-- <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> 68.2%</small> -->
                                                                
                                                            </div>
                                                        </div>
                                                        <!-- <div id="profileReportChart"></div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                                            <div class="row mb-3">
                                                <div class="card col">
                                                    <div class="card-body">
                                                        <!-- <div class="card-title d-flex align-items-start justify-content-between">
                                                            <div class="avatar flex-shrink-0">
                                                            </div>
                                                        </div> -->
                                                        <span>Top Pick Menu</span>
                                                        <h3 id="topPickMenu" class="card-title text-nowrap mb-1">Loading Data...</h3>
                                                        <div id="chart"></div>
                                                        <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                            <div class="card col">
                                                <div class="card-body">
                                                    <span>Purchase History</span>
                                                    <h3 id="purchaseHistory" class="card-title text-nowrap mb-1">Loading Data...</h3>
                                                    <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                                </div>
                                            </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Content -->
                    </div>
                </div>
            </div>

            <!-- TOP PICK MENU - Datatables
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header h4">Top Pick Menu</div>
                        <div class="card-body">
                            <table id="topPickMenu" class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Availability</th>
                                        <th scope="col">Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- <script src="../assets/js/dashboards-analytics.js"></script> -->
    </body>

    <script>
    </script>

    </html>
<?php } ?>