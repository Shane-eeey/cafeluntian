<?php
    session_start();
    include('mycon.php')
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
    </head>
    <body id="about-page">
        <section class="nav">
            <div class="menu-toggle" id="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </div>
            
            <a href="index.php">
                <img src="img/logo.png" class="logo">
            </a>
            
            <nav class="navbar">
                <ul>
                <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li class="dropdown">
                        <a href="#"  style="color: #41a884;">Pages</a>
                        <ul class="dropdown-content">
                            <li><a href="reservation.php">Reservation</a></li>
                            <li><a href="events.php">Events</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>

            <div class="cart-icon">
                <a href="#" id="cart-icon">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span id="cart-count">0</span>
                </a>
            </div>
        </section>

        <!-- Sidebar Menu for Mobile -->
        <aside class="sidebar" id="sidebar">
            <div class="close-btn" id="close-sidebar">&times;</div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="reservation.php">Reservation</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </aside>

        <section class="intro-banner">
            <div class="banner">
                <img src="img/home-bg.jpeg">
            </div>
            <div class="info">
                <h1>EVENTS</h1>
            </div>       
        </section>


        <section class="events" id="events">
           <div class="container">
            <button class="scroll-btn left-btn">&#10094;</button>
                <div class="event-item">
                    <div class="image">
                        <img src="img/home-bg2.jpg" alt="Cafe Background">
                    </div>
                    <div class="info">
                        <h1>EVENT #1</h1> 
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dolor velit, vehicula quis molestie sed, 
                            elementum quis erat. Praesent volutpat convallis fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing
                             elit. Vivamus dolor velit, vehicula quis molestie sed, elementum quis erat. Praesent volutpat convallis 
                             fringilla. </p>   
                    </div>         
                </div> 
                
             
            <button class="scroll-btn right-btn">&#10095;</button>
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

    </body>
</html>