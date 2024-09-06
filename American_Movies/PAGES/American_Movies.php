<?php include "../PHP/American_Movies.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <?php include "../../header.php" ?>
    <link href="../CSS/American_Movies.css" rel="stylesheet">
</head>


<body>
    <?php include "../../nav_user.php" ?>

    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5 ">American Movies</h2>

            <div class="mb-4">


                <div class="mb-4">
                    <a href="American_Movies_add.php" class="btn btn-success mb-3">Add New American Movies</a>
                    <div class="alert alert-info text-center">
                        <strong>Total Movies:</strong> <?php echo $total_records; ?>
                    </div>
                </div>

                <?php include "../PHP/American_Movies_notif.php" ?>
            </div>

            <!-- Filter Search and Entries Dropdown -->
            <div class="row d-flex justify-content-between mb-4">
                <div class="col-md-6">
                    <input type="text" id="filter-search" class="form-control"
                        placeholder="Search for movies by title, year and director...">
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
            <div class="container" id="movies-container">
             <?php include "../PHP/American_Movies_Card.php" ?>
            </div>

            <!-- Previous and Next buttons -->
            <div class="row  d-flex justify-content-center mt-4">
                <div class=" col-md-auto mb-5 ">
                    <list class="btn btn-primary" id="prev-button">Previous</list>
                    <list class="btn btn-primary" id="next-button">Next</list>
                </div>
            </div>
        </div>
    </section>

    <?php include "../../Footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/American_Movies_table.js"></script>
    <script src="../JS/American_Movies_Notif.js"></script>
 
</body>

</html>

<?php
$stmt->close();
$count_stmt->close();
$conn->close();
?>