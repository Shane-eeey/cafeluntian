<?php
  session_start();
  include('mycon.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reservation | Cafe Luntian</title>
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
            <h1>Reservation List</h1>
        </header>

        <section class="search">
            <a href="#" class="search-icon"><i class="fas fa-search"></i></a>
            <input type="text" id="searchInput" placeholder="Search Name or ID here" >   
        </section>

        <section class="search-result">
            <h1>Search Results</h1><hr>
            <div class="box-container" id="reservationList">
                <!-- PHP START HERE -->
                <?php
                    include('mycon.php');
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'], $_POST['status'])) {
                      $reservationId = $_POST['reservation_id'];
                      $status = $_POST['status'];
                      $updateSql = "UPDATE table_reservation_tbl SET Status='$status' WHERE Reservation_ID='$reservationId'";
                      $connection->query($updateSql);
                  }
                    $sql = "SELECT * FROM table_reservation_tbl ORDER BY Reservation_ID DESC";
                    $result = $connection->query($sql);

                    echo "<table id='userTable' border='1' width='100%'>";
                    echo "<tr align='center' class='tblheader'>
                            <td><b>Reservation ID</b></td>
                            <td><b>Full Name</b></td>
                            <td><b>Reservation Date</b></td>
                            <td><b>Reservation Time</b></td>
                            <td><b>Email</b></td>
                            <td><b>Number of Guests</b></td>
                            <td><b>Reservation Created</b></td>
                            <td><b>Status</b></td>
                            <td><b>Actions</b></td>
                          </tr>";

                    if ($result->num_rows > 0) {
                        $prevReservationID = null;
                        $rowspanCount = [];
                        $reservationGroups = [];
                        $groupIndex = 0;

                        while ($row = $result->fetch_assoc()) {
                            if (!isset($rowspanCount[$row['Reservation_ID']])) {
                                $rowspanCount[$row['Reservation_ID']] = 1;
                                $reservationGroups[$row['Reservation_ID']] = $groupIndex % 2 == 0 ? "group-even" : "group-odd";
                                $groupIndex++;
                            } else {
                                $rowspanCount[$row['Reservation_ID']]++;
                            }
                        }

                        $result->data_seek(0);
                        $reservationRowspan = [];

                        while ($row = $result->fetch_assoc()) {
                            $Reservation_ID = $row['Reservation_ID'];
                            $isFirstRow = ($Reservation_ID != $prevReservationID);
                            $formattedTime = date("h:i A", strtotime($row['Reservation_Time']));
                            $formattedCreated = date("Y-m-d h:i A", strtotime($row['Reservation_Created']));
                            $rowClass = $reservationGroups[$Reservation_ID];

                            echo '<tr class="' . $rowClass . '">';

                            if ($isFirstRow) {
                                $reservationRowspan[$Reservation_ID] = $rowspanCount[$Reservation_ID];

                                echo '<td rowspan="' . $reservationRowspan[$Reservation_ID] . '" class="user-id">' . $row['Reservation_ID'] . '</td>';
                                echo '<td rowspan="' . $reservationRowspan[$Reservation_ID] . '" class="user-name">' . $row['Full_Name'] . '</td>';
                            }

                            echo '<td>' . $row['Reservation_Date'] . '</td>';
                            echo '<td>' . $formattedTime . '</td>';
                            echo '<td>' . $row['Email'] . '</td>';
                            echo '<td>' . $row['Pax'] . '</td>';
                            echo '<td>' . $formattedCreated . '</td>';
                            echo '<td>' . $row['Status'] . '</td>';
                            

                            if ($isFirstRow) {
                                echo '<td rowspan="' . $reservationRowspan[$Reservation_ID] . '">
                                  <form method="POST" style="display: flex; flex-direction: column; gap: 5px; align-items: center;">
                                        <input type="hidden" name="reservation_id" value="' . $Reservation_ID . '">
                                        <button type="submit" name="status" value="confirmed" style="background-color:#177353; color: white; border: none; padding: 10px 10px; cursor: pointer; border-radius: 5px; width: 80px;">Confirm</button>
                                        <button type="submit" name="status" value="cancelled" style="background-color:#ac3830; color: white; border: none; padding: 10px 10px; cursor: pointer; border-radius: 5px; width: 80px;">Cancel</button>
                                  </form>
                              </td>';
                            }

                            echo '</tr>';
                            $prevReservationID = $Reservation_ID;
                        }
                    } else {
                        echo "<tr><td colspan='9' align='center'>No reservations found.</td></tr>";
                    }

                    echo "</table>";
                    ?>
            </div>
        </section>
    </main>

    <script src="main.js"></script>
    <script>
      function updateStatus(reservationId, status) {
        const statusElement = document.getElementById(`status-${reservationId}`);
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
</body>
</html>
