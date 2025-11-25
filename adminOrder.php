<?php
session_start();
include('mycon.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order | Cafe Luntian</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo2.png">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://kit.fontawesome.com/1e3d5daa34.js" crossorigin="anonymous"></script>
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
      <h1>Order List</h1>
    </header>

    <section class="search">
      <a href="#" class="search-icon"><i class="fas fa-search"></i></a>
      <input type="text" id="searchInput" placeholder="Search Name or ID here" >   
    </section>

    <section class="search-result">
      <h1>Search Results</h1><hr>
      <div class="table-wrapper">
      <?php
        include('mycon.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Order_ID'], $_POST['status'])) {
            $Order_ID = $_POST['Order_ID'];
            $status = $_POST['status'];

            // Update order status
            $stmt = $connection->prepare("UPDATE order_items_tbl SET Status=? WHERE Order_ID=?");
            $stmt->bind_param("ss", $status, $Order_ID);
            $stmt->execute();

            // If confirmed, add to transactions if not already there
            if ($status === 'confirmed') {
                $stmt = $connection->prepare("SELECT 1 FROM transactions_tbl WHERE Order_ID=?");
                $stmt->bind_param("s", $Order_ID);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows === 0) {
                    // Calculate total amount
                    $amountQuery = "SELECT SUM((Price + 
                                            CASE 
                                                WHEN LOWER(Add_Ons) LIKE '%coffee%' THEN 10 
                                                WHEN LOWER(Add_Ons) LIKE '%alcohol%' THEN 50 
                                                ELSE 0 
                                            END) * Quantity) AS total_amount
                                    FROM order_items_tbl 
                                    WHERE Order_ID=?";
                    $stmtAmount = $connection->prepare($amountQuery);
                    $stmtAmount->bind_param("s", $Order_ID);
                    $stmtAmount->execute();
                    $amountResult = $stmtAmount->get_result()->fetch_assoc();
                    $totalAmount = $amountResult['total_amount'];

                    // Get customer name
                    $stmtCust = $connection->prepare("SELECT Customer_Name FROM customer_order_tbl WHERE Order_ID=?");
                    $stmtCust->bind_param("s", $Order_ID);
                    $stmtCust->execute();
                    $customerRow = $stmtCust->get_result()->fetch_assoc();
                    $customerName = $customerRow['Customer_Name'];

                    // Insert transaction
                    $insertTransaction = $connection->prepare("INSERT INTO transactions_tbl (Order_ID, Customer_Name, Order_Date, Amount, Status) 
                                                              VALUES (?, ?, NOW(), ?, 'pending')");
                    $insertTransaction->bind_param("ssd", $Order_ID, $customerName, $totalAmount);
                    $insertTransaction->execute();
                }
            }
        }

        // Pagination
        $limit = 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $limit;

        // Count total orders
        $countResult = $connection->query("SELECT COUNT(DISTINCT Order_ID) AS total_orders FROM customer_order_tbl");
        $totalOrders = $countResult->fetch_assoc()['total_orders'];
        $totalPages = ceil($totalOrders / $limit);

        // Fetch orders and items
        $sql = "SELECT c.Order_ID, c.Customer_Name, c.Contact, c.Email, c.Room_Num, c.Mode_of_Service, c.Time,
                      i.Item_Name, i.Quantity, i.Price, i.Add_Ons, i.Status
                FROM customer_order_tbl c
                LEFT JOIN order_items_tbl i ON c.Order_ID = i.Order_ID
                WHERE i.Order_ID IS NOT NULL
                ORDER BY c.Order_ID DESC";
        $result = $connection->query($sql);

        // Start table
        echo "<table border='1' width='100%' id='userTable'>
        <tr align='center' class='tblheader'>
            <td><b>Order ID</b></td>
            <td><b>Customer Name</b></td>
            <td><b>Item (Add-Ons)</b></td>
            <td><b>Quantity</b></td>
            <td><b>Item Price</b></td>
            <td><b>Add-On Price</b></td>
            <td><b>Total</b></td>
            <td><b>Subtotal</b></td>
            <td><b>Contact</b></td>
            <td><b>Time</b></td>
            <td><b>Room Num</b></td>
            <td><b>Mode of Service</b></td>
            <td><b>Status</b></td>
            <td><b>Actions</b></td>
        </tr>";

        if ($result->num_rows > 0) {
            $prevOrderID = null;
            $rowspanCount = [];
            $orderTotal = [];
            $orderGroups = [];
            $groupIndex = 0;

            while ($row = $result->fetch_assoc()) {
                $Order_ID = $row['Order_ID'];
                $addonPrice = (!empty($row['Add_Ons']) && stripos($row['Add_Ons'], 'coffee') !== false) ? 10 :
                              ((!empty($row['Add_Ons']) && stripos($row['Add_Ons'], 'alcohol') !== false) ? 50 : 0);
                $itemTotal = ($row['Price'] + $addonPrice) * $row['Quantity'];

                if (!isset($rowspanCount[$Order_ID])) {
                    $rowspanCount[$Order_ID] = 1;
                    $orderTotal[$Order_ID] = $itemTotal;
                    $orderGroups[$Order_ID] = $groupIndex % 2 === 0 ? "group-even" : "group-odd";
                    $groupIndex++;
                } else {
                    $rowspanCount[$Order_ID]++;
                    $orderTotal[$Order_ID] += $itemTotal;
                }
            }

            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                $Order_ID = $row['Order_ID'];
                $isFirstRow = ($Order_ID !== $prevOrderID);
                $formattedTime = date("h:i A", strtotime($row['Time']));
                $roomNumber = $row['Mode_of_Service'] === "Pickup" ? "---" : $row['Room_Num'];
                $rowClass = $orderGroups[$Order_ID];
                $itemWithAddOns = !empty($row['Add_Ons']) ? $row['Item_Name'] . " (" . $row['Add_Ons'] . ")" : $row['Item_Name'];
                $addonPrice = (!empty($row['Add_Ons']) && stripos($row['Add_Ons'], 'coffee') !== false) ? 10 :
                              ((!empty($row['Add_Ons']) && stripos($row['Add_Ons'], 'alcohol') !== false) ? 50 : 0);
                $itemTotal = ($row['Price'] + $addonPrice) * $row['Quantity'];

                echo "<tr class='{$rowClass}'>" .
                    ($isFirstRow ? "<td rowspan='{$rowspanCount[$Order_ID]}'>{$Order_ID}</td>
                                    <td rowspan='{$rowspanCount[$Order_ID]}'>{$row['Customer_Name']}</td>" : "") .
                    "<td>{$itemWithAddOns}</td>
                    <td>{$row['Quantity']}</td>
                    <td>" . number_format($row['Price'], 2) . "</td>
                    <td>" . number_format($addonPrice, 2) . "</td>
                    <td>" . number_format($itemTotal, 2) . "</td>" .
                    ($isFirstRow ? "<td rowspan='{$rowspanCount[$Order_ID]}'><b>" . number_format($orderTotal[$Order_ID], 2) . "</b></td>
                                    <td rowspan='{$rowspanCount[$Order_ID]}'>{$row['Contact']}</td>
                                    <td rowspan='{$rowspanCount[$Order_ID]}'>{$formattedTime}</td>
                                    <td rowspan='{$rowspanCount[$Order_ID]}'>{$roomNumber}</td>
                                    <td rowspan='{$rowspanCount[$Order_ID]}'>{$row['Mode_of_Service']}</td>
                                    <td rowspan='{$rowspanCount[$Order_ID]}'>{$row['Status']}</td>
                                    <td rowspan='{$rowspanCount[$Order_ID]}'>
                                        <form method='POST' style='display:flex; flex-direction:column; align-items:center; gap:5px;'>
                                            <input type='hidden' name='Order_ID' value='{$Order_ID}'>
                                            <button type='submit' name='status' value='confirmed' style='background:#177353; color:white; padding:10px; border:none; border-radius:5px;'>Confirm</button>
                                            <button type='submit' name='status' value='cancelled' style='background:#ac3830; color:white; padding:10px; border:none; border-radius:5px;'>Cancel</button>
                                        </form>
                                    </td>" : "") .
                    "</tr>";
                $prevOrderID = $Order_ID;
            }
        } else {
            echo "<tr><td colspan='14' align='center'>No orders found.</td></tr>";
        }

        echo "</table>";

          // Pagination Links
            echo "<div style='text-align: center; margin-top: 20px;'>";

            // First Button
            if ($page > 1) {
                echo "<a href='?page=1' style='padding: 8px 12px; background-color: #4CAF50; color: #fff; border-radius: 5px; text-decoration: none; margin-right: 5px;'>First</a>";
            } else {
                echo "<button disabled style='padding: 8px 12px; background-color: #ccc; color: #666; border-radius: 5px; margin-right: 5px;'>First</button>";
            }

            // Previous Button
            if ($page > 1) {
                echo "<a href='?page=" . ($page - 1) . "' style='padding: 8px 12px; background-color: #4CAF50; color: #fff; border-radius: 5px; text-decoration: none; margin-right: 5px;'>Previous</a>";
            } else {
                echo "<button disabled style='padding: 8px 12px; background-color: #ccc; color: #666; border-radius: 5px; margin-right: 5px;'>Previous</button>";
            }

            // Page Numbers
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    echo "<button style='padding: 8px 12px; background-color: #4CAF50; color: #fff; border-radius: 5px; margin: 0 3px;' disabled>$i</button>";
                } else {
                    echo "<a href='?page=$i' style='padding: 8px 12px; background-color: #4CAF50; color: #fff; border-radius: 5px; text-decoration: none; margin: 0 3px;'>$i</a>";
                }
            }

            // Next Button
            if ($page < $totalPages) {
                echo "<a href='?page=" . ($page + 1) . "' style='padding: 8px 12px; background-color: #4CAF50; color: #fff; border-radius: 5px; text-decoration: none; margin-left: 5px;'>Next</a>";
            } else {
                echo "<button disabled style='padding: 8px 12px; background-color: #ccc; color: #666; border-radius: 5px; margin-left: 5px;'>Next</button>";
            }

            // Last Button
            if ($page < $totalPages) {
                echo "<a href='?page=$totalPages' style='padding: 8px 12px; background-color: #4CAF50; color: #fff; border-radius: 5px; text-decoration: none; margin-left: 5px;'>Last</a>";
            } else {
                echo "<button disabled style='padding: 8px 12px; background-color: #ccc; color: #666; border-radius: 5px; margin-left: 5px;'>Last</button>";
            }

            echo "</div>";
        ?>
      </div>
    </section>
  </main>
  <script>
   function updateStatus(Order_ID, status) {
     const statusElement = document.getElementById(`status-${Order_ID}`);
     if (status === 'confirmed') {
       statusElement.innerHTML = '<span class="bg-green-500 text-white px-2 py-1 rounded-md">Confirmed</span>';
     } else if (status === 'cancelled') {
       statusElement.innerHTML = '<span class="bg-red-500 text-white px-2 py-1 rounded-md">Cancelled</span>';
     }
   }

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
  <script src="main.js"></script>
</body>
</html>
