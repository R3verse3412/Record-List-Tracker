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
    $publisher = $_POST['publisher'];
    $studio = $_POST['studio'];
    $device = $_POST['device'];

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
    $sql = "UPDATE games SET name=?, summary=?, year=?, img=?, genre=?, rating=?, publisher=?, studio=?, device=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssissssssi", $name, $summary, $year, $img, $genre, $rating, $publisher, $studio, $device, $id);
    
    if ($stmt->execute()) {
        header("Location: Games.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing record details
$sql = "SELECT * FROM games WHERE id=?";
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
    $publisher = $row['publisher'];
    $studio = $row['studio'];
    $device = $row['device']; // Fetch the device value
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