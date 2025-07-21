<?php
include('php/_config.php');
include('php/_navbar.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .movie-item {
            margin-bottom: 20px;
            text-decoration: none;
            color: inherit;
        }
        .movie-item:hover {
            text-decoration: none;
            color: inherit;
        }
        .movie-poster {
            width: 100%;
            height: 380px;
            width: 250px;
            object-fit: cover;
            border-radius: 5px 5px 0 0;
        }
        .movie-title {
            font-size: 1.2rem
            margin-top: 10px;
        }
        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <div class="row">
            <?php
            // Fetch movies from the database
            $query = "SELECT movies.*, movie_pictures.picture_url
                      FROM movies
                      LEFT JOIN movie_pictures ON movies.movie_id = movie_pictures.movie_id";
            $result = mysqli_query($connect, $query);

            // Check if any movies are found
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $movieId = $row['movie_id'];
                    $title = $row['title'];
                    $posterUrl = $row['picture_url'];

                    // Display each movie as a thumbnail with title and picture
                    echo '<div class="col-md-3 col-sm-6">';
                    echo '<a href="movie_details.php?id=' . $movieId . '" class="movie-item">';
                    echo '<img class="movie-poster" src="' . $posterUrl . '" alt="' . $title . '">';
                    echo '<h3 class="movie-title">' .$title. '</h3>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>No movies found.</p>";
            }
            ?>
        </div>
    </div>

    <footer>
        <p>2024 ApnaBooking.com | All rights reserved.</p>
    </footer>

</body>
</html>