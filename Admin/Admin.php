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

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch total records for different categories
$categories = [
    'american_movies' => 'American Movies',
    'american_tv_series' => 'American Series',
    'anime_movies' => 'Anime Movies',
    'anime_series' => 'Anime Series',
    'cartoon_movies' => 'Cartoon Movies',
    'cartoon_series' => 'Cartoon Series',
    'games' => 'Games',
    'manga' => 'Manga',
    'manhwa' => 'Manhwa',
    'manhwa_18' => 'Manhwa_18'
   
];

foreach ($categories as $table => $label) {
    $count_sql = "SELECT COUNT(*) as count FROM $table";
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $row_count = $count_result->fetch_assoc();
    ${"total_$table"} = $row_count['count'];
    $count_stmt->close();
}

// Close the connection here to ensure it is closed only after all interactions
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title> 
    <?php include "../header.php"; ?>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="Admin.css">
   
</head>
<body id="body-pd">
    <?php include "Sidebar.php"; ?>
    <!--Container Main start-->
    <div class="height-100 bg-light">
     

        <div class="container mb-5">
            <h1>Dashboard</h1>
        </div>

        <div class="container mb-5">
    <div class="row mb-5">
        <?php 
        $cards_per_column = 4; // Number of cards per column
        $counter = 0; // Initialize card counter
        $bg_classes = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-secondary']; // Array of Bootstrap background classes

        foreach ($categories as $table => $label) { 
            if ($counter % $cards_per_column == 0) {
                // Start a new row after every 4 cards
                if ($counter > 0) {
                   
                }
            }
            $bg_class = $bg_classes[$counter % count($bg_classes)]; // Get a class from the array
            $counter++;
        ?>
            <div class="col-md-3 mb-3"> <!-- Use col-md-3 for a 4-card per row layout -->
                <div class="card">
                    <div class="card-header d-flex justify-content-center text-white <?php echo $bg_class; ?>">
                        <h5 class="text-header"><?php echo htmlspecialchars($label); ?></h5>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <h2 class="number-header"><?php echo ${"total_$table"}; ?></h2>
                    </div>
                    <div class="card-footer <?php echo $bg_class; ?>"></div>
                </div>
            </div>
                <?php 
                    $counter++;
                } 
                ?>
            </div>
        </div>
    </div>
    </div>
    <script src="Admin.js"></script>
</body>
</html>
