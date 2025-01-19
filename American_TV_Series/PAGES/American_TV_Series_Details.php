<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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

// Get the movie ID from the URL
$tv_series_id = $_GET['id'];

// Fetch the movie details using the movie ID
$sql = "SELECT * FROM american_tv_series WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tv_series_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $tv_series = $result->fetch_assoc();
} else {
    echo "Series not found.";
    exit();
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TV Series Details</title>
    <?php include "../../header.php"?>
    <style>
        body {
            background-color: #0a1019;
            background-image: 
                linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9)),
                url('https://cdnjs.cloudflare.com/ajax/libs/cinema-icons/1.0.0/pattern.svg');
            background-size: 200px;
            color: #fff;
        }

        .card {
            background-color: rgba(25, 35, 55, 0.9) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(10px);
        }

        .card-body {
            color: #fff;
        }

        .series-title {
            color: #00ffcc;
            text-shadow: 0 0 10px rgba(0, 255, 204, 0.3);
        }

        .section-title {
            color: #4d79ff;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .series-info {
            background: linear-gradient(135deg, rgba(25, 35, 55, 0.9), rgba(40, 50, 70, 0.9));
        }

        .rating-badge {
            background-color: #00ffcc;
            color: #000;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
        }

        .genre-badge {
            background-color: #4d79ff;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
        }

        .season-badge {
            background-color: #ff6b6b;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
        }

        .cast-card {
            transition: transform 0.3s ease;
        }

        .cast-card:hover {
            transform: translateY(-5px);
        }

        .screenshot-img {
            transition: transform 0.3s ease;
            border: 3px solid transparent;
            height: 200px;
            object-fit: cover;
        }

        .screenshot-img:hover {
            transform: scale(1.05);
            border-color: #4d79ff;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #0a1019;
        }

        ::-webkit-scrollbar-thumb {
            background: #4d79ff;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include "../../nav_user.php" ?>

    <div class="container py-5">
        <!-- TV Series Title -->
        <h1 class="display-4 mb-5 series-title text-center">TV Series Details</h1>

        <!-- TV Series Info Section -->
        <div class="row g-4 mb-5">
            <!-- Series Poster -->
            <div class="col-md-3">
                <div class="card border-0 shadow-lg">
                    <img src="<?php echo htmlspecialchars($tv_series['img']); ?>" class="card-img-top" alt="Series Poster">
                </div>
            </div>

            <!-- Series Details -->
            <div class="col-md-5">
                <div class="card h-100 border-0 shadow-lg series-info">
                    <div class="card-body">
                        <h2 class="card-title h3 mb-4 series-title"><?php echo htmlspecialchars($tv_series['name']); ?></h2>
                        <p class="fs-5 mb-3"><strong>Year:</strong> <?php echo htmlspecialchars($tv_series['year']); ?></p>
                        <span class="genre-badge mb-3 d-inline-block"><?php echo htmlspecialchars($tv_series['genre']); ?></span>
                        <div class="mt-3 d-flex gap-2 flex-wrap">
                            <span class="rating-badge">Rating: <?php echo htmlspecialchars($tv_series['rating']); ?></span>
                            <span class="season-badge">Season: <?php echo htmlspecialchars($tv_series['season']); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Director & Cast -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-lg cast-card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h3 class="h5 mb-3 section-title">Director</h3>
                            <div class="d-flex align-items-center gap-2">
                                <img class="rounded-circle" src="" alt="" width="40" height="40">
                                <span class="fs-5"><?php echo htmlspecialchars($tv_series['director']); ?></span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h3 class="h5 mb-3 section-title">Cast</h3>
                            <div class="d-flex align-items-center gap-2">
                                <img class="rounded-circle" src="" alt="" width="40" height="40">
                                <span class="fs-5"><?php echo htmlspecialchars($tv_series['cast']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plot Section -->
        <div class="card border-0 shadow-lg mb-5">
            <div class="card-body">
                <h3 class="h2 mb-4 section-title">Plot</h3>
                <p class="fs-5"><?php echo htmlspecialchars($tv_series['summary']); ?></p>
            </div>
        </div>

        <!-- Screenshots Section -->
        <div class="card border-0 shadow-lg mb-5">
            <div class="card-body">
                <h3 class="h2 mb-4 section-title">Screenshots</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <img src="uploads/12 strong image 1.jpg" class="img-fluid rounded screenshot-img w-100" alt="Screenshot 1">
                    </div>
                    <div class="col-md-4">
                        <img src="uploads/12 strong image 2.jpg" class="img-fluid rounded screenshot-img w-100" alt="Screenshot 2">
                    </div>
                    <div class="col-md-4">
                        <img src="uploads/12 strong image 3.jpg" class="img-fluid rounded screenshot-img w-100" alt="Screenshot 3">
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <h3 class="h2 mb-4 section-title">Reviews</h3>
                <p class="fs-5"><?php echo htmlspecialchars($tv_series['reviews']); ?></p>
            </div>
        </div>
    </div>

    <?php include "../../footer.php" ?>

    
</body>
</html>