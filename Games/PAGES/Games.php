<?php include "../PHP/Games.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games</title>
    <?php include "../../header.php" ?>
    <link href="../CSS/Games.css" rel="stylesheet">
</head>
<body>   
<?php include "../../nav_user.php" ?>
<section class="section">
    <div class="container">
        <div class="text-center mb-4">
            <h3>Games</h3>
        </div>

        <div class="mb-4">
        <a href="Games_add.php" class="btn btn-success mb-3">Add New Games</a>
        <div class="alert alert-info text-center mb-4">
            <strong>Total Games:</strong> <?php echo $total_records; ?>
        </div>
        <?php include "../PHP/games_notif.php" ?>
        </div>

        <!-- Filter Search and Entries Dropdown -->
        <div class="row d-flex justify-content-between mb-4">
            <div class="col-md-6">
                <input type="text" id="filter-search" class="form-control" placeholder="Search for Games by title or year...">
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
                    <option value="20">20 entries</option>
                    <option value="40">40 entries</option>
                    <option value="80">80 entries</option>
                    <option value="160">160 entries</option>
                </select>
            </div>
        </div>

        <!-- Games Cards -->
        <div class="row d-flex justify-content-center" id="games-container">
        <?php include "../PHP/Games_Card.php" ?>
      
        <!-- Previous and Next buttons -->
        <div class="row  d-flex justify-content-center mt-4">
            <div class="col-md-auto mb-5">
                <button class="btn btn-primary" id="prev-button">Previous</button>
                <button class="btn btn-primary" id="next-button">Next</button>
            </div>
        </div>
    </div>
</section>

<?php include "../../Footer.php" ?>

<script src="../JS/Games_tables.js"></script> 
<script src="../JS/Games_notif.js"></script>


</body>
</html>
