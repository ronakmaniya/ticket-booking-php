<?php
session_start();
include('php/_config.php');

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

// Check if the ticket_id is provided
if (!isset($_GET['ticket_id'])) {
    header("Location: ticket.php");
    exit();
}

$ticket_id = $_GET['ticket_id'];

// Retrieve the booking date of the ticket
$sql = "SELECT booking_date FROM ticket_booking WHERE id = ? AND user_id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ii", $ticket_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $booking_date = $row['booking_date'];
} else {
    // Invalid ticket or user
    header("Location: ticket.php");
    exit();
}

// Check if the current date is at least one day before the booking date
$current_date = date('Y-m-d');
$one_day_before = date('Y-m-d', strtotime($booking_date . ' -1 day'));

if ($current_date <= $one_day_before) {
    // Delete the ticket from the database
    $sql = "DELETE FROM ticket_booking WHERE id = ? AND user_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ii", $ticket_id, $user_id);
    $stmt->execute();

    // Redirect to ticket.php after successful deletion
    header("Location: ticket.php");
    exit();
} else {
    // Deletion not allowed within one day of the booking date
    header("Location: ticket.php");
    exit();
}
?>