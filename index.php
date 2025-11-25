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
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Birthstone&display=swap" rel="stylesheet">
    </head>
    <body>

        <section class="nav">
            <div class="menu-toggle" id="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </div>
            
            <a href="index.php">
                <img src="img/logo.png" class="logo">
            </a>
            
            <nav class="navbar">
                <ul>
                    <li><a href="index.php" style="color: #41a884;">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li class="dropdown">
                        <a href="#">Pages</a>
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

        <section class="intro" id="home">
            <div class="carousel">
                <img src="img/home-bg.jpeg" class="carousel-image active">
                <img src="img/home-bg2.jpg" class="carousel-image">
                <img src="img/home-bg3.jpg" class="carousel-image">
            </div>
            <div class="info">
                <h1>Freshly Brewed, Just for You!</h1>
                <h3>Order your favorite coffee and treats now!</h3>
                <a href="menu.php" class="btn-1">Order Now</a>    
            </div>       
        </section>
        

        <section class="about" id="about">
            <div class="container">
                <img src="img/about.png" alt="Cafe Background">
                <div class="info">
                    <h1>About Us</h1>
                    <p>Welcome to Cafe Luntian, your go-to spot for refreshing and comforting drinks 
                        at Hacienda Darasa Garden Resort Hotel. We specialize in hot drinks 
                        (coffee & non-coffee), iced coffee, iced non-coffee, and frappes, 
                        crafted to satisfy every craving. Whether you’re a coffee lover or
                        prefer something cool and creamy, we’ve got the perfect drink for you. Live your best coffee life with us! </p>
                    <a href="about.php"><button class="btn-1">Learn More</button></a>
                </div>
            </div>
        </section>
    
        <section class="vid">     
            <div class="vid-container">
                <video autoplay muted loop>
                    <source src="vid/cafe.mp4" type="video/mp4">
                </video>
            </div>  
        </section>

        <section class="services" id="services">
            <h1>Services</h1>
            <div class="container"> 
            <a href="reservation.php">
                <div class="box">
                    <div class="image">
                        <img src="img/tablersvt.jpg">
                    </div>
                    <div class="info">
                        <h2>Table Reservation</h2>
                        <p>Secure your spot and enjoy a hassle-free coffee date with just a few clicks!</p>
                    </div>
                </div>
            </a> 
            
            <a href="menu.php">
                <div class="box">
                    <div class="image">
                        <img src="img/tablersvt.jpg">
                    </div>
                    <div class="info">
                        <h2>Online Ordering</h2>
                        <p>Order your favorite coffee and drinks online for quick pickup or dine-in convenience!</p>
                    </div>
                </div>
            </a>
            </div>
        </section>

        <section class="favorites" id="menu">
            <h1>Customer Favorites</h1>
            <div class="favorites-container">
                <div class="favorite-item"> 
                    <img src="img/caramelMacchiato.jpg" alt="Caramel Macchiato">
                    <div class="info">
                        <h3>Caramel Macchiato</h3>
                        <p>₱99.00</p>
                    </div>  
                </div>
                <div class="favorite-item">
                    <img src="img/saltedCaramel.jpg" alt="Salted Caramel">
                    <div class="info">
                        <h3>Salted Caramel</h3>
                        <p>₱99.00</p>
                    </div>  
                </div>
                <div class="favorite-item">
                    <img src="img/americano.jpg" alt="Americano">
                        <div class="info">
                            <h3>Americano</h3>
                            <p>₱99.00</p>
                        </div>    
                </div>
                <div class="favorite-item">
                    <img src="img/whitechocmocha.jpg" alt="White Chocolate Mocha">
                        <div class="info">
                            <h3>White Chocolate Mocha</h3>
                            <p>₱99.00</p>
                        </div>   
                </div>
            </div>
            <a href="menu.php" class="btn-1">See Full Menu <i class="fa-solid fa-arrow-right"></i></a>
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

        <section class="hacienda">
            <img src="img/hacienda.jpeg" alt="Hacienda Darasa Resort & Hotel">
            <div class="content">
                <h1>Hacienda Darasa Resort & Hotel</h1>
                <p>Experience a relaxing getaway at Hacienda Darasa Resort & Hotel. Enjoy nature, comfort, 
                    and top-notch amenities perfect for your vacation, events, or retreats.</p>
                <a href="" id="btn-1" class="btn-1">Go to Page</a>
                
                <div class="contact-info">
                    <h2>Contact Us</h2>
                    <p><strong>Phone:</strong> 0915 061 6194</p>
                    <p><strong>Email:</strong> fo.haciendadarasa@gmail.com</p>
                    <p><strong>Address:</strong> 791 President Laurel Highway, Brgy. Darasa, Tanauan</p>
                </div>

                <div class="social-links">
                    <h2>Follow Us</h2>
                    <a href="" target="_blank" class="social-icon">
                        <i class="fab fa-facebook"></i> Facebook
                    </a>
                </div>
            </div>
        </section>

        <section class="footer-banner" id="footer-banner-index">
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
            // carousel img
            document.addEventListener("DOMContentLoaded", function () {
                let images = document.querySelectorAll(".carousel img");
                let currentIndex = 0;
        
                function changeImage() {
                    images[currentIndex].classList.remove("active");
                    currentIndex = (currentIndex + 1) % images.length;
                    images[currentIndex].classList.add("active");
                }
        
                setInterval(changeImage, 3000); // Change image every 3 secs
            });
  
        </script>
    </body>
</html>