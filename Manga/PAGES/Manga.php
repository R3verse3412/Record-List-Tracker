<?php include "../PHP/Manga.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga List</title>
    <?php include "../../header.php" ?>
    <link href="../CSS/Manga.css" rel="stylesheet">
</head>
<body>  
<?php include "../../nav_user.php" ?>

<section class="section">
<div class="container">
    <div class="text-center mb-4">
        <h3>Manga</h3>
    </div>

    <div class="mb-4">
    <a href="Manga_Add.php" class="btn btn-success mb-3">Add New Manga</a>
    <div class="alert alert-info text-center mb-4">
        <strong>Total Manga:</strong> <?php echo $total_records; ?>
    </div>
    <?php include "../PHP/Manga_notif.php" ?> 
    </div>

    <!-- Filter Search and Entries Dropdown -->
    <div class="row d-flex justify-content-between mb-4">
        <div class="col-md-6">
            <input type="text" id="filter-search" class="form-control" placeholder="Search for Manga by title or year...">
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

    <!-- Manga Cards -->
    <div class="row d-flex justify-content-center" id="manga-container">
      <?php include "../PHP/Manga_Card.php" ?>
     
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

<?php include "../../Footer.php" ?>

<script src="../JS/Manga_Tables.js"></script>
<script src="../JS/Manga_notif.js"></script>

</body>
</html>

<?php $conn->close(); ?>
