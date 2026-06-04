<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TacTiles login</title>
    <link rel="stylesheet" href="tactiles.css">
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/3666/3666228.png">
</head>
<body>

<div class="home">

    <div class="accountForm">

        <?php
        if (isset($_SESSION['login_error'])){
            echo '<p style="color:red;text-align:center;">' .$_SESSION['login_error'].'</p>';
            unset($_SESSION['login_error']);
        }
        ?>

        <form method="POST" action="login.php" class="homeTitle">

            <h1 style="color: black; margin: 2vh;">Login</h1>

            <input class="textBox" name="name" placeholder="Username" required>

            <input class="textBox" name="password" type="password" placeholder="Password" required>

            <button class="btn" type="submit">Login</button>

        </form>

        <form action="register.php" class="homeTitle">
            <button class="btn" type="submit">Go to Register</button>
        </form>

    </div>

</div>

</body>
</html>