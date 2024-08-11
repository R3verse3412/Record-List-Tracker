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

// Fetch all records from manhwa
$sql = "SELECT * FROM manhwa WHERE user_id = $user_id";
$result = $conn->query($sql);

// Count the number of records
$count_sql = "SELECT COUNT(*) as count FROM manhwa WHERE user_id = ?";
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
$count_sql = "SELECT COUNT(*) as count FROM manhwa WHERE user_id = ?";
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
    <title>Manhwa List</title>
    <?php
include "../../header.php"
?>
</head>
<body>
    
<?php include "../../nav_user.php"?>

<section class="section">
<div class="container">
    <div class="text-center mb-4">
        <h3>Manhwa</h3>
    </div>

    <a href="Manhwa_add.php" class="btn btn-success mb-3">Add New Manhwa</a>
    <div class="alert alert-info text-center mb-4">
        <strong>Total Manhwa:</strong> <?php echo $total_records; ?>
    </div>
    
    
    <!-- Filter Search and Entries Dropdown -->
    <div class="row d-flex justify-content-between mb-4">
            <div class="col-md-6">
                <input type="text" id="filter-search" class="form-control" placeholder="Search for Manhwa by title or year...">
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

        
        <!-- Manhwa Cards -->
        <div class="row d-flex justify-content-center" id="manhwa-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-auto mb-3 manhwa-card">
                        <div class="card shadow">
                            <div class="card-body d-flex justify-content-center img_manhwa a">
                                <a>
                                    <img src="' . $row['img'] . '" alt="" class="" style="height: 210px;">
                                </a>
                            </div>
                            <div class="card-body text-center">
                                <p class="text-title fs-5">' . $row['title'] . '</p>
                                <p class="text-year fs-8">' . $row['release_date'] . '</p>
                                <a href="Manhwa_edit.php?id=' . $row['id'] . '" class="btn btn-warning">Edit</a>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#manhwaModal" 
                                    data-id="' . $row['id'] . '" 
                                    data-title="' . htmlspecialchars($row['title']) . '" 
                                    data-author="' . htmlspecialchars($row['author']) . '"
                                    data-description="' . htmlspecialchars($row['description']) . '" 
                                    data-genre="' . htmlspecialchars($row['genre']) . '" 
                                    data-rating="' . htmlspecialchars($row['rating']) . '" 
                                    data-release_date="' . htmlspecialchars($row['release_date']) . '" 
                                    data-status="' . htmlspecialchars($row['status']) . '"
                                    data-img="' . htmlspecialchars($row['img']) . '">See</button>
                                <a href="manhwa_delete.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>
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
<div class="modal fade" id="manhwaModal" tabindex="-1" aria-labelledby="manhwaModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="manhwaModalLabel">Manhwa Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Title:</strong> <span id="manhwaTitle"></span></p>
                <p><strong>Author:</strong> <span id="manhwaAuthor"></span></p>
                <p><strong>Description:</strong> <span id="manhwaDescription"></span></p>
                <p><strong>Genre:</strong> <span id="manhwaGenre"></span></p>
                <p><strong>Rating:</strong> <span id="manhwaRating"></span></p>
                <p><strong>Release Date:</strong> <span id="manhwaRelease_Date"></span></p>
                <p><strong>Status:</strong> <span id="manhwaStatus"></span></p>
                <img id="manhwaImage" src="" alt="Image" style="max-width: 250px; max-height: 300px;">
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

<script src="../JS/Manhwa_tables.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const manhwaContainer = document.getElementById('manhwa-container');
    const manhwaCards = document.querySelectorAll('.manhwa-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);

    function filterManhwa() {
        const filterValue = filterInput.value.toLowerCase();
        return Array.from(manhwaCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            return title.includes(filterValue) || year.includes(filterValue);
        });
    }

    function renderPage() {
        const filteredCards = filterManhwa();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        currentPage = Math.min(currentPage, totalPages || 1);

        manhwaCards.forEach(card => card.style.display = 'none');
        
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
        const filteredCards = filterManhwa();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }
    });

    renderPage(); // Call renderPage initially to set up the initial view

    // Event listener for opening the modal
    $('#manhwaModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var title = button.data('title');
        var author = button.data('author');
        var description = button.data('description');
        var genre = button.data('genre');
        var rating = button.data('rating');
        var release_date = button.data('release_date');
        var img = button.data('img');
        var status = button.data('status');

        var modal = $(this);
        modal.find('#manhwaTitle').text(title);
        modal.find('#manhwaAuthor').text(author);
        modal.find('#manhwaDescription').text(description);
        modal.find('#manhwaGenre').text(genre);
        modal.find('#manhwaRating').text(rating);
        modal.find('#manhwaRelease_Date').text(release_date);
        modal.find('#manhwaImage').attr('src', img);
        modal.find('#manhwaStatus').text(status);
    });
});
</script>


</body>
</html>

<?php $conn->close(); ?>
