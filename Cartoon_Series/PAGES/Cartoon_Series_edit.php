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
    $name = $_POST['name'];
    $summary = $_POST['summary'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $episodes = $_POST['episodes'];
    $studio = $_POST['studio'];

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
    $sql = "UPDATE cartoon_series SET name=?, summary=?, year=?, img=?, genre=?, rating=?, episodes=?, studio=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssisssssi", $name, $summary, $year, $img, $genre, $rating, $episodes, $studio, $id);
    
    if ($stmt->execute()) {
        header("Location: Cartoon_Series.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing record details
$sql = "SELECT * FROM cartoon_series WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $summary = $row['summary'];
    $year = $row['year'];
    $img = $row['img'];
    $genre = $row['genre'];
    $rating = $row['rating'];
    $episodes = $row['episodes'];
    $studio = $row['studio'];
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
            <h3>Edit Anime Series</h3>
            <p class="text-muted">Update the details of the anime series</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width: 50vw; min-width: 300px;">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Summary</label>
                    <textarea class="form-control" name="summary" rows="3"><?php echo htmlspecialchars($summary); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text" class="form-control" name="genre" value="<?php echo htmlspecialchars($genre); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Year</label>
                    <input type="number" class="form-control" name="year" value="<?php echo htmlspecialchars($year); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <input type="number" class="form-control" name="rating" value="<?php echo htmlspecialchars($rating); ?>" min="1" max="10">
                </div>
                <div class="mb-3">
                    <label class="form-label">Episodes</label>
                    <input type="number" class="form-control" name="episodes" value="<?php echo htmlspecialchars($episodes); ?>" min="1" max="2000">
                </div>
                <div class="mb-3">
                    <label class="form-label">Studio</label>
                    <input type="text" class="form-control" name="studio" value="<?php echo htmlspecialchars($studio); ?>">
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
                    <a href="Cartoon_Series.php" class="btn btn-danger">Cancel</a>
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
