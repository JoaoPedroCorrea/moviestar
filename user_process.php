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

    $userDao->update($userData);

    // Update User Password 
} else if($type === "changepassword"){

} else {
    $message->setMessage("Credenciais invalidas.", "error", "index.php");
}