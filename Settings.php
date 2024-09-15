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

<style>
    .btn{
        height: 40px;
    }
</style>

<body>
    <?php include "nav.php" ?>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <p class="fs-1">Account</p>
                <div class="row row-cols-1 row-cols-lg-2 g-4 mb-3">
                    <div class="col d-flex">
                        <img src="img/Adventure Time.png" alt="" style="width: 20%; height: 100px;">
                        <div class="row-1">
                            <ul class="list-group">
                        <li class="list-group-item">Profile Picture</li>
                        <li class="list-group-item">JPEG</li>
                        </ul>
                        </div>
                    </div>
                    <div class="col d-flex">
                            <input type="file" class="form-control">
                            <button class="btn btn-danger">Delete</button>
                    </div>
                   
                </div>
                <div class="row mb-2">
                    <p class="fs-4">Full name</p>
                </div>
                <div class="row row-cols-1 row-cols-lg-2 g-2">
                    <div class="col">
                    <span class="input-group-text">First Name</span>
                    <input type="text" class="form-control">
                    </div>
                    <div class="col ">
                    <span class="input-group-text">Last Name</span>
                    <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>