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
$games_id = $_GET['id'];

// Fetch the movie details using the movie ID
$sql = "SELECT * FROM games WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $games_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $games = $result->fetch_assoc();
} else {
    echo "Games not found.";
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
</head>
<style>
   .card {
    height: auto;
    padding: 10px;
}

.card1 {
    width: 400px;
}

.card2 {
    width: 350px;
}

.card3 {
    width: 100%;
    max-width: 1100px;
}

.name {
    font-size: 30px;
    font-weight: bold;
}

.section {
    min-height: 45vh;
    display: flex;
    position: relative;
    justify-content: center;
}

.icons-card {
    border-radius: 50px;
}

.cast, .director, .year, .ratings  {
    font-weight: bold;
    font-size: 18px;
}

.genre{
    font-weight: bold;
    font-size: 20px;
}

.plot {
    font-size: 30px;
    font-weight: bold;
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

    .screenshot{
       display: none;
    }

    .card-screenshot{
        display: none;
    }
}

.screenshot{
    width: 300px;
    height: 200px;
}
</style>
<body >
    <?php include "../../nav_user.php" ?>

    <section class="section mb-5">
        <div class="container">
        <div class="row">
            <p class="name">GAMES DETAILS</p>
            <div class="col-md-3">
                <div class="card shadow card-pics">
                    <img src="<?php echo htmlspecialchars($games ['img']); ?>" alt="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="card shadow card1">
                    <div class="card-body">
                    <div class="name mb-4"><?php echo htmlspecialchars($games ['name']); ?></div>
                    <div class="year mb-2"><?php echo htmlspecialchars($games ['year']); ?></div>
                    <div class="genre mb-2"><?php echo htmlspecialchars($games ['genre']); ?></div>
                    <div class="ratings">Ratings: <span><?php echo htmlspecialchars($games ['rating']); ?></p></div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="card shadow card2">
                <div class="card-body">
                <div class="director mb-3">Pulisher</div>
                <img class="icons-card" src="" alt="">
                <span><?php echo htmlspecialchars($games ['publisher']); ?></p>
                <div class="cast mb-3">Developer</div>
                <img class="icons-card" src="" alt="">
                <span><?php echo htmlspecialchars($games ['studio']); ?> Episodes</p>
                <div class="cast mb-3">Device</div>
                <img class="icons-card" src="" alt="">
                <span><?php echo htmlspecialchars($games ['device']); ?> Episodes</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>

        <section class="section mb-5">
            <div class="container">
                <div class="card shadow card3">
                    <div class="card-body">
                    <div class="plot mb-3">Plot</div>
                    <div class="summary"><?php echo htmlspecialchars($games ['summary']); ?></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section mb-5">
            <div class="container">
            <div class="card shadow card-screenshot">
                <div class="row">
               
                    <div class="col d-flex justify-content-center">
                     
                        <img class="screenshot" src="uploads/12 strong image 1.jpg" alt="">
                       
                    </div>
                    <div class="col d-flex justify-content-center">
                 
                        <img class="screenshot" src="uploads/12 strong image 2.jpg" alt="">
                    
                    </div>
                    <div class="col d-flex justify-content-center">
                    
                        <img class="screenshot" src="uploads/12 strong image 3.jpg" alt="">
                     
                    </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
        <div class="container">
            <div class="plot">REVIEWS</div>
                    <div class="fs-5 reviews"><?php echo htmlspecialchars($games['reviews']); ?></div>
                    </div>
            </div>
        </section>

        <?php include "../../footer.php" ?>
</body>
</html>