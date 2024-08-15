<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_db";
$user_id = $_SESSION['user_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all records from anime_series
$sql = "SELECT * FROM anime_movies WHERE user_id = $user_id";
$result = $conn->query($sql);

// Count the number of records
$count_sql = "SELECT COUNT(*) as count FROM anime_movies WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
if (!$count_stmt) {
    die("Prepare failed: " . $conn->error);
}

$count_stmt->bind_param("i", $user_id);
if (!$count_stmt->execute()) {
    die("Execute failed: " . $count_stmt->error);
}

$count_result = $count_stmt->get_result();
if ($count_result === false) {
    die("Get result failed: " . $count_stmt->error);
}

$row_count = $count_result->fetch_assoc();
$total_records = $row_count['count'];


// Count the number of records for the logged-in user
$count_sql = "SELECT COUNT(*) as count FROM anime_movies WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_records = $row_count['count'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Series</title>
    <?php include "../../header.php"?>
</head>
<style>
    .card {
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .movie-poster {
        transition: transform 0.3s ease-in-out;
    }

    .card:hover .movie-poster {
        transform: scale(1.05);
    }

    .text-title {
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 1rem;
    }

    .text-year {
        text-align: center;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>

<body>

    <?php include "../../nav_user.php"?>

    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">Anime Movies</h2>

            <div class="mb-4">
                <a href="Anime_Movies_add.php" class="btn btn-success mb-3">Add New Anime Movies</a>
                <div class="alert alert-info text-center">
                    <strong>Total Movies:</strong> <?php echo $total_records; ?>
                </div>
            </div>

            <!-- Filter Search and Entries Dropdown -->
            <div class="row d-flex justify-content-between mb-4">
                <div class="col-md-6">
                    <input type="text" id="filter-search" class="form-control"
                        placeholder="Search for movies by title or year...">
                </div>
                <div class="col-md-2">
                    <select id="entries-dropdown" class="form-select">
                        <option value="4">4 entries</option>
                        <option value="8">8 entries</option>
                        <option value="12">12 entries</option>
                        <option value="16">16 entries</option>
                    </select>
                </div>
            </div>

            <!-- Movie Cards -->
            <div class="row d-flex justify-content-center" id="anime-movies-container">
                <?php
            // ... (previous code remains the same)

            function truncateTitle($title, $limit = 25) {
                if (strlen($title) > $limit) {
                    return substr($title, 0, $limit) . '...';
                }
                return $title;
            }
            // Inside the loop where we generate the cards:
if ($result->num_rows > 0) {
    echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col anime-movie-card">
            <div class="card h-100 shadow">
                <div class="card-img-top d-flex justify-content-center align-items-center" style="height: 250px;">
                    <img src="' . htmlspecialchars($row['img']) . '" alt="" class="img-fluid movie-poster" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-title" title="' . htmlspecialchars($row['name']) . '">' . truncateTitle($row['name']) . '</h5>
                    <p class="card-text text-year">' . htmlspecialchars($row['year']) . '</p>
                    <div class="mt-auto d-flex justify-content-evenly">
                        <a href="Anime_Movies_edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#movieModal" 
                            data-id="' . $row['id'] . '" 
                            data-name="' . htmlspecialchars($row['name']) . '" 
                            data-summary="' . htmlspecialchars($row['summary']) . '" 
                            data-genre="' . htmlspecialchars($row['genre']) . '" 
                            data-rating="' . htmlspecialchars($row['rating']) . '" 
                            data-year="' . htmlspecialchars($row['year']) . '" 
                            data-duration="' . htmlspecialchars($row['duration']) . '"
                            data-studio="' . htmlspecialchars($row['studio']) . '"
                            data-img="' . htmlspecialchars($row['img']) . '" >See</button>
                        <a href="Anime_Movies_delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </div>
            </div>
        </div>';
    }
    echo '</div>';
}
?>

            </div>

            <!-- Previous and Next buttons -->
            <div class="row  d-flex justify-content-center mt-4">
                <div class="col-md-auto mb-5">
                    <button class="btn btn-primary" id="prev-button">Previous</button>
                    <button class="btn btn-primary" id="next-button">Next</button>
                </div>
            </div>
        </div>

        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="movieModal" tabindex="-1" aria-labelledby="movieModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-lg text-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="movieModalLabel">Movie Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="movieName"></span></p>
                    <p><strong>Summary:</strong> <span id="movieSummary"></span></p>
                    <p><strong>Genre:</strong> <span id="movieGenre"></span></p>
                    <p><strong>Rating:</strong> <span id="movieRating"></span></p>
                    <p><strong>Year:</strong> <span id="movieYear"></span></p>
                    <p><strong>Duration:</strong> <span id="movieDuration"></span></p>
                    <p><strong>Studio:</strong> <span id="movieStudio"></span></p>
                    <img id="movieImage" src="" alt="Image" style="max-width: 250px; max-height: 300px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <?php
    include "../../Footer.php"
?>

    <script src="../JS/Anime_Movies_tables.js"></script>


</body>

</html>

<?php $conn->close(); ?>