<?php
    session_start();
    include "../../database.php";
    include "../profileData.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        mysqli_query($con,"DELETE FROM felhasznalo WHERE email='$currentUserData[0]'");
        session_unset();
        session_destroy();
        header("Location: ../../../index.php");
        exit();
    }
    header("Location: ../../../pages/profile/profile_del_question.php");
    exit();


