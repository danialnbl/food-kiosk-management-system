<?php
    session_start();
    //error_reporting(0);
    include('../includes/connect.php');
    include('../functions/functions.php');

    //Function to delete item
    function removeItem($itemId) {
        if (isset($_SESSION['cart'][$itemId])) {
            unset($_SESSION['cart'][$itemId]);
        }

        // Re-index the array after removing an item
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Check if the remove button is clicked
    if (isset($_POST['remove_item'])) {
        $itemIdToRemove = $_POST['item_id'];
        removeItem($itemIdToRemove);
        header("Location: cart.php"); // Redirect to refresh the page
        exit;
    }

    // Function to clear all items
    function clearCart() {
        unset($_SESSION['cart']);
    }

    // Check if the clear button is clicked
    if (isset($_POST['clear'])) {
        clearCart();
        header("Location: cart.php"); // Redirect to refresh the page
        exit;
    }



    if (!isset($_SESSION['User'])) {
    header('location:../login.php');
    } else {
    ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart</title>
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
                              <h5 class="card-header">Your Cart</h5>
                              <div class="card-body">
                                    <?php
                                        if (isset($_GET['id'])) {
                                            $kiosk_id = $_GET['id'];

                                            // Query to retrieve menu items for the specified kiosk_id
                                            $sql = "SELECT * FROM menu WHERE KioskID = $kiosk_id";
                                            $result = $conn->query($sql);

                                            // Check if the cart is initiated in the session
                                            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                                                echo "<div class='card card-style position-relative'>";
                                                echo "<div class='table-responsive text-nowrap'>";
                                                echo "<table class='table'>";
                                                echo "<thead><tr>";
                                                echo "<th scope='col'>#</th>";
                                                echo "<th scope='col'>Item Name</th>";
                                                echo "<th scope='col'>Price</th>";
                                                echo "<th class='td-width' scope='col'>Quantity</th>";
                                                echo "<th class='td-remove' scope='col'>Action</th>";
                                                echo "</tr></thead>";
                                            } else {
                                                echo "<div class='card card-style position-relative'>";
                                                echo "<div class='table-responsive text-nowrap'>";
                                                echo "<table class='table'>";
                                                echo "<thead><tr>";
                                                echo "<th scope='col'>#</th>";
                                                echo "<th scope='col'>Item Name</th>";
                                                echo "<th scope='col'>Price</th>";
                                                echo "<th class='td-width' scope='col'>Quantity</th>";
                                                echo "<th class='td-remove' scope='col'>Action</th>";
                                                echo "</tr></thead>";
                                                echo "<tbody>";

                                                $totalPrice = 0; // Initializing total price
                                                $itemNumber = 1;

                                                //Display items in the cart
                                        
                                                

                                                if ($result->num_rows > 0) {
                                                    echo "<div class='row'>";
                                                    while ($row = $result->fetch_assoc()) {
                                                    $itemTotalPrice = $item['price'] * $item['quantity'];
                                                    $totalPrice += $itemTotalPrice; // Accumulating total price considering quantity
                                                
                                                    echo "<tr>";
                                                    echo "<th>" . $itemNumber . "</th>";
                                                    echo "<td>" . $row['name'] . "</td>";
                                                    echo "<td class='item-price'>RM " . number_format($itemTotalPrice, 2) . "</td>";
                                                    echo "<td class='td-width'>";
                                                    echo "<form class='quantity-form' data-item-id='{$row['id']}' method='post'>";
                                                    echo "<input type='hidden' name='item_id' value='{$row['id']}'>";
                                                    echo "<div class='input-group'>";
                                                    echo "<button type='button' class='input-group-text quantity-button decrease'>-</button>";
                                                    echo "<input type='number' name='quantity' class='form-control quantity-input' value='{$item['quantity']}'>";
                                                    echo "<button type='button' class='input-group-text quantity-button increase'>+</button>";
                                                    echo "</div>";
                                                    echo "</form>";
                                                    echo "</td>";
                                                    echo "<td>"; // Remove button column
                                                    echo "<form method='post'>";
                                                    echo "<input type='hidden' name='item_id' value='{$itemId}'>";
                                                    echo "<button type='submit' name='remove_item' class='btn btn-danger'>Remove</button>";
                                                    echo "</form>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                
                                                    $itemNumber++; // Increment item number for the next item
                                                    }
                                                    echo "</div>";
                                                } else {
                                                    echo "Your cart is empty.";
                                                }
                                                

                                                echo "</tbody></table></div>";
                                                echo "<div class='total-price'>";
                                                //Display total price
                                                echo "<p><strong>Total Price: RM <span id='total-price'>" . number_format($totalPrice, 2) . "</span></strong><p>";
                                                echo "</div>";
                                                echo "</div>"; // card div
                                            }
                                        
                                        }
                                        // Close the connection
                                        $conn->close();
                                    ?>
                                                
                              </div>
                          </div>
                      </div>


                      <!-- Left ide of page -->
                      <div class="col-md-4">
                          <div class="card">
                              <h5 class="card-header">Checkout Information</h5>
                              <div class="card-body">
                                  <div class="d-flex justify-content-between mb-3">
                                      <p class="m-0"><strong>Subtotal:</strong></p>
                                      <p class="m-0 text-end"><strong><?= $totalPrice ?></strong></p>
                                  </div>
                                  <!-- Add payment method form or information here -->
                                  <form action="checkoutPage.php" method="POST">
                                      <p class="m-0"><strong>Points Earned:</strong></p>
                                      <div class="d-grid">
                                        <form action='checkoutPage.php' method='GET'>
                                        <button type="submit" class="btn btn-success mb-2">Confirm Order</button>
                                        </form>
                                        <form action='displayKiosk.php' method='POST'>
                                        <button type="submit" class="btn btn-danger">Cancel Order</button>
                                        </form>
                                        
                                      </div>
                                  </form>

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


  <script>
    //to handle quantity and price update with Javascript and AJAX    
    document.addEventListener('DOMContentLoaded', () => {
        const quantityForms = document.querySelectorAll('.quantity-form');

        quantityForms.forEach(form => {
            form.addEventListener('click', e => {
                const target = e.target;
                const form = target.closest('.quantity-form');
                const itemId = form.getAttribute('data-item-id');
                const input = form.querySelector('input[name="quantity"]');
                const currentValue = parseInt(input.value);

                if (target.classList.contains('decrease')) {
                    if (currentValue > 1) {
                        input.value = currentValue - 1;
                        updateQuantity(itemId, currentValue - 1);
                    }
                } else if (target.classList.contains('increase')) {
                    input.value = currentValue + 1;
                    updateQuantity(itemId, currentValue + 1);
                }
            });
        });

        function updateQuantity(itemId, newQuantity) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update-cart.php'); 
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const updatedCart = JSON.parse(xhr.responseText);
                    updatePrices(updatedCart); // Update displayed prices using the updated cart data
                } else {
                    console.error('Request failed');
                }
            };

            const params = `item_id=${itemId}&new_quantity=${newQuantity}`;
            xhr.send(params);
        }


        function updatePrices(updatedCart) {
            const items = updatedCart; // Use the updated cart data received from the server
            const itemPrices = document.querySelectorAll('.item-price');
            let total = 0;

            itemPrices.forEach((price, index) => {
                const itemTotalPrice = items[index].price * items[index].quantity;
                price.textContent = `RM ${itemTotalPrice.toFixed(2)}`;
                total += itemTotalPrice;
            });

            document.querySelector('p strong').textContent = `Total Price: RM ${total.toFixed(2)}`;
        }
    });

    </script>


</body>
</html> 
<?php } ?>