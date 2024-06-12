<div class="latest-movies" id="trending">
    <h1>TRENDING ON CinemaHub</h1>
    <div class="latest-container">

        <?php foreach($trending as $trend) : ?>

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