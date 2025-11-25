<?php
    include('mycon.php');

    $countQuery = "
    SELECT 
        (SELECT COUNT(*) FROM table_reservation_tbl) AS total_reservations,
        (SELECT COUNT(*) FROM order_items_tbl) AS total_orders
";
$countResult = mysqli_query($connection, $countQuery);
$countData = mysqli_fetch_assoc($countResult);

$totalReservations = $countData['total_reservations'];
$totalOrders = $countData['total_orders'];

$confirmedOrdersQuery = "SELECT COUNT(*) AS confirmed_orders FROM order_items_tbl WHERE Status = 'confirmed'";
$confirmedOrdersResult = mysqli_query($connection, $confirmedOrdersQuery);
$confirmedOrdersData = mysqli_fetch_assoc($confirmedOrdersResult);
$totalConfirmedOrders = $confirmedOrdersData['confirmed_orders'];

// Count Pending Reservations
$pendingOrdersQuery = "SELECT COUNT(*) AS pending_orders FROM order_items_tbl WHERE Status = 'pending'";
$pendingOrdersResult = mysqli_query($connection, $pendingOrdersQuery);
$pendingOrdersData = mysqli_fetch_assoc($pendingOrdersResult);
$totalPendingOrders = $pendingOrdersData['pending_orders'];

// Count Pending Reservations
$cancelOrdersQuery = "SELECT COUNT(*) AS canceled_orders FROM order_items_tbl WHERE Status = 'cancelled'";
$cancelOrdersResult = mysqli_query($connection, $cancelOrdersQuery);
$cancelOrdersData = mysqli_fetch_assoc($cancelOrdersResult);
$totalCanceledOrders = $cancelOrdersData['canceled_orders'];

// Query to count unique customers
$countCustomersquery = "
        SELECT COUNT(*) AS total_customers FROM (
        SELECT Reservation_ID AS customer_id FROM table_reservation_tbl
        UNION
        SELECT Order_ID AS customer_id FROM order_items_tbl
    ) AS combined_customers
";
$countCustomers = mysqli_query($connection, $countCustomersquery);

if ($countCustomers) {
    $countCustomersData = mysqli_fetch_assoc($countCustomers);
    $totalCustomersCount = $countCustomersData['total_customers'];
} else {
    $totalCustomersCount = 0; // Fallback if query fails
}
?>