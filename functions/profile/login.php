<?php
    session_start();
    include "../database.php";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST["email"];
        $passwd = $_POST["passwd"];

        if (!empty(trim($email)) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['invalid_email'] = true;
        }
        $emailQuery = mysqli_query($con,"SELECT email,jelszo FROM felhasznalo WHERE email='$email'");
        if(mysqli_num_rows($emailQuery)>0){
            $userData = mysqli_fetch_assoc($emailQuery);
            if(!password_verify($passwd,$userData['jelszo'])){
                $_SESSION['wrong_password'] = true;
                header("Location: ../../pages/profile/log.php");
                exit();
            }
            else{
                $_SESSION["email"] = $email;
                header("Location: ../../index.php");
                exit();
            }
        }
        else{
            $_SESSION['userNotFound'] = true;
            header("Location: ../../pages/profile/log.php");
            exit();
        }
    }
    header("Location: ../../pages/profile/log.php");
    exit();