<?php
session_start();
// if session not set then user is redirected to index.php for login
if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css">
    <style>
        .navbar {
            background-color: #141414;
            color: #f2f2f2;
            font-size: 24px;
        }
        .navbar-brand {
            color: #fff;
        }
        .nav-link {
            color: rgba(255, 255, 255, 1) !important;
        }
        .nav-link:hover {
            color: #ff6f00;
        }
        .welcome {
            color: #ff6f00;
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- logo of website visible here -->
            <a class="navbar-brand" href="home.php">
                <img src="graphics/indian.png" alt="Logo" width="50px" height="50px"> 
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">Home</a>
                    </li>
                    <!-- if login as admin than Movies panel is visibled for admin -->
                    <?php
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                        echo '<li class="nav-item"><a class="nav-link" href="admin.php">Movies</a></li>';    
                    }
                    ?>
                    <!-- if login as admin than Tickets and About panels are visibled for user -->
                    <?php
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0){                        
                        echo '<li class="nav-item"><a class="nav-link" href="ticket.php">Tickets</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="about.php">About</a></li>';
                    }
                    ?>
                    <!-- logout button for user to logged out -->
                    <li class="nav-item">
                        <a class="nav-link" href="php/logout.php">Log Out</a>
                    </li>
                </ul>
                <!-- name of user displayed here -->
                <div class="d-flex">
                    <?php
                    if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
                        echo '<p class="me-3 welcome">Welcome, ' . $_SESSION['name'] . '</p>';
                    }
                    ?>
                </div>
            </div>

        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>