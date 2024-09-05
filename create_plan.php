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

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$type = $_POST['type'];
$image_path = '';

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $upload_dir = 'uploads/';
    $image_path = $upload_dir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
}

$sql = "INSERT INTO plans (user_id, name, type, image_path) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $name, $type, $image_path);

if ($stmt->execute()) {
    header("Location: To-Do-List.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
