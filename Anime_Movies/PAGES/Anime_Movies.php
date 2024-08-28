<?php include "../PHP/Anime_Movies.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Series</title>
    <?php include "../../header.php"?>
    <link href="../CSS/Anime_Movies.css" rel="stylesheet">
</head>
<body>

    <?php include "../../nav_user.php"?>

    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">Anime Movies</h2>

            <div class="mb-4">
                <a href="Anime_Movies_add.php" class="btn btn-success mb-3">Add New Anime Movies</a>
                <div class="alert alert-info text-center">
                    <strong>Total Movies:</strong> <?php echo $total_records; ?>
                </div>
                <?php include "../PHP/Anime_Movies_notif.php"?>
            </div>

            <!-- Filter Search and Entries Dropdown -->
            <div class="row d-flex justify-content-between mb-4">
                <div class="col-md-6">
                    <input type="text" id="filter-search" class="form-control"
                        placeholder="Search for movies by title or year...">
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

            <!-- Movie Cards -->
            <div class="row d-flex justify-content-center" id="anime-movies-container">
            <?php include "../PHP/Anime_Movies_Card.php" ?>
            </div>

            <!-- Previous and Next buttons -->
            <div class="row  d-flex justify-content-center mt-4">
                <div class="col-md-auto mb-5">
                    <button class="btn btn-primary" id="prev-button">Previous</button>
                    <button class="btn btn-primary" id="next-button">Next</button>
                </div>
            </div>
        </div>

        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="movieModal" tabindex="-1" aria-labelledby="movieModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
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
                    <p><strong>Rating:</strong> <span id="movieRating"></span></p>
                    <p><strong>Year:</strong> <span id="movieYear"></span></p>
                    <p><strong>Duration:</strong> <span id="movieDuration"></span></p>
                    <p><strong>Studio:</strong> <span id="movieStudio"></span></p>
                    <img id="movieImage" src="" alt="Image" style="max-width: 250px; max-height: 300px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <?php include "../../Footer.php"?>

    <script src="../JS/Anime_Movies_tables.js"> </script>
    <script src="../JS/Anime_Movies_notif.js"></script>
   
</body>

</html>

<?php $conn->close(); ?>