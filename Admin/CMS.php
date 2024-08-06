<?php
session_start();

// Check if the user is logged in and is an admin
if (!(isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)) {
    header("Location: admin_login.php"); // Redirect if not an admin
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

// Fetch the homepage content
$sql = "SELECT * FROM homepage_content WHERE id = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Initialize variables to avoid undefined index warnings
$title = '';
$genre = '';
$about = '';

if ($row) {
    $title = $row['title'];
    $genre = $row['genre'];
    $about = $row['about'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_file_id'])) {
        // Handle file deletion
        $file_id = $_POST['delete_file_id'];
        $stmt = $conn->prepare("DELETE FROM uploads WHERE id = ?");
        $stmt->bind_param("i", $file_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Handle other form submissions
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $about = $_POST['about'];

        // Handle file uploads
        if (isset($_FILES['uploads']) && is_array($_FILES['uploads']['name'])) {
            $upload_dir = 'uploads/';
            foreach ($_FILES['uploads']['name'] as $index => $filename) {
                if ($_FILES['uploads']['error'][$index] == UPLOAD_ERR_OK) {
                    $upload_file = $upload_dir . basename($filename);
                    move_uploaded_file($_FILES['uploads']['tmp_name'][$index], $upload_file);
                    $upload_text = $_POST['upload_text'][$index];

                    // Save file path and upload text in the database
                    $stmt = $conn->prepare("INSERT INTO uploads (file_path, upload_text) VALUES (?, ?)");
                    $stmt->bind_param("ss", $upload_file, $upload_text);
                    $stmt->execute();
                }
            }
            $stmt->close();
        }

        // Update the homepage content
        if ($row) {
            $stmt = $conn->prepare("UPDATE homepage_content SET title = ?, genre = ?, about = ? WHERE id = 1");
            $stmt->bind_param("sss", $title, $genre, $about);
        } else {
            $stmt = $conn->prepare("INSERT INTO homepage_content (title, genre, about) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $genre, $about);
        }
        $stmt->execute();
        $stmt->close();
    }

    // Refresh the page to show updated content
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$upload_sql = "SELECT id, file_path, upload_text FROM uploads";
$upload_result = $conn->query($upload_sql);
$uploads = [];
if ($upload_result->num_rows > 0) {
    while ($upload_row = $upload_result->fetch_assoc()) {
        $uploads[] = $upload_row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Include your CSS and JS files -->
    <?php include "../header.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="Admin.css">
</head>

<body id="body-pd">
    <?php include "Sidebar.php"; ?>
    <div class="height-100 bg-light">
        <h1 class="text-header mb-5">Content Management</h1>
        <form method="POST" enctype="multipart/form-data">
            <p class="text-header">Title:</p>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($title); ?>" aria-label="Title" aria-describedby="basic-addon1">
            </div>
            <p class="text-header">Genre:</p>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" name="genre" value="<?php echo htmlspecialchars($genre); ?>" aria-label="Genre" aria-describedby="basic-addon1">
            </div>
            <p class="text-header">Upcoming To Watch:</p>
            <div class="mb-3">
                <button type="button" class="btn btn-success" id="add-new-upload">Add New</button>
            </div>
            <div id="uploads-container">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile02" name="uploads[]">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" name="upload_text[]" value="">

                </div>
            </div>
            <div class="mb-3">
                
    <!-- Display uploaded files with delete buttons -->
<h2>Uploaded Files</h2>
<?php foreach ($uploads as $upload): ?>
    <div class="upload-item">
        <span><?php echo htmlspecialchars($upload['file_path']); ?> - <?php echo htmlspecialchars($upload['upload_text']); ?></span>
        <form method="POST" style="display:inline;">
            <input type="hidden" name="delete_file_id" value="<?php echo $upload['id']; ?>">
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
    </div>
<?php endforeach; ?>

            </div>
            <p class="text-header">About:</p>
            <div class="mb-3">
                <textarea class="form-control" name="about" rows="3"><?php echo htmlspecialchars($about); ?></textarea>
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </form>
    </div>
    <script src="Admin.js"></script>
    <script>
        document.getElementById('add-new-upload').addEventListener('click', function () {
            var uploadsContainer = document.getElementById('uploads-container');
            var newUploadDiv = document.createElement('div');
            newUploadDiv.classList.add('input-group', 'mb-3');
            newUploadDiv.innerHTML = `
                <input type="file" class="form-control" id="inputGroupFile02" name="uploads[]">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" name="upload_text[]" value="">`;
            uploadsContainer.appendChild(newUploadDiv);
        });
    </script>
</body>

</html>
