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
$movie_id = $_GET['id'];

// Fetch the movie details using the movie ID
$sql = "SELECT * FROM american_movies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $movie = $result->fetch_assoc();
} else {
    echo "Movie not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<?php
// Process the screenshots data
$screenshots_arr = [];

if (!empty($movie['screenshots'])) {
    // Assuming screenshots are stored as a semicolon-separated string
    $screenshots_arr = explode(';', $movie['screenshots']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
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

        .movie-title {
            color: #ffd700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }

        .section-title {
            color: #ff4d4d;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .movie-info {
            background: linear-gradient(135deg, rgba(25, 35, 55, 0.9), rgba(40, 50, 70, 0.9));
        }

        .rating-badge {
            background-color: #ffd700;
            color: #000;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
        }

        .genre-badge {
            background-color: #ff4d4d;
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
        }

        .screenshot-img:hover {
            transform: scale(1.05);
            border-color: #ff4d4d;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #0a1019;
        }

        ::-webkit-scrollbar-thumb {
            background: #ff4d4d;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include "../../nav_user.php" ?>

    <div class="container py-5">
        <!-- Movie Title -->
        <h1 class="display-4 mb-5 movie-title text-center">Movie Details</h1>

        <!-- Movie Info Section -->
        <div class="row g-4 mb-5">
            <!-- Movie Poster -->
            <div class="col-md-3">
                <div class="card border-0 shadow-lg">
                    <img src="<?php echo htmlspecialchars($movie['img']); ?>" class="card-img-top" alt="Movie Poster">
                </div>
            </div>

            <!-- Movie Details -->
            <div class="col-md-5">
                <div class="card h-100 border-0 shadow-lg movie-info">
                    <div class="card-body">
                        <h2 class="card-title h3 mb-4 movie-title"><?php echo htmlspecialchars($movie['name']); ?></h2>
                        <p class="fs-5 mb-3"><strong>Year:</strong> <?php echo htmlspecialchars($movie['year']); ?></p>
                        <span class="genre-badge mb-3 d-inline-block"><?php echo htmlspecialchars($movie['genre']); ?></span>
                        <div class="mt-3">
                            <span class="rating-badge">Rating: <?php echo htmlspecialchars($movie['rating']); ?></span>
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
                                <span class="fs-5"><?php echo htmlspecialchars($movie['director']); ?></span>
                            </div>
                        </div>
                        <div>
                            <h3 class="h5 mb-3 section-title">Cast</h3>
                            <div class="d-flex align-items-center gap-2">
                                <img class="rounded-circle" src="" alt="" width="40" height="40">
                                <span class="fs-5"><?php echo htmlspecialchars($movie['cast']); ?></span>
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
                <p class="fs-5"><?php echo htmlspecialchars($movie['summary']); ?></p>
            </div>
        </div>

        <!-- Screenshots Section -->
        <div class="card border-0 shadow-lg mb-5">
            <div class="card-body">
                <h3 class="h2 mb-4 section-title">Screenshots</h3>
                <div class="row g-4">
                    <?php if (!empty($screenshots_arr)): ?>
                        <?php foreach ($screenshots_arr as $screenshot): ?>
                            <div class="col-6 col-md-3">
                                <img src="<?php echo htmlspecialchars($screenshot); ?>" 
                                     class="img-fluid rounded screenshot-img" 
                                     alt="Movie Screenshot">
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <p class="text-muted">No screenshots available.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <h3 class="h2 mb-4 section-title">Reviews</h3>
                <p class="fs-5"><?php echo htmlspecialchars($movie['reviews']); ?></p>
            </div>
        </div>
    </div>

    <?php include "../../footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>