<?php
session_start();

// Check if the user is logged in and is an admin
if (!(isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)) {
    header("Location: admin_login.php"); // Redirect if not an admin
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

// Fetch total records for different categories
$categories = [
    'american_movies' => 'American Movies',
    'american_tv_series' => 'American Series',
    'anime_movies' => 'Anime Movies',
    'anime_series' => 'Anime Series',
    'cartoon_movies' => 'Cartoon Movies',
    'cartoon_series' => 'Cartoon Series',
    'games' => 'Games',
    'manga' => 'Manga',
    'manhwa' => 'Manhwa',
    'manhwa_18' => 'Manhwa 18'
];

$search_results = null;
$user_data = [];
$total_data = [];

foreach ($categories as $table => $label) {
    $count_sql = "SELECT COUNT(*) as count FROM $table";
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $row_count = $count_result->fetch_assoc();
    $total_data[$table] = $row_count['count'];
    $count_stmt->close();
}

if (isset($_POST['search'])) {
    $search_username = trim($_POST['search_username']);

    if (!empty($search_username)) {
        // Search for a specific user
        $search_sql = "SELECT id, username FROM users WHERE username LIKE ?";
        $search_stmt = $conn->prepare($search_sql);
        $search_param = "%$search_username%";
        $search_stmt->bind_param("s", $search_param);
        $search_stmt->execute();
        $search_results = $search_stmt->get_result();
        $search_stmt->close();

        if ($search_results->num_rows > 0) {
            $search_user = $search_results->fetch_assoc();
            $search_user_id = $search_user['id'];

            foreach ($categories as $table => $label) {
                $user_count_sql = "SELECT COUNT(*) as count FROM $table WHERE user_id = ?";
                $user_count_stmt = $conn->prepare($user_count_sql);
                $user_count_stmt->bind_param("i", $search_user_id);
                $user_count_stmt->execute();
                $user_count_result = $user_count_stmt->get_result();
                $user_row_count = $user_count_result->fetch_assoc();
                $user_data[$table] = $user_row_count['count'];
                $user_count_stmt->close();
            }
        }
    }
}

// Close the connection here to ensure it is closed only after all interactions
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <?php include "../header.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
    <link rel="stylesheet" href="Admin.css">
</head>
<body>
<?php include "Sidebar.php"; ?>
<div class="height-100 bg-light">
    <div class="container mb-5">
        <h1>Statistics</h1>
    </div>

    <div class="container mb-5">
        <form method="POST" action="">
            <div class="form-label">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="search_username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    <?php if ($search_results && $search_results->num_rows > 0): ?>
    <div class="container mb-5">
        <h2>Search Results for "<?php echo htmlspecialchars($search_username); ?>"</h2>
    </div>
    <?php endif; ?>

    <div class="container">
        <div class="row mb-5">
            <?php 
            $cards_per_column = 4; // Number of cards per column
            $counter = 0; // Initialize card counter
            $bg_classes = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-secondary']; // Array of Bootstrap background classes

            foreach ($categories as $table => $label) { 
                if ($counter % $cards_per_column == 0) {
                    // Start a new row after every 4 cards
                    if ($counter > 0) {
                        echo '</div><div class="row mb-5">';
                    }
                }
                $bg_class = $bg_classes[$counter % count($bg_classes)]; // Get a class from the array
                $counter++;
            ?>
                <div class="col-md-3 mb-3"> <!-- Use col-md-3 for a 4-card per row layout -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-center text-white <?php echo $bg_class; ?>">
                            <h5 class="text-header"><?php echo htmlspecialchars($label); ?></h5>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <h2 class="number-header">
                                <?php
                                    if (isset($user_data[$table])) {
                                        echo " " . $user_data[$table] . " ";
                                    } else {
                                        echo " " . $total_data[$table] . " ";
                                    }
                                ?>
                            </h2>
                        </div>
                        <div class="card-footer <?php echo $bg_class; ?>"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9 col-xl-10">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-block d-sm-flex align-items-center justify-content-between mb-3">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title widget-card-title">Record List</h5>
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
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="chart" width="509" height="254" class="chartjs-render-monitor" style="display: block; width: 509px; height: 254px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="Admin.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('chart').getContext('2d');

    // Initial Chart Type
    var chartType = document.getElementById('chartType').value;

    // Generate the chart data dynamically
    var chartData = {
        labels: <?php echo json_encode(array_values($categories)); ?>,
        datasets: [{
            label: 'Records',
            data: <?php echo json_encode(array_values(isset($user_data) && !empty($user_data) ? $user_data : $total_data)); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };

    var myChart = new Chart(ctx, {
        type: chartType,
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Update chart type dynamically
    document.getElementById('chartType').addEventListener('change', function () {
        myChart.destroy(); // Destroy current chart instance
        chartType = this.value;
        myChart = new Chart(ctx, {
            type: chartType,
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
});
</script>


</body>
</html>
