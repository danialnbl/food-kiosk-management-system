<?php
session_start();
//error_reporting(0);
include('../includes/connect.php');
if (!isset($_SESSION['User'])) {
    //   header('location:../login.php');
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
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
                            <div class="row">
                                <div class="col-lg-12 col-md-4 order-1">
                                    <div class="row">
                                        <div class="col-lg-8 mb-4 order-0">
                                            <div class="card">
                                                <div class="d-flex align-items-end row">
                                                    <div class="col-sm-7">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                                                            <p class="mb-4">
                                                                You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                                                your profile.
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
                                        <div class="col-4 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                            <div class="card-title">
                                                                <h5 class="text-nowrap mb-2">Profile Report</h5>
                                                                <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                                                            </div>
                                                            <div class="mt-sm-auto">
                                                                <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> 68.2%</small>
                                                                <h3 class="mb-0">$84,686k</h3>
                                                            </div>
                                                        </div>
                                                        <div id="profileReportChart"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Total Appointments</span>
                                                    <h3 class="card-title mb-2">$12,628</h3>
                                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                        </div>
                                                    </div>
                                                    <span>New Queries</span>
                                                    <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Content -->
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>