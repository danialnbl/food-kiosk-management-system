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
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <form method="post">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item del" data-id=""><i class="bx bx-trash me-1"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
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

        <!-- Add Meal Modal -->
        <form method="post">
              <div class="modal fade" id="add-meal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel2">Add Meal</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col mb-3">
                          <label for="exampleFormControlSelect1" class="form-label">Type</label>
                          <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="mealType">
                            <option selected>Open this select menu</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="exampleFormControlSelect1" class="form-label">Calorie</label>
                          <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="mealCal">
                            <option selected>Open this select menu</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="exampleFormControlSelect1" class="form-label">Meal</label>
                          <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="Meal">
                            <option selected>Open this select menu</option>
                          </select>
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
        <script src="../assets/js/dashboards-analytics.js"></script>
    </body>

    </html>
<?php } ?>