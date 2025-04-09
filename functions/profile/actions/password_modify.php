<?php
    session_start();
    $currentUserData = null;
    include "../../database.php";
    include "../profileData.php";
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $errors = array();

        $password = $_POST["passwd"];
        $newPassword = $_POST["newpasswd"];
        $newPasswordAgain = $_POST["newpasswdagain"];

        if(empty(trim($password))){
            $errors[] = "empty_password";
        }
        if(empty(trim($newPassword))){
            $errors[] = "empty_newpassword";
        }
        if(empty(trim($newPasswordAgain))){
            $errors[] = "empty_newpasswordagain";
        }

        $jelszo = $currentUserData[4];
        if(!empty(trim($password)) && !password_verify($password,$jelszo)){
            $errors[] = "wrong_passwd";
        }

        if(trim($newPassword)!=trim($newPasswordAgain)){
            $errors[] = "new_passwd_not_equal";
        }

        if(count($errors)==0){
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            mysqli_query($con,"UPDATE felhasznalo SET jelszo='$passwordHash' WHERE email='$currentUserData[0]'");
            $_SESSION["successfull"] = true;
            header("Location: ../../../pages/profile/profile_edit_passwd.php");
            exit();

        }
        else{
            $_SESSION["errors"] = $errors;
            header("Location: ../../../pages/profile/profile_edit_passwd.php");
            exit();
        }
    }
    header("Location: ../../../pages/profile/profile_edit_passwd.php");
    exit();

