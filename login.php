<?php
session_start();

$file = 'tactiles.json';
$data = json_decode(file_get_contents($file), true);

$name = $_POST['name'];
$password = $_POST['password'];

$found = false;

foreach ($data as $user){
    if ($user['name'] === $name){
        $found = $user;
        break;
    }
}

if (!$found){
    $_SESSION['login_error'] = "User not found";
    header("Location: index.php");
    exit();
}

if (!password_verify($password, $found['password'])){
    $_SESSION['login_error'] = "Wrong password";
    header("Location: index.php");
    exit();
}

$_SESSION['name'] = $found['name'];
$_SESSION['email'] = $found['email'];

header("Location: main.php");
exit();