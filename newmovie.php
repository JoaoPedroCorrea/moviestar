<?php
    require_once("templates/header.php");
    require_once("dao/UserDAO.php");
    require_once("models/user.php");

    $user = new User();
    $userDao = new UserDAO($conn, $BASE_URL);
    $userData = $userDao->verifyToken(true);
?>
    <div id="main-container" class="container-fluid">
        <div class="offset-md-4 col-md-4 new-movie-container">
            <h1 class="page-title">Adicionar Filme</h1>
            <p class="page-description">Adicione sua crítica sobre filmes!</p>
            <form action="<?= $BASE_URL ?>movie_process.php" method="POST" id="add-movie-form" enctype="multipart/form-data">
                <input type="hidden" name="type" value="create">
                <div class="form-group">
                    <label for="title"> Título:</label>
                    <input type="text" required name="title" id="title" class="form-control" placeholder="Digite o título do filme">
                </div>
                <div class="form-group">
                    <label for="image"> Imagem:</label>
                    <input type="file" name="image"  class="form-control-file" id="image">
                </div>
                <div class="form-group">
                    <label for="length"> Duração:</label>
                    <input type="text" name="length" id="length" class="form-control" placeholder="Duração do filme">
                </div>
                <div class="form-group">
                    <label for="category"> Categoria:</label>
                    <select name="category" required id="category" class="form-control">
                        <option value="">Selecione</option>
                        <option value="Ação">Ação</option>
                        <option value="Terror">Terror</option>
                        <option value="Drama">Drama</option>
                        <option value="Romance">Romance</option>
                        <option value="Suspense">Suspense</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="trailer"> Trailer:</label>
                    <input type="text" name="trailer" id="trailer" class="form-control" placeholder="Insira o link do trailer">
                </div>
                <div class="form-group">
                    <label for="description"> Descrição:</label>
                    <textarea class="form-control" required name="description" id="description" rows="5" placeholder="Descrição do filme"></textarea>
                </div>
                <input type="submit" class="btn card-btn" value="Adicionar filme">
            </form>
        </div> 
    </div>
<?php
    require_once("templates/footer.php");
?>