<?php
    session_start();
    $currentUserData = null;
    include "../../database.php";
    include "profileData.php";
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

        $jelszoAllQuery = mysqli_query($con,"SELECT jelszo FROM felhasznalo");
        $jelszo = $currentUserData[4];

        if(!empty(trim($password)) && !password_verify($password,$jelszo)){
            $errors[] = "wrong_passwd";
        }

        if($newPassword!=$newPasswordAgain){
            $errors[] = "new_passwd_not_equal";
        }

        if(count($errors)==0){
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            mysqli_query($con,"UPDATE felhasznalo SET jelszo='$passwordHash' WHERE email='$currentUserData[0]'");
            $_SESSION["successfull"] = true;
            header("Location: ../profile_edit_passwd.php");
            exit();

        }
        else{
            $_SESSION["errors"] = $errors;
            header("Location: ../profile_edit_passwd.php");
            exit();
        }


    }
