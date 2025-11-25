<?php  
session_start();

$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'cafeluntiandata';

// Improved error reporting for better debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $connection = mysqli_connect($server, $user, $pass, $db);
} catch (Exception $ex) {
    die('Database Connection Error: ' . $ex->getMessage());
}

// Reservation ID Generator
function generateReservationID($prefix = 'RES') {
    $yearMonth = date('Ym'); // Current year and month
    $randomString = strtoupper(substr(bin2hex(random_bytes(3)), 0, 5)); // More secure random string
    return "{$prefix}-{$yearMonth}-{$randomString}";
}

// Handle Reservation Submission
if (isset($_POST['Reservation'])) {
    // Ensure all required fields are set
    $requiredFields = ['Full_Name', 'Date', 'Time', 'Email', 'Pax'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo '<script>alert("Please fill in all fields.");</script>';
            exit();
        }
    }

    // Sanitize inputs
    $Full_Name = mysqli_real_escape_string($connection, $_POST['Full_Name']);
    $Date = mysqli_real_escape_string($connection, $_POST['Date']);
    $Time = mysqli_real_escape_string($connection, $_POST['Time']);
    $Email = mysqli_real_escape_string($connection, $_POST['Email']);
    $Pax = mysqli_real_escape_string($connection, $_POST['Pax']);

    // Generate unique Reservation ID (retry if ID collision occurs)
    do {
        $Reservation_ID = generateReservationID();
        $checkID = mysqli_query($connection, "SELECT Reservation_ID FROM table_reservation_tbl WHERE Reservation_ID = '$Reservation_ID'");
    } while (mysqli_num_rows($checkID) > 0);

    // Insert data into the table
    $insert = "INSERT INTO table_reservation_tbl 
                (Reservation_ID, Full_Name, Reservation_Date, Reservation_Time, Email, Pax, Reservation_Created, Status)
                VALUES (?, ?, ?, ?, ?, ?, NOW(), 'pending')";

    // Use prepared statements for better security
    $stmt = mysqli_prepare($connection, $insert);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $Reservation_ID, $Full_Name, $Date, $Time, $Email, $Pax);

        try {
            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Successfully Reserved!");</script>';
                echo '<script>window.location.assign("reservation.php");</script>';
            } else {
                throw new Exception('Failed to insert reservation data.');
            }
        } catch (Exception $ex) {
            echo 'Error: ' . $ex->getMessage();
        }

        mysqli_stmt_close($stmt);
    } else {
        echo 'Error preparing statement: ' . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>
