<?php

require_once("globals.php");
require_once("db.php");
require_once("models/movie.php");
require_once("models/message.php");
require_once("dao/UserDAO.php");
require_once("dao/MovieDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$movieDao = new MovieDAO($conn, $BASE_URL);

// Receive form type
$type = filter_input(INPUT_POST, "type");

// Receive user data
$userData = $userDao->verifyToken();

if($type === "create") {

    // Receive input data
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $movie = new Movie();

    // Data validation
    if(!empty($title) && !empty($description) && !empty($category)){

        $movie->title = $title;
        $movie->description = $description;
        $movie->trailer = $trailer;
        $movie->category = $category;
        $movie->length = $length;
        $movie->users_id = $userData->id;

        // Image Upload
        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
            
            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            // Check image type
            if(in_array($image["type"], $imageTypes)) {

                if(in_array($image["type"], $jpgArray)){

                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
    
                // png image 
                } else {
                
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
    
                }
    
                $imageName = $movie->imageGenerateName();
    
                imagejpeg($imageFile, "./img/movies/" . $imageName, 100);
    
                $movie->image = $imageName;

            } else {

                $message->setMessage("Formato de arquivo não suportado.", "error", "back");

            }
        }

        $movieDao->create($movie);

    } else {

        $message->setMessage("Você precisa adicionar titulo, descrição e categoria.", "error", "newmovie.php");

    }


} else {

    $message->setMessage("Informações invalidas.", "error", "index.php");

}