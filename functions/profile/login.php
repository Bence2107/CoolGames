<?php
    session_start();
    include "../database.php";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $errors = array();

        $email = $_POST["email"];
        $passwd = $_POST["passwd"];

        if (!empty(trim($email)) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "invalid_email";
            $_SESSION['login_failed'] = true;
        }
        $emailQuery = mysqli_query($con,"SELECT email,jelszo FROM felhasznalo WHERE email='$email'");
        if(mysqli_num_rows($emailQuery)>0){
            $query = mysqli_fetch_row($emailQuery);
            if(!password_verify($passwd,$query[1])){
                $_SESSION['login_failed'] = true;
                $errors[] = "hibas";
                header("Location: ../../pages/profile/log.php");
            }
            else{
                $_SESSION["email"] = $email;
                header("Location: ../../index.php");
            }
        }
        else{
            $errors[] = "hibas";
            $_SESSION['login_failed'] = true;
            header("Location: ../../pages/profile/log.php");
        }

        $_SESSION["errors"] = $errors;
        exit();
    }