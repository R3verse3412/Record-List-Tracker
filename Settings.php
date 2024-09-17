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
    <title>User Settings</title>
    <?php include "header.php"; ?>
    <style>
        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php include "nav.php" ?>
    <div class="container mb-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title mb-4">Account Settings</h1>
                
                <!-- Profile Picture Section -->
                <div class="mb-4">
                    <h2 class="h4 mb-3">Profile Picture</h2>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img src="img/Adventure Time.png" alt="Profile Picture" class="profile-picture rounded-circle">
                        </div>
                        <div class="col-md-9">
                            <div class="mb-2">
                                <small class="text-muted">JPEG or PNG, max 1MB</small>
                            </div>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash-alt me-2"></i>Delete Picture
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Personal Information Section -->
                <div class="mb-4">
                    <h2 class="h4 mb-3">Personal Information</h2>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" value="John">
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" value="Doe">
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Contact Information Section -->
                <div class="mb-4">
                    <h2 class="h4 mb-3">Contact Information</h2>
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" value="john.doe@example.com">
                        </div>
                    </form>
                </div>
                
                <!-- Action Buttons -->
                <div class="text-end">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>