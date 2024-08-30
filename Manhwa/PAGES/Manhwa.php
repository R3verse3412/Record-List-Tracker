<?php include "../PHP/Manhwa.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manhwa List</title>
    <?php include "../../header.php" ?>
    <link href="../CSS/Manhwa.css" rel="stylesheet">
</head>
<body>
    
<?php include "../../nav_user.php"?>

<section class="section">
<div class="container">
    <div class="text-center mb-4">
        <h3>Manhwa</h3>
    </div>

    <div class="mb-4">
    <a href="Manhwa_add.php" class="btn btn-success mb-3">Add New Manhwa</a>
    <div class="alert alert-info text-center mb-4">
        <strong>Total Manhwa:</strong> <?php echo $total_records; ?>
    </div>
    <?php include "../PHP/Manhwa_notif.php" ?>
    </div>
    
    
    <!-- Filter Search and Entries Dropdown -->
    <div class="row d-flex justify-content-between mb-4">
            <div class="col-md-6">
                <input type="text" id="filter-search" class="form-control" placeholder="Search for Manhwa by title or year...">
            </div>
            <div class="col-md-2">
                <select id="entries-dropdown" class="form-select">
                    <option value="20">20 entries</option>
                    <option value="40">40 entries</option>
                    <option value="80">80 entries</option>
                    <option value="160">160 entries</option>
                </select>
            </div>
        </div>

        
        <!-- Manhwa Cards -->
        <div class="row d-flex justify-content-center" id="manhwa-container">
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
    echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col manhwa-card">
            <div class="card h-100 shadow">
                <div class="card-img-top d-flex justify-content-center align-items-center" style="height: 250px;">
                    <img src="' . htmlspecialchars($row['img']) . '" alt="" class="img-fluid movie-poster" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-title" title="' . htmlspecialchars($row['title']) . '">' . truncateTitle($row['title']) . '</h5>
                    <p class="card-text text-year">' . htmlspecialchars($row['release_date']) . '</p>
                    <div class="mt-auto d-flex justify-content-evenly">
                        <a href="Manhwa_edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#manhwaModal" 
                          data-id="' . $row['id'] . '" 
                                    data-title="' . htmlspecialchars($row['title']) . '" 
                                    data-author="' . htmlspecialchars($row['author']) . '"
                                    data-description="' . htmlspecialchars($row['description']) . '" 
                                    data-genre="' . htmlspecialchars($row['genre']) . '" 
                                    data-rating="' . htmlspecialchars($row['rating']) . '" 
                                    data-release_date="' . htmlspecialchars($row['release_date']) . '" 
                                    data-status="' . htmlspecialchars($row['status']) . '"
                                    data-img="' . htmlspecialchars($row['img']) . '">See</button>
                        <a href="Manhwa_delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
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
<script src="../JS/Manhwa_notif.js"></script>

</body>
</html>

<?php $conn->close(); ?>
