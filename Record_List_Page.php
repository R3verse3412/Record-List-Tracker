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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


</head>
<style>
    .bg {
        background-color: #181818;
    }

    body {
        background: #f2f4f8;
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        height: 100vh;
        font-family: "Open Sans";
    }

    .credentialing {
        --bg-color: #B8F9D3;
        --bg-color-light: #e2fced;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(184, 249, 211, 0.48);
    }

    .wallet {
        --bg-color: #CEB2FC;
        --bg-color-light: #F0E7FF;
        --text-color-hover: #fff;
        --box-shadow-color: rgba(206, 178, 252, 0.48);
    }

    .human-resources {
        --bg-color: #DCE9FF;
        --bg-color-light: #f1f7ff;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(220, 233, 255, 0.48);
    }

    .American_Movies{
        --bg-color:#DCE9FF;
        --bg-color-light: #f1f7ff;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(220, 233, 255, 0.48);
    }

    
    .American_TV_Series{
        --bg-color:#cf554b;
        --bg-color-light: #cf554b;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(207, 85, 75 );
    }

    .Anime_Movies {
        --bg-color: #307a55;
        --bg-color-light: #307a55;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(48, 122, 85);
    }


    .Anime_Series {
        --bg-color: #ffd861;
        --bg-color-light: #ffeeba;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(255, 215, 97, 0.48);
    }

    .Cartoon_Movies{
        --bg-color:#DCE9FF;
        --bg-color-light: #f1f7ff;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(220, 233, 255, 0.48);
    }

    .Cartoon_Series{
        --bg-color:#8dc9ee;
        --bg-color-light: #8dc9ee;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(141, 201, 238 );
    }

    .Games{
        --bg-color: #3f464e;
        --bg-color-light: #3f464e;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(63, 70, 78 );
    }

    .Manga{
        --bg-color: #0a0809;
        --bg-color-light: #0a0809;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(10, 8, 9);
    }

    
    .Manhwa{
        --bg-color: #ae9bc9;
        --bg-color-light: #ae9bc9;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(174, 155, 201);
    }

    .Manhwa_18{
        --bg-color: #e8c3b0;
        --bg-color-light: #e8c3b0;
        --text-color-hover: #4C5656;
        --box-shadow-color: rgba(232, 195, 176 );
    }

    .card {
        width: 220px;
        height: 321px;
        background: #fff;
        border-top-right-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        box-shadow: 0 14px 26px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease-out;
        text-decoration: none;
    }


    .card:hover {
        transform: translateY(-5px) scale(1.005) translateZ(0);
        box-shadow: 0 24px 36px rgba(0, 0, 0, 0.11),
            0 24px 46px var(--box-shadow-color);
    }

    .card:hover .overlay {
        transform: scale(4) translateZ(0);
    }

    .card:hover .circle {
        border-color: var(--bg-color-light);
        background: var(--bg-color);
    }

    .card:hover .circle:after {
        background: var(--bg-color-light);
    }

    .card:hover p {
        color: var(--text-color-hover);
    }

    .card:active {
        transform: scale(1) translateZ(0);
        box-shadow: 0 15px 24px rgba(0, 0, 0, 0.11),
            0 15px 24px var(--box-shadow-color);
    }

    .card p {
        font-size: 17px;
        color: #4C5656;
        margin-top: 30px;
        z-index: 1000;
        transition: color 0.3s ease-out;
    }

    .circle {
        width: 131px;
        height: 131px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid var(--bg-color);
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        z-index: 1;
        transition: all 0.3s ease-out;
    }

    .circle:after {
        content: "";
        width: 118px;
        height: 118px;
        display: block;
        position: absolute;
        background: var(--bg-color);
        border-radius: 50%;
        top: 7px;
        left: 7px;
        transition: opacity 0.3s ease-out;
    }

    .circle svg {
        z-index: 10000;
        transform: translateZ(0);
    }

    .overlay {
        width: 118px;
        position: absolute;
        height: 118px;
        border-radius: 50%;
        background: var(--bg-color);
        top: 70px;
        left: 50px;
        z-index: 0;
        transition: transform 0.3s ease-out;
    }

    .card.a,
    .card {
    text-decoration: none;
}

 
</style>

<body class="bg">

    <?php
 include "nav.php"
?>


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