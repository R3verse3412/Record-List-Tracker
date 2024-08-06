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
}
</style>

<body  style="background-color: #181818;">
    <div class="container mt-5 d-flex justify-content-center ">
    <div class="card col-md-6 login">
        <div class="card-body">
        <div class="text-center mb-4">
            <h3>Login</h3>
            <p class="text-muted">Sign in to your account</p>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 10vw; min-width: 300px;">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="pwd" name="password" required>
                    <input type="checkbox" id="chk"> Show Password
                </div>
                <div class="d-flex justify-content-center">
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
