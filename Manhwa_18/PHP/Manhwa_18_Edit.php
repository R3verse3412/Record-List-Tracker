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
