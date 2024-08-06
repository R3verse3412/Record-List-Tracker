<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_db";
$user_id = $_SESSION['user_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all records from anime_series
$sql = "SELECT * FROM games WHERE user_id = $user_id";
$result = $conn->query($sql);

// Count the number of records
$count_sql = "SELECT COUNT(*) as count FROM games WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
if (!$count_stmt) {
    die("Prepare failed: " . $conn->error);
}

$count_stmt->bind_param("i", $user_id);
if (!$count_stmt->execute()) {
    die("Execute failed: " . $count_stmt->error);
}

$count_result = $count_stmt->get_result();
if ($count_result === false) {
    die("Get result failed: " . $count_stmt->error);
}

$row_count = $count_result->fetch_assoc();
$total_records = $row_count['count'];


// Count the number of records for the logged-in user
$count_sql = "SELECT COUNT(*) as count FROM games WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_records = $row_count['count'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Series</title>
    <?php
include "../../header.php"
?>
</head>
<body>
    
<?php
include "../../nav_user.php"
?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Games</h3>
    </div>
</div>

<div class="mb-5 container">
    <a href="Games_add.php" class="btn btn-success mb-3">Add New Games</a>
    <div class="alert alert-info text-center mb-4">
        <strong>Total Anime Series:</strong> <?php echo $total_records; ?>
    </div>
    <table id="Games" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Genre</th>
                <th>Ratings</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td><img src='{$row['img']}' alt='Image' style='max-width: 100px;'></td>
                        <td>{$row['name']}</td>
                        <td>{$row['genre']}</td>
                        <td>{$row['rating']}</td>
                        <td>{$row['year']}</td>
                        <td>
                            <a href='Games_edit.php?id={$row['id']}' class='btn btn-primary'>Edit</a>
                            <a href='Games_delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#gamesModal' 
                                data-id='{$row['id']}' data-name='{$row['name']}' data-summary='{$row['summary']}' 
                                data-genre='{$row['genre']}' data-rating='{$row['rating']}' data-year='{$row['year']}' 
                                data-img='{$row['img']}' data-publisher='{$row['publisher']}' data-studio='{$row['studio']}' ' data-device='{$row['device']}'>Show</button>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
        }
        ?>

        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="gamesModal" tabindex="-1" aria-labelledby="gamesModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="gamesModalLabel">Anime Series Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="gamesName"></span></p>
                <p><strong>Summary:</strong> <span id="gamesSummary"></span></p>
                <p><strong>Genre:</strong> <span id="gamesGenre"></span></p>
                <p><strong>Rating:</strong> <span id="gamesRating"></span></p>
                <p><strong>Year:</strong> <span id="gamesYear"></span></p>
                <p><strong>Publisher:</strong> <span id="gamesPublisher"></span></p>
                <p><strong>Studio:</strong> <span id="gamesStudio"></span></p>
                <p><strong>Device:</strong> <span id="gamesDevice"></span></p>
                <img id="gamesImage" src="" alt="Image" style="max-width: 250px; max-height: 300px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
    include "../../Footer.php"
?>

<script src="../JS/Games_tables.js"></script> 

</body>
</html>

<?php $conn->close(); ?>
