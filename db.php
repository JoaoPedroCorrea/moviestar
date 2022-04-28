<?php

$db_name = "moviestar";
$db_host = "localhost";
$db_user = "joao";
$db_pass = "senha123";

$conn = new PDO("mysql:dbname=$db_name;hostname=$db_host", $db_user, $db_pass);


// enable PDO errors

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
