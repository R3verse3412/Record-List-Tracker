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
                <input type="text" id="filter-search" class="form-control" placeholder="Search for movies by title or year...">
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
          <div class="row d-flex justify-content-center" id="movies-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-auto mb-3 movie-card">
                        <div class="card shadow">
                            <div class="card-body d-flex justify-content-center img_anime_movies a">
                                <a>
                                    <img src="' . $row['img'] . '" alt="" class="" style="height: 210px;">
                                </a>
                            </div>
                            <div class="card-body text-center">
                                <p class="text-title fs-5">' . $row['name'] . '</p>
                                <p class="text-year fs-8">' . $row['year'] . '</p>
                                <a href="Anime_Movies_edit.php?id=' . $row['id'] . '" class="btn btn-warning">Edit</a>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#movieModal" 
                                    data-id="' . $row['id'] . '" 
                                    data-name="' . htmlspecialchars($row['name']) . '" 
                                    data-summary="' . htmlspecialchars($row['summary']) . '" 
                                    data-genre="' . htmlspecialchars($row['genre']) . '" 
                                    data-rating="' . htmlspecialchars($row['rating']) . '" 
                                    data-year="' . htmlspecialchars($row['year']) . '" 
                                    data-duration="' . htmlspecialchars($row['duration']) . '"
                                    data-studio="' . htmlspecialchars($row['studio']) . '"
                                    data-img="' . htmlspecialchars($row['img']) . '" >See</button>
                                <a href="Anime_Movies_delete.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>';
                }
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
<div class="modal fade" id="movieModal" tabindex="-1" aria-labelledby="movieModalLabel" aria-hidden="true" data-bs-backdrop="static">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const moviesContainer = document.getElementById('movies-container');
    const movieCards = document.querySelectorAll('.movie-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);

    function filterMovies() {
        const filterValue = filterInput.value.toLowerCase();
        return Array.from(movieCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            return title.includes(filterValue) || year.includes(filterValue);
        });
    }

    function renderPage() {
        const filteredCards = filterMovies();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        currentPage = Math.min(currentPage, totalPages || 1);

        movieCards.forEach(card => card.style.display = 'none');
        
        filteredCards.slice((currentPage - 1) * entriesPerPage, currentPage * entriesPerPage)
            .forEach(card => card.style.display = 'block');

        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages || totalPages === 0;
    }

    filterInput.addEventListener('input', function() {
        currentPage = 1;
        renderPage();
    });

    entriesDropdown.addEventListener('change', function() {
        entriesPerPage = parseInt(this.value);
        currentPage = 1;
        renderPage();
    });

    prevButton.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            renderPage();
        }
    });

    nextButton.addEventListener('click', function() {
        const filteredCards = filterMovies();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }
    });

    renderPage();

    // Modal functionality
    const movieModal = document.getElementById('movieModal');
    movieModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        
        const movieName = button.getAttribute('data-name');
        const movieSummary = button.getAttribute('data-summary');
        const movieGenre = button.getAttribute('data-genre');
        const movieRating = button.getAttribute('data-rating');
        const movieYear = button.getAttribute('data-year');
        const movieDuration = button.getAttribute('data-duration');
        const movieStudio = button.getAttribute('data-studio');
        const movieImage = button.getAttribute('data-img');

        const modalTitle = movieModal.querySelector('.modal-title');
        const modalBodyName = movieModal.querySelector('#movieName');
        const modalBodySummary = movieModal.querySelector('#movieSummary');
        const modalBodyGenre = movieModal.querySelector('#movieGenre');
        const modalBodyRating = movieModal.querySelector('#movieRating');
        const modalBodyYear = movieModal.querySelector('#movieYear');
        const modalBodyDuration = movieModal.querySelector('#movieDuration');
        const modalBodyStudio = movieModal.querySelector('#movieStudio');
        const modalBodyImage = movieModal.querySelector('#movieImage');

        modalTitle.textContent = 'Movie Details: ' + movieName;
        modalBodyName.textContent = movieName;
        modalBodySummary.textContent = movieSummary;
        modalBodyGenre.textContent = movieGenre;
        modalBodyRating.textContent = movieRating;
        modalBodyYear.textContent = movieYear;
        modalBodyDuration.textContent = movieDuration;
        modalBodyStudio.textContent = movieStudio;
        modalBodyImage.src = movieImage;
    });
});
</script>


</body>
</html>

<?php $conn->close(); ?>


