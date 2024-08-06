<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID not provided.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $status = $_POST['status'];
    $release_date = $_POST['release_date'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];
   

    // Handle file upload if a new file is uploaded
    if ($_FILES['img']['name']) {
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES['img']['name']);
        move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
        $img = $target_file;
    } else {
        $img = $_POST['current_img'];
    }

    // Prepare SQL statement
    $sql = "UPDATE manhwa_18 SET title=?, author=?, genre=?, img=?, status=?, release_date=?, description=?, rating=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssssssssi", $title, $author, $genre, $img, $status, $release_date, $description, $rating, $id);
    
    if ($stmt->execute()) {
        header("Location: Manhwa_18.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing record details
$sql = "SELECT * FROM manhwa_18 WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $author = $row['author'];
    $genre = $row['genre']; 
    $img = $row['img'];
    $status = $row['status'];
    $release_date = $row['release_date'];
    $description = $row['description'];
    $rating = $row['rating'];
   
} else {
    echo "No record found.";
    exit();
}


$stmt->close();
$conn->close();
?>



<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD - Edit Anime Series</title>
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
            <h3>Edit Manhwa 18</h3>
            <p class="text-muted">Update the details of the anime series</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width: 50vw; min-width: 300px;">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($title); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"><?php echo htmlspecialchars($description); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text" class="form-control" name="genre" value="<?php echo htmlspecialchars($genre); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Release_date</label>
                    <input type="number" class="form-control" name="release_date" value="<?php echo htmlspecialchars($year); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <input type="number" class="form-control" name="rating" value="<?php echo htmlspecialchars($rating); ?>" min="1" max="10">
                </div>
                <div class="mb-3">
                    <label class="form-label">Author</label>
                    <input type="text" class="form-control" name="author" value="<?php echo htmlspecialchars($author); ?>" >
                </div>
                <div class="mb-3">
    <label class="form-label">Status</label>
    <select class="form-control" name="status">
        <option value="Mobile Phone" <?php if ($status == 'Mobile Phone') echo 'selected'; ?>>Mobile Phone</option>
        <option value="PC" <?php if ($status == 'PC') echo 'selected'; ?>>PC</option>
        <option value="Playstation" <?php if ($status == 'Playstation') echo 'selected'; ?>>Playstation</option>
        <option value="Xbox" <?php if ($status == 'Xbox') echo 'selected'; ?>>Xbox</option>
    </select>
</div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <?php if (!empty($img)): ?>
                    <img src="<?php echo htmlspecialchars($img); ?>" alt="Current Image" style="max-width: 200px;"><br>
                    <?php endif; ?>
                    <label class="form-label">Update Image</label>
                    <input type="file" class="form-control-file" name="img">
                    <input type="hidden" name="current_img" value="<?php echo htmlspecialchars($img); ?>">
                </div>
                <div class="mb-5 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="Manhwa_18.php" class="btn btn-danger">Cancel</a>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                </div>
            </form>
        </div>
    </div>
    <?php
    include "../../Footer.php"
?>
</body>
</html>
