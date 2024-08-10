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
    <?php
    include "header.php"
    ?>
   
</head>
<style>
    .bg{
        background-color: #181818;
    }
    
</style>
<body class="bg">

<?php
 include "nav.php"
?>

   
<section class="section">
    <div class="container">
        <div class="row mb-5">
            <div class="col mb-5 d-flex justify-content-center">
        <div class="card img" style="width: 18rem;">
            <img class="card-img-top card-img-fluid" src="img/1917.png" alt="Card image cap" style=" height: 420px;">
            <div class="card-body">
                <h5 class="card-title text-center">American Movies</h5>
                <div class="mb-2">
                <a href="American_Movies/PAGES/American_Movies.php" class="btn btn-primary d-flex justify-content-center">OPEN</a>
                </div>
            </div>
        </div>
        </div>
        <div class="col mb-5 d-flex justify-content-center">
        <div class="card img" style="width: 18rem;">
            <img class="card-img-top" src="img/breaking bad.jpg" alt="Card image cap" style=" height: 420px;">
            <div class="card-body">
                <h5 class="card-title text-center">American TV Series</h5>
                <div class="mb-2">
                <a href="American_TV_Series/PAGES/American_TV_Series.php" class="btn btn-primary d-flex justify-content-center">OPEN</a>
                </div>
            </div>
        </div>
        </div>
        <div class="col mb-5 d-flex justify-content-center">
        <div class="card img" style="width: 18rem;">
            <img class="card-img-top" src="img/Your Name.jpg" alt="Card image cap" style=" height: 420px;">
            <div class="card-body">
            <h5 class="card-title text-center">Anime Movies</h5>
            <div class="mb-2">
                <a href="Anime_Movies/PAGES/Anime_Movies.php" class="btn btn-primary d-flex justify-content-center">OPEN</a>
            </div>
            </div>
        </div>
        </div>
        </div>
        </section>
        <section class="section">
            <div class="container">
        <div class="row mb-5">
        <div class="col mb-5 d-flex justify-content-center">
        <div class="card img" style="width: 18rem;">
            <img class="card-img-top" src="img/jjk.jpg" alt="Card image cap" style=" height: 420px;">
            <div class="card-body">
            <h5 class="card-title text-center">Anime Series</h5>
            <div class="mb-2">
                <a href="Anime_Series/PAGES/Anime_Series.php" class="btn btn-primary d-flex justify-content-center">OPEN</a>
            </div>
            </div>
        </div>
        </div>
        <div class="col mb-5 d-flex justify-content-center">
        <div class="card img" style="width: 18rem;">
            <img class="card-img-top" src="img/Inside Out 2.jpg" alt="Card image cap" style=" height: 420px;">
            <div class="card-body">
            <h5 class="card-title text-center">Cartoon Movies</h5>
            <div class="mb-2">
                <a href="Cartoon_Movies/PAGES/Cartoon_Movies.php" class="btn btn-primary d-flex justify-content-center">OPEN</a>
            </div>
            </div>
        </div>
        </div>
        <div class="col mb-5 d-flex justify-content-center">
        <div class="card img" style="width: 18rem;">
            <img class="card-img-top" src="img/Avatar The last airender.jpg" alt="Card image cap" style=" height: 420px;">
            <div class="card-body">
            <h5 class="card-title text-center">Cartoon Series</h5>
            <div class="mb-2">
                <a href="Cartoon_Series/PAGES/Cartoon_Series.php" class="btn btn-primary d-flex justify-content-center">OPEN</a>
            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </section>
        <section class="section">
        <div class="container">
        <div class="row mb-5">
        <div class="col mb-5 d-flex justify-content-center">
        <div class="card img" style="width: 18rem;">
            <img class="card-img-top" src="img/Call Of Duty.jpg" alt="Card image cap"  style=" height: 420px;">
            <div class="card-body">
            <h5 class="card-title text-center">Games</h5>
            <div class="mb-2">
                <a href="Games/PAGES/Games.php" class="btn btn-primary d-flex justify-content-center">OPEN</a>
            </div>
            </div>
        </div>
</div>
        <div class="col mb-5 d-flex justify-content-center">
        <div class="card img" style="width: 18rem;">
            <img class="card-img-top" src="img/OPM.jpg" alt="Card image cap"  style=" height: 420px;">
            <div class="card-body">
            <h5 class="card-title text-center">Manga</h5>
            <div class="mb-2">
                <a href="Manga/PAGES/Manga.php" class="btn btn-primary d-flex justify-content-center">OPEN</a>
            </div>
            </div>
        </div>
        </div>
        <div class="col mb-5 d-flex justify-content-center">
        <div class="card img" style="width: 18rem;">
            <img class="card-img-top" src="img/Solo Leveling.jpg" alt="Card image cap"  style=" height: 420px;">
            <div class="card-body">
            <h5 class="card-title text-center">Manhwa</h5>
            <div class="mb-2">
                <a href="Manhwa/PAGES/Manhwa.php" class="btn btn-primary d-flex justify-content-center">OPEN</a>
            </div>
            </div>
        </div>
        </div>
        </div>
        </section>
        <section class="section">
        <div class="container">
        <div class="col mb-5 d-flex justify-content-center">
        <div class="card img" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title text-center">Manhwa 18</h5>
            <div class="mb-2">
                <a href="Manhwa_18/PAGES/Manhwa_18.php" class="btn btn-primary d-flex justify-content-center">OPEN</a>
            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </section>
        
      

        </div>
    </div>
  <?php
    include "Footer.php"
  ?>
</body>

</html>