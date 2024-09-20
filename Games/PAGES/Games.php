<?php include "../PHP/Games.php"; 
include "../PHP/Games_Pagination.php";
include "../PHP/Games_Search.php";
?>

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
        <?php include "../PHP/Games_notif.php" ?>
        </div>

        <form method="GET" action="Games.php" class="d-flex mb-4">
                <input type="text" name="query" class="form-control me-2" placeholder="Search Games..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>

          <!-- Filter Search and Entries Dropdown -->
          <div class="row d-flex justify-content-between mb-4">
                <div class="d-flex justify-content-center">
                    <?php
                    include "../PHP/Games_Nav_Pagination.php";
                    // Retain search query in pagination links
                    $query_string = isset($_GET['query']) ? '&query=' . urlencode($_GET['query']) : '';
                    ?>
                </div>

                <div class="col-md-2">
                    <select id="entries-dropdown" class="form-select" onchange="window.location.href='Anime_Series.php?limit='+this.value+'<?php echo $query_string; ?>'">
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
             <?php include "../PHP/Games_Card.php";?>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <?php include "../PHP/Games_Nav_Pagination.php"; ?>
            </div>
        </div>
</section>

<?php include "../../Footer.php" ?>

<script src="../JS/Games_tables.js"></script> 
<script src="../JS/Games_notif.js"></script>


</body>
</html>
