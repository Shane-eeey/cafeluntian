<?php
session_start();
include('mycon.php');
$showSuccessMessage = isset($_GET['success']) && $_GET['success'] == 1;
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>Cafe Luntian</title>
        <link rel="icon" type="image/png" sizes="32x32" href="img/logo2.png">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <script src="https://kit.fontawesome.com/1e3d5daa34.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
        <style>

        select {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        select:focus {
            border-color: #356D59;
            outline: none;
        }
        
        </style>
</head>
<body style="background-color: #f4f4f4;">
    <section class="nav" id="checkout-nav">
        <a href="index.php"><img src="img/logo.png" class="logo"></a>
        <div class="cart-icon">
            <a href="#" id="cart-icon">
                <i class="fa-solid fa-bag-shopping"></i>               
                <span id="cart-count">0</span>
            </a>
        </div>
    </section>

    <section class="checkout">
        <div class="form-side">
            <h2>Checkout</h2>
            <div class="image-side">
                <div class="qr-container">
                    <img src="img/gcash.png" alt="GCash QR Code">
                    <div class="gcash-info">
                        <h2>GCash Account</h2>
                        <p class="gcash-number">09xx xxx xxx</p> 
                    </div>
                </div>
            </div>

            <div id="successMessage" class="success-message" style="display: <?= $showSuccessMessage ? 'block' : 'none' ?>;">
                ✔ Checkout Successful!
            </div>


            <form method="POST" action="checkoutScript.php" id="checkoutForm" onsubmit="submitCartData()">  
                <input type="hidden" name="cartData" id="cartData">
                <input type="hidden" name="Order_Name" id="Order_Name">
                <input type="hidden" name="Price" id="Price">
                <input type="hidden" name="Quantity" id="Quantity">

                <div class="form-group">
                    <label for="name">Full Name (Preferably Registered Name in GCash):</label> <br>
                    <input type="text" name="Customer_Name" required>
                </div>

                <div class="form-group">
                    <label for="contact">Contact Number (Registered Number in GCash):</label> <br>
                    <input type="text" placeholder="09xx xxx xxx" name="Contact" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address:</label> <br>
                    <input type="email" placeholder="youremail@gmail.com" name="Email" required>
                </div>

                <div class="form-group">
                    <label for="orderType">Select Mode of Service:</label>
                    <select id="orderType" name="Mode_of_Service" onchange="toggleRoomField()">
                        <option value="Pickup" selected>Pickup</option>
                        <option value="Delivery">Delivery</option>
                    </select>
                </div>

                <div class="form-group" id="roomField" style="display: none;">
                    <label for="room">Room Number:</label> <br>
                    <input type="text" name="Room_Num">
                </div>

                <div class="form-group">
                    <label for="time">Time:</label> <br>
                    <input type="time" name="Time" required>
                </div>

                <div class="form-group">
                    <label for="paymentMethod">Select Mode of Payment:</label>
                    <select id="paymentMethod" name="Payment_Method" onchange="toggleGcashFields()">
                        <option value="GCash" selected>GCash (Full Payment)</option>
                        <option value="Cash">Cash (50% GCash Downpayment, 50% upon Pickup/Delivery)</option>
                    </select>
                </div>

                <div class="form-group" id="gcashReceiptField">
                    <label for="receipt">Upload Your GCash Receipt:</label> <br>
                    <input type="file" name="Receipt" id="receipt" accept="image/*" required>
                </div>

                <button class="btn-1" name="Checkout" id="checkoutBtn">Complete Purchase</button>

                <div id="confirmationModal" class="modal">
                    <div class="modal-content">
                        <h3>Non-Refundable Policy</h3>
                        <p>Please note that this purchase is **non-refundable**. Do you agree to proceed?</p>
                        <div class="modal-buttons">
                            <button type="button" class="btn-cancel" id="cancelCheckout">Cancel</button>
                            <button type="submit" class="btn-agree" id="confirmCheckout" name="confirmCheckout">Agree & Proceed</button>      
                        </div>
                    </div>
                </div>
            </form> 
        </div>

        <div class="separator"></div>

        <div class="checkout-container">
            <h2>Checkout Summary</h2>
            <div id="checkout-items"></div> 
            <p class="subtotal"><strong>Subtotal:</strong> 
                <span id="checkout-subtotal">₱0.00</span>
            </p>
        </div>
    </section>

    <div class="cart-sidebar" id="cartSidebar"> 
        <div class="cart-header">
            <h2>Cart</h2>
            <button id="closeCart">&times;</button>
        </div>
        <div class="cart-items" id="cartItems">
            <p class="empty-cart-msg">Your cart is currently empty.</p>
        </div>
        <div class="cart-footer">
            <p>Subtotal: <span id="cart-subtotal">₱0.00</span></p>
            <a href="checkout.php" id="checkout-btn" class="checkout-btn">Checkout</a>
        </div>
    </div>

    <section class="footer-banner">
        <img src="img/banner.jpg">
        <div class="content">
            <h1>Every cup tells a story.</h1>
            <p>CRAFTED WITH PASSION, BREWED FOR YOU.</p>
        </div>
    </section>
    
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>QUICK LINKS</h3>
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="services.php">Services</a> 
                <a href="menu.php">Menu</a> 
                <a href="reservation.php">Reservation</a> 
                <a href="events.php">Events</a> 
            </div>

            <div class="box">
                <h3>GET IN TOUCH</h3>
                <p><i class="fas fa-map-marker-alt"></i>791 President Laurel Highway, Brgy. Darasa, Tanauan</p>
                <p><i class="fas fa-phone-alt"></i>0915 061 6194</p>
                <p><i class="fas fa-envelope"></i>fo.haciendadarasa@gmail.com</p> 
            </div>

            <div class="box">
                <h3>FOLLOW US</h3>
                <p>Stay updated with our latest brews and offers!</p>
                <div class="icons">
                    <a href="#" class="fa-brands fa-square-facebook"></a> 
                </div>  
            </div>

            <div class="box">
                <h3>OPEN HOURS</h3>
                <p><span>Monday - Friday</span></p>
                <p>8:00 AM - 5:00 PM</p>
                <p><span>Saturday - Sunday</span></p>
                <p>8:00 AM - 5:00 PM</p>
            </div>
        </div>

        <div class="credit">©2025 Café Luntian <span> | All rights reserved.</span></div> 
    </section>

    <script src="main.js"></script> 
    <script>

        

          // modal
          document.addEventListener("DOMContentLoaded", function () {
                const checkoutBtn = document.getElementById("checkoutBtn");
                const confirmationModal = document.getElementById("confirmationModal");
                const cancelCheckout = document.getElementById("cancelCheckout");
                const confirmCheckout = document.getElementById("confirmCheckout");
                const checkoutForm = document.getElementById("checkoutForm");
                const successMessage = document.getElementById("successMessage");

                // show modal 
                checkoutBtn.addEventListener("click", function (event) {
                    event.preventDefault(); 
                    confirmationModal.classList.add("show");
                });

                // hide modal 
                cancelCheckout.addEventListener("click", function () {
                    confirmationModal.classList.remove("show");
                });

                // proceed with checkout when confirm is clicked
                confirmCheckout.addEventListener("click", function () {
                    confirmationModal.classList.remove("show"); // hide modal

                    // show success message
                    successMessage.style.display = "block";

                    setTimeout(() => {
                        checkoutForm.submit(); // submit the form 
                    }, 5000); // delay form submission slightly 
                });
            });

            // toggle mode for delivery
            function toggleRoomField() {
                var orderType = document.getElementById("orderType").value;
                var roomField = document.getElementById("roomField");

                // show the room field if 'Delivery' is selected
                if (orderType === "Delivery") {
                    roomField.style.display = "block";
                } else {
                    roomField.style.display = "none";
                }
            }
            document.addEventListener("DOMContentLoaded", toggleRoomField);
    </script>

</body>
</html>