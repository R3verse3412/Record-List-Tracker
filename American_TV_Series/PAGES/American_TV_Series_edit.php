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
    $season = $_POST['season'];
    $rating = $_POST['rating'];
    $director = $_POST['director'];

    // Handle file upload if a new file is uploaded
    if ($_FILES['img']['name']) {
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES['img']['name']);
        move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
        $img = $target_file;
    } else {
        $img = $_POST['current_img'];
    }

    // Handle cast information
    $cast = [];
    if (isset($_POST['cast_name']) && isset($_FILES['cast_img'])) {
        foreach ($_POST['cast_name'] as $index => $cast_name) {
            $cast_img = '';
            if ($_FILES['cast_img']['name'][$index]) {
                $target_file = "../../uploads/" . basename($_FILES['cast_img']['name'][$index]);
                move_uploaded_file($_FILES['cast_img']['tmp_name'][$index], $target_file);
                $cast_img = $target_file;
            } else {
                $cast_img = $_POST['current_cast_img'][$index];
            }
            if (!empty($cast_name)) {
                $cast[] = $cast_name . "|" . $cast_img;
            }
        }
    }
    $cast_str = implode(';', $cast);

    $sql = "UPDATE american_tv_series SET name=?, summary=?, year=?, img=?, genre=?, rating=?, season=?, cast=?, director=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissssssi", $name, $summary, $year, $img, $genre, $rating, $season, $cast_str, $director, $id);
    
    if ($stmt->execute()) {
        header("Location: American_TV_Series.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

// Fetch existing record details
$sql = "SELECT * FROM american_tv_series WHERE id=?";
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
    $season = $row['season'];
    $cast = $row['cast'];
    $director = $row['director'];
} else {
    echo "No record found.";
    exit();
}

$cast_arr = explode(';', $cast);
$cast_names = [];
$cast_imgs = [];
foreach ($cast_arr as $cast_member) {
    if (strpos($cast_member, '|') !== false) {
        list($cast_name, $cast_img) = explode('|', $cast_member);
        $cast_names[] = $cast_name;
        $cast_imgs[] = $cast_img;
    }
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
    <title>PHP CRUD - Edit American TV Series</title>
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
            <h3>Edit American TV Series</h3>
            <p class="text-muted">Update the details of the American TV Series</p>
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
                    <label class="form-label">Season</label>
                    <input type="text" class="form-control" name="season" value="<?php echo htmlspecialchars($season); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Director</label>
                    <input type="text" class="form-control" name="director" value="<?php echo htmlspecialchars($director); ?>">
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
                <div class="mb-3">
                    <label class="form-label">Cast</label>
                    <div id="cast-container">
                        <?php foreach ($cast_names as $index => $cast_name): ?>
                        <div class="cast-member mb-3">
                            <input type="text" class="form-control mb-2" name="cast_name[]" value="<?php echo htmlspecialchars($cast_name); ?>">
                            <?php if (!empty($cast_imgs[$index])): ?>
                            <img src="<?php echo htmlspecialchars($cast_imgs[$index]); ?>" alt="Cast Image" style="max-width: 100px;"><br>
                            <?php endif; ?>
                            <input type="file" class="form-control-file mb-2" name="cast_img[]">
                            <input type="hidden" name="current_cast_img[]" value="<?php echo htmlspecialchars($cast_imgs[$index]); ?>">
                            <button type="button" class="btn btn-danger" onclick="removeCastMember(this)">Delete</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addCastMember()">Add Cast Member</button>
                </div>
                <div class="mb-5 d-flex justify-content-center">
                    <div class="col-md-auto">
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="American_TV_Series.php" class="btn btn-danger">Cancel</a>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    include "../../Footer.php"
?>

    <script src="../JS/American_TV_Series_Edit.js"> </script>
</body>
</html>

