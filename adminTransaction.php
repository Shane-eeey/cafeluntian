
<?php
    session_start();
    include('mycon.php');
    include('counter.php')
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | Cafe Luntian</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo2.png">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://kit.fontawesome.com/1e3d5daa34.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
       .table-wrapper {
          overflow-x: auto; 
          width: 100%;
        }
    </style>
  </head>
  <body>
  <button id="sidebarToggle" class="sidebar-toggle">
      <span class="material-symbols-outlined">menu</span>
    </button>

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
          <a href="adminReservation.php" class="active"><span class="material-symbols-outlined">book</span>Reservation</a>
        </li>
        <li>
          <a href="adminTransaction.php" class="active"><span class="material-symbols-outlined">receipt_long</span>Transaction</a>
        </li>

        <h4>
          <span>Account</span>
          <div class="menu-separator"></div>
        </h4>
        <li>
          <a href="profile.php"><span class="material-symbols-outlined">account_circle</span>Profile</a>
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
        <h1>Transaction List</h1>
        </header>

    <section class="search">
      <a href="#" class="search-icon"><i class="fas fa-search"></i></a>
      <input type="text" id="searchInput" placeholder="Search Name or Order ID here" >   
    </section>

    <section class="search-result">
      <h1>Search Results</h1><hr>
      <div class="box-container" id="transactionList">
      <?php
          include('mycon.php');

          $sql = "SELECT Transaction_ID, Order_ID, Customer_Name, Order_Date, Amount, Status 
                  FROM transactions_tbl 
                  ORDER BY Order_ID DESC, Order_Date DESC";

          $result = $connection->query($sql);

          echo "<table id='userTable' border='1' width='100%'>";
          echo "<tr align='center' class='tblheader'>
                <td><b>Transaction ID</b></td>
                <td><b>Order ID</b></td>
                <td><b>Customer Name</b></td>
                <td><b>Date & Time</b></td>
                <td><b>Amount</b></td>
                <td><b>Status</b></td>
                <td><b>Actions</b></td>
                <td><b>Details</b></td>
              </tr>";

          if ($result->num_rows > 0) {
              $prevOrderID = null;
              $rowspanCount = [];
              $orderGroups = [];
              $groupIndex = 0;

              while ($row = $result->fetch_assoc()) {
                  if (!isset($rowspanCount[$row['Order_ID']])) {
                      $rowspanCount[$row['Order_ID']] = 1;
                      $orderGroups[$row['Order_ID']] = $groupIndex % 2 == 0 ? "group-even" : "group-odd";
                      $groupIndex++;
                  } else {
                      $rowspanCount[$row['Order_ID']]++;
                  }
              }

              $result->data_seek(0);
              $orderRowspan = [];

              while ($row = $result->fetch_assoc()) {
                  $Order_ID = $row['Order_ID'];
                  $isFirstRow = ($Order_ID != $prevOrderID);
                  $formattedDateTime = date("Y-m-d h:i A", strtotime($row['Order_Date']));
                  $rowClass = $orderGroups[$Order_ID];

                  echo '<tr class="' . $rowClass . '">' ;

                  if ($isFirstRow) {
                      $orderRowspan[$Order_ID] = $rowspanCount[$Order_ID];

                      echo '<td rowspan="' . $orderRowspan[$Order_ID] . '">' . $row['Transaction_ID'] . '</td>';
                      echo '<td rowspan="' . $orderRowspan[$Order_ID] . '" class="order-id">' . $row['Order_ID'] . '</td>';
                      echo '<td rowspan="' . $orderRowspan[$Order_ID] . '" class="user-name">' . $row['Customer_Name'] . '</td>';
                  }

                  echo '<td>' . $formattedDateTime . '</td>';
                  echo '<td>₱' . number_format($row['Amount'], 2) . '</td>';
                  echo '<td>' . $row['Status'] . '</td>';

                  if ($isFirstRow) {
                      echo "<td rowspan='{$orderRowspan[$Order_ID]}'>";
                      if ($row['Status'] == 'pending') {
                        echo "<form method='POST'  class='action-form' style='display: flex; flex-direction: row; gap: 5px; align-items: stretch; width: 100px;'>
                                <input type='hidden' name='transaction_id' value='{$row['Transaction_ID']}'>
                                <button type='submit' name='status' value='confirmed' style='background-color:#177353; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 5px;'>Confirm</button>
                                <button type='submit' name='status' value='cancelled' style='background-color:#ac3830; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 5px;'>Cancel</button>
                              </form>";
                      } else {
                          echo "--";
                      }
                      echo "</td>";
                  }

                  if ($isFirstRow) {
                      echo "<td rowspan='{$orderRowspan[$Order_ID]}'>";
                      if ($row['Status'] == 'confirmed') {
                          echo "<a href='receipt.php?Order_ID={$row['Order_ID']}' title='View Receipt' style='text-decoration: none; color: black;'>
                                  <i class='fas fa-receipt'></i>
                                </a>";
                      } else {
                          echo "--";
                      }
                      echo "</td>";
                  }

                  echo '</tr>';
                  $prevOrderID = $Order_ID;
              }
          } else {
              echo "<tr><td colspan='8' align='center'>No transactions found.</td></tr>";
          }

          echo "</table>";
          ?>



      </div>
     </section>
    </main>

    <script src="main.js"></script>
    <script>
        //toggle sidebar
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.querySelector('.sidebar-toggle');

        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // prevent immediate closing
            sidebar.classList.add('show-sidebar');
            toggleBtn.style.display = 'none'; // hide toggle btn
        });

        // close sidebar when clicking outside
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target)) {
                sidebar.classList.remove('show-sidebar');
                toggleBtn.style.display = 'block'; // show toggle btn
            }
        });

        // prevent closing when clicking inside the sidebar
        sidebar.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    </script>
  </body>
</html>
