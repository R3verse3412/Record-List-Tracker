<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud_db"; // Ensure this is the correct database for user registration

    // Create a new database connection for user registration
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the username already exists
    $sql_check = "SELECT id FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $error = "Username already taken. Please choose another one.";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            initializeUserAccount($conn, $user_id); // Initialize user account in the same database
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmt_check->close();
    $conn->close();
}

function initializeUserAccount($conn, $user_id) {
    // Initialize user records in the same database
    $sql = "INSERT INTO user_records (user_id, record_name, record_value) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $default_record_name = "Welcome Record";
    $default_record_value = "This is your first record.";
    $stmt->bind_param("iss", $user_id, $default_record_name, $default_record_value);
    $stmt->execute();
    $stmt->close();

    // Initialize user settings if needed in the same database
    $sql_settings = "INSERT INTO user_settings (user_id, setting_name, setting_value) VALUES (?, ?, ?)";
    $stmt_settings = $conn->prepare($sql_settings);
    $default_setting_name = "Default Setting";
    $default_setting_value = "Default Value";
    $stmt_settings->bind_param("iss", $user_id, $default_setting_name, $default_setting_value);
    $stmt_settings->execute();
    $stmt_settings->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #181818;">
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card col-md-6">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h3>Register</h3>
                    <p class="text-muted">Create a new account</p>
                </div>
                <div class="container d-flex justify-content-center">
                    <form action="" method="post" style="width: 50vw; min-width: 300px;">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                        
                            <input type="password" class="form-control" id="pwd" name="password" required>
              
                            <input type="checkbox" id="chk"> Show Password
      
       
                        </div>
                        <div class="d-flex justify-content-center mb-3">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>
                        <div class="justify-content-center">
                            <a href="login.php">Return To Login</a>
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