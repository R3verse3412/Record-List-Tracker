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

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <?php include "header.php" ?>
</head>

<body>
    <?php include "nav.php" ?>

    <div class="container">
        <div class="row row-cols-1 row-cols-lg-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="img/Adventure Time.png" alt="">
                        </div>
                        <div class="d-flex justify-content-center mb-5">
                            <p>Hello</p>
                        </div>
                        <div class="mb-3">
                            <p class="fs-5">My Profile</p>
                            <li>Manage Account</li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>