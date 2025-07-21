<!DOCTYPE html>
<html>
<head>
    <title>Book Seats</title>
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
    // Fetch movie details
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_GET['error'])){
            echo "<p style='color:red;'>Error: You cannot book more than 60 seats for this movie on the selected date.</p>";
        }
    }
    ?>

    <main>
        <h1>Book Seats</h1>
        <!-- Form for getting seats and date -->
        <form action="booking_process.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="seats">Number of Seats:</label><br>
            <input type="number" id="seats" name="seats" min="1" max="60" required><br>
            <label for="date">Date:</label><br>
            <input type="date" id="date" name="date" 
                min="<?php  
                        // checking for date validation
                        $timestamp = time();
                        echo $currentDate = gmdate('Y-m-d', $timestamp); 
                    ?>" 
            required><br>
            <input type="submit" value="Submit">
        </form>
    </main>

    <footer>
        <p>2024 ApnaBooking.com | All rights reserved.</p>
    </footer>
    
</body>
</html>