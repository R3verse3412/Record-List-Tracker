<?php
session_start();

// Initialize variables
$error = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password, is_admin FROM users WHERE username = ? AND is_admin = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['is_admin'] = 1; // Set admin session variable

            // Redirect to admin panel
            header("Location: admin.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No admin found with that username.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Include your CSS and JS files -->
     <?php
     include "../header.php";
     ?>
</head>
<style>
    .admin-login{
        position: relative;
        top: 80px;
        padding: 20px;
    }
</style>
<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card col-md-6 admin-login">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h3>Admin Login</h3>
                    <p class="text-muted">Sign in to your admin account</p>
                </div>
                <div class="container d-flex justify-content-center">
                    <form action="" method="post" style="width: 300px;">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Login</button>
                        </div>
                       <!-- <div class="justify-content-center">
                          <a href="Admin_Register.php">Register</a>
                      </div>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
