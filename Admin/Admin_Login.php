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
<body style="background-color: #181818;">
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
                        <div class="mb-2">
                            <label class="form-label">Username</label>
                        </div>
                        <div class="input-group mb-3">
                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 26 26"><path fill="black" d="M16.563 15.9c-.159-.052-1.164-.505-.536-2.414h-.009c1.637-1.686 2.888-4.399 2.888-7.07c0-4.107-2.731-6.26-5.905-6.26c-3.176 0-5.892 2.152-5.892 6.26c0 2.682 1.244 5.406 2.891 7.088c.642 1.684-.506 2.309-.746 2.397c-3.324 1.202-7.224 3.393-7.224 5.556v.811c0 2.947 5.714 3.617 11.002 3.617c5.296 0 10.938-.67 10.938-3.617v-.811c0-2.228-3.919-4.402-7.407-5.557"/></svg></span>
                        <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Password</label>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="black" d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3"/></svg></span>
                        <input type="password" class="form-control" id="pwd" name="password" required>
                        </div>
                        <div class="mb-2">
                        <input type="checkbox" id="chk"> Show Password</input>
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

<script>
    const pwd = document.getElementById("pwd");
    const chk = document.getElementById("chk");

    chk.onchange = function(e) {
        pwd.type = chk.checked ? "text" : "password";
    };    
</script>
