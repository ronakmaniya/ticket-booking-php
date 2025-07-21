<!DOCTYPE html>
<html>
<head>
    <title>Booking Process</title>
    <link rel="stylesheet" href="css/stylebook.css">
    <style>
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    
    <?php
    include('php/_config.php');
    include('php/_navbar.php');

    $error = false;
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST['date'];
        $id = $_POST['id'];
        $seats = $_POST['seats'];

        // Convert date to 'YYYY-MM-DD' format
        $date = date('Y-m-d', strtotime($date));
        $user_id = $_SESSION['id'];

        // Check if the requested number of seats exceeds 60
        $sql = "SELECT SUM(qty) AS total_seats FROM ticket_booking WHERE movie_id = ? AND booking_date = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("is", $id, $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $total_seats_booked = $row['total_seats'] ?? 0;

        if (($total_seats_booked + $seats) > 60) {
            $error = true;
            header('location:booking.php?id=' . $id . '&error=' . $error);
            exit();
        }

        // Insert data into database
        $sql = "INSERT INTO `ticket_booking` (qty, booking_date, user_id, movie_id) VALUES (?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("isii", $seats, $date, $user_id, $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Fetch user details
            $user_sql = "SELECT Name, Email FROM `user` WHERE Id = ?";
            $user_stmt = $connect->prepare($user_sql);
            $user_stmt->bind_param("i", $user_id);
            $user_stmt->execute();
            $user_result = $user_stmt->get_result();
            $user_data = $user_result->fetch_assoc();

            // Fetch movie details
            $movie_sql = "SELECT m.title, m.price, m.release_date, m.genre, mp.picture_url FROM `movies` m JOIN `movie_pictures` mp ON m.movie_id = mp.movie_id WHERE m.movie_id = ? LIMIT 1";
            $movie_stmt = $connect->prepare($movie_sql);
            $movie_stmt->bind_param("i", $id);
            $movie_stmt->execute();
            $movie_result = $movie_stmt->get_result();
            $movie_data = $movie_result->fetch_assoc();
    ?>

    <main>
        <div class="ticket-details">
            <h2>Ticket Details</h2>
            <p>Name: <?php echo $user_data['Name']; ?></p>
            <p>Email: <?php echo $user_data['Email']; ?></p>
            <p>Movie: <?php echo $movie_data['title']; ?></p>
            <p>Release Date: <?php echo $movie_data['release_date']; ?></p>
            <p>Genre: <?php echo $movie_data['genre']; ?></p>
            <p>Price: <?php echo ($movie_data['price'] * $seats) . "₹"; ?></p>
            <p>Booking Date: <?php echo $date; ?></p>
            <p>Seats: <?php echo $seats; ?></p>
            <img src="<?php echo $movie_data['picture_url']; ?>" alt="Movie Poster" width="200">
        </div>
    </main>

    <?php
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "No data submitted.";
    }
    ?>

    <footer>
        <p>2024 ApnaBooking.com | All rights reserved.</p>
    </footer>

</body>
</html>