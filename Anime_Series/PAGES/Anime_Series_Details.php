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
$anime_series_id = $_GET['id'];

// Fetch the movie details using the movie ID
$sql = "SELECT * FROM anime_series WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $anime_series_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $anime_series = $result->fetch_assoc();
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
    <title>Details</title>
    <?php include "../../header.php"?>
    <style>
         body {
            background-color: #1a1a2e;
            background-image: 
                linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9)),
                url('https://cdnjs.cloudflare.com/ajax/libs/cinema-icons/1.0.0/pattern.svg');
            background-size: 200px;
            color: #e6e6e6;
        }

        .card {
            background-color: rgba(25, 25, 45, 0.95) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(10px);
            height: auto;
            padding: 10px;
        }

        .card-body {
            color: #e6e6e6;
        }

        /* Title styling */
        .anime-title {
            color: #ff9ed2;
            text-shadow: 0 0 10px rgba(255, 158, 210, 0.3);
            font-size: 30px;
            font-weight: bold;
        }

        .section-title {
            color: #a596ff;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 30px;
            font-weight: bold;
        }

        /* Info card styling */
        .anime-info {
            background: linear-gradient(135deg, rgba(25, 25, 45, 0.95), rgba(35, 35, 60, 0.95));
        }

        /* Badge styling with better contrast */
        .rating-badge {
            background-color: #ff9ed2;
            color: #000;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
        }

        .genre-badge {
            background-color: #a596ff;
            color: #000;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            font-size: 20px;
        }

        .episodes-badge {
            background-color: #66d9ff;
            color: #000;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
        }

        /* Text colors */
        .year, .director {
            color: #e6e6e6;
            font-weight: bold;
            font-size: 18px;
        }

        .summary, .reviews {
            color: #e6e6e6;
            line-height: 1.6;
        }

        /* Rest of your styles remain the same */
        .studio-card {
            transition: transform 0.3s ease;
        }

        .studio-card:hover {
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
            border-color: #a596ff;
        }

        .section {
            min-height: 45vh;
            display: flex;
            position: relative;
            justify-content: center;
        }

        .card1 { width: 400px; }
        .card2 { width: 350px; }
        .card3 { width: 100%; max-width: 1100px; }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a2e;
        }

        ::-webkit-scrollbar-thumb {
            background: #a596ff;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .card, .card1, .card2, .card3 {
                width: 100%;
                max-width: none;
            }

            .card2 {
                height: auto;
            }

            body {
                text-align: center;
            }

            .section {
                flex-direction: column;
                align-items: center;
            }

            .row {
                flex-direction: column;
            }

            .col-md-3, .col-md-5, .col-md-1 {
                width: 100%;
                margin-bottom: 20px;
            }

            .screenshot {
                display: none;
            }

            .card-screenshot {
                display: none;
            }
        }
    </style>
</head>
<body>
    <?php include "../../nav_user.php" ?>

    <section class="section mb-5">
        <div class="container">
            <div class="row">
                <p class="anime-title">ANIME SERIES DETAILS</p>
                <!-- Anime Poster -->
                <div class="col-md-3">
                    <div class="card card-pics">
                        <img src="<?php echo htmlspecialchars($anime_series['img']); ?>" class="img-fluid" alt="Anime Poster">
                    </div>
                </div>

                <!-- Anime Details -->
                <div class="col-md-5">
                    <div class="card shadow card1 anime-info">
                        <div class="card-body">
                            <div class="anime-title mb-4"><?php echo htmlspecialchars($anime_series['name']); ?></div>
                            <div class="year mb-2"><?php echo htmlspecialchars($anime_series['year']); ?></div>
                            <div class="genre-badge mb-2"><?php echo htmlspecialchars($anime_series['genre']); ?></div>
                            <div class="rating-badge">Ratings: <?php echo htmlspecialchars($anime_series['rating']); ?></div>
                        </div>
                    </div>
                </div>

                <!-- Studio & Episodes -->
                <div class="col-md-4">
                    <div class="card shadow card2 studio-card">
                        <div class="card-body">
                            <div class="director mb-3">Studio</div>
                            <span class="genre-badge mb-3"><?php echo htmlspecialchars($anime_series['studio']); ?></span>
                            <div class="director mb-3 mt-4">Episodes</div>
                            <span class="episodes-badge"><?php echo htmlspecialchars($anime_series['episodes']); ?> Episodes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Plot Section -->
    <section class="section mb-5">
        <div class="container">
            <div class="card shadow card3">
                <div class="card-body">
                    <div class="section-title mb-3">Plot</div>
                    <div class="summary fs-5 text-white"><?php echo htmlspecialchars($anime_series['summary']); ?></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Screenshots Section -->
    <section class="section mb-5">
        <div class="container">
            <div class="card shadow card-screenshot">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <img class="screenshot screenshot-img" src="uploads/12 strong image 1.jpg" alt="">
                    </div>
                    <div class="col d-flex justify-content-center">
                        <img class="screenshot screenshot-img" src="uploads/12 strong image 2.jpg" alt="">
                    </div>
                    <div class="col d-flex justify-content-center">
                        <img class="screenshot screenshot-img" src="uploads/12 strong image 3.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="section mb-5">
        <div class="container">
            <div class="card">
                <div class="section-title">REVIEWS</div>
                <div class="fs-5 reviews text-white"><?php echo htmlspecialchars($anime_series['reviews']); ?></div>
            </div>
        </div>
    </section>

    <?php include "../../footer.php" ?>
</body>
</html>