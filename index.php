<?php
// session started here for user login
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
    <div class="main">
    <video autoplay muted loop id="bg-video">
                <source src="graphics/logvideo.mp4" type="video/mp4">
                Your browser does not support HTML5 video.  
            </video>    
        <div class="login1">

            <?php
            // to connect with database
            require_once("php/_config.php");

            if(isset($_POST['submit'])){
                // mysqli_real_escape_string is a PHP function helps to prevent SQL injection attacks.
                $Email = mysqli_real_escape_string($connect,$_POST['email']);
                $Password = mysqli_real_escape_string($connect,$_POST['password']);

                // sql query to fetch data from database
                $sql = "SELECT * FROM user WHERE Email='$Email' AND Password='$Password'";
                $result = mysqli_query($connect,$sql) or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    // session variables for storing user information during login
                    $_SESSION['email'] = $row['Email'];
                    $_SESSION['name'] = $row['Name'];
                    $_SESSION['id'] = $row['Id'];
                    $_SESSION['admin'] = $row['is_admin'];

                }else{
                    // if email or passwors is incorect than elert message displayed
                    echo "<div class='message'>
                        <p>Wrong Username or Password</p>
                        </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Go Back</button>";
         
                }
                // user is valid so user redirected to home.php
                if(isset($_SESSION['email'])){
                    header("Location: home.php");

                }
              }else{    
            ?>
            
            <!-- user login form -->
            <header>Login</header>
            <form action="" method="post">
                <div class="f1">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="f1">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="sub">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="sign">
                    Don't have an account? <a href="signup.php">Create New</a>
                </div>
            </form>
        </div>

        <?php } ?>
    </div>
    
</body>
</html>