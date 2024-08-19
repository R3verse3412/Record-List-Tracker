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
$upload_dir = "../../uploads/";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $summary = $_POST['summary'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $director = $_POST['director'];
    $user_id = $_SESSION['user_id']; // Retrieve user ID from session

    // Handle file upload
    if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img_name = $_FILES['img']['name'];
        $img_tmp_name = $_FILES['img']['tmp_name'];
        $img_size = $_FILES['img']['size'];
        $img_type = $_FILES['img']['type'];

        // Move uploaded file to desired location
        $img_path = $upload_dir . $img_name;

        if (move_uploaded_file($img_tmp_name, $img_path)) {
            // File successfully uploaded, continue with SQL insert
            $date_added = date('Y-m-d H:i:s'); // or any specific date
            $sql = "INSERT INTO american_movies (user_id, name, summary, genre, rating, year, cast, img, director, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssiisss", $user_id, $name, $summary, $genre, $rating, $year, $cast, $img_path, $director);
            
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Movie added successfully!";
                header("Location: American_Movies.php");
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
    <title>PHP CRUD - Add New American Movie</title>
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
            <h3>Add New American Movie</h3>
            <p class="text-muted">Complete the form below to add a new American movie</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width: 50vw; min-width: 300px;">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Summary</label>
                    <textarea class="form-control" name="summary" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text" class="form-control" name="genre" placeholder="Genre" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Year</label>
                    <input type="number" class="form-control" name="year" placeholder="Year" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <input type="number" class="form-control" name="rating" min="1" max="10">
                </div>
                <div class="mb-3">
                    <label class="form-label">Director</label>
                    <input type="text" class="form-control" name="director" placeholder="Director" required>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">Choose Image</label>
                    <input type="file" class="form-control-file" id="img" name="img" required>
                </div>
                <div class="mb-5 d-flex justify-content-center">
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="American_Movies.php" class="btn btn-danger">Cancel</a>
                </div>
                </div>
            </form>
        </div>
    </div>
    
<?php
    include "../../Footer.php"
?>

</body>
</html>