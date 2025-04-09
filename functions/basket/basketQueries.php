<?php
    if(!isset($_SESSION["basket"])){
        header("Location: ../../pages/basket.php");
        exit();
    }
    //Basket
    $basketQuery = mysqli_query($con, "SELECT id,kep,nev,ar FROM jatek 
                INNER JOIN kosar on jatek.id = kosar.jatek_id 
                INNER JOIN felhasznalo ON kosar.email = felhasznalo.email 
                WHERE felhasznalo.email='$currentUserData[0]'");
    //Price
    $priceQuery = mysqli_query($con, "SELECT SUM(jatek.ar) AS osszesen_fizetendo FROM jatek
                INNER JOIN kosar ON jatek.id = kosar.jatek_id
                INNER JOIN felhasznalo ON kosar.email = felhasznalo.email
                WHERE felhasznalo.email='$currentUserData[0]'");
    $price = mysqli_fetch_assoc($priceQuery);

    //Reward
    $reward = floor($price['osszesen_fizetendo']*0.15);

