<?php
session_start();
include('mycon.php'); 

if (isset($_POST['log_user'])) {
    $Email = mysqli_real_escape_string($connection, $_POST['Email']);
    $Password = mysqli_real_escape_string($connection, $_POST['Password']);

        $query1 = mysqli_query($connection, "SELECT * FROM admin_tbl WHERE Email = '$Email'");
        $existing = mysqli_num_rows($query1);

        if ($existing > 0) {
            $row = mysqli_fetch_assoc($query1);
            $table_password = $row['Password'];

            if ($Password == $table_password) {
                // Set session variables
                $_SESSION['Admin_ID'] = $row['Admin_ID'];
                $_SESSION['User_FName'] = $row['User_FName'];
                $_SESSION['User_LName'] = $row['User_LName'];
                $_SESSION['Contact_Num'] = $row['Contact_Num'];
                $_SESSION['Email'] = $Email;
                echo '<script>window.location.assign("adminDashboard.php");</script>';
                } 
                exit;
            } else {
                echo '<script>alert("Incorrect Password! Please try again.");</script>';
                echo '<script>window.location.assign("login.php");</script>';
                exit;
            }
        } else {
            echo '<script>alert("User not found! Please try again.");</script>';
            echo '<script>window.location.assign("login.php");</script>';
            exit;
        }
?>
