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

// Fetch total records for American Movies
$count_sql = "SELECT COUNT(*) as count FROM american_movies WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_american_movies = $row_count['count'];
$count_stmt->close();

// Fetch total records for American TV Series
$count_sql = "SELECT COUNT(*) as count FROM american_tv_series WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_american_tv_series = $row_count['count'];
$count_stmt->close();


// Fetch total records for American Movies
$count_sql = "SELECT COUNT(*) as count FROM anime_movies WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_anime_movies = $row_count['count'];
$count_stmt->close();

// Fetch total records for Anime Series
$count_sql = "SELECT COUNT(*) as count FROM anime_series WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_anime_series = $row_count['count'];
$count_stmt->close();

// Fetch total records for Cartoon Movies
$count_sql = "SELECT COUNT(*) as count FROM cartoon_movies WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_cartoon_movies = $row_count['count'];
$count_stmt->close();

// Fetch total records for Cartoon Series
$count_sql = "SELECT COUNT(*) as count FROM cartoon_series WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_cartoon_series = $row_count['count'];
$count_stmt->close();

// Fetch total records for Games
$count_sql = "SELECT COUNT(*) as count FROM games WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_games = $row_count['count'];
$count_stmt->close();

// Fetch total records for Manga
$count_sql = "SELECT COUNT(*) as count FROM manga WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_manga = $row_count['count'];
$count_stmt->close();

// Fetch total records for Manga
$count_sql = "SELECT COUNT(*) as count FROM manhwa WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_manhwa = $row_count['count'];
$count_stmt->close();

// Fetch total records for Manga
$count_sql = "SELECT COUNT(*) as count FROM manhwa_18 WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$row_count = $count_result->fetch_assoc();
$total_manhwa_18 = $row_count['count'];
$count_stmt->close();




$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include "header.php"; ?>
</head>
<style>

    .card-title{
        font-size: 20px;
    }

    .text-header {
        font-size: 40px;
        font-family: bold;
    }

    .text-body {

        font-size: 20px;
        color: #fff;
       

        /* Light grey background */
        border-radius: 5px;
        /* Rounded corners */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      
    }

    .card-header {
        font-size: 20px;
    }

    .card-footer {
        text-align: center;
    }

    #tags {
        text-decoration: none;
        color:none;
    }
    .gradient-1 {
        background: linear-gradient(to bottom, #ee9ca7 , #ffdde1);
        color: #fff;
    }

    .gradient-2 {
        background: linear-gradient(to bottom, #cc2b5e , #753a88);
        color: #fff;
    }

    .gradient-3 {
    background: linear-gradient(to bottom, #2193b0 , #6dd5ed);
    color: #333;
    }

    .gradient-4 {
    background: linear-gradient(to bottom, #ffafbd , #ffc3a0);
    color: #333;
    }

    .gradient-5 {
    background: linear-gradient(to bottom,  #42275a , #734b6d);
    color: #333;
    }

    .gradient-6 {
    background: linear-gradient(to bottom,  #bdc3c7 , #2c3e50);
    color: #333;
    }

    .gradient-7 {
    background: linear-gradient(to bottom,  #de6262 , #ffb88c);
    color: #333;
    }

    .gradient-8 {
    background: linear-gradient(to bottom,  #06beb6 , #48b1bf);
    color: #333;
    }

    .gradient-9 {
    background: linear-gradient(to bottom,   #eb3349 , #f45c43);
    color: #333;
    }

    .gradient-10 {
    background: linear-gradient(to bottom,  #dd5e89 , #f7bb97);
    color: #333;
    }

        /* Define styles for the hover effect */
        .img {
        transition: transform 0.3s ease-in-out;
    }
    
    /* Scale up the image on hover */
    .img:hover {
        transform: scale(1.1);
    }

    .card {
  transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
}

.card:hover {
  background-color: rgba(0, 0, 0, 0.1);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
  transform: scale(1.05);
}

</style>

<body style="background-color: #181818;">
    <?php include "nav.php"; ?>
 
    <div class="mb-5 container d-flex justify-content-left">
        <div class="text-header text-white">Dashboard</div>
    </div>

    <div class="container mb-5">
        <div class="row mb-3">
            <div class="col mb-3">
            <div class="card img gradient-1">
                    <a href="American_Movies/PAGES/American_Movies.php" id="tags">
                    <div class="card-body">
                        <h3 class="card-title text-black">American Movies</h3>
                        <div class="d-inline-block">
                            <h2 class="text-black ovarallSales"></h2>
                              <p class="text-body d-flex justify-content-center"><?php echo $total_american_movies; ?></p>
                        </div>
                        <span class="float-right display-5 opacity-5" style="font-size: 30px; color:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 2048 2048"><path fill="currentColor" d="M1920 896v832q0 40-15 75t-41 61t-61 41t-75 15H320q-40 0-75-15t-61-41t-41-61t-15-75v-507q0-37 1-67t2-59t1-60t-4-67q-2-21-6-38t-8-34t-10-32t-11-38L22 541l1738-434l124 497L713 896zM681 508l-321 80l352 176l321-80zm543 129l322-81l-352-175l-322 80zm-1046 4l61 241l282-70zm1489-379l-282 71l342 171zm125 762H256v704q0 26 19 45t45 19h1408q26 0 45-19t19-45z"/></svg></span>
                    </div>
                    <div class="card-footer" style="color: #fff;">See More</div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card img gradient-2">
                    <a href="American_TV_Series/PAGES/American_TV_Series.php" id="tags">
                    <div class="card-body">
                        <h3 class="card-title text-black">American Series</h3>
                        <div class="d-inline-block">
                            <h2 class="text-black ovarallSales"></h2>
                              <p class="text-body d-flex justify-content-center"><?php echo $total_american_tv_series; ?></p>
                        </div>
                        <span class="float-right display-5 opacity-5" style="font-size: 30px; color:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 2048 2048"><path fill="currentColor" d="M1920 896v832q0 40-15 75t-41 61t-61 41t-75 15H320q-40 0-75-15t-61-41t-41-61t-15-75v-507q0-37 1-67t2-59t1-60t-4-67q-2-21-6-38t-8-34t-10-32t-11-38L22 541l1738-434l124 497L713 896zM681 508l-321 80l352 176l321-80zm543 129l322-81l-352-175l-322 80zm-1046 4l61 241l282-70zm1489-379l-282 71l342 171zm125 762H256v704q0 26 19 45t45 19h1408q26 0 45-19t19-45z"/></svg></span>
                    </div>
                    <div class="card-footer" style="color: #fff;">See More</div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card img gradient-3">
                    <a href="Anime_Movies/PAGES/Anime_Movies.php" id="tags">
                    <div class="card-body">
                        <h3 class="card-title text-black">Anime Movies</h3>
                        <div class="d-inline-block">
                            <h2 class="text-black ovarallSales"></h2>
                              <p class="text-body d-flex justify-content-center"><?php echo $total_anime_movies; ?></p>
                        </div>
                        <span class="float-right display-5 opacity-5" style="font-size: 30px; color:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M35.81 28.508c-1.857 2.114-6.298 4.43-10.38 5.045l-.023 9.945h-2.54v-9.855c-2.158-.078-6.622-1.521-9.732-5.426c5.65-6.275 15.125-5.604 22.675.291"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M14.635 19.783c-1.507.805-3.349 3.184-3.714 4.229c6.544-5.84 18.592-7.137 26.937.01C42.343-.452 8.236-2.924 10.238 22.357q2.16-1.98 4.397-2.573Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M19.859 21.704q5.224-1.545 8.11 0m-3.938-2.503v1.73"/></svg></span>
                    </div>
                    <div class="card-footer" style="color: #fff;">See More</div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card img gradient-4">
                    <a href="Anime_Series/PAGES/Anime_Series.php" id="tags">
                    <div class="card-body">
                        <h3 class="card-title text-black">Anime Series</h3>
                        <div class="d-inline-block">
                            <h2 class="text-black ovarallSales"></h2>
                              <p class="text-body d-flex justify-content-center"><?php echo $total_anime_series; ?></p>
                        </div>
                        <span class="float-right display-5 opacity-5" style="font-size: 30px; color:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M35.81 28.508c-1.857 2.114-6.298 4.43-10.38 5.045l-.023 9.945h-2.54v-9.855c-2.158-.078-6.622-1.521-9.732-5.426c5.65-6.275 15.125-5.604 22.675.291"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M14.635 19.783c-1.507.805-3.349 3.184-3.714 4.229c6.544-5.84 18.592-7.137 26.937.01C42.343-.452 8.236-2.924 10.238 22.357q2.16-1.98 4.397-2.573Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M19.859 21.704q5.224-1.545 8.11 0m-3.938-2.503v1.73"/></svg></span>
                    </div>
                    <div class="card-footer" style="color: #fff;">See More</div>
                    </a>
                </div>
                </div>
            </div>
            <div class="row mb-3">
            <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card img gradient-5">
                    <a href="Cartoon_Movies/PAGES/Cartoon_Movies.php" id="tags">
                    <div class="card-body">
                        <h3 class="card-title text-black">Cartoon Movies</h3>
                        <div class="d-inline-block">
                            <h2 class="text-black ovarallSales"></h2>
                              <p class="text-body d-flex justify-content-center"><?php echo $total_cartoon_movies; ?></p>
                        </div>
                        <span class="float-right display-5 opacity-5" style="font-size: 30px; color:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M32.132 30.753V17.247L42.5 30.753V17.247m-22.158 8.977v.055a4.474 4.474 0 0 1-4.474 4.474h0a4.474 4.474 0 0 1-4.474-4.474v-4.558a4.474 4.474 0 0 1 4.474-4.474h0a4.474 4.474 0 0 1 4.474 4.474v.055"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M5.5 13.632h20.736v20.736H5.5z"/></svg></span>
                    </div>
                    <div class="card-footer" style="color: #fff;">See More</div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card img gradient-6">
                    <a href="Cartoon_Series/PAGES/Cartoon_Series.php" id="tags">
                    <div class="card-body">
                        <h3 class="card-title text-black">Cartoon Series</h3>
                        <div class="d-inline-block">
                            <h2 class="text-black ovarallSales"></h2>
                              <p class="text-body d-flex justify-content-center"><?php echo $total_cartoon_series; ?></p>
                        </div>
                        <span class="float-right display-5 opacity-5" style="font-size: 30px; color:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M32.132 30.753V17.247L42.5 30.753V17.247m-22.158 8.977v.055a4.474 4.474 0 0 1-4.474 4.474h0a4.474 4.474 0 0 1-4.474-4.474v-4.558a4.474 4.474 0 0 1 4.474-4.474h0a4.474 4.474 0 0 1 4.474 4.474v.055"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M5.5 13.632h20.736v20.736H5.5z"/></svg></span>
                    </div>
                    <div class="card-footer" style="color: #fff;">See More</div>
                    </a>
                </div>
            </div>
                <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card img gradient-7">
                    <a href="Games/PAGES/Games.php" id="tags">
                    <div class="card-body">
                        <h3 class="card-title text-black">Games</h3>
                        <div class="d-inline-block">
                            <h2 class="text-black ovarallSales"></h2>
                              <p class="text-body d-flex justify-content-center"><?php echo $total_games; ?></p>
                        </div>
                        <span class="float-right display-5 opacity-5" style="font-size: 30px; color:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 20 20"><path fill="currentColor" d="M15.9 5.5C15.3 4.5 14.2 4 13 4H7c-1.2 0-2.3.5-2.9 1.5c-2.3 3.5-2.8 8.8-1.2 9.9s5.2-3.7 7.1-3.7s5.4 4.8 7.1 3.7c1.6-1.1 1.1-6.4-1.2-9.9M8 9H7v1H6V9H5V8h1V7h1v1h1zm5.4.5c0 .5-.4.9-.9.9s-.9-.4-.9-.9s.4-.9.9-.9s.9.4.9.9m1.9-2c0 .5-.4.9-.9.9s-.9-.4-.9-.9s.4-.9.9-.9s.9.4.9.9"/></svg></span>
                    </div>
                    <div class="card-footer" style="color: #fff;">See More</div>
                    </a>
                </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card img gradient-8">
                    <a href="Manga/PAGES/Manga.php" id="tags">
                    <div class="card-body">
                        <h3 class="card-title text-black">Manga</h3>
                        <div class="d-inline-block">
                            <h2 class="text-black ovarallSales"></h2>
                              <p class="text-body d-flex justify-content-center"><?php echo $total_manga; ?></p>
                        </div>
                        <span class="float-right display-5 opacity-5" style="font-size: 30px; color:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M39.028 39.195c-.287 1.117-1.673 1.726-3.094 1.36q0 0 0 0c-1.422-.365-2.342-1.567-2.055-2.683v-.001c.288-1.117 1.673-1.725 3.095-1.36c1.421.366 2.34 1.568 2.054 2.684m-2.952-4.265c-.27-.073-.744.086-.537-1.09l2.476-14.07c.092-.53.237-1.224.996-1.025l4.033 1.063c.755.199.52.793.385 1.248l-4.102 13.83c-.191.65-.38.834-1.12.63zm-14.964 5.15c0 .256.167.462.424.462h4.058c.256 0 .601-.207.601-.462v-5.903c0-.687.402-.749.894-.717c3.629.24 7.555-1.075 7.755-5.495c.162-3.576-2.449-5.733-7.117-5.733h-5.6c-.734 0-1.125.333-1.014.848zm6.585-15.106l-2.796 4.843h5.592zM4.573 22.693c0-.256.167-.462.423-.462h4.058c.256 0 .417.206.417.463v8.252c0 1.423 1.113 2.57 2.495 2.57c1.38 0 2.493-1.147 2.493-2.57V19.829c0-.256.168-.462.423-.462h4.059c.256 0 .416.207.416.462v12.027a5.993 5.993 0 0 1-5.979 6.007h-2.8a5.993 5.993 0 0 1-6.005-5.98zm2.216-5.443l-.092-7.441l3.24 3.916l3.055-3.916l.092 5.927h1.896l2.865-5.971l2.864 5.97h1.892V10.01l5.16 4.596V7.463m6.821 2.585c-2.153-1.22-5.188-.53-5.188 2.4s3.035 3.621 5.188 2.4v-1.861m1.385 2.604l2.741-5.626l2.742 5.626"/></svg></span>
                    </div>
                    <div class="card-footer" style="color: #fff;">See More</div>
                    </a>
                </div>
                </div>
                </div>
                <div class="row mb-3">
                    <div class="col">

                    </div>
                <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card img gradient-9">
                    <a href="Manhwa/PAGES/Manhwa.php" id="tags">
                    <div class="card-body">
                        <h3 class="card-title text-black">Manhwa</h3>
                        <div class="d-inline-block">
                            <h2 class="text-black ovarallSales"></h2>
                              <p class="text-body d-flex justify-content-center"><?php echo $total_manhwa; ?></p>
                        </div>
                        <span class="float-right display-5 opacity-5" style="font-size: 30px; color:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M38.5 5.5h-29c-2.2 0-4 1.8-4 4v29c0 2.2 1.8 4 4 4h29c2.2 0 4-1.8 4-4v-29c0-2.2-1.8-4-4-4"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M33.741 16.496c0-1.023-.953-1.91-2.054-1.842c-1.027.068-1.833.955-1.833 1.91v1.707c0 1.023.88 1.842 1.98 1.842s1.98-.819 1.98-1.842h-1.98M7.9 20.11v-5.46l2.934 5.46l2.934-5.46v5.46m9.216 0v-5.46l3.888 5.46v-5.46m-6.552 5.46l-1.907-5.46l-1.981 5.46m.66-1.843h2.568M40.1 20.11l-1.907-5.46l-1.98 5.46m.66-1.843h2.567m-26.142 5.032h3.693m-1.812 5.36v-5.36m3.628 3.551c0 1.005.836 1.81 1.812 1.81c1.045 0 1.881-.804 1.881-1.81v-1.809c0-1.005-.836-1.81-1.881-1.81s-1.812.805-1.812 1.81zm6.099 0c0 1.005.836 1.81 1.812 1.81c1.045 0 1.881-.804 1.881-1.81v-1.809c0-1.005-.836-1.81-1.881-1.81s-1.812.805-1.812 1.81zm6.103 1.809v-5.36l3.693 5.36v-5.36M19.66 31.776c2.352 2.261 5.988 1.929 8.032 0"/></svg></span>
                    </div>
                    <div class="card-footer" style="color: #fff;">See More</div>
                    </a>
                </div>
                </div>
                   <div class="col-lg-3 col-sm-6 mb-3">
                    <div class="card img gradient-10">
                    <a href="Manhwa_18/PAGES/Manhwa_18.php" id="tags">
                    <div class="card-body">
                        <h3 class="card-title text-black">Manhwa 18</h3>
                        <div class="d-inline-block">
                            <h2 class="text-black ovarallSales"></h2>
                              <p class="text-body d-flex justify-content-center"><?php echo $total_manhwa_18; ?></p>
                        </div>
                        <span class="float-right display-5 opacity-5" style="font-size: 30px; color:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M38.5 5.5h-29c-2.2 0-4 1.8-4 4v29c0 2.2 1.8 4 4 4h29c2.2 0 4-1.8 4-4v-29c0-2.2-1.8-4-4-4"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M33.741 16.496c0-1.023-.953-1.91-2.054-1.842c-1.027.068-1.833.955-1.833 1.91v1.707c0 1.023.88 1.842 1.98 1.842s1.98-.819 1.98-1.842h-1.98M7.9 20.11v-5.46l2.934 5.46l2.934-5.46v5.46m9.216 0v-5.46l3.888 5.46v-5.46m-6.552 5.46l-1.907-5.46l-1.981 5.46m.66-1.843h2.568M40.1 20.11l-1.907-5.46l-1.98 5.46m.66-1.843h2.567m-26.142 5.032h3.693m-1.812 5.36v-5.36m3.628 3.551c0 1.005.836 1.81 1.812 1.81c1.045 0 1.881-.804 1.881-1.81v-1.809c0-1.005-.836-1.81-1.881-1.81s-1.812.805-1.812 1.81zm6.099 0c0 1.005.836 1.81 1.812 1.81c1.045 0 1.881-.804 1.881-1.81v-1.809c0-1.005-.836-1.81-1.881-1.81s-1.812.805-1.812 1.81zm6.103 1.809v-5.36l3.693 5.36v-5.36M19.66 31.776c2.352 2.261 5.988 1.929 8.032 0"/></svg></span>
                    </div>
                    <div class="card-footer" style="color: #fff;">See More</div>
                    </a>
                </div>
                    </div>
                    <div class="col">
                        <!-- Empty Column -->
                    </div>
                </div>
            </div>
    </div>


    <?php include "Footer.php"; ?>
</body>

</html>