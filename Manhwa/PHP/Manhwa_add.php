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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $status = $_POST['status'] ?? '';
    $release_date = $_POST['release_date'] ?? '';
    $description = $_POST['description'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $user_id = $_SESSION['user_id']; // Retrieve user ID from session

    // Handle file upload
    if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img_name = $_FILES['img']['name'];
        $img_tmp_name = $_FILES['img']['tmp_name'];

        // Ensure the uploads directory exists
        $upload_dir = '../../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory recursively with full permissions
        }

        // Move uploaded file to desired location
        $img_path = $upload_dir . $img_name;

        if (move_uploaded_file($img_tmp_name, $img_path)) {
            // File successfully uploaded, continue with your SQL insert
            $sql = "INSERT INTO manhwa (user_id, title, author, genre, status, release_date, description, rating, img, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("issssisss",$user_id, $title, $author, $genre, $status, $release_date, $description, $rating, $img_path);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Manhwa added successfully!";
                header("Location: Manhwa.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            // Close statement
            $stmt->close();

        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "File upload failed with error code: " . $_FILES['img']['error'];
    }
}

// Close connection
$conn->close();
?>
