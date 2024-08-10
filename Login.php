<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

  // Inside your existing login logic
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        
        if ($row['is_admin'] == 1) {
            // Redirect to admin panel
            header("Location: Admin_Panel.php");
        } else {
            // Regular user, check and initialize
            checkAndInitializeUser($conn, $row['id']);
            header("Location: Record_List_Page.php");
        }
        exit();
    } else {
        $error = "Invalid password.";
    }
} else {
    $error = "No user found with that username.";
}


    $stmt->close();
}

$conn->close();

function checkAndInitializeUser($conn, $user_id) {
    // Check if user has any records
    $sql = "SELECT COUNT(*) as record_count FROM user_records WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row['record_count'] == 0) {
        // Initialize user account if they don't have any records
        initializeUserAccount($conn, $user_id);
    }
    
    $stmt->close();
}

function initializeUserAccount($conn, $user_id) {
    // Add any initialization logic here, such as creating default records
    // Example: Creating a default category or default settings for the user
    $sql = "INSERT INTO user_records (user_id, record_name, record_value) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $default_record_name = "Welcome Record";
    $default_record_value = "This is your first record.";
    $stmt->bind_param("iss", $user_id, $default_record_name, $default_record_value);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<style>
    .login{
        position: relative;
        top: 80px;
        padding: 20px;
}
</style>

<body style="background-color: #181818;">
    <div class="container mt-5 d-flex justify-content-center ">
    <div class="card col-md-6 login">
        <div class="card-body">
        <div class="text-center mb-4">
            <h3>Login</h3>
            <p class="text-muted">Sign in to your account</p>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 300px;">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="mb-1">
                    <label class="form-label">Username</label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 26 26"><path fill="black" d="M16.563 15.9c-.159-.052-1.164-.505-.536-2.414h-.009c1.637-1.686 2.888-4.399 2.888-7.07c0-4.107-2.731-6.26-5.905-6.26c-3.176 0-5.892 2.152-5.892 6.26c0 2.682 1.244 5.406 2.891 7.088c.642 1.684-.506 2.309-.746 2.397c-3.324 1.202-7.224 3.393-7.224 5.556v.811c0 2.947 5.714 3.617 11.002 3.617c5.296 0 10.938-.67 10.938-3.617v-.811c0-2.228-3.919-4.402-7.407-5.557"/></svg></span>
                    <input type="text" class="form-control" name="username" required>
                    </div>
                <div class="mb-1">
                    <label class="form-label">Password</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="black" d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3"/></svg></span>
                    <input type="password" class="form-control" id="pwd" name="password" required>
                </div>
                <div class="mb-3">
                <input type="checkbox" id="chk"> Show Password
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <button type="submit" class="btn btn-success" >Login</button>
                </div>
                <div class="justify-content-center">
                <a href="Register.php">Register</a>
                </div>
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
