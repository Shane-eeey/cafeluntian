<?php
 session_start();
 include('mycon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Luntian Register</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo2.png">
    <script src="https://kit.fontawesome.com/1e3d5daa34.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style2.css">
</head>
<body>

    <main class="main">

    <div class="register-form">
        <div class="container">
            <div class="main2">
                <div class="content2">
                    <h2>Register</h2>
                    <form method="POST" action="RegisterScript.php">
                        <div class="input-pair">
                          <input type="text" name="User_FName" placeholder="First Name" required>
                          <input type="text" name="User_LName" placeholder="Last Name" required>
                        </div>   
                        <div class="input-pair">  
                            <input type="text" name="ContactNo" placeholder="Contact No." required>        
                        </div>
                        <input type="email" name="Email" placeholder="Email" required>
                        <input type="password" name="Password" placeholder="Password" required>  
  
                        <input type="submit" id="reg-btn" name="register" value="Register"/>
                    </form>
                </div>
                <div class="form-img">
                    <img src="img/logo2.jpeg" alt="Background Image">
                </div>
            </div>
        </div>
    </div>
    </main>
    
</body>
</html>