<?php include "Homepagephp.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="Homepage.css">

  <?php include "header.php";?>

</head>

<body style="background-color: #181818;">
<link rel="stylesheet" href="Homepage-1.css">

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
          <div class="card-img">
            <img src="<?php echo htmlspecialchars($upload['file_path']); ?>" class="d-block w-100" alt="Slide <?php echo $index + 1; ?>">
          </div>
          <div class="card-img-overlay"><?php echo htmlspecialchars($upload['upload_text']); ?></div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
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
 

</body>

</html>

<script src="Homepage.js"> </script>