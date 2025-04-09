<?php
    session_start();
    include "../database.php";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST["email"];
        $gameID = $_POST["jatekID"];
        $isAlreadyOwned = mysqli_query($con,"SELECT id FROM jatek INNER JOIN birtokol ON jatek.id = birtokol.jatek_id INNER JOIN felhasznalo ON birtokol.felh_email = felhasznalo.email WHERE id='$gameID' AND felhasznalo.email='$email'");
        $kosarLekerdezQuery = mysqli_query($con,"SELECT jatek_id,email FROM kosar WHERE jatek_id='$gameID' AND email='$email'");
        if(mysqli_num_rows($isAlreadyOwned)>0){
            $_SESSION["ownedGame"] = true;
        }
        else if(mysqli_num_rows($kosarLekerdezQuery)>0){
            $_SESSION["alreadyInBasket"] = true;
        }
        else{
            $kosarQuery = mysqli_query($con, "INSERT INTO kosar (jatek_id, email) VALUES ('$gameID','$email')");
            $_SESSION["addToBasketSuccessfull"] = true;
        }
        header("Location: ../../pages/games.php");
        exit();
    }
    header("Location: ../../pages/games.php");
    exit();