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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $status = $_POST['status'] ?? '';
    $release_date = $_POST['release_date'] ?? '';
    $description = $_POST['description'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $user_id = $_SESSION['user_id']; // Retrieve user ID from session

    // Handle file upload
    if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img_name = $_FILES['img']['name'];
        $img_tmp_name = $_FILES['img']['tmp_name'];

        // Ensure the uploads directory exists
        $upload_dir = '../../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory recursively with full permissions
        }

        // Move uploaded file to desired location
        $img_path = $upload_dir . $img_name;

        if (move_uploaded_file($img_tmp_name, $img_path)) {
            // File successfully uploaded, continue with your SQL insert
            $sql = "INSERT INTO manga (user_id, title, author, genre, status, release_date, description, rating, img, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("issssisss",$user_id, $title, $author, $genre, $status, $release_date, $description, $rating, $img_path);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Game added successfully!";
                header("Location: Manga.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            // Close statement
            $stmt->close();

        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "File upload failed with error code: " . $_FILES['img']['error'];
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
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
        <h3>Add New Manga</h3>
        <p class="text-muted">Complete the form below to add a new Manga</p>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" enctype="multipart/form-data" style="width: 50vw; min-width: 300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Author</label>
                    <input type="text" class="form-control" name="author" placeholder="Author" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" class="form-control" name="genre" placeholder="Genre" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Release Date</label>
                <input type="number" class="form-control" name="release_date" placeholder="Year" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Rating</label>
                <input type="number" class="form-control" name="rating" min="1" max="10">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Complete">Complete</option>
                    <option value="Ongoing">Ongoing</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Choose Image</label>
                <input type="file" class="form-control-file" id="img" name="img" required>
            </div>
            <div class="mb-5 d-flex justify-content-center">
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="Manga.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php
    include "../../Footer.php"
?>
</body>
</html>
