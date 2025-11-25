<?php
  session_start();
  include('mycon.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | Cafe Luntian</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo2.png">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://kit.fontawesome.com/1e3d5daa34.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <aside class="sidebar">
      <div class="sidebar-header">
        <img src="img/logo3.png" alt="logo" />
        <h2>Cafe Luntian</h2>
      </div>

      <ul class="sidebar-links">
        <h4>
          <span>Main Menu</span>
          <div class="menu-separator"></div>
        </h4>
        <li>
          <a href="adminDashboard.php"><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
        </li>
        <li>
          <a href="adminOrder.php"><span class="material-symbols-outlined">list_alt</span>Order</a>
        </li>
        <li>
          <a href="adminReservation.php"><span class="material-symbols-outlined">book</span>Reservation</a>
        </li>
        <li>
          <a href="adminTransaction.php" class="active"><span class="material-symbols-outlined">receipt_long</span>Transaction</a>
        </li>

        <h4>
          <span>Account</span>
          <div class="menu-separator"></div>
        </h4>
        <li>
          <a href="profile.php"  class="active"><span class="material-symbols-outlined">account_circle</span>Profile</a>
        </li>
        <li>
          <a href="login.php"><span class="material-symbols-outlined">logout</span>Logout</a>
        </li>
      </ul>

      <div class="user-account">
        <div class="user-profile">
          <img src="img/profile.png" alt="Profile Image" />
          <div class="user-detail">
          <h3><?php echo $_SESSION['User_FName']." ".$_SESSION['User_LName']; ?></h3>
            <span>Admin</span>
          </div>
        </div>
      </div>
    </aside>

    <main class="main">
      <header>
        <h1>Profile</h1>
      </header>

      <section class="profile">
            <div class="profile-container">
                <div class="admin-profile">
                    <div class="profile-info">
                        <div class="admin-details">
                            <p><strong>Admin ID:</strong><span id="AdminID"><?php echo $_SESSION['Admin_ID']?></span></p>
                            <p><strong>Name:</strong> <span id="Name"><?php echo $_SESSION['User_FName'] . ' ' . $_SESSION['User_LName']; ?></span></p>
                            <p><strong>Email:</strong> <span id="Email"><?php echo $_SESSION['Email'] ?></span></p>
                            <p><strong>Contact No:</strong> <span id="Contact"><?php echo $_SESSION ['Contact_Num']?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    </main>
  </body>
</html>
