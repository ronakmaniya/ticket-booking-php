<?php
// to connect with database
require_once("php/_config.php");

    // Function to clear the form after a delay
        echo "<script>function clearForm() { 
                setTimeout(function() {
                    document.getElementById('name').value = '';
                    document.getElementById('email').value = '';
                    document.getElementById('password').value = '';
                    document.querySelector('.message').style.display = 'none'; // Hide the message after clearing the form
                }, 2000);
            }</script>";


    if(isset($_POST['submit'])){
        // mysqli_real_escape_string is a PHP function helps to prevent SQL injection attacks.
        $Name = mysqli_real_escape_string($connect,$_POST['name']);
        $Email = mysqli_real_escape_string($connect,$_POST['email']);
        $Password = mysqli_real_escape_string($connect,$_POST['password']);
        
        // sql query to verify user already exist or not
        $sql = "SELECT Email FROM user WHERE Email='$Email'";
        $verify_query = mysqli_query($connect,$sql);

        if(mysqli_num_rows($verify_query) !=0 ){
            // if already exist than throw an error message
            echo "<div class='message'>
                <p>This email is used, Try another One Please!</p>
                </div>";

            // Clear the form after showing the error message
            echo  "<script>clearForm()</script>";

        } else {
            // if already not exist than allow user to signup and redirected user to home.php
            $insert_sql = "INSERT INTO user(Name,Email,Password) VALUES('$Name','$Email','$Password')";
            mysqli_query($connect,$insert_sql) or die("Error Occurred");

            // session started here for user login and session variables for storing user information during signup
            session_start();
            $_SESSION['email'] = $Email;
            $_SESSION['name'] = $Name;
            $_SESSION['id'] = mysqli_insert_id($connect);
            $_SESSION['admin']=0;
                        
            echo "<div class='message'>
                <p>Registration successfully! Redirecting to Home Page</p>
                </div>";

            echo "<script>function clearForm() { 
                    setTimeout(function() {
                        document.querySelector('.message').style.display = 'none'; // Hide the message after clearing the form
                        // Redirect to the desired location after 2 seconds
                        setTimeout(function() {
                            window.location.href = '\home.php';
                        }, 1000);
                    }, 1000);
                }</script>";

            echo  "<script>clearForm()</script>";     
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="main">
        <video autoplay muted loop id="bg-video">
            <source src="graphics/logvideo.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
        <div class="login1">

            <!-- user signup form -->
            <header>Sign Up</header>
            <form  action="" method="post">
                <div class="f1">
                    <label for="Fname">Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" required>
                </div>
                <div class="f1">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="f1">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="sub">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="sign">
                    Already have an account? <a href="index.php">Sign In</a>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
