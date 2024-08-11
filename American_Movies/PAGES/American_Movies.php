<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch American movies for the logged-in user
$sql = "SELECT * FROM american_movies WHERE user_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();
if ($result === false) {
    die("Get result failed: " . $stmt->error);
}

// Count the number of records for the logged-in user
$count_sql = "SELECT COUNT(*) as count FROM american_movies WHERE user_id = ?";
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
$count_sql = "SELECT COUNT(*) as count FROM american_movies WHERE user_id = ?";
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
    <?php include "../../header.php" ?>
</head>

<body >
<?php include "../../nav_user.php" ?>

<section class="section">
    <div class="container">
        <h2 class="text-center mb-5 text-white">American Movies</h2>
        
        <div class="mb-4">
            <a href="American_Movies_add.php" class="btn btn-success mb-3">Add New American Movies</a>
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
                            <div class="card-body d-flex justify-content-center img_american_movies a">
                                <a>
                                    <img src="' . $row['img'] . '" alt="" class="" style="height: 210px;">
                                </a>
                            </div>
                            <div class="card-body text-center">
                                <p class="text-title fs-5">' . $row['name'] . '</p>
                                <p class="text-year fs-8">' . $row['year'] . '</p>
                                <a href="edit.php?id=' . $row['id'] . '" class="btn btn-warning">Edit</a>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#movieModal" 
                                    data-id="' . $row['id'] . '" 
                                    data-name="' . htmlspecialchars($row['name']) . '" 
                                    data-summary="' . htmlspecialchars($row['summary']) . '" 
                                    data-genre="' . htmlspecialchars($row['genre']) . '" 
                                    data-rating="' . htmlspecialchars($row['rating']) . '" 
                                    data-year="' . htmlspecialchars($row['year']) . '" 
                                    data-img="' . htmlspecialchars($row['img']) . '" 
                                    data-cast="' . htmlspecialchars($row['cast']) . '" 
                                    data-director="' . htmlspecialchars($row['director']) . '">See</button>
                                <a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>
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
                <p><strong>Director:</strong> <span id="movieDirector"></span></p>
                <p><strong>Cast</strong> <span id="movieCast"></span></p>
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner mb-5" id="movieCastCarousel">
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
                <p><strong>Rating:</strong> <span id="movieRating"></span></p>
                <p><strong>Year:</strong> <span id="movieYear"></span></p>
                <img id="movieImage" src="" alt="Image" style="max-width: 250px; max-height: 300px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include "../../Footer.php" ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
    var movieModal = document.getElementById('movieModal')
    movieModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        
        var movieName = button.getAttribute('data-name')
        var movieSummary = button.getAttribute('data-summary')
        var movieGenre = button.getAttribute('data-genre')
        var movieDirector = button.getAttribute('data-director')
        var movieCast = button.getAttribute('data-cast')
        var movieRating = button.getAttribute('data-rating')
        var movieYear = button.getAttribute('data-year')
        var movieImage = button.getAttribute('data-img')

        var modalTitle = movieModal.querySelector('.modal-title')
        var modalBodyName = movieModal.querySelector('#movieName')
        var modalBodySummary = movieModal.querySelector('#movieSummary')
        var modalBodyGenre = movieModal.querySelector('#movieGenre')
        var modalBodyDirector = movieModal.querySelector('#movieDirector')
        var modalBodyCast = movieModal.querySelector('#movieCast')
        var modalBodyRating = movieModal.querySelector('#movieRating')
        var modalBodyYear = movieModal.querySelector('#movieYear')
        var modalBodyImage = movieModal.querySelector('#movieImage')

        modalTitle.textContent = 'Movie Details: ' + movieName
        modalBodyName.textContent = movieName
        modalBodySummary.textContent = movieSummary
        modalBodyGenre.textContent = movieGenre
        modalBodyDirector.textContent = movieDirector
        modalBodyCast.textContent = movieCast
        modalBodyRating.textContent = movieRating
        modalBodyYear.textContent = movieYear
        modalBodyImage.src = movieImage

        var castString = button.getAttribute('data-cast');
var castMembers = castString.split('|');
var carouselInner = movieModal.querySelector('#movieCastCarousel');
carouselInner.innerHTML = '';
castMembers.forEach(function(member, index) {
    var [name, imgUrl] = member.split(',');
    var div = document.createElement('div');
    div.className = index === 0 ? 'carousel-item active' : 'carousel-item';
    div.innerHTML = `
        <h5>${name}</h5>
        <img src="${imgUrl}" alt="${name}" style="max-width: 200px; max-height: 200px;">
    `;
    carouselInner.appendChild(div);
});
    })
});
</script>

</body>
</html>

<?php
$stmt->close();
$count_stmt->close();
$conn->close();
?>