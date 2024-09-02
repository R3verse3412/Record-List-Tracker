<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <?php include "header.php"?>
</head>
<style>
    .card{
        height: auto;
        width: 300px;
        padding: 10px;
    }
    
    .text{
        font-size: 30px;
        font-weight: bold;
    }

    .section{
        display: flex;
        position: relative;
        min-height: 110px;
    }

    .icons{

    }

</style>
<body >
    <?php include "nav_user.php" ?>

    <section class="section">
        <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card-pics">
                    <img src="uploads/12 strong.jpg" alt="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                    <div class="text mb-4">BorderLands</div>
                    <div class="year">2024</div>
                    <div class="genre">Action / Adventure / Comedy / Sci-Fi / Thriller</div>
                    <div class="ratings">8</div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="card">
                <div class="card-body">
                <div class="director">Director</div>
                <img class="icons" src="img/Adventure Time.png" alt="Finn">
                <div class="cast"><img src="img/Deku.png" alt="deku"></div>
                </div>
                </div>
            </div>
            </div>
        </div>

        <section class="section">
            <div class="container">

            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col">

                    </div>
                </div>
            </div>
        </section>
       

    </section>
    
</body>
</html>