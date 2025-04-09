<?php
    if(isset($_SESSION["email"])){ //Ha be van jelentkezve
        $currentUserEmail = $_SESSION["email"];
        $currentUserQuery = mysqli_query($con,"SELECT * FROM felhasznalo WHERE email='$currentUserEmail'");
        $currentUserData = mysqli_fetch_array($currentUserQuery);
        $ownGamesQuery = mysqli_query($con,"SELECT * FROM jatek 
    INNER JOIN birtokol ON jatek.id = birtokol.jatek_id 
    INNER JOIN felhasznalo ON birtokol.felh_email = felhasznalo.email
    WHERE felhasznalo.email='$currentUserData[0]'");
    } else{
        header("Location: ../../../pages/profile/log.php");//HA url-ből akraja elérni egy nem bejlentkezett személy
        exit();
    }
