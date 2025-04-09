<?php
    session_start();
    include_once "../database.php";
    include_once "../profile/profileData.php";
    include_once "../basket/basketQueries.php";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(mysqli_num_rows($basketQuery)>0){
            $maradekPenz = ($currentUserData[7]-$price['osszesen_fizetendo'])+$reward;
            if($maradekPenz>0){
                mysqli_query($con, "UPDATE felhasznalo SET money = '$maradekPenz' WHERE email='$currentUserData[0]'");
                while(($game = mysqli_fetch_assoc($basketQuery))!=null){
                    $gameID = $game['id'];
                    mysqli_query($con,"INSERT INTO birtokol (jatek_id, felh_email) VALUES ('$gameID','$currentUserData[0]')");
                    $_SESSION["buySuccessfull"] = true;
                }
                mysqli_query($con, "DELETE FROM kosar WHERE email='$currentUserData[0]'");
            }
            else{
                $_SESSION["notEnoughMoneyError"] = true;
            }
        }

        header("Location: ../../pages/basket.php");
        exit();
        }
    header("Location: ../../pages/basket.php");
    exit();