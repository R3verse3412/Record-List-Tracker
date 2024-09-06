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

// Fetch plans for the logged-in user
$plans = [];
$sql = "SELECT * FROM plans WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $plans[] = $row;
}
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do-List</title>
    <?php include "header.php" ?>
</head>
<style>
    .section {
        min-height: 20vh;
    }
    .card {
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}

.movie-poster {
    transition: transform 0.3s ease-in-out;
}

.card:hover .movie-poster {
    transform: scale(1.05);
 
}

</style>

<body style="background-color: #181818;">
    <?php include "nav.php" ?>

    <section class="section mb-5">
        <div class="container">
            <div class="text mb-3 fs-2 text-white">Add New Plan List</div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New</button>
        </div>
    </section>

    <section class="section mb-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4">
                <?php foreach ($plans as $plan): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-center">
                                    <img src="<?= htmlspecialchars($plan['image_path']) ?>" alt="<?= htmlspecialchars($plan['name']) ?>"class="img-fluid movie-poster"  style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Details-<?= $plan['id'] ?>">Details</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details Modal -->
                    <div class="modal fade" id="Details-<?= $plan['id'] ?>" tabindex="-1" aria-labelledby="DetailsLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="DetailsLabel">Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <p class="fs-6 text-center">
                                        <?= htmlspecialchars($plan['name']) ?></p>
                                        <p class="fs-6 text-center">Type: <?= htmlspecialchars($plan['type']) ?></p>
                                    <div class="input-group mb-2 d-flex justify-content-center">
                                        <img src="<?= htmlspecialchars($plan['image_path']) ?>" alt="<?= htmlspecialchars($plan['name']) ?>" style="width: 40%; height: auto;">
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <form action="delete_plan.php" method="POST">
                                        <input type="hidden" name="plan_id" value="<?= $plan['id'] ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Add New Plan Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="create_plan.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">TO DO LIST</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Type</label>
                            <select class="form-select" id="inputGroupSelect01" name="type" required>
                                <option value="">Choose...</option>
                                <option value="Movie">Movie</option>
                                <option value="Anime">Anime</option>
                                <option value="Manhwa">Manhwa</option>
                                <option value="Manga">Manga</option>
                                <option value="Games">Games</option>
                            </select>
                        </div>
                        <div class="input-group mb-2">
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
