<?php
    session_start();
    include_once "../database.php";
    include_once "../profile/profileData.php";
    if(isset($_GET['id'])) {
        $gameDataCharacters = explode("'",$_GET['id']);
        $gameID = $gameDataCharacters[1];
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $rating = $_POST["rating"];
        if($rating==null){
            header("Location: ../../pages/games.php");
            exit();
        }
        else if ($rating==0){
            header("Location: ../../pages/games.php");
            exit();
        }

        $gameQuery = mysqli_query($con,"SELECT * from jatek WHERE id='$gameID'");
        $gameData = mysqli_fetch_assoc($gameQuery);

        $gameRatingInfos = mysqli_query($con, "SELECT COUNT(ertekeles) as darab ,SUM(ertekeles) as osszesen FROM ertekel WHERE jatek_id='$gameID'");
        $gameRatingData = mysqli_fetch_assoc($gameRatingInfos);

        $isRated = mysqli_query($con,"SELECT * FROM ertekel WHERE email='$currentUserData[0]' AND jatek_id='$gameID'");
        $isTheGameOwned = mysqli_query($con, "SELECT * FROM birtokol WHERE jatek_id='$gameID' AND felh_email='$currentUserData[0]'");

        //Ertekeles módja
        if($gameRatingData['darab']==0){
            $afterRate = ($gameData['ertekeles']+$rating)/2;
        }
        else{
            $afterRate = ($gameRatingData['osszesen']+$rating)/($gameRatingData['darab']+1);
        }

        //Ha a játék már értékelve van, illetve nem birtokolva értékelve:
        if(mysqli_num_rows($isRated)>0){
            $_SESSION["alreadyRated"] = true;
        }
        else if(mysqli_num_rows($isTheGameOwned)==0){
            $_SESSION["notOwnedRate"] = true;
        }
        else{ //Különben hatjsa végre a műveleteket
            $newMoney = $currentUserData[7] + 5;
            mysqli_query($con,"INSERT INTO ertekel (jatek_id, email, ertekeles) VALUES ('$gameID','$currentUserData[0]','$rating')");
            mysqli_query($con, "UPDATE jatek SET ertekeles='$afterRate' WHERE id='$gameID'");
            mysqli_query($con,"UPDATE felhasznalo SET money='$newMoney' WHERE email='$currentUserData[0]'");
            $_SESSION["ratingSuccess"] = true;
        }
    }
    header("Location: ../../pages/games.php");
    exit();

