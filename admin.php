<?php
include('php/_config.php');
include('php/_navbar.php');

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_movie'])) {
        // Handle adding a new movie
        $title = mysqli_real_escape_string($connect, $_POST['title']);
        $genre = mysqli_real_escape_string($connect, $_POST['genre']);
        $release_date = $_POST['release_date'];
        $price = $_POST['price'];
        $duration = $_POST['duration'];
        $trailer_url = mysqli_real_escape_string($connect, $_POST['trailer_url']);
        $poster_url = mysqli_real_escape_string($connect, $_POST['poster_url']);

        $query = "INSERT INTO movies (title, genre, release_date, price, duration, trailer_url) VALUES ('$title', '$genre', '$release_date', '$price', '$duration', '$trailer_url')";
        mysqli_query($connect, $query);

        $movie_id = mysqli_insert_id($connect);
        $poster_query = "INSERT INTO movie_pictures (movie_id, picture_url) VALUES ('$movie_id', '$poster_url')";
        mysqli_query($connect, $poster_query);
    } elseif (isset($_POST['delete_movie'])) {
        // Handle deleting a movie
        $movie_id = $_POST['movie_id'];

        $query = "DELETE FROM movies WHERE movie_id='$movie_id'";
        mysqli_query($connect, $query);

        $poster_query = "DELETE FROM movie_pictures WHERE movie_id='$movie_id'";
        mysqli_query($connect, $poster_query);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Admin Panel</title>
    <style>
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
        <h1>Admin Panel</h1>

        <h2>Add Movie</h2>
        <form method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
            <div class="mb-3">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="date" class="form-control" id="release_date" name="release_date" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration (minutes)</label>
                <input type="number" class="form-control" id="duration" name="duration" required>
            </div>
            <div class="mb-3">
                <label for="trailer_url" class="form-label">Trailer URL</label>
                <input type="text" class="form-control" id="trailer_url" name="trailer_url" required>
            </div>
            <div class="mb-3">
                <label for="poster_url" class="form-label">Poster URL</label>
                <input type="text" class="form-control" id="poster_url" name="poster_url" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_movie">Add Movie</button>
        </form>

        <h2 class="mt-5">Update/Delete Movies</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Release Date</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Trailer URL</th>
                    <th>Poster URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT m.*, mp.picture_url FROM movies m LEFT JOIN movie_pictures mp ON m.movie_id = mp.movie_id";
                $result = mysqli_query($connect, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $movie_id = $row['movie_id'];
                    $title = $row['title'];
                    $genre = $row['genre'];
                    $release_date = $row['release_date'];
                    $price = $row['price'];
                    $duration = $row['duration'];
                    $trailer_url = $row['trailer_url'];
                    $poster_url = $row['picture_url'];

                    echo "<tr>";
                    echo "<td>$title</td>";
                    echo "<td>$genre</td>";
                    echo "<td>$release_date</td>";
                    echo "<td>$price</td>";
                    echo "<td>$duration</td>";
                    echo "<td>$trailer_url</td>";
                    echo "<td><img src='$poster_url' width='100'></td>";
                    echo "<td>
                        <button type='button' class='btn btn-primary edit-btn' data-bs-toggle='modal' data-bs-target='#editModal' data-bs-movie-id='$movie_id' data-bs-title='$title' data-bs-genre='$genre' data-bs-release-date='$release_date' data-bs-price='$price' data-bs-duration='$duration' data-bs-trailer-url='$trailer_url' data-bs-poster-url='$poster_url'>Edit</button>
                        <form method='post' class='d-inline'>
                            <input type='hidden' name='movie_id' value='$movie_id'>
                            <button type='submit' class='btn btn-danger' name='delete_movie'>Delete</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Edit Movie Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Movie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="update_movie.php">
                <div class="modal-body">
                    <input type="hidden" name="movie_id" id="editMovieId" value="">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editGenre" class="form-label">Genre</label>
                        <input type="text" class="form-control" id="editGenre" name="genre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editReleaseDate" class="form-label">Release Date</label>
                        <input type="date" class="form-control" id="editReleaseDate" name="release_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="editPrice" name="price" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDuration" class="form-label">Duration (minutes)</label>
                        <input type="number" class="form-control" id="editDuration" name="duration" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTrailerUrl" class="form-label">Trailer URL</label>
                        <input type="url" class="form-control" id="editTrailerUrl" name="trailer_url" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPosterUrl" class="form-label">Poster URL</label>
                        <input type="url" class="form-control" id="editPosterUrl" name="poster_url" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<footer>
        <p>2024 Movie Ticket Booking. All rights reserved.</p>
    </footer>
<script>
    const editModal = document.getElementById('editModal');
    const editMovieId = document.getElementById('editMovieId');
    const editTitle = document.getElementById('editTitle');
    const editGenre = document.getElementById('editGenre');
    const editReleaseDate = document.getElementById('editReleaseDate');
    const editPrice = document.getElementById('editPrice');
    const editDuration = document.getElementById('editDuration');
    const editTrailerUrl = document.getElementById('editTrailerUrl');
    const editPosterUrl = document.getElementById('editPosterUrl');

    editModal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        const movieId = button.getAttribute('data-bs-movie-id');
        const title = button.getAttribute('data-bs-title');
        const genre = button.getAttribute('data-bs-genre');
        const releaseDate = button.getAttribute('data-bs-release-date');
        const price = button.getAttribute('data-bs-price');
        const duration = button.getAttribute('data-bs-duration');
        const trailerUrl = button.getAttribute('data-bs-trailer-url');
        const posterUrl = button.getAttribute('data-bs-poster-url');

        editMovieId.value = movieId;
        editTitle.value = title;
        editGenre.value = genre;
        editReleaseDate.value = releaseDate;
        editPrice.value = price;
        editDuration.value = duration;
        editTrailerUrl.value = trailerUrl;
        editPosterUrl.value = posterUrl;
    });
</script>
</body>
</html>