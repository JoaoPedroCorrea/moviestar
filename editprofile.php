<?php
    require_once("templates/header.php");
    require_once("dao/UserDAO.php");
    require_once("models/user.php");

    $user = new User();
    $userDao = new UserDAO($conn, $BASE_URL);
    $userData = $userDao->verifyToken(true);
    $fullName = $user->getFullName($userData);

    if($userData->image == ""){
        $userData->image = "user.png";
    }

?>
    <div id="main-container" class="container-fluid edit-profile-page">
        <div class="col-md-12">
            <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="update">
                <div class="row">
                    <div class="col-md-4">
                        <h1><?= $fullName ?></h1>
                        <p class="page-descrition">Altere seus dados no formulário abaixo:</p>
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Digite seu nome" value="<?= $userData->name ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Sobrenome:</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Digite seu sobrenome" value="<?= $userData->lastname ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" readonly name="email" id="email" class="form-control disabled" placeholder="Email" value="<?= $userData->email ?>">
                        </div>
                        <input type="submit" class="btn card-btn" value="Alterar">
                    </div>
                    <div class="col-md-4">
                        <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>/img/users/<?= $userData->image ?>')"></div>
                        <div class="form-group">
                            <label for="image">Foto:</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="bio">Sobre Você:</label>
                            <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Conte um pouco sobre você!"><?= $userData->bio ?></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row" id="change-password-container">
                <div class="col-md-4">
                    <h2>Alterar a senha:</h2>
                    <p class="page-description">Digite a nova senha e confirme, para alterar sua senha.</p>
                    <form action="<?= $BASE_URL ?>user_process.php" method="POST">
                        <input type="hidden" name="type" value="changepassword">
                        <input type="hidden" name="id" value="<?= $userData->id ?>">
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Digite sua nova senha:">
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Senha:</label>
                            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirme sua nova senha:">
                        </div>
                        <input type="submit" class="btn card-btn" value="Alterar Senha">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once("templates/footer.php");
?>