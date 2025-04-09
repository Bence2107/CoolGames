<?php
    session_start();
    $currentUserData = null;
    include "../../database.php";
    include "../profileData.php";
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if($_FILES["profile-pic"]["name"]==null){
            header("Location: ../../../pages/profile/profile_edit.php");
        }
        $picture = addslashes(file_get_contents($_FILES["profile-pic"]["tmp_name"]));
        $darabok = explode(".",$_FILES["profile-pic"]["name"]);
        $type = strtolower(end($darabok));

        $allowedTypes = ['jpg','png','jpeg'];

        if($_FILES["profile-pic"]["size"] > 3145728){
           $_SESSION["fileSizeError"] = true;
        }
        else if(!in_array($type,$allowedTypes)){
           $_SESSION["typeError"] = true;
        }
        else if(!isset($_SESSION["typeError"])&& !isset($_SESSION["fileSizeError"])){
            mysqli_query($con, "UPDATE felhasznalo SET profilkep='$picture' WHERE email='$currentUserData[0]'");
            $_SESSION["successfull"] = true;
        }

        header("Location: ../../../pages/profile/profile_edit.php");
        exit();
    }
    header("Location: ../../../pages/profile/profile_edit.php");
    exit();



