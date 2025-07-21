<?php
include('php/_config.php');
include('php/_navbar.php');

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$movie_id = $_GET['id'];

// Fetch movie details from the database
$sql = "SELECT * FROM movies WHERE movie_id = $movie_id";
$result = mysqli_query($connect,$sql);

if ($result === false) {
    echo "Error executing query: " . mysqli_error($connect);
} else {
    if (mysqli_num_rows($result) > 0) {
        $movie = mysqli_fetch_assoc($result);

        // Fetch movie poster from the database
        $sql_pictures = "SELECT picture_url FROM movie_pictures WHERE movie_id = $movie_id ";
        $result_pictures = mysqli_query($connect,$sql_pictures);

        if ($result_pictures === false) {
            echo "Error executing query: " . mysqli_error($connect);
        } else {
            $poster_url = array();
            while ($picture = mysqli_fetch_assoc($result_pictures)) {
                $poster_url[] = $picture['picture_url'];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }
        body,html{
            width: 100%;
            height: 100%;
        }
        .main{
            width: 100%;
            height: 100%;
        
            padding: 20px;
            
        }
        .bgphoto{
            justify-content: space-between;
            display: flex;
            position: relative; 
            padding: 10px;
            width: 100%;
            height: 80%;
            background-color: black;
            background-size: cover;
            border-radius: 10px ;
        }
        .photo{
            position: absolute;
            left: 8%;
            top: 20px;
            width: 300px;
            height: 450px;
            /* displaying movie poster here */
            background-image:  url('<?php echo $poster_url[0]; ?>');
            background-size: cover;
            border-radius: 10px;
            border: 5px solid black;
        }
        .content{
            position: absolute;
            width: 50%;
            height: auto;
            left: 35%;
            top:40px;
        }
        .rate{
            display: flex;
            position: relative;
            gap: 15px;
            width: 420px;
            height: 60px;
            background-color: rgba(245, 245, 220, 0.486);
            font-size: 30px;
            border-radius: 5px;
            border:2px solid black;
            padding: 10px;
            margin-bottom: 10px;
        }
        h1{
            color:white;
            font-size: 50px;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-weight: 400;
            margin-bottom: 10PX;
        }
        .rate1{
            color:rgba(255, 0, 0, 0.63);
        }
        .rate2{
            margin-top: 3px;
            color:white;
            font-size: 25px;
        }
        .rate2 button{
            position: absolute;
            margin-left: 10px;
            margin-top:-5px;
            padding: 7.5px;
            width: auto;
            height: auto;
            text-align: center;
            color: black;
            background-color: rgb(206, 221, 234);
            border-radius: 5px;
            font-size: 15px;
        }
        a{
            text-decoration: none;
        }
        #p2,#p3{
            color:white;
            font-size: 30px;
            margin-bottom: 10px;
            margin-left: 5px;
        }
        #b2{
            color:white;
            background-color:darkred;
            padding: 12px;
            text-align: center;
            width: auto;
            font-size: 25px;
            border-radius: 10px;
            border:2px solid whitesmoke;    
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="bgphoto">
            <div class="photo"></div>
            <div class="content">
                <h1><?php echo  $movie['title']; ?></h1>
                <div class="rate">
                    <div class="rate1"><i class="ri-star-half-fill"></i></div>
                    <div class="rate2">
                        <p id="p1">8.8/10 (71.8K Votes) > <button ><a href="<?php echo $movie['trailer_url']; ?>" target="_blank">Watch Trailer</a></button></p>
                    </div>
                </div>
                <p id="p2"> <?php echo  $movie['genre']; ?></p>
                <p id="p3"> Release Date : <?php echo  $movie['release_date']; ?> 
                <p id="p2">Price : <?php echo $movie['price']."₹";?></p>
             <p id="p3"> Time Duration : <?php echo  $movie['duration']; ?> Minutes </p>
                <button id="b2"><a href="booking.php?id=<?php echo $movie['movie_id']; ?>">Book Now</a></button>
            </div>
        </div>
        <div class="about"></div>
    </div>

    <footer>
        <p>2024 ApnaBooking.com | All rights reserved.</p>
    </footer>

</body>
</html>