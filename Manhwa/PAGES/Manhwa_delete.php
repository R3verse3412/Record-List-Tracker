<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM manhwa WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manhwa.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
