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

    $sql = "UPDATE american_movies SET name=?, summary=?, year=?, img=?, genre=?, rating=?, cast=?, director=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssssi", $name, $summary, $year, $img, $genre, $rating, $cast_str, $director, $id);
    
    if ($stmt->execute()) {
        header("Location: American_Movies.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

// Fetch existing record details
$sql = "SELECT * FROM american_movies WHERE id=?";
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
