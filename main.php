<?php
include("code.php");

$highscore = 0;

$file = 'tactiles.json';
$data = json_decode(file_get_contents($file), true);

if (is_array($data) && isset($_SESSION['name'])) {

    foreach ($data as $user) {

        if ($user['name'] === $_SESSION['name']) {
            $highscore = $user['highscore'] ?? 0;
            break;
        }
    }
}

if (!isset($_SESSION["name"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tactiles.css">
    <title>TacTiles</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/3666/3666228.png">
</head>
<audio id="correctSound" src="sounds/yes.mp3"></audio>
<audio id="loseSound" src="sounds/no.mp3"></audio>

<script>
    window.addEventListener("DOMContentLoaded", function(){

    const sound = "<?php echo $_SESSION['sound'] ?? '';?>";

    if (sound === "correct"){
        document.getElementById("correctSound").play();
    }

    if (sound === "lose"){
        document.getElementById("loseSound").play();
    }

    if (sound === "start"){
        document.getElementById("correctSound").play();
    }

    <?php $_SESSION['sound'] = '';?>
});
</script>



<body>
    <div class="everything">
        <div class="topBar">
            <div class="sideText">
                <p class="userText">Welcome, <?php echo $_SESSION['name'];?></p>
            </div>
            <div style="display: flex; width: 300px; height: 100%; justify-content: center; align-items: center;">
                <p class="mainText">TacTiles</p>
            </div>
            <div class="sideText" style="justify-content: right; margin-right: 25px;">
                <form action="logout.php" method="POST">
                    <button type="submit" class="logoutButton">Logout</button>
                </form>
            </div>
        </div>
        <div class="mapWhole">
            <div class="sideBar">
                <div class="leftButtons">
                    <form class="buttonHolder" method="post">
                        <button class="moveButton" type="submit" name="mainButton">
                            <?php
                            if($_SESSION['game_started']){

                                echo "Submit";

                            }else{

                                echo "Start";

                            }
                            ?>
                        </button>

                        <input type="submit" name="button1" class="moveButton" value="Clear"/>
                    </form>
                </div>
            </div>
            <div class="mapRowContainer">
            <?php
            for($row = 0; $row < $boardSize; $row++){

                echo '<div class="mapRow">';

                for($col = 0; $col < $boardSize; $col++){

                    $index=$row*$boardSize+$col;

                    echo '<form class="mapTile" method="post"><input class="tileButton" style="background-color:'.$color[$index].'" type="submit" value="'.($index + 1).'" name="Hex" '.$working.'/></form>';
                }

                echo '</div>';
            }
            ?>

            </div>
            <div class="rightBar">

                <h2 class="gameMessage">
                    <?php echo $_SESSION['message'];?>
                </h2>

                <h2 class="scoreText">
                    Score: <?php echo $_SESSION['score'];?>
                </h2>

                <h2 class="highScoreText">
                    Highscore: <?php echo $highscore;?>
                </h2>
            </div>
        </div>
    </div>
</body>
</html>