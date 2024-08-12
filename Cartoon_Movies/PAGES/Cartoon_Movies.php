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

$sql = "SELECT * FROM cartoon_movies WHERE user_id = $user_id";
$result = $conn->query($sql);

// Count the number of records
$count_sql = "SELECT COUNT(*) as count FROM cartoon_movies WHERE user_id = ?";
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
$count_sql = "SELECT COUNT(*) as count FROM cartoon_movies WHERE user_id = ?";
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
    <title>PHP CRUD</title>
    <?php
    include "../../header.php"
    ?>
</head>

<body>
<?php include "../../nav_user.php"?>

<section class="section">
    <div class="container">
    <h2 class="text-center mb-5">Cartoon Movies</h2>
        <a href="Cartoon_Movies_add.php" class="btn btn-success mb-3">Add New Cartoon Movies</a>
        <div class="alert alert-info text-center mb-4">
            <strong>Total Cartoon Movies:</strong> <?php echo $total_records; ?>
        </div>

         <!-- Filter Search and Entries Dropdown -->
         <div class="row d-flex justify-content-between mb-4">
            <div class="col-md-6">
                <input type="text" id="filter-search" class="form-control" placeholder="Search for Cartoon Movies by title or year...">
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

              <!-- TV Series Cards -->
              <div class="row d-flex justify-content-center" id="cartoon-movies-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-auto mb-3 cartoon-movies-card">
                        <div class="card shadow">
                            <div class="card-body d-flex justify-content-center img_american_tv_series a">
                                <a>
                                    <img src="' . $row['img'] . '" alt="" class="" style="height: 210px;">
                                </a>
                            </div>
                            <div class="card-body text-center">
                                <p class="text-title fs-5">' . $row['name'] . '</p>
                                <p class="text-year fs-8">' . $row['year'] . '</p>
                                <a href="Cartoon_Movies_edit.php?id=' . $row['id'] . '" class="btn btn-warning">Edit</a>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cartoonmoviesModal" 
                                    data-id="' . $row['id'] . '" 
                                    data-name="' . htmlspecialchars($row['name']) . '" 
                                    data-summary="' . htmlspecialchars($row['summary']) . '" 
                                    data-genre="' . htmlspecialchars($row['genre']) . '" 
                                    data-rating="' . htmlspecialchars($row['rating']) . '" 
                                    data-year="' . htmlspecialchars($row['year']) . '" 
                                    data-img="' . htmlspecialchars($row['img']) . '" 
                                    data-cast="' . htmlspecialchars($row['cast']) . '" 
                                    data-director="' . htmlspecialchars($row['director']) . '">See</button>
                                <a href="Cartoon_Movies_delete.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>';
                }
            }
            ?>
        </div>
        
        <!-- Previous and Next buttons -->
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-md-auto mb-5">
                <button class="btn btn-primary" id="prev-button">Previous</button>
                <button class="btn btn-primary" id="next-button">Next</button>
            </div>
        </div>
    </div>
</section>



  <!-- Modal -->
<div class="modal fade" id="cartoonmoviesModal" tabindex="-1" aria-labelledby="cartoonmoviesModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="cartoonmoviesModalLabel">Cartoon Movie Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="cartoonmoviesName"></span></p>
                <p><strong>Summary:</strong> <span id="cartoonmoviesSummary"></span></p>
                <p><strong>Genre:</strong> <span id="cartoonmoviesGenre"></span></p>
                <p><strong>Director:</strong> <span id="cartoonmoviesDirector"></span></p>
                <p><strong>Cast</strong> <span id="cartoonmoviesCast"></span></p>
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner mb-5" id="cartoonmoviesCastCarousel">
                        <!-- Carousel items will be dynamically added here -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev" style="background-color: black;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="background-color: black;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <p><strong>Rating:</strong> <span id="cartoonmoviesRating"></span></p>
                <p><strong>Year:</strong> <span id="cartoonmoviesYear"></span></p>
                <img id="cartoonmoviesImage" src="" alt="Image" style="max-width: 250px; max-height: 300px;">
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


    <script src="../JS/Cartoon_Movies_tables.js"> </script> 

</body>

</html>

<?php $conn->close(); ?>