<?php

require "inc/function.php";

$trending = query("SELECT * FROM trending");

if (isset($_POST["cari"])) {
    $trending = cari($_POST["keyword"]);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css?=<?= time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="images/logo/e.png">
    <title>CinemaHub</title>
</head>

<body>
    <!--Header section-->
    <header>
        <div class="logo">
            <img src="images/logo/e.png" alt="">
            <h3>Movies</h3>
        </div>
        <div class="nav" id="small_menu">
            <button class="hamburger" id="hamburger">
                <i class="fas fa-bars"></i>
            </button>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="#hollywood">Movies</a></li>
                <li><a href="#tollywood">Genres</a></li>
                <li><a href="#youtube">Series</a></li>
            </ul>
        </div>
        <form class="search-box" method="post">
            <input type="search" name="keyword" placeholder="Search..." class="search-input">
            <button type="submit" name="
        cari" class="search-button">Submit</button>
        </form>

    </header>


    <!--Hero section-->
    <?php include ('partikels/hero.php'); ?>


    <!------Lates movies---->
    <div class="latest-movies" id="trending">
        <h1>TRENDING ON CinemaHub</h1>
        <div class="latest-container">

            <?php foreach ($trending as $trend): ?>

                <div class="latest-inside">
                    <img src="images/upload/<?= $trend['gambar']; ?>" alt="">
                    <a href="trending.html"></a>
                    <div class="heading1">
                        <h4><?= $trend['judul']; ?></h4>
                        <p><span>&#9733;&#9733;&#9733;&#9733;&#9734; </span></p>
                        <h6><?= $trend['genre']; ?></h6>
                    </div>
                    <div class="btn2">
                        <a href="#">See 5More</a>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

    <!---Hollywood Movies-->
    <?php include ('partikels/hollywood.php'); ?>


    <!---tollywood Movies-->
    <?php include ('partikels/tollywood.php'); ?>


    <!---collywood Movies-->
    <?php include ('partikels/collywood.php'); ?>


    <!---iollywood Movies-->
    <?php include ('partikels/iollywood.php'); ?>


    <!---sollywood Movies-->
    <?php include ('partikels/sollywood.php'); ?>


    <!-- Yt Movies -->
    <?php include ('partikels/ytmovies.php'); ?>


    <!---Footer-->
    <?php include ('partikels/footer.php'); ?>


    <!--Goto button-->
    <div class="scroll">
        <a href=""><i class="fas fa-arrow-up"></i></a>
    </div>
</body>

</html>