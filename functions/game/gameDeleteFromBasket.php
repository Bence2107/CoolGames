<?php
    session_start();
    include "../database.php";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST["email"];
        $jatekID = $_POST["jatekID"];
        mysqli_query($con, "DELETE FROM kosar WHERE jatek_id='$jatekID' AND email='$email'");
        header("Location: ../../pages/basket.php");
        exit();
    }
    header("Location: ../../pages/basket.php");
    exit();