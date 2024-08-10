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

// Fetch all records from games
$sql = "SELECT * FROM games WHERE user_id = $user_id";
$result = $conn->query($sql);

// Count the number of records for the logged-in user
$count_sql = "SELECT COUNT(*) as count FROM games WHERE user_id = ?";
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
    <title>Games</title>
    <?php
    include "../../header.php"
    ?>
</head>
<body>
    
<?php
include "../../nav_user.php"
?>

<section class="section">
    <div class="container">
        <div class="text-center mb-4">
            <h3>Games</h3>
        </div>

        <a href="Games_add.php" class="btn btn-success mb-3">Add New Games</a>
        <div class="alert alert-info text-center mb-4">
            <strong>Total Games:</strong> <?php echo $total_records; ?>
        </div>

        <!-- Filter Search and Entries Dropdown -->
        <div class="row d-flex justify-content-between mb-4">
            <div class="col-md-6">
                <input type="text" id="filter-search" class="form-control" placeholder="Search for Games by title or year...">
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

        <!-- Games Cards -->
        <div class="row d-flex justify-content-center" id="games-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-auto mb-3 games-card">
                        <div class="card shadow">
                            <div class="card-body d-flex justify-content-center img_games a">
                                <a>
                                    <img src="' . $row['img'] . '" alt="" class="" style="height: 210px;">
                                </a>
                            </div>
                            <div class="card-body text-center">
                                <p class="text-title fs-5">' . $row['name'] . '</p>
                                <p class="text-year fs-8">' . $row['year'] . '</p>
                                <a href="Games_edit.php?id=' . $row['id'] . '" class="btn btn-warning">Edit</a>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#gamesModal" 
                                    data-id="' . $row['id'] . '" 
                                    data-name="' . htmlspecialchars($row['name']) . '" 
                                    data-summary="' . htmlspecialchars($row['summary']) . '" 
                                    data-genre="' . htmlspecialchars($row['genre']) . '" 
                                    data-rating="' . htmlspecialchars($row['rating']) . '" 
                                    data-year="' . htmlspecialchars($row['year']) . '" 
                                     data-publisher="' . htmlspecialchars($row['publisher']) . '"
                                    data-device="' . htmlspecialchars($row['device']) . '"
                                    data-studio="' . htmlspecialchars($row['studio']) . '"
                                    data-img="' . htmlspecialchars($row['img']) . '">See</button>
                                <a href="games_delete.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>
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
<div class="modal fade" id="gamesModal" tabindex="-1" aria-labelledby="gamesModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gamesModalLabel">Games Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="gamesName"></span></p>
                <p><strong>Summary:</strong> <span id="gamesSummary"></span></p>
                <p><strong>Genre:</strong> <span id="gamesGenre"></span></p>
                <p><strong>Rating:</strong> <span id="gamesRating"></span></p>
                <p><strong>Year:</strong> <span id="gamesYear"></span></p>
                <p><strong>Publisher:</strong> <span id="gamesPublisher"></span></p>
                <p><strong>Device:</strong> <span id="gamesDevice"></span></p>
                <p><strong>Studio:</strong> <span id="gamesStudio"></span></p>
                <img id="gamesImage" src="" alt="Image" style="max-width: 250px; max-height: 300px;">
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

<script src="../JS/Games_tables.js"></script> 

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterInput = document.getElementById('filter-search');
        const entriesDropdown = document.getElementById('entries-dropdown');
        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');
        const gamesContainer = document.getElementById('games-container');
        const gamesCards = document.querySelectorAll('.games-card');
        let currentPage = 1;
        let entriesPerPage = parseInt(entriesDropdown.value);

        function filterGames() {
            const filterValue = filterInput.value.toLowerCase();
            return Array.from(gamesCards).filter(card => {
                const title = card.querySelector('.text-title').textContent.toLowerCase();
                const year = card.querySelector('.text-year').textContent.toLowerCase();
                return title.includes(filterValue) || year.includes(filterValue);
            });
        }

        function renderPage() {
            const filteredCards = filterGames();
            const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
            currentPage = Math.min(currentPage, totalPages || 1);

            gamesCards.forEach(card => card.style.display = 'none');
            
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
            const filteredCards = filterGames();
            const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderPage();
            }
        });

        renderPage();

        // Event listener for opening the modal
        $('#gamesModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var name = button.data('name');
            var summary = button.data('summary');
            var genre = button.data('genre');
            var rating = button.data('rating');
            var year = button.data('year');
            var publisher = button.data('publisher');
            var device = button.data('device');
            var studio = button.data('studio');
            var img = button.data('img');

            var modal = $(this);
            modal.find('#gamesName').text(name);
            modal.find('#gamesSummary').text(summary);
            modal.find('#gamesGenre').text(genre);
            modal.find('#gamesRating').text(rating);
            modal.find('#gamesYear').text(year);
            modal.find('#gamesPublisher').text(publisher);
            modal.find('#gamesDevice').text(device);
            modal.find('#gamesStudio').text(studio);
            modal.find('#gamesImage').attr('src', img);
        });
    });
</script>
</body>
</html>
