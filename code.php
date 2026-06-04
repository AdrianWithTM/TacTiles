<?php

session_start();

if (!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}

if (!isset($_SESSION['game_started'])){
    $_SESSION['game_started'] = false;
}

if (!isset($_SESSION['show_red'])){
    $_SESSION['show_red'] = false;
}

if (!isset($_SESSION['round'])){
    $_SESSION['round'] = 1;
}

if (!isset($_SESSION['message'])){
    $_SESSION['message'] = '';
}

if (!isset($_SESSION['sound'])){
    $_SESSION['sound'] = '';
}

$boardSize = 6;
$totalTiles = $boardSize * $boardSize;
$t = 0;
$tc = 0;
$moveTo = 9;
$mapRowNr = 1;
$i = 1;
$c = 0;
$s = 0;
$cValue = 0;
$test = 0;
$working = '';
$colored = []; 
$color = [];

while ($c < $totalTiles){

    $color[$c] = "white";

    $c++;

}

if(isset($_POST['mainButton'])){
    if(!$_SESSION['game_started']) {
        
        $_SESSION['colored'] = [];

        $tileCount = getTileCount();

        $level = [];

        while(count($level) < $tileCount){

            $random = rand(0, $totalTiles - 1) ;

            if(!in_array($random, $level)){
                $level[] = $random;
            }
        }

        $_SESSION['level_numbers'] = $level;
        $_SESSION['game_started'] = true;
        $_SESSION['show_red'] = true;
        $_SESSION['message'] = 'Game started!';
        $_SESSION['sound'] = 'start';

    }else{
        if(!isset($_SESSION['level_numbers'])){
            return;
        }
            $player = $_SESSION['colored'];
            $level = $_SESSION['level_numbers'];

            sort($player);
            sort($level);

        if($player == $level){

            $_SESSION['score']++;
            $file = 'tactiles.json';
            $data = json_decode(file_get_contents($file), true);

            foreach ($data as &$user) {
                if ($user['name'] === $_SESSION['name']){
                    if ($_SESSION['score'] > $user['highscore']){
                        $user['highscore'] = $_SESSION['score'];
                    }
                    break;
                }
            }

            file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
            $_SESSION['round']++;
            $_SESSION['message'] = 'Correct!';
            $_SESSION['sound'] = 'correct';

            $_SESSION['colored'] = [];

            $tileCount = getTileCount();

            $newLevel = [];

            while (count($newLevel) < $tileCount){

                $random = rand(0, $totalTiles - 1);

                if (!in_array($random, $newLevel)){
                    $newLevel[] = $random;
                }
            }

            $_SESSION['level_numbers'] = $newLevel;
            $_SESSION['show_red'] = true;

        }else{
            $file = 'tactiles.json';
            $data = json_decode(file_get_contents($file), true);

            foreach ($data as &$user){
                if ($user['name'] === $_SESSION['name']){

                    if ($_SESSION['score'] > $user['highscore']){
                        $user['highscore'] = $_SESSION['score'];
                    }

                    break;
                }
            }

            file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
            $_SESSION['message'] = 'Wrong, you lose!';
            $_SESSION['sound'] = 'lose';
            $_SESSION['score'] = 0;
            $_SESSION['round'] = 1;
            $_SESSION['game_started'] = false;
            $_SESSION['show_red'] = false;
            $_SESSION['colored'] = [];
            $_SESSION['level_numbers'] = [];
        }
    }
}


function getTileCount(){

    $round = $_SESSION['round'];

    $tiles = floor(($round-1)/3)+3;

    if ($tiles > 10){
        $tiles = 10;
    }

    return $tiles;
}

function levelNumbers(){
    $level = [];
    $_SESSION['level_numbers'] = $level;
}

if (isset($_POST['button4'])){
    levelNumbers();
    
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

$level = isset($_SESSION['level_numbers']) ? $_SESSION['level_numbers'] : [];
$json = 'tactiles.json';


if (!isset($_SESSION['colored'])){
    $_SESSION['colored'] = [];
}

if (isset($_POST['Hex'])){

    if ($_SESSION['show_red']){
        $_SESSION['show_red'] = false;
    }

    $test = $_POST['Hex'] - 1;
    $key = array_search($test, $_SESSION['colored']);

    if ($key !== false){

        unset($_SESSION['colored'][$key]);

        $_SESSION['colored'] = array_values($_SESSION['colored']);

    }else{

        $_SESSION['colored'][] = $test;
    }
}


$color = array_fill(0, $totalTiles, 'white');

foreach ($_SESSION['colored'] as $index) {
    if (!is_array($index) && isset($color[$index])){
        $color[$index] = 'steelblue';
    }
}

$map = [];

while ($i <= $totalTiles){
    $map[] = $i;
    $i++;
}

if ($_SESSION['show_red']){

    foreach ($level as $index){
        
        if (isset($color[$index])){

            $color[$index] = 'red';

        }
    }
}

if (isset($_POST['button1'])){
    button1();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

function button1(){
    $_SESSION['colored'] = [];
}

?>