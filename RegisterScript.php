<?php
session_start();

$server = 'localhost';
$user = 'root';
$pass ='';
$db = 'cafeluntiandata';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
	$conn = mysqli_connect($server, $user, $pass, $db);
}catch (Exception $ex)
{
	echo'Error';
}

// Function to generate Admin_ID
function generateAdminID($conn) {
    $currentYearMonth = date("Ym"); // Get current Year and Month (YYYYMM)

    // Get the latest Admin_ID from the database
    $query = "SELECT Admin_ID FROM admin_tbl ORDER BY Admin_ID DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastID = $row['Admin_ID'];

        // Extract the last three digits
        $lastThreeDigits = (int)substr($lastID, -3);

        // Check if the previous Admin_ID belongs to the current Year-Month
        if (substr($lastID, 0, 6) == $currentYearMonth) {
            $newThreeDigits = str_pad($lastThreeDigits + 1, 3, "0", STR_PAD_LEFT);
        } else {
            // Reset to 001 if it's a new month
            $newThreeDigits = "001";
        }
    } else {
        // No previous records, start with 001
        $newThreeDigits = "001";
    }

    return $currentYearMonth . $newThreeDigits;
}

// Handle Admin Registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $User_FName = trim($_POST["User_FName"]);
    $User_LName = trim($_POST["User_LName"]);
    $Contact_Num = trim($_POST["ContactNo"]);
    $Email = trim($_POST["Email"]);
    $Password = $_POST["Password"]; // Hash the password

    // Check if email already exists
    $check_query = "SELECT * FROM admin_tbl WHERE Email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo '<script>alert("Error: Email already exists!");</script>';
		print '<script>window.location.assign("register.php");</script>';
    } else {
        // Generate a unique Admin_ID
        $Admin_ID = generateAdminID($conn);

        // Insert new admin into the admin_tbl table
        $insert = "INSERT INTO admin_tbl (Admin_ID, User_FName, User_LName, Contact_Num, Email, Password, Account_Created)
                   VALUES('$Admin_ID', '$User_FName', '$User_LName', '$Contact_Num', '$Email', '$Password', NOW())";

        try {
            $insert_result = mysqli_query($conn, $insert);

            if ($insert_result) {
                if (mysqli_affected_rows($conn) > 0) {
                    print '<script>alert("Successfully Registered! Your Admin ID is: ' . $Admin_ID . '");</script>';
                    print '<script>window.location.assign("login.php");</script>';
                } else {
                    echo 'Data not inserted!';
                }
            }
        } catch (Exception $ex) {
            echo 'Error Insert: ' . $ex->getMessage();
        }
    }

    $stmt->close();
}

$conn->close();
?>