<?php 
include "../PHP/American_Movies.php"; 
include "../PHP/American_Movies_Pagination.php";
include "../PHP/American_Movies_Search.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <?php include "../../header.php"; ?>
    <link href="../CSS/American_Movies.css" rel="stylesheet">
</head>

<body>
    <?php include "../../nav_user.php"; ?>

    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">American Movies</h2>

            <div class="mb-4">
                <a href="American_Movies_add.php" class="btn btn-success mb-3">Add New American Movies</a>
                <div class="alert alert-info text-center">
                    <strong>Movies:</strong> <?php echo $total_records; ?>
                </div>

                <?php include "../PHP/American_Movies_notif.php"; ?>
            </div>

            <!-- Search Form -->
            <form method="GET" action="American_Movies.php" class="d-flex mb-4">
                <input type="text" name="query" class="form-control me-2" placeholder="Search movies..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>

            <!-- Filter Search and Entries Dropdown -->
            <div class="row d-flex justify-content-between mb-4">
                <div class="d-flex justify-content-center">
                    <?php
                    include "../PHP/Ameican_Movies_Nav_Pagination.php";
                    // Retain search query in pagination links
                    $query_string = isset($_GET['query']) ? '&query=' . urlencode($_GET['query']) : '';
                    ?>
                </div>

                <!-- Entries Per Page Dropdown -->
                <div class="col-md-2">
                    <select id="entries-dropdown" class="form-select" onchange="window.location.href='American_Movies.php?limit='+this.value+'<?php echo $query_string; ?>'">
                        <option value="20" <?php if ($limit == 20) echo 'selected'; ?>>20 entries</option>
                        <option value="50" <?php if ($limit == 50) echo 'selected'; ?>>50 entries</option>
                        <option value="100" <?php if ($limit == 100) echo 'selected'; ?>>100 entries</option>
                        <option value="200" <?php if ($limit == 200) echo 'selected'; ?>>200 entries</option>
                        <option value="500" <?php if ($limit == 500) echo 'selected'; ?>>500 entries</option>
                    </select>
                </div>
            </div>

            <!-- Movies List -->
            <div class="container mb-5" id="movies-container">
             <?php include "../PHP/American_Movies_Card.php";?>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <?php include "../PHP/Ameican_Movies_Nav_Pagination.php"; ?>
            </div>
        </div>
    </section>

    <?php include "../../Footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/American_Movies_table.js"></script>
    <script src="../JS/American_Movies_Notif.js"></script>
    <script src="../JS/American_Movies_Pagination.js"></script>
    <script src="../JS/American_Movies_Edit.js"></script>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
