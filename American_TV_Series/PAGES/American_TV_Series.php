<?php include "../PHP/American_TV_Series.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>American TV Series</title>
    <?php include "../../header.php" ?>
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
    <?php include "../../nav_user.php" ?>

    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">American TV Series</h2>

            <div class="mb-4">
                <a href="American_TV_Series_add.php" class="btn btn-success mb-3">Add New American TV Series</a>
                <div class="alert alert-info text-center">
                    <strong>Total TV Series:</strong> <?php echo $total_records; ?>
                </div>
            </div>

            <!-- Filter Search and Entries Dropdown -->
            <div class="row d-flex justify-content-between mb-4">
                <div class="col-md-6">
                    <input type="text" id="filter-search" class="form-control"
                        placeholder="Search for American TV series by title or year...">
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

            <!-- TV Series Cards -->
            <div class="row d-flex justify-content-center" id="american-tv-series-container">
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
        echo '<div class="col american-tv-series-card">
            <div class="card h-100 shadow">
                <div class="card-img-top d-flex justify-content-center align-items-center" style="height: 250px;">
                    <img src="' . htmlspecialchars($row['img']) . '" alt="" class="img-fluid movie-poster" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-title" title="' . htmlspecialchars($row['name']) . '">' . truncateTitle($row['name']) . '</h5>
                    <p class="card-text text-year">' . htmlspecialchars($row['year']) . '</p>
                    <div class="mt-auto d-flex justify-content-evenly">
                        <a href="American_TV_Series_edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#seriesModal" 
                            data-id="' . $row['id'] . '" 
                            data-name="' . htmlspecialchars($row['name']) . '" 
                            data-summary="' . htmlspecialchars($row['summary']) . '" 
                            data-genre="' . htmlspecialchars($row['genre']) . '" 
                            data-rating="' . htmlspecialchars($row['rating']) . '" 
                            data-year="' . htmlspecialchars($row['year']) . '" 
                            data-img="' . htmlspecialchars($row['img']) . '" 
                            data-season="' . htmlspecialchars($row['season']) . '"
                            data-cast="' . htmlspecialchars($row['cast']) . '" 
                            data-director="' . htmlspecialchars($row['director']) . '">See</button>
                        <a href="American_TV_Series_delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
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
    <div class="modal fade" id="seriesModal" tabindex="-1" aria-labelledby="seriesModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-lg text-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="seriesModalLabel">TV Series Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="seriesName"></span></p>
                    <p><strong>Summary:</strong> <span id="seriesSummary"></span></p>
                    <p><strong>Genre:</strong> <span id="seriesGenre"></span></p>
                    <p><strong>Director:</strong> <span id="seriesDirector"></span></p>
                    <p><strong>Season:</strong> <span id="seriesSeason"></span></p>
                    <p><strong>Cast</strong> <span id="seriesCast"></span></p>
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner mb-5" id="seriesCastCarousel">
                            <!-- Carousel items will be dynamically added here -->
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev" style="background-color: black;">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next" style="background-color: black;">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <p><strong>Rating:</strong> <span id="seriesRating"></span></p>
                    <p><strong>Year:</strong> <span id="seriesYear"></span></p>
                    <img id="seriesImage" src="" alt="Image" style="max-width: 250px; max-height: 300px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php include "../../Footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/American_TV_Series_tables.js"></script>
</body>

</html>

<?php
$stmt->close();
$count_stmt->close();
$conn->close();
?>