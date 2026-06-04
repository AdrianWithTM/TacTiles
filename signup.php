<?php
session_start();

$file = "tactiles.json";
$data = json_decode(file_get_contents($file), true) ?? [];

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

foreach ($data as $user) {
    if ($user["name"] === $name){
        $_SESSION["login_error"] = "Username already exists";
        header("Location: register.php");
        exit();
    }
}

$newUser = [
    "name" => $name,
    "email" => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT),
    "highscore" => 0
];

$data[] = $newUser;

file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

$_SESSION['name'] = $name;
$_SESSION['email'] = $email;

header("Location: main.php");
exit();