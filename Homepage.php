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
    <?php include "Footer.php" ?>

</body>

</html>

<script src="Homepage.js"> </script>