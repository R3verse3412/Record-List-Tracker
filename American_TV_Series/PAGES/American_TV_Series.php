<?php 
include "../PHP/American_TV_Series.php";
include "../PHP/American_TV_Series_Pagination.php";
include "../PHP/American_TV_Series_Search.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>American TV Series</title>
    <?php include "../../header.php" ?>
    <link href="../CSS/American_TV_Series.css" rel="stylesheet">
</head>
<body>
    <?php include "../../nav_user.php" ?>

    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">American TV Series</h2>

            <div class="mb-4">
                <a href="American_TV_Series_add.php" class="btn btn-success mb-3">Add New American TV Series</a>
                <div class="alert alert-info text-center">
                    <strong>TV Series:</strong> <?php echo $total_records; ?>
                </div>

                <?php include "../PHP/American_TV_Series_notif.php" ?>
            </div>

            <!-- Search Form -->
            <form method="GET" action="American_TV_Series.php" class="d-flex mb-4">
                <input type="text" name="query" class="form-control me-2" placeholder="Search movies..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>

            <!-- Filter Search and Entries Dropdown -->
            <div class="row d-flex justify-content-between mb-4">
                <div class="d-flex justify-content-center">
                    <?php
                    include "../PHP/American_TV_Series_Nav_Pagination.php";
                    // Retain search query in pagination links
                    $query_string = isset($_GET['query']) ? '&query=' . urlencode($_GET['query']) : '';
                    ?>
                </div>

                <!-- Entries Per Page Dropdown -->
                <div class="col-md-2">
                    <select id="entries-dropdown" class="form-select" onchange="window.location.href='American_TV_Series.php?limit='+this.value+'<?php echo $query_string; ?>'">
                        <option value="5" <?php if ($limit == 5) echo 'selected'; ?>>5 entries</option>
                        <option value="20" <?php if ($limit == 20) echo 'selected'; ?>>20 entries</option>
                        <option value="40" <?php if ($limit == 40) echo 'selected'; ?>>40 entries</option>
                        <option value="80" <?php if ($limit == 80) echo 'selected'; ?>>80 entries</option>
                        <option value="160" <?php if ($limit == 160) echo 'selected'; ?>>160 entries</option>
                    </select>
                </div>
            </div>

            <!-- Movies List -->
            <div class="container mb-5" id="movies-container">
             <?php include "../PHP/American_TV_Series_Card.php";?>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <?php include "../PHP/American_TV_Series_Nav_Pagination.php"; ?>
            </div>
        </div>
    </section>

    <?php include "../../Footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/American_TV_Series_tables.js"></script>
    <script src="../JS/American_TV_Series_notif.js"></script>
    <script src="../JS/American_TV_Series_Pagination.js"></script>
    <script src="../JS/American_TV_Series_Edit.js"></script>
</body>

</html>

<?php
// Close any prepared statements if used and close database connection
if (isset($stmt)) $stmt->close();
if (isset($count_stmt)) $count_stmt->close();
$conn->close();
?>
