<?php include "../PHP/Cartoon_Movies.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <?php include "../../header.php" ?>
    <link href="../CSS/Cartoon_Movies.css" rel="stylesheet">
</head>
<body>
<?php include "../../nav_user.php"?>

<section class="section">
    <div class="container">
    <h2 class="text-center mb-5">Cartoon Movies</h2>
   
    <div class="mb-4">
            <a href="Cartoon_Movies_add.php" class="btn btn-success mb-3">Add New Cartoon Movies</a>
            <div class="alert alert-info text-center">
                <strong>Total Cartoon Movies:</strong> <?php echo $total_records; ?>
            </div>
            <?php include "../PHP/Cartoon_Movies_notif.php"?>
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
                    <option value="20">20 entries</option>
                    <option value="40">40 entries</option>
                    <option value="80">80 entries</option>
                    <option value="160">160 entries</option>
                </select>
            </div>
        </div>

              <!-- Cartoon Movies Cards -->
              <div class="row d-flex justify-content-center" id="cartoon-movies-container">
                <?php include "../PHP/Cartoon_Movies_Card.php" ?>
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

    <script src="../JS/Cartoon_Movies_tables.js"> </script> 
    <script src="../JS/Cartoon_Movies_notif.js"></script>
    <script>
 
    </script>

</body>

</html>

<?php $conn->close(); ?>