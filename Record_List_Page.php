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

<body class="bg">

    <?php include "nav.php" ?>

    <section class="section">
        <div class="container ">
            <div class="row ">
                <div class="col mb-5 d-flex justify-content-center">
                    <a href="American_Movies/PAGES/American_Movies.php" class="card a American_Movies">
                        <div class="overlay"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="131" height="131" viewBox="0 0 131 131">

                                <image href="img/Folder-Movie-icon.png"
                                    width="131" height="121"  />
                            </svg>
                        </div>
                        <p>American Movies</p>
                    </a>
                </div>
                <div class="col mb-5 d-flex justify-content-center">
                    <a href="American_TV_Series/PAGES/American_TV_Series.php" class="card a American_TV_Series">
                        <div class="overlay"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="131" height="131" viewBox="0 0 131 131">

                                <image href="img/tv-series-icon-13.png"
                                    width="131" height="121"  />
                            </svg>
                        </div>
                        <p>American TV Series</p>
                    </a>
                </div>
                <div class="col mb-5 d-flex justify-content-center">
                    <a href="Anime_Movies/PAGES/Anime_Movies.php" class="card a Anime_Movies">
                        <div class="overlay"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="131" height="131" viewBox="0 0 131 131">
                                <image href="img/Deku.png"
                                    width="131" height="121"  />
                            </svg>
                        </div>
                        <p>Anime Movies</p>
                    </a>
                </div>
                <div class="col mb-5 d-flex justify-content-center">
                    <a href="Anime_Series/PAGES/Anime_Series.php" class="card a Anime_Series">
                        <div class="overlay"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="131" height="131" viewBox="0 0 131 131">

                                <image href="img/naruto_circle_icon_by_knives_by_knives1024_d78ur8v-250t.png"
                                    width="131" height="121"  />
                            </svg>
                        </div>
                        <p>Anime Series</p>
                    </a>
                </div>
              
            </div>
            <div class="row">
            <div class="col mb-5 d-flex justify-content-center">
                    <a href="Cartoon_Movies/PAGES/Cartoon_Movies.php" class="card a Cartoon_Movies">
                        <div class="overlay"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="131" height="131" viewBox="0 0 131 131">

                                <image href="img/duck.png"
                                    width="131" height="121"  />
                            </svg>
                        </div>
                        <p>Cartoon Movies</p>
                    </a>
                </div>
                <div class="col mb-5 d-flex justify-content-center">
                    <a href="Cartoon_Series/PAGES/Cartoon_Series.php" class="card a Cartoon_Movies">
                        <div class="overlay"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="131" height="131" viewBox="0 0 131 131">

                                <image href="img/Adventure Time.png"
                                    width="131" height="121"  />
                            </svg>
                        </div>
                        <p>Cartoon Series</p>
                    </a>
                </div>
                <div class="col mb-5 d-flex justify-content-center">
                    <a href="Games/PAGES/Games.php" class="card a Games">
                        <div class="overlay"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="131" height="131" viewBox="0 0 131 131">

                                <image href="img/COD.png"
                                    width="131" height="121"  />
                            </svg>
                        </div>
                        <p>Games</p>
                    </a>
                </div>
                <div class="col mb-5 d-flex justify-content-center">
                    <a href="Manga/PAGES/Manga.php" class="card a Manga">
                        <div class="overlay"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="131" height="131" viewBox="0 0 131 131">

                                <image href="img/Saitama.png"
                                    width="131" height="121"  />
                            </svg>
                        </div>
                        <p>Manga</p>
                    </a>
                </div>
              
                </div>
                <div class="row justify-content-center align-item-center">
                <div class="col-md-auto mb-5 d-flex justify-content-center">
                    <a href="Manhwa/PAGES/Manhwa.php" class="card a Manhwa">
                        <div class="overlay"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="131" height="131" viewBox="0 0 131 131">

                                <image href="img/Solo Leveling.png"
                                    width="131" height="121"  />
                            </svg>
                        </div>
                        <p>Manhwa</p>
                    </a>
                </div>
                <div class="col-md-auto mb-5 d-flex justify-content-center ">
                    <a href="Manhwa_18/PAGES/Manhwa_18.php" class="card a Manhwa_18">
                        <div class="overlay"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="131" height="131" viewBox="0 0 131 131">

                                <image href="img/Young Boss.png"
                                    width="131" height="121"  />
                            </svg>
                        </div>
                        <p>Manhwa 18</p>
                    </a>
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