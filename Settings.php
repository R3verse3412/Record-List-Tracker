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
$sql = "SELECT username, email, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Handle form submission for updating user info
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update Username and Email
    if (isset($_POST['username'], $_POST['email'])) {
        $new_username = $_POST['username'];
        $new_email = $_POST['email'];

        $update_sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssi", $new_username, $new_email, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    $success_message = ''; // Initialize success message

// Handle form submission for updating user info
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update Username and Email
    if (isset($_POST['username'], $_POST['email'])) {
        $new_username = $_POST['username'];
        $new_email = $_POST['email'];

        $update_sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssi", $new_username, $new_email, $user_id);
        $stmt->execute();
        $stmt->close();

        // Set success message
        $success_message = "Profile updated successfully.";
    }

    // ... (rest of your existing code)
}


   // Initialize error flag
$error_message = '';

if (isset($_POST['current_password'], $_POST['new_password']) && !empty($_POST['current_password']) && !empty($_POST['new_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Verify current password
    $password_sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($password_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($current_password, $hashed_password)) {
        // Hash the new password and update
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_password_sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($update_password_sql);
        $stmt->bind_param("si", $new_hashed_password, $user_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Set error message
        $error_message = "Current password is incorrect.";
    }
}


    // Handle Profile Picture Upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png'];
        $file_type = $_FILES['profile_picture']['type'];
        $file_size = $_FILES['profile_picture']['size'];

        if (in_array($file_type, $allowed_types) && $file_size <= 1048576) { // 1MB max
            $upload_dir = "uploads/";
            $file_ext = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
            $file_name = "profile_" . $user_id . "." . $file_ext;
            $upload_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path)) {
                // Update profile picture in the database
                $update_picture_sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
                $stmt = $conn->prepare($update_picture_sql);
                $stmt->bind_param("si", $file_name, $user_id);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "Failed to upload the profile picture.";
            }
        } else {
            echo "Invalid file type or size.";
        }
    }
}

// Fetch the updated user data
$sql = "SELECT username, email, profile_picture FROM users WHERE id = ?";
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

        @media screen and (max-width: 768px) {
            .h4, .card-title, .text-muted{
                text-align: center;
                justify-content: center;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <?php include "nav.php"; ?>
    <div class="container mb-5">
        <h1 class="card-title mb-4">Account Settings</h1>
        
        <!-- Profile Picture Section -->
        <div class="mb-4">
            <h2 class="h4 mb-3">Profile Picture</h2>
            <div class="row align-items-center">
                <div class="col-md-3">
                    <img src="uploads/<?php echo !empty($user['profile_picture']) ? $user['profile_picture'] : 'default.png'; ?>" alt="Profile Picture" class="profile-picture rounded-circle">
                </div>
                <div class="col-md-9">
                    <form method="POST" enctype="multipart/form-data">
                        <small class="text-muted">JPEG or PNG, max 1MB</small>
                        <div class="input-group mb-3">
                            <input type="file" name="profile_picture" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                        <button class="btn btn-outline-primary btn-sm" type="submit">
                            Upload Picture
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="mb-4">
            <h2 class="h4 mb-3">Personal Information</h2>
            <form method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
                    </div>
                </div>
        </div>

        <!-- Contact Information Section -->
        <div class="mb-4">
            <h2 class="h4 mb-3">Contact Information</h2>
            <div class="row g-1 mb-3 align-items-center">
                <div class="col md-8">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                </div>
                    <div class="col">
                    
                    </div>
                </div>
        </div>

     <!-- Password Section -->
<div class="mb-4">
    <h2 class="h4 mb-3">Password</h2>
    <div class="text-muted mb-3">Modify your current password</div>
    <div class="row align-items-center d-flex mb-5">
        <div class="col">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-control" name="current_password" id="current_pwd">
            <label for="">Show</label>
            <input type="checkbox" id="show_current_pwd">
        </div>
        <div class="col">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" name="new_password" id="new_pwd">
            <label for="">Show</label>
            <input type="checkbox" id="show_new_pwd">
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="text-end d-flex justify-content-center">
    <button class="btn btn-primary" type="submit">
        <i class="fas fa-save me-2"></i>Save Changes
    </button>
</div>
</form>

<!-- Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="errorModalLabel">Error</h5>
            </div>
            <div class="modal-body">
               <p class="text-center">Current password is incorrect.</p> 
            </div>
            <div class="modal-footer">
             
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="successModalLabel">Success</h5>
            </div>
            <div class="modal-body">
                <p class="text-center"><?php echo $success_message; ?></p> 
            </div>
            <div class="modal-footer">
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

<script>
    // Show the success modal if there's a success message
    <?php if (!empty($success_message)): ?>
        var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
            keyboard: false
        });
        myModal.show();
    <?php endif; ?>
</script>


<script>
    // Show the error modal if there's an error message
    <?php if (!empty($error_message)): ?>
        var myModal = new bootstrap.Modal(document.getElementById('errorModal'), {
            keyboard: false
        });
        myModal.show();
    <?php endif; ?>
</script>

