<?php

include('php/_config.php');
include('php/_navbar.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding:0;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .ticket-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .ticket {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(50% - 30px);
            text-align: center;
            transition: transform 0.3s;
            margin: 15px;
        }

        .ticket:hover {
            transform: translateY(-5px);
        }

        .ticket h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .ticket p {
            margin-bottom: 5px;
            color: #666;
        }

        .ticket img {
            display: block;
            margin: 15px auto;
            width: 200px;
            height: 300px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .delete-btn {
            display: inline-block;
            background-color: #dc3545;
            color: #fff;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        @media (max-width: 768px) {
            .ticket-group {
                flex-direction: column;
                align-items: center;
            }

            .ticket {
                width: 100%; 
            }
        }
        #h{
            margin-top:10px;
        }
    </style>
</head>
<body>

<?php
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $sql = "SELECT tb.id, tb.qty, tb.booking_date, m.title, m.price, m.release_date, m.genre, mp.picture_url
            FROM `ticket_booking` tb
            JOIN `movies` m ON tb.movie_id = m.movie_id
            JOIN `movie_pictures` mp ON m.movie_id = mp.movie_id
            WHERE tb.user_id = ?
            ORDER BY tb.booking_date DESC";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<br>";
        echo "<h2>Your Tickets</h2>";
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $flex_class = ($counter % 2 == 0) ? 'flex-start' : 'flex-end';
            if ($counter % 2 == 0) {
                echo "<div class='ticket-group'>";
            }
            echo "<div class='ticket' style='align-self: $flex_class;'>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>Booking Date: " . $row['booking_date'] . "</p>";
            echo "<p>Release Date: " . $row['release_date'] . "</p>";
            echo "<p>Genre: " . $row['genre'] . "</p>";
            echo "<p>Seats: " . $row['qty'] . "</p>";
            echo "<p>Price: ₹" . ($row['price'] * $row['qty']) . "</p>";
            echo "<img class='image' src='" . $row['picture_url'] . "' alt='Movie Poster'>";

            // Check if the current date is at least one day before the booking date
            $current_date = date('Y-m-d');
            $one_day_before = date('Y-m-d', strtotime($row['booking_date'] . ' -1 day'));

            if ($current_date <= $one_day_before) {
                echo "<a href='delete_ticket.php?ticket_id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this ticket?\")'>Delete Ticket</a>";
            }
            echo "</div>";
            if ($counter % 2 != 0 || $counter == $result->num_rows - 1) {
                echo "</div>";
            }
            $counter++;
        }
    } else {
        echo "<p>No tickets booked yet.</p>";
    }
} else {
    echo "<p>Please log in to view your tickets.</p>";
}

?>

</body>
</html>
