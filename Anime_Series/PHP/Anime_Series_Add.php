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
    $name = $_POST['name'];
    $summary = $_POST['summary'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $episodes = $_POST['episodes'];
    $studio = $_POST['studio'];
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
            $sql = "INSERT INTO anime_series (user_id, name, summary, year, genre, rating, img, episodes, studio, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("ississsis",$user_id, $name, $summary, $year, $genre, $rating, $img_path, $episodes, $studio);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Series added successfully!";
                header("Location: Anime_Series.php");
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
