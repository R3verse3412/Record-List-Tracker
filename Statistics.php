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

// Get selected year and month from dropdowns
$selected_year = isset($_POST['year']) ? $_POST['year'] : date('Y');
$selected_month = isset($_POST['month']) ? $_POST['month'] : date('m');

// Adjust SQL query to filter by year and month
function getTotalCount($conn, $table, $user_id, $year, $month) {
    $count_sql = "SELECT COUNT(*) as count FROM $table WHERE user_id = ? AND YEAR(date_added) = ? AND MONTH(date_added) = ?";
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->bind_param("iii", $user_id, $year, $month);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $row_count = $count_result->fetch_assoc();
    $count_stmt->close();
    return $row_count['count'];
}

$total_american_movies = getTotalCount($conn, 'american_movies', $user_id, $selected_year, $selected_month);
$total_american_tv_series = getTotalCount($conn, 'american_tv_series', $user_id, $selected_year, $selected_month);
$total_anime_movies = getTotalCount($conn, 'anime_movies', $user_id, $selected_year, $selected_month);
$total_anime_series = getTotalCount($conn, 'anime_series', $user_id, $selected_year, $selected_month);
$total_cartoon_movies = getTotalCount($conn, 'cartoon_movies', $user_id, $selected_year, $selected_month);
$total_cartoon_series = getTotalCount($conn, 'cartoon_series', $user_id, $selected_year, $selected_month);
$total_games = getTotalCount($conn, 'games', $user_id, $selected_year, $selected_month);
$total_manga = getTotalCount($conn, 'manga', $user_id, $selected_year, $selected_month);
$total_manhwa = getTotalCount($conn, 'manhwa', $user_id, $selected_year, $selected_month);
$total_manhwa_18 = getTotalCount($conn, 'manhwa_18', $user_id, $selected_year, $selected_month);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include "header.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    /* Your CSS styles here */
</style>

<body style="background-color: #181818;">
    <?php include "nav.php"; ?>
    <section class="py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9 col-xl-10">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-block d-sm-flex align-items-center justify-content-between mb-3">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title widget-card-title">Statistics</h5>
                                </div>
                                <div>
                                    <form method="post" action="">
                                        <div class="row">
                                            <div class="col">
                                                <select name="year" class="form-select text-secondary border-light-subtle">
                                                    <?php
                                                    // Populate year dropdown dynamically
                                                    for ($year = 2020; $year <= date('Y'); $year++) {
                                                        echo "<option value=\"$year\" " . ($selected_year == $year ? "selected" : "") . ">$year</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="month" class="form-select text-secondary border-light-subtle">
                                                    <?php
                                                    $months = [
                                                        1 => "January",
                                                        2 => "February",
                                                        3 => "March",
                                                        4 => "April",
                                                        5 => "May",
                                                        6 => "June",
                                                        7 => "July",
                                                        8 => "August",
                                                        9 => "September",
                                                        10 => "October",
                                                        11 => "November",
                                                        12 => "December"
                                                    ];
                                                    foreach ($months as $num => $name) {
                                                        echo "<option value=\"$num\" " . ($selected_month == $num ? "selected" : "") . ">$name</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select id="chartType" class="form-select text-secondary border-light-subtle">
                                                    <option value="bar" selected>Bar</option>
                                                    <option value="line">Line</option>
                                                    <option value="pie">Pie</option>
                                                    <option value="doughnut">Doughnut</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <canvas id="statisticsChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const chartData = {
            labels: ['American Movies', 'American Series', 'Anime Movies', 'Anime Series', 'Cartoon Movies', 'Cartoon Series', 'Games', 'Manga', 'Manhwa', 'Manhwa 18'],
            datasets: [{
                label: 'Total Records',
                data: [
                    <?php echo $total_american_movies; ?>,
                    <?php echo $total_american_tv_series; ?>,
                    <?php echo $total_anime_movies; ?>,
                    <?php echo $total_anime_series; ?>,
                    <?php echo $total_cartoon_movies; ?>,
                    <?php echo $total_cartoon_series; ?>,
                    <?php echo $total_games; ?>,
                    <?php echo $total_manga; ?>,
                    <?php echo $total_manhwa; ?>,
                    <?php echo $total_manhwa_18; ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };

        let statisticsChart = new Chart(document.getElementById('statisticsChart').getContext('2d'), {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        document.getElementById('chartType').addEventListener('change', function() {
            statisticsChart.destroy();
            statisticsChart = new Chart(document.getElementById('statisticsChart').getContext('2d'), {
                type: this.value,
                data: chartData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
