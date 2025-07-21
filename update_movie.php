<?php
include('php/_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = $_POST['movie_id'];
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $genre = mysqli_real_escape_string($connect, $_POST['genre']);
    $release_date = $_POST['release_date'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $trailer_url = mysqli_real_escape_string($connect, $_POST['trailer_url']);
    $poster_url = mysqli_real_escape_string($connect, $_POST['poster_url']);

    $update_query = "UPDATE movies SET title='$title', genre='$genre', release_date='$release_date', price='$price', duration='$duration', trailer_url='$trailer_url' WHERE movie_id='$movie_id'";
    mysqli_query($connect, $update_query);

    $update_picture_query = "UPDATE movie_pictures SET picture_url='$poster_url' WHERE movie_id='$movie_id'";
    mysqli_query($connect, $update_picture_query);

    header("Location: admin.php?success=Movie updated successfully");
    exit();
}