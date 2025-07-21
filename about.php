<?php
    include("php/_config.php");
    include("php/_navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Movie Ticket Booking</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        /* Header and Navigation */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }
        /* Main Content */
        main {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        section {
            margin-bottom: 40px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }

        section:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1, h2 {
            color: #ff6600;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        /* Animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        section {
            opacity: 0;
            animation: fadeIn 1s ease-in-out forwards;
        }

        section:nth-child(1) {
            animation-delay: 0s;
        }

        section:nth-child(2) {
            animation-delay: 0.2s;
        }

        section:nth-child(3) {
            animation-delay: 0.4s;
        }

        section:nth-child(4) {
            animation-delay: 0.6s;
        }

        section:nth-child(5) {
            animation-delay: 0.8s;
        }
    </style>
</head>

<body>

    <main>
        <section>
            <h1>About Us</h1>
            <p>Welcome to Movie Ticket Booking, your ultimate destination for convenient and hassle-free movie ticket reservations. We are a team of passionate movie enthusiasts dedicated to providing you with the best online movie booking experience.</p>
        </section>

        <section>
            <h2>Our Mission</h2>
            <p>Our mission is to make your movie-going experience as seamless and enjoyable as possible. We strive to offer a user-friendly platform where you can explore the latest movie releases, check showtimes, and book your tickets with just a few clicks.</p>
        </section>

        <section>
            <h2>Our Team</h2>
            <p>Behind the scenes of Movie Ticket Booking is a talented and dedicated team of professionals who work tirelessly to ensure that every aspect of our service meets the highest standards. From our skilled developers to our friendly customer support staff, we are committed to delivering an exceptional experience for our valued customers.</p>
        </section>

        <section>
            <h2>Our Partners</h2>
            <p>We have partnered with leading cinema chains and movie theaters across the country to bring you a wide variety of movie options and convenient showtimes. Our partnerships allow us to offer you the best deals and exclusive promotions, ensuring that you get the most value for your money.</p>
        </section>

        <section>
            <h2>Get in Touch</h2>
            <p>If you have any questions, suggestions, or feedback, please don't hesitate to reach out to us. We value our customers and are always eager to hear from you.</p>
        </section>
    </main>

    <footer>
        <p>2024 ApnaBooking.com | All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>