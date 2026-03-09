<?php include('../config/get_api.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HYPER - Streaming</title>
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>

    <header>
        <div class="logo">HYPER</div>
        <nav>
            <ul>
                <li>Horreur</li>
                <li>Adventure</li>
                <li>Survie</li>
                <li>Romantique</li>
                <li>fantastique</li>
            </ul>
        </nav>
        <div class="search-icon">🔍</div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>San Andreas</h1>
            <p>Lara races through Istanbul to uncover an ancient artifact before a secret society does.</p>
            <div class="buttons">
                <img  src="./image/san-andreas.jpg" alt="San Andreas">
                <button class="btn-watch">▶ Watch Now</button>
                <button class="btn-free">Get This Free</button>
            </div>
        </div>
    </section>

    <main>

<section class="movie-row">

    <h2>Latest Movies</h2>


    <section class="movie-row">
    <h2>Latest Movies</h2>
    <div class="movie-grid">

        <?php afficherFilms('action'); ?>

    </div>
    </section>


    </main>

</body>
</html>


