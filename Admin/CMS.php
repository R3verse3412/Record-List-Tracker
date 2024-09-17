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
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $about = $_POST['about'];

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

    // Refresh the page to show updated content
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <?php include "../header.php"; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="Admin.css">
</head>

<body id="body-pd">
    <?php include "Sidebar.php"; ?>
    <div class="height-100 bg-light">
        <div class="container py-5">
            <h1 class="mb-5">Content Management</h1>
            <form method="POST" class="needs-validation" novalidate>
                <div class="mb-4">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
                    <div class="invalid-feedback">
                        Please provide a title.
                    </div>
                </div>
                <div class="mb-4">
                    <label for="genre" class="form-label">Genre:</label>
                    <input type="text" class="form-control" id="genre" name="genre" value="<?php echo htmlspecialchars($genre); ?>" required>
                    <div class="invalid-feedback">
                        Please provide a genre.
                    </div>
                </div>
                <div class="mb-4">
                    <label for="about" class="form-label">About:</label>
                    <textarea class="form-control" id="about" name="about" rows="5" required><?php echo htmlspecialchars($about); ?></textarea>
                    <div class="invalid-feedback">
                        Please provide content for the about section.
                    </div>
                </div>
                <div class="d-grid gap-2 col-2 mx-auto">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    <script src="Admin.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>