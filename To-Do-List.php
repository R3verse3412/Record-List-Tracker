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
    <title>To-Do-List</title>
    <?php include "header.php" ?>
</head>
<style>
    .section {
        min-height: 20vh;
    }
</style>

<body>
    <?php include "nav.php" ?>

    <section class="section">
        <div class="container">
            <div class="text mb-3 fs-2">Add New Plan List</div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New</button>
        </div>
    </section>

    <section class="section mb-5">
        <div class="container">
            <div class="row-cols-1 row-cols-md-2 row-cols-lg-5 g-4">
                <div class="col">
                    <div class="card">
                        <div class="card-body ">
                            <div class="mb-3">
                            <img src="uploads/21 Jump Street.jpg" alt=""
                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                <div class="d-flex justify-content-center">
                            <button class="btn btn-success ">Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "Footer.php" ?>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">TO DO LIST</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Type</label>
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            <option value="1">Movie</option>
                            <option value="2">Anime</option>
                            <option value="3">Manhwa</option>
                            <option value="3">Manga</option>
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <input type="file" class="form-control">
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>