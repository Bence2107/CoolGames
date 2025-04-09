<?php
    if(!isset($_SESSION["games"])){
        header("Location: ../../pages/games.php");
        exit();
    }

    //Games
    $gamesQuery = mysqli_query($con, "SELECT * FROM jatek ORDER BY nev ");
    $top3GameQuery = mysqli_query($con, "SELECT * FROM jatek ORDER BY ertekeles DESC LIMIT 3");

    //Game
    $gameName = null;
    $gameData = null;
    $gameID = null;
    if(isset($_GET['name'])) {
        $gameName = trim($_GET['name']);
    }
    $gameQuery = mysqli_query($con,"SELECT * FROM jatek WHERE nev='$gameName'");
    $gameData = mysqli_fetch_assoc($gameQuery);