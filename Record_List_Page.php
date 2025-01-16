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
$sql = "SELECT username FROM users WHERE id = ?";
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
    <title>Record List</title>
    <?php include "header.php" ?>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="Record_List_Page_1.css" rel="stylesheet">
</head>
<style>
      body {
            background-color: #f8f9fa;
        }
        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .card-img-wrapper {
            background-color: #f8f9fa;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px;
        }
        .card-img-wrapper img {
            max-height: 120px;
            width: auto;
            object-fit: contain;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            text-align: center;
            color: #2c3e50;
            margin: 1rem 0;
        }
        .section-title {
            color: #2c3e50;
            margin-bottom: 2rem;
            font-weight: 700;
        }
        .main-container {
            padding: 4rem 0;
        }
</style>

<body class="bg">

    <?php include "nav.php" ?>

    <div class="container main-container">
        <h1 class="text-center section-title mb-5 text-white">Entertainment Categories</h1>
        
        <div class="row g-4">
            <!-- American Movies -->
            <div class="col-sm-6 col-lg-3">
                <a href="American_Movies/PAGES/American_Movies.php" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-img-wrapper">
                            <img src="img/Folder-Movie-icon.png" alt="American Movies" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">American Movies</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- American TV Series -->
            <div class="col-sm-6 col-lg-3">
                <a href="American_TV_Series/PAGES/American_TV_Series.php" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-img-wrapper">
                            <img src="img/tv-series-icon-13.png" alt="American TV Series" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">American TV Series</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Anime Movies -->
            <div class="col-sm-6 col-lg-3">
                <a href="Anime_Movies/PAGES/Anime_Movies.php" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-img-wrapper">
                            <img src="img/Deku.png" alt="Anime Movies" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Anime Movies</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Anime Series -->
            <div class="col-sm-6 col-lg-3">
                <a href="Anime_Series/PAGES/Anime_Series.php" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-img-wrapper">
                            <img src="img/naruto_circle_icon_by_knives_by_knives1024_d78ur8v-250t.png" alt="Anime Series" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Anime Series</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Cartoon Movies -->
            <div class="col-sm-6 col-lg-3">
                <a href="Cartoon_Movies/PAGES/Cartoon_Movies.php" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-img-wrapper">
                            <img src="img/duck.png" alt="Cartoon Movies" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Cartoon Movies</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Cartoon Series -->
            <div class="col-sm-6 col-lg-3">
                <a href="Cartoon_Series/PAGES/Cartoon_Series.php" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-img-wrapper">
                            <img src="img/Adventure Time.png" alt="Cartoon Series" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Cartoon Series</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Games -->
            <div class="col-sm-6 col-lg-3">
                <a href="Games/PAGES/Games.php" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-img-wrapper">
                            <img src="img/COD.png" alt="Games" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Games</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Manga -->
            <div class="col-sm-6 col-lg-3">
                <a href="Manga/PAGES/Manga.php" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-img-wrapper">
                            <img src="img/Saitama.png" alt="Manga" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Manga</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Manhwa -->
            <div class="col-sm-6 col-lg-3">
                <a href="Manhwa/PAGES/Manhwa.php" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-img-wrapper">
                            <img src="img/Solo Leveling.png" alt="Manhwa" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Manhwa</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Manhwa 18 -->
            <div class="col-sm-6 col-lg-3">
                <a href="Manhwa_18/PAGES/Manhwa_18.php" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-img-wrapper">
                            <img src="img/Young Boss.png" alt="Manhwa 18" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Manhwa 18+</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php include "Footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>