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
            border: 3px solid #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .settings-card {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }
        .settings-header {
            background-color: #f8f9fa;
            border-radius: 12px 12px 0 0;
            padding: 1rem;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.15);
        }
        .btn-upload {
            position: relative;
            overflow: hidden;
        }
        .btn-upload input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            opacity: 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include "nav.php"; ?>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-6 mb-4">Account Settings</h1>
                
                <!-- Profile Picture Card -->
                <div class="card settings-card">
                    <div class="settings-header">
                        <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Profile Picture</h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <img src="uploads/<?php echo !empty($user['profile_picture']) ? $user['profile_picture'] : 'default.png'; ?>" 
                                     alt="Profile Picture" 
                                     class="profile-picture rounded-circle mb-2">
                            </div>
                            <div class="col-md-8">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <div class="btn-group w-100">
                                            <button type="button" class="btn btn-outline-primary btn-upload">
                                                <i class="fas fa-cloud-upload-alt me-2"></i>Choose File
                                                <input type="file" name="profile_picture" class="form-control" id="inputGroupFile02">
                                            </button>
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-save me-2"></i>Upload
                                            </button>
                                        </div>
                                        <div class="form-text mt-2">
                                            <i class="fas fa-info-circle me-1"></i>Accepted formats: JPEG, PNG (Max: 1MB)
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST">
                    <!-- Personal Information Card -->
                    <div class="card settings-card">
                        <div class="settings-header">
                            <h5 class="mb-0"><i class="fas fa-user me-2"></i>Personal Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           value="<?php echo $user['username']; ?>" placeholder="Enter username">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo $user['email']; ?>" placeholder="Enter email">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password Card -->
                    <div class="card settings-card">
                        <div class="settings-header">
                            <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Change Password</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="current_pwd" class="form-label">Current Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        <input type="password" class="form-control" name="current_password" id="current_pwd">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_pwd')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="new_pwd" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" name="new_password" id="new_pwd">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_pwd')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="text-center mt-4 mb-5">
                        <button class="btn btn-primary btn-lg px-5" type="submit">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                    <h5>Success!</h5>
                    <p class="mb-0"><?php echo $success_message; ?></p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-circle text-danger fa-3x mb-3"></i>
                    <h5>Error</h5>
                    <p class="mb-0"><?php echo $error_message; ?></p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password toggle function
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;
            
            // Toggle icon
            const icon = event.currentTarget.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

        // Show modals
        <?php if (!empty($success_message)): ?>
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        <?php endif; ?>
    </script>
</body>
</html>
