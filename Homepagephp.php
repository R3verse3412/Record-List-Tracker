<?php
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
$title = 'Record List Tracker';
$genre = 'Anime • Manga • Movies • Manhwa • Series';
$about = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Error eveniet aperiam qui recusandae dolorem. Quaerat quas quisquam necessitatibus aperiam illo, sed ea voluptatum dolorem omnis? Amet beatae magni non dolore.';

if ($row) {
    $title = $row['title'];
    $genre = $row['genre'];
    $about = $row['about'];
}

// Fetch the uploads content
$upload_sql = "SELECT file_path, upload_text FROM uploads";
$upload_result = $conn->query($upload_sql);
$uploads = [];
if ($upload_result->num_rows > 0) {
    while ($upload_row = $upload_result->fetch_assoc()) {
        $uploads[] = $upload_row;
    }
}

?>