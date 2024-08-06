<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the homepage content
$sql = "SELECT * FROM homepage_content WHERE id = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Initialize variables to avoid undefined index warnings
$title = 'Record List Tracker';
$genre = 'Anime • Manga • Movies • Manhwa • Series';
$about = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Error eveniet aperiam qui recusandae dolorem. Quaerat quas quisquam necessitatibus aperiam illo, sed ea voluptatum dolorem omnis? Amet beatae magni non dolore.';

if ($row) {
    $title = $row['title'];
    $genre = $row['genre'];
    $about = $row['about'];
}

// Fetch the uploads content
$upload_sql = "SELECT file_path, upload_text FROM uploads";
$upload_result = $conn->query($upload_sql);
$uploads = [];
if ($upload_result->num_rows > 0) {
    while ($upload_row = $upload_result->fetch_assoc()) {
        $uploads[] = $upload_row;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="Homepage.css">
  <?php include "header.php";?>

</head>
<style>
  .navbar{
    position: fixed;
    width: 100%;
    z-index: 1000; /* Ensure navbar is always on top */
    transition: top 0.5s;
}

.navbar-transparent {
    background-color: rgba(200, 234, 179, 0);
  }

  .navbar-hidden {
    top: -80px; /* Adjust based on your navbar height */
  }

  .navbar:hover {
    top: 0;
  }
    
</style>
<body style="background-color: #181818;">
<nav class="navbar navbar-expand-lg navbar-light justify-content-between fs-3 mb-5" style="background-color: #84eab3;">
  <div class="container-fluid">
    <a class="navbar-brand">Record List Tracker</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
  
      <a class="navbar-brand" href="#about">About</a>
      <a class="navbar-brand" href="#new">New</a>
      <a class="navbar-brand" href="Login.php">Login</a>
      <a class="navbar-brand" href="Register.php">Register</a>

        <!-- If you need to add any additional links, add them here -->
      </ul>
      </div>
    </div>
  </div>
</nav>

<section class="section">
  <div class="container">

      <div class="row d-flex text-left">
        <div class="col">
      <h1 class="text-white fs-11"><?php echo $row['title']; ?></h1>
      </div>
      </div>
      <div class="row d-flex text-left">
          <div class="col">
      <h1 class="text-white fs-5"><?php echo $row['genre']; ?></h1>
      </div>
      </div>
  </div>
  </section>

  <section class="section">
  <div class="container">
    <div class="arrow">
      <div class="container-fluid text-center my-3" id="new">
        <div class="mb-5">
          <h1 class="text-white" >UPCOMING TO WATCH</h1>
        </div>
        <div class="row">
          <div class="row mx-auto my-auto justify-content-center">
            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner" role="listbox">
                <?php foreach ($uploads as $index => $upload) { ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                  <div class="col-md-3">
                    <div class="card mx-1">
                      <div class="card-img card-img-top">
                        <div class="card-img-container">
                          <img alt="Slide <?php echo $index + 1; ?>"
                            src="<?php echo htmlspecialchars($upload['file_path']); ?>">
                        </div>
                      </div>
                      <div class="card-img-overlay"><?php echo htmlspecialchars($upload['upload_text']); ?> </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
              <a class="carousel-control-prev bg-transparent w-aut" href="#myCarousel" role="button"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              </a>
              <a class="carousel-control-next bg-transparent w-aut" href="#myCarousel" role="button"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div id="visible" class="d-none d-md-block"></div>
    </div>
  </div>
  </section>

  <section class="section">
  <div class="container">
    <div class="row d-flex justify-content-center text-center" id="about">
      <div class="col">
      <h1 class="text-white">What Is Record List Tracker ?</h1>
      </div>
    </div>
    <div class="row d-flex justify-content-center text-center">
      <div class="col">
      <p class="text-white fs-5"><?php echo $row['about']; ?></p>
      </div>
    </div>
    </div>
  </section>

  <div class="footer">
    <?php include "Footer.php";?>
  </div>
</body>

</html>

<script src="Homepage.js"> </script>