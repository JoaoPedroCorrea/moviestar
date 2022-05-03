<?php

require_once("globals.php");
require_once("db.php");
require_once("models/user.php");
require_once("models/message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

// Update User
if($type === "update") {

    // Receive user data
    $userData = $userDao->verifyToken();

    // Receive post data
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    // Create new user object
    $user = new User();

    // Fill user data
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    // Image Upload
    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];

        // Check file type
        if(in_array($image["type"], $imageTypes)) {

            // Check jpg/jpeg format
            if(in_array($image, $jpgArray)){

                $imageFile = imagecreatefromjpeg($image["tmp_name"]);

            // png image 
            } else {
            
                $imageFile = imagecreatefrompng($image["tmp_name"]);

            }

            $imageName = $user->imageGenerateName();

            imagejpeg($imageFile, "./img/users/" . $imageName, 100);

            $userData->image = $imageName;

        } else {
            $message->setMessage("Formato de arquivo não suportado.", "error", "back");
        }

    }

    $userDao->update($userData);

    // Update User Password 
} else if($type === "changepassword"){

    // Receive data from POST
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");
    $id = filter_input(INPUT_POST, "id");

    if($password == $confirmpassword){

        // Create new User object
        $user = new User();
        $finalPassword = $user->generatePassword($password);

        $user->password = $finalPassword;
        $user->id = $id;

        $userDao->changePassword($user);


    } else {
        $message->setMessage("As senhas não são iguais.", "error", "back");
    }

} else {
    $message->setMessage("Informações invalidas.", "error", "index.php");
}