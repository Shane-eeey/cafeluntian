<?php
session_start();

$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'cafeluntiandata';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $connection = mysqli_connect($server, $user, $pass, $db);
} catch (Exception $ex) {
    echo 'Error: ' . $ex->getMessage();
    exit();
}

// Function to generate a unique Order_ID
function generateOrderID($connection) {
    $currentYearMonth = date("Ym");
    $query = "SELECT Order_ID FROM customer_order_tbl ORDER BY Order_ID DESC LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastID = $row['Order_ID'];
        $lastThreeDigits = (int)substr($lastID, -3);

        if (substr($lastID, 0, 6) == $currentYearMonth) {
            $newThreeDigits = str_pad($lastThreeDigits + 1, 3, "0", STR_PAD_LEFT);
        } else {
            $newThreeDigits = "001";
        }
    } else {
        $newThreeDigits = "001";
    }

    return $currentYearMonth . $newThreeDigits;
}

if (isset($_POST['confirmCheckout'])) {
    $Order_ID = generateOrderID($connection);
    $Customer_Name = mysqli_real_escape_string($connection, $_POST['Customer_Name']);
    $Contact = mysqli_real_escape_string($connection, $_POST['Contact']);
    $Email = mysqli_real_escape_string($connection, $_POST['Email']);
    $Room_Num = mysqli_real_escape_string($connection, $_POST['Room_Num']);
    $Mode_of_Service = mysqli_real_escape_string($connection, $_POST['Mode_of_Service']);
    $Time = mysqli_real_escape_string($connection, $_POST['Time']);

    // Handle Receipt Upload
    $receiptPath = null;
    if (isset($_FILES['Receipt']) && $_FILES['Receipt']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $fileType = mime_content_type($_FILES['Receipt']['tmp_name']);
        $fileSize = $_FILES['Receipt']['size'];
        
        if (!in_array($fileType, $allowedTypes)) {
            die("Error: Only JPG, PNG images are allowed.");
        }
        if ($fileSize > 5 * 1024 * 1024) {
            die("Error: File size exceeds 5MB.");
        }

        $newFileName = $Order_ID . "_" . basename($_FILES['Receipt']['name']);
        $receiptPath = $uploadDir . $newFileName;
        move_uploaded_file($_FILES['Receipt']['tmp_name'], $receiptPath);
    }

    // Insert into customer_order_tbl
    $insertOrder = "INSERT INTO customer_order_tbl (Order_ID, Customer_Name, Contact, Email, Room_Num, Mode_of_Service, Time, Receipt, Status)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $status = "pending";

    try {
        mysqli_begin_transaction($connection);

        $stmt = mysqli_prepare($connection, $insertOrder);
        mysqli_stmt_bind_param($stmt, "sssssssss", $Order_ID, $Customer_Name, $Contact, $Email, $Room_Num, $Mode_of_Service, $Time, $receiptPath, $status);
        $orderResult = mysqli_stmt_execute($stmt);

        if (!$orderResult) {
            throw new Exception('Insert Error in customer_order_tbl: ' . mysqli_error($connection));
        }

        // Validate cartData
        if (!isset($_POST['cartData']) || empty($_POST['cartData'])) {
            throw new Exception('Error: cartData is missing or empty.');
        }

        $cartData = $_POST['cartData'];
        $cartItems = json_decode($cartData, true);

        if ($cartItems === null) {
            throw new Exception('Error: cartData is not valid JSON.');
        }

        // Insert cart items into order_items_tbl
        $insertItem = "INSERT INTO order_items_tbl (Order_ID, Item_Name, Price, Quantity, Subtotal, Add_Ons, Add_Ons_Price, Status) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmtItem = mysqli_prepare($connection, $insertItem);

        foreach ($cartItems as $item) {
            if (!isset($item['name'], $item['price'], $item['quantity'])) {
                throw new Exception('Error: cart item has missing fields.');
            }
        
            $Item_Name = $item['name'];
            $Item_Price = floatval($item['price']);
            $Item_Quantity = intval($item['quantity']);
            $Subtotal = ($Item_Price + (isset($item['Add_Ons_Price']) ? floatval($item['Add_Ons_Price']) : 0.00)) * $Item_Quantity;
        
    
            $Add_Ons = isset($item['Add_Ons']) 
                        ? (is_array($item['Add_Ons']) 
                        ? implode(', ', $item['Add_Ons']) 
                        : $item['Add_Ons']) // If it's already a string, assign directly
                        : null;

            $Add_Ons_Price = isset($item['Add_Ons_Price']) 
                        ? floatval($item['Add_Ons_Price']) 
                        : 0.00;

        
            mysqli_stmt_bind_param($stmtItem, "ssdddsds", 
                $Order_ID, 
                $Item_Name, 
                $Item_Price, 
                $Item_Quantity, 
                $Subtotal, 
                $Add_Ons, 
                $Add_Ons_Price, 
                $status
            );
        
            $itemResult = mysqli_stmt_execute($stmtItem);
        
            if (!$itemResult) {
                echo 'SQL Error: ' . mysqli_error($connection);
            }            
        }
        

        mysqli_commit($connection);
        echo '<script>
            localStorage.removeItem("cart"); // Clear cart from localStorage
            sessionStorage.setItem("orderComplete", "true"); // Set flag to ensure cart clears on reload
            setTimeout(() => {
                window.location.assign("menu.php");
            }, 2100);
        </script>';

    } catch (Exception $ex) {
        mysqli_rollback($connection);
        echo 'Error: ' . $ex->getMessage();
    }
}
?>
    