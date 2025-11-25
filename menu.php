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
                <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="menu.php" style="color: #41a884;">Menu</a></li>
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

        <section class="intro-banner">
            <div class="banner">
                <img src="img/home-bg.jpeg">
            </div>
            <div class="info">
                <h1>MENU</h1>
            </div>       
        </section>

        <section class="menu-page">
            <h1>HOTDRINKS</h1>
            <h2>COFFEE <span>₱99.00</span></h2>
            <div class="menu-container">
                <button class="scroll-btn left-btn">&#10094;</button>
                <ul class="menu-items">
                    <li class="menu-item" data-name="Caramel Macchiato" data-type="Hotdrinks Coffee" data-price="₱99.0" data-image="img/caramelMacchiato.jpg">
                        <img src="img/caramelMacchiato.jpg" alt="Caramel Macchiato">
                        <div class="info">
                            <h3>Caramel Macchiato</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Salted Caramel" data-type="Hotdrinks Coffee" data-price="₱99.0" data-image="img/saltedCaramel.jpg">
                        <img src="img/saltedCaramel.jpg" alt="Salted Caramel">
                        <div class="info">
                            <h3>Salted Caramel</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>   
                    <li class="menu-item" data-name="Cappuccino" data-type="Hotdrinks Coffee" data-price="₱99.0" data-image="img/cappuccino.png">
                        <img src="img/cappuccino.png" alt="Cappuccino">
                        <div class="info">
                            <h3>Cappuccino</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Spanish Latte" data-type="Hotdrinks Coffee" data-price="₱99.0" data-image="img/spanishLatte.jpg">
                        <img src="img/spanishLatte.jpg" alt="Spanish Latte">
                        <div class="info">
                            <h3>Spanish Latte</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Americano" data-type="Hotdrinks Coffee" data-price="₱99.0" data-image="img/americano.jpg">
                        <img src="img/americano.jpg" alt="Americano">
                        <div class="info">
                            <h3>Americano</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="White Chocolate Mocha" data-type="Hotdrinks Coffee" data-price="₱99.0" data-image="img/whitechocmocha.jpg">
                        <img src="img/whitechocmocha.jpg" alt="White Chocolate Mocha">
                        <div class="info">
                            <h3>White Chocolate Mocha</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Cafe Latte" data-type="Hotdrinks Coffee" data-price="₱99.0" data-image="img/cafeLatte.jpg">
                        <img src="img/cafeLatte.jpg" alt="Cafe Latte">
                        <div class="info">
                            <h3>Cafe Latte</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Vanilla Latte" data-type="Hotdrinks Coffee" data-price="₱99.0" data-image="img/vanillaLatte.jpg">
                        <img src="img/vanillaLatte.jpg" alt="Vanilla Latte">
                        <div class="info">
                            <h3>Vanilla Latte</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Espresso"  data-type="Hotdrinks Coffee" data-price="₱99.0" data-image="img/espresso.jpg">
                        <img src="img/espresso.jpg" alt="Espresso">
                        <div class="info">
                            <h3>Espresso</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                </ul>
                <button class="scroll-btn right-btn">&#10095;</button>
            </div>

            <h2>NON-COFFEE <span>₱99.00</span></h2>
            <div class="menu-container">
                <button class="scroll-btn left-btn">&#10094;</button>
                <ul class="menu-items">
                    <li class="menu-item" data-name="Caramel Macchiato" data-type="Hotdrinks Non-Coffee" data-price="₱99.0" data-image="img/carMachNonCof.jpg">
                        <img src="img/carMachNonCof.jpg" alt="Caramel Macchiato">
                        <div class="info">
                            <h3>Caramel Macchiato</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Salted Caramel" data-type="Hotdrinks Non-Coffee" data-price="₱99.0" data-image="img/saltCarNonCof.jpg">
                        <img src="img/saltCarNonCof.jpg" alt="Salted Caramel">
                        <div class="info">
                            <h3>Salted Caramel</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Chocolate" data-type="Hotdrinks Non-Coffee" data-price="₱99.0" data-image="img/chocolate.jpg">
                        <img src="img/chocolate.jpg" alt="Chocolate">
                        <div class="info">
                            <h3>Chocolate</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="White Chocolate" data-type="Hotdrinks Non-Coffee" data-price="₱99.0" data-image="img/whitechocNonCof.jpg">
                        <img src="img/whitechocNonCof.jpg" alt="White Chocolate">
                        <div class="info">
                            <h3>White Chocolate</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Vanilla" data-type="Hotdrinks Non-Coffee" data-price="₱99.0" data-image="img/vanilla.jpg">
                        <img src="img/vanilla.jpg" alt="Vanilla">
                        <div class="info">
                            <h3>Vanilla</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Caramel" data-type="Hotdrinks Non-Coffee" data-price="₱99.0" data-image="img/carMachNonCof.jpg">
                        <img src="img/carMachNonCof.jpg" alt="Caramel">
                        <div class="info">
                            <h3>Caramel</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>                  
                </ul>
                <button class="scroll-btn right-btn">&#10095;</button>
            </div>

            <h1>ICED-COFFEE</h1>
            <h2><span>₱129.00</span></h2>
            <div class="menu-container">
                <button class="scroll-btn left-btn">&#10094;</button>
                <ul class="menu-items">
                    <li class="menu-item" data-name="Americano" data-type="Iced Coffee" data-price="₱129.0" data-image="img/americanoIced.jpg">
                        <img src="img/americanoIced.jpg" alt="Americano">
                        <div class="info">
                            <h3>Americano</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Caramel Macchiato" data-type="Iced Coffee" data-price="₱129.0" data-image="img/caramelMacIced.jpg">
                        <img src="img/caramelMacIced.jpg" alt="Caramel Macchiato">
                        <div class="info">
                            <h3>Caramel Macchiato</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Salted Caramel" data-type="Iced Coffee" data-price="₱129.0" data-image="img/saltedcarIced.jpg">
                        <img src="img/saltedcarIced.jpg" alt="Salted Caramel">
                        <div class="info">
                            <h3>Salted Caramel</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Spanish Latte" data-type="Iced Coffee" data-price="₱129.0" data-image="img/spanishLatteIced.jpg">
                        <img src="img/spanishLatteIced.jpg" alt="Spanish Latte">
                        <div class="info">
                            <h3>Spanish Latte</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Cafe Mocha" data-type="Iced Coffee" data-price="₱129.0" data-image="img/cafeMochaIced.jpg">
                        <img src="img/cafeMochaIced.jpg" alt="Cafe Mocha">
                        <div class="info">
                            <h3>Cafe Mocha</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="White Chocolate Mocha" data-type="Iced Coffee" data-price="₱129.0" data-image="img/whitechocIced.jpg">
                        <img src="img/whitechocIced.jpg" alt="White Chocolate Mocha">
                        <div class="info">
                            <h3>White Chocolate Mocha</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Dirty Matcha" data-type="Iced Coffee" data-price="₱129.0" data-image="img/dirtymatchaIced.jpg">
                        <img src="img/dirtymatchaIced.jpg" alt="Dirty Matcha">
                        <div class="info">
                            <h3>Dirty Matcha</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Vanilla Latte" data-type="Iced Coffee" data-price="₱129.0" data-image="img/vanillaLatIced.jpg">
                        <img src="img/vanillaLatIced.jpg" alt="Vanilla Latte">
                        <div class="info">
                            <h3>Vanilla Latte</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>                 
                </ul>
                <button class="scroll-btn right-btn">&#10095;</button>
            </div>

            <h1>ICED  NON-COFFEE</h1>
            <h2><span>₱129.00</span></h2>
            <div class="menu-container">
                <button class="scroll-btn left-btn">&#10094;</button>
                <ul class="menu-items">
                    <li class="menu-item" data-name="Dark Chocolate" data-type="Iced Non-Coffee" data-price="₱129.0" data-image="img/darkChocoNonCof.jpg">
                        <img src="img/darkChocoNonCof.jpg" alt="Dark Chocolate">
                        <div class="info">
                            <h3>Dark Chocolate</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Caramel Macchiato" data-type="Iced Non-Coffee" data-price="₱129.0" data-image="img/carMachNonCof.jpg">
                        <img src="img/carMachNonCof.jpg" alt="Caramel Macchiato">
                        <div class="info">
                            <h3>Caramel Macchiato</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Salted Caramel" data-type="Iced Non-Coffee" data-price="₱129.0" data-image="img/saltCarNonCof.jpg">
                        <img src="img/saltCarNonCof.jpg" alt="Salted Caramel">
                        <div class="info">
                            <h3>Salted Caramel</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="White Choco" data-type="Iced Non-Coffee" data-price="₱129.0" data-image="img/whitechocNonCof.jpg">
                        <img src="img/whitechocNonCof.jpg" alt="White Choco">
                        <div class="info">
                            <h3>White Choco</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Dirty Matcha" data-type="Iced Non-Coffee" data-price="₱129.0" data-image="img/dirtMatchaNonCof.jpg">
                        <img src="img/dirtMatchaNonCof.jpg" alt="Dirty Matcha">
                        <div class="info">
                            <h3>Dirty Matcha</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Milky Vanilla" data-type="Iced Non-Coffee" data-price="₱129.0" data-image="img/milkyvanilla.jpg">
                        <img src="img/milkyvanilla.jpg" alt="Milky Vanilla">
                        <div class="info">
                            <h3>Milky Vanilla</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                                
                </ul>
                <button class="scroll-btn right-btn">&#10095;</button>
            </div>

            <h1>FRAPPE</h1>
            <h2><span>₱149.00</span></h2>
            <div class="menu-container">
                <button class="scroll-btn left-btn">&#10094;</button>
                <ul class="menu-items">
                    <li class="menu-item" data-name="Java Chip" data-type="Frappe" data-price="₱149.0" data-image="img/javachip.jpg">
                        <img src="img/javachip.jpg" alt="Java Chip">
                        <div class="info">
                            <h3>Java Chip</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Salted Caramel" data-type="Frappe" data-price="₱149.0" data-image="img/saltcarFrappe.jpg">
                        <img src="img/saltcarFrappe.jpg" alt="Salted Caramel">
                        <div class="info">
                            <h3>Salted Caramel</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="White Chocolate" data-type="Frappe" data-price="₱149.0" data-image="img/whitechocFrappe.jpg">
                        <img src="img/whitechocFrappe.jpg" alt="White Chocolate">
                        <div class="info">
                            <h3>White Chocolate</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Dark Chocolate" data-type="Frappe" data-price="₱149.0" data-image="img/darkChocFrappe.jpg">
                        <img src="img/darkChocFrappe.jpg" alt="Dark Chocolate">
                        <div class="info">
                            <h3>Dark Chocolate</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>
                    <li class="menu-item" data-name="Matcha" data-type="Frappe" data-price="₱149.0" data-image="img/matchaFrappe.jpg">
                        <img src="img/matchaFrappe.jpg" alt="Matcha">
                        <div class="info">
                            <h3>Matcha</h3>
                        </div>
                        <button class="add-btn">+</button>
                    </li>                        
                </ul>
                <button class="scroll-btn right-btn">&#10095;</button>
            </div>

            <div class="add">
                <h3>ADD <span>10+</span> FOR COFFEE SHOT</h3>
                <h3>ADD <span>50+</span> FOR ALCOHOL SHOT</h3>
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

       
        <script>

        let subtotal = 0;

            document.querySelectorAll('.add-btn').forEach(button => {
            button.addEventListener('click', function() {
                const menuItem = this.parentElement;
                const price = parseFloat(menuItem.getAttribute('data-price').replace('₱', '').replace(',', ''));
        
                subtotal += price;

                // Update the subtotal in the session
                    fetch('update_subtotal.php', {
                        method: 'POST',
                        headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ subtotal: subtotal })
                });

                // Update the displayed subtotal in the cart
                    document.getElementById('cart-subtotal').innerText = '₱' + subtotal.toFixed(2);
                });
            });

            //scroll btns for menu items
            document.querySelectorAll('.menu-container').forEach(container => {
                const leftBtn = container.querySelector('.left-btn');
                const rightBtn = container.querySelector('.right-btn');
                const menuItems = container.querySelector('.menu-items');
                const menuItem = container.querySelector('.menu-item'); 
                
                let scrollAmount = 0;
                
                if (!menuItem) return; // Exit if there are no items

                const itemWidth = menuItem.offsetWidth;
                const scrollStep = itemWidth * 2; // Scroll by 2 items

                function toggleButtons() {
                    if (scrollAmount > 0) {
                        leftBtn.style.display = 'block'; 
                    } else {
                        leftBtn.style.display = 'none'; 
                    }

                    if (scrollAmount < menuItems.scrollWidth - menuItems.clientWidth) {
                        rightBtn.style.display = 'block'; 
                    } else {
                        rightBtn.style.display = 'none'; 
                    }
                }

                toggleButtons();

                leftBtn.addEventListener('click', () => {
                    // Scroll the menu left 
                    if (scrollAmount > 0) {
                        scrollAmount -= scrollStep; // scroll by 2 items
                        menuItems.style.transform = `translateX(-${scrollAmount}px)`;
                        toggleButtons(); // update button visibility
                    }
                });

                rightBtn.addEventListener('click', () => {
                    // Scroll the menu right 
                    if (scrollAmount < menuItems.scrollWidth - menuItems.clientWidth) {
                        scrollAmount += scrollStep;
                        menuItems.style.transform = `translateX(-${scrollAmount}px)`;
                        toggleButtons();
                    }
                });
            });

        </script> 

        <script src="main.js"></script> 
    
    </body>
</html>