<?php
    session_start();
    $currentProfileData = null;
    $currentUserEmail = $_SESSION["email"];
    include "../../database.php";
    include "profileData.php";
    mysqli_query($con,"DELETE FROM felhasznalo WHERE email='$currentUserEmail'");
    session_unset();
    session_destroy();
    $_SESSION["delProfile"] = true;
    header("Location: ../../../index.php");
    exit();