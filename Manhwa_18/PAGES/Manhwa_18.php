<?php include "../PHP/Manhwa_18.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manhwa List</title>
    <?php include "../../header.php"?>
    <link href="../CSS/Manhwa_18.css" rel="stylesheet">
</head>
<body>
<?php include "../../nav_user.php"?>
<section>
<div class="container">
    <div class="text-center mb-4">
        <h3>Manhwa 18</h3>
    </div>

    <div class="mb-4">
    <a href="Manhwa_18_add.php" class="btn btn-success mb-3">Add New Manhwa</a>
    <div class="alert alert-info text-center mb-4">
        <strong>Total Manhwa 18:</strong> <?php echo $total_records; ?>
    </div>
    <?php include "../PHP/Manhwa_18_notif.php" ?>
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

    <!-- Manhwa 18 Cards -->
    <div class="row d-flex justify-content-center" id="manhwa_18-container">
    <?php include "../PHP/Manhwa_18_Card.php" ?>
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
<div class="modal fade" id="manhwa_18Modal" tabindex="-1" aria-labelledby="manhwa_18ModalLabel" aria-hidden="true">
    <div class="modal-dialog text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manhwa_18ModalLabel">Manhwa 18 Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Title:</strong> <span id="manhwa_18Title"></span></p>
                <p><strong>Author:</strong> <span id="manhwa_18Author"></span></p>
                <p><strong>Description:</strong> <span id="manhwa_18Description"></span></p>
                <p><strong>Genre:</strong> <span id="manhwa_18Genre"></span></p>
                <p><strong>Rating:</strong> <span id="manhwa_18Rating"></span></p>
                <p><strong>Release Date:</strong> <span id="manhwa_18Release_Date"></span></p>
                <p><strong>Status:</strong> <span id="manhwa_18Status"></span></p>
                <img id="manhwa_18Image" src="" alt="Manhwa Image" style="max-width: 100%; height: auto;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include "../../Footer.php" ?>

<script src="../JS/Manhwa_18_tables.js"></script>
<script src="../JS/Manhwa_18_notif.js"></script>

</body>
</html>

<?php $conn->close(); ?>