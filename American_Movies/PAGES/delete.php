<?php
session_start(); // Make sure to start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM american_movies WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['delete_message'] = "Movie deleted successfully!";
        header("Location: american_movies.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>