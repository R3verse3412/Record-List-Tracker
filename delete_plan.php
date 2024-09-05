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

$plan_id = $_POST['plan_id'];

$sql = "DELETE FROM plans WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $plan_id);

if ($stmt->execute()) {
    header("Location: To-Do-List.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
