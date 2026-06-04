<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TacTiles register</title>
    <link rel="stylesheet" href="tactiles.css">
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/3666/3666228.png">
</head>
<body>

<div class="home">

    <div class="accountForm" style="min-height: 250px">

        <form method="POST" action="signup.php" class="homeTitle">

            <h1 style="color: black; margin: 2vh;">Register</h1>

            <input class="textBox" name="name" placeholder="Username" required>

            <input class="textBox" name="email" placeholder="Email" required>

            <input class="textBox" name="password" type="password" placeholder="Password" required>

            <button class="btn" type="submit">Create account</button>

        </form>

        <form action="index.php" class="homeTitle">
            <button class="btn" type="submit">Go to Login</button>
        </form>

    </div>

</div>

</body>
</html>