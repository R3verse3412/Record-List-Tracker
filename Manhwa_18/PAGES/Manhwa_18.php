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

// Fetch all records from manhwa
$sql = "SELECT * FROM manhwa_18 WHERE user_id = $user_id";
$result = $conn->query($sql);

// Count the number of records
$count_sql = "SELECT COUNT(*) as count FROM manhwa_18 WHERE user_id = ?";
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
$count_sql = "SELECT COUNT(*) as count FROM manhwa_18 WHERE user_id = ?";
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
    <title>Manhwa List</title>
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
        <h3>Manhwa 18</h3>
    </div>
</div>

<div class="mb-5 container">
    <a href="Manhwa_18_add.php" class="btn btn-success mb-3">Add New Manhwa</a>
    <div class="alert alert-info text-center mb-4">
        <strong>Total Manhwa:</strong> <?php echo $total_records; ?>
    </div>
    <table id="Manhwa_18" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Status</th>
                <th>Release Date</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td><img src='{$row['img']}' alt='Image' style='max-width: 100px;'></td>
                          <td>{$row['title']}</td>
                          <td>{$row['author']}</td>
                          <td>{$row['genre']}</td>
                          <td>{$row['status']}</td>
                          <td>{$row['release_date']}</td>
                          <td>{$row['rating']}</td>
                          <td>
                              <a href='Manhwa_18_edit.php?id={$row['id']}' class='btn btn-primary'>Edit</a>
                              <a href='Manhwa_18_delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                              <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#manhwa_18Modal' 
                                  data-id='{$row['id']}' data-title='{$row['title']}' data-description='{$row['description']}' 
                                  data-genre='{$row['genre']}' data-rating='{$row['rating']}' data-release_date='{$row['release_date']}' 
                                  data-img='{$row['img']}' data-author='{$row['author']}' data-status='{$row['status']}'>Show</button>
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
<div class="modal fade" id="manhwa_18Modal" tabindex="-1" aria-labelledby="manhwa_18ModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="manhwa_18ModalLabel">Manhwa 18 Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Title:</strong> <span id="manhwa_18Title"></span></p>
                <p><strong>Description:</strong> <span id="manhwa_18Description"></span></p>
                <p><strong>Genre:</strong> <span id="manhwa_18Genre"></span></p>
                <p><strong>Rating:</strong> <span id="manhwa_18Rating"></span></p>
                <p><strong>Release Date:</strong> <span id="manhwa_18Release_Date"></span></p>
                <p><strong>Author:</strong> <span id="manhwa_18Author"></span></p>
                <p><strong>Status:</strong> <span id="manhwa_18Status"></span></p>
                <img id="manhwa_18Image" src="" alt="Image" style="max-width: 250px; max-height: 300px;">
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

<script src="../JS/Manhwa_18_tables.js"></script>

</body>
</html>

<?php $conn->close(); ?>
