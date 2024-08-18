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
                <select id="entries-Alpahabetical" class="form-select">
                    <option value="ALL">ALL</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="G">G</option>
                    <option value="H">H</option>
                    <option value="I">I</option>
                    <option value="J">J</option>
                    <option value="K">K</option>
                    <option value="L">L</option>
                    <option value="M">M</option>
                    <option value="N">N</option>
                    <option value="O">O</option>
                    <option value="P">P</option>
                    <option value="Q">Q</option>
                    <option value="R">R</option>
                    <option value="S">S</option>
                    <option value="T">T</option>
                    <option value="U">U</option>
                    <option value="V">V</option>
                    <option value="W">W</option>
                    <option value="X">X</option>
                    <option value="Y">Y</option>
                    <option value="Z">Z</option>
                </select>
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

              <!-- Cartoon Movies Cards -->
              <div class="row d-flex justify-content-center" id="cartoon-movies-container">
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
        echo '<div class="col cartoon-movies-card">
            <div class="card h-100 shadow">
                <div class="card-img-top d-flex justify-content-center align-items-center" style="height: 250px;">
                    <img src="' . htmlspecialchars($row['img']) . '" alt="" class="img-fluid movie-poster" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-title" title="' . htmlspecialchars($row['name']) . '">' . truncateTitle($row['name']) . '</h5>
                    <p class="card-text text-year">' . htmlspecialchars($row['year']) . '</p>
                    <div class="mt-auto d-flex justify-content-evenly">
                        <a href="Cartoon_Movies_edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#cartoonmoviesModal" 
                            data-id="' . $row['id'] . '" 
                            data-name="' . htmlspecialchars($row['name']) . '" 
                            data-summary="' . htmlspecialchars($row['summary']) . '" 
                            data-genre="' . htmlspecialchars($row['genre']) . '" 
                            data-rating="' . htmlspecialchars($row['rating']) . '" 
                            data-year="' . htmlspecialchars($row['year']) . '" 
                             data-img="' . htmlspecialchars($row['img']) . '"
                            data-cast="' . htmlspecialchars($row['cast']) . '" 
                           data-director="' . htmlspecialchars($row['director']) . '"
                            >See</button>
                        <a href="Cartoon_Movies_delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const alphabeticalDropdown = document.getElementById('entries-Alpahabetical');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const seriesContainer = document.getElementById('cartoon-movies-container');
    const seriesCards = document.querySelectorAll('.cartoon-movies-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);
    let filteredCards = Array.from(seriesCards);

    function filterMovies() {
        const filterValue = filterInput.value.toLowerCase();
        const alphabeticalValue = alphabeticalDropdown.value.toLowerCase();

        return Array.from(seriesCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            const matchesSearch = title.includes(filterValue) || year.includes(filterValue);
            const matchesAlphabetical = alphabeticalValue === 'all' || title.startsWith(alphabeticalValue);

            return matchesSearch && matchesAlphabetical;
        });
    }

    function renderPage() {
        filteredCards = filterMovies();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        currentPage = Math.min(currentPage, totalPages || 1);

        seriesCards.forEach(card => card.style.display = 'none');

        filteredCards.slice((currentPage - 1) * entriesPerPage, currentPage * entriesPerPage)
            .forEach(card => card.style.display = 'block');

        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages || totalPages === 0;
    }

    filterInput.addEventListener('input', function() {
        currentPage = 1;
        renderPage();
    });

    alphabeticalDropdown.addEventListener('change', function() {
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
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }
    });

    renderPage();

    // Modal functionality
    var cartoonmoviesModal = document.getElementById('cartoonmoviesModal');
    cartoonmoviesModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;

        var name = button.getAttribute('data-name');
        var summary = button.getAttribute('data-summary');
        var genre = button.getAttribute('data-genre');
        var director = button.getAttribute('data-director');
        var rating = button.getAttribute('data-rating');
        var year = button.getAttribute('data-year');
        var img = button.getAttribute('data-img');
        var cast = button.getAttribute('data-cast');

        var modalTitle = cartoonmoviesModal.querySelector('.modal-title');
        var modalBodyName = cartoonmoviesModal.querySelector('#cartoonmoviesName');
        var modalBodySummary = cartoonmoviesModal.querySelector('#cartoonmoviesSummary');
        var modalBodyGenre = cartoonmoviesModal.querySelector('#cartoonmoviesGenre');
        var modalBodyDirector = cartoonmoviesModal.querySelector('#cartoonmoviesDirector');
        var modalBodyRating = cartoonmoviesModal.querySelector('#cartoonmoviesRating');
        var modalBodyYear = cartoonmoviesModal.querySelector('#cartoonmoviesYear');
        var modalBodyImage = cartoonmoviesModal.querySelector('#cartoonmoviesImage');
        var modalBodyCast = cartoonmoviesModal.querySelector('#cartoonmoviesCast');

        modalTitle.textContent = 'Cartoon Movie Details: ' + name;
        modalBodyName.textContent = name;
        modalBodySummary.textContent = summary;
        modalBodyGenre.textContent = genre;
        modalBodyDirector.textContent = director;
        modalBodyRating.textContent = rating;
        modalBodyYear.textContent = year;
        modalBodyImage.src = img;
        modalBodyCast.textContent = cast;

        var castArray = cast.split(';');
        var carouselInner = cartoonmoviesModal.querySelector('#cartoonmoviesCastCarousel');
        carouselInner.innerHTML = '';
        castArray.forEach(function(castMember, index) {
            var [castName, castImg] = castMember.split('|');
            if (castName && castImg) {
                var div = document.createElement('div');
                div.className = index === 0 ? 'carousel-item active' : 'carousel-item';
                div.innerHTML = `
                    <div>
                        <p><strong>Name:</strong> ${castName}</p>
                        <img src="${castImg}" alt="Cast Image" style="max-width: 100px; border: 2px solid black; border-radius: 50px;">
                    </div>
                `;
                carouselInner.appendChild(div);
            }
        });
    });
});

    </script>

</body>

</html>

<?php $conn->close(); ?>