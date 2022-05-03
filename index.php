<?php
    require_once("templates/header.php");
    require_once("dao/MovieDAO.php");

    $movieDao = new MovieDAO($conn, $BASE_URL);

    $latestMovies = $movieDao->getLastestMovies();

    $actionMovies = [];
    
    $comedyMovies = [];

?>
    <div id="main-container" class="container-fluid">
        
        <h2 class="section-title">Filmes novos</h2>
        <p class="section-description">Veja as críticas dos ultimos filmes adicionados ao MovieStar</p>
        <div class="movies-container">
            <?php foreach($latestMovies as $movie): ?>
                <?php require("templates/movie_card.php"); ?>
            <?php endforeach; ?>
        </div>
        <h2 class="section-title">Ação</h2>
        <p class="section-description">Veja os melhores filmes de ação</p>
        <div class="movies-container">
        </div>
        <h2 class="section-title">Comédia</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container"></div>


<?php
    require_once("templates/footer.php");
?>