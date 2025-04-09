<?php
    session_start();
    include "../database.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $errors = array();

    $email = $_POST["email"];
    $veznev = $_POST["veznev"];
    $kernev = $_POST["kernev"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordagain = $_POST["passwdagain"];
    $szul_datum = $_POST["szul_datum"];

    /*Ellenőrzések*/
    //Emptys

    if(empty(trim($email))){
        $errors[] = "empty_email";
    }
    if(empty(trim($veznev))){
        $errors[] = "empty_veznev";
    }
    if(empty(trim($kernev))){
        $errors[] = "empty_kernev";
    }
    if(empty(trim($username))){
        $errors[] = "empty_username";
    }
    if(empty(trim($password))){
        $errors[] = "empty_password";
    }
    if(empty(trim($passwordagain))){
        $errors[] = "empty_passwordagain";
    }
    if(empty(trim($szul_datum))){
        $errors[] = "empty_szul_datum";
    }

    //Nev
    if(trim(strlen($veznev)>45)){
        $errors[] = "long_veznev";
    }
    if(trim(strlen($kernev)>45)){
        $errors[] = "long_kernev";
    }
    if(trim(strlen($username)>50)){
        $errors[] = "long_username";
    }
    $usernameCheck = mysqli_query($con,"SELECT felhasznalo_nev FROM felhasznalo WHERE felhasznalo_nev='$username'");
    if(mysqli_num_rows($usernameCheck)>0)
    {
        $errors[] = "username_contains";
    }



    //Jelszo
    if($password !== "" && strlen($password) < 7)
        $errors[] = "short_password";
    if($password!== "" && strlen($password) > 7 && (!preg_match("/[a-zA-Z]/",$password) || !preg_match("/[0-9]/",$password)))
        $errors[] = "wrong_character";
    if(trim($passwordagain!="" && $password!=$passwordagain)){
        $errors[] = "passwords_not_match";
    }
    $passwordCheck = mysqli_query($con,"SELECT jelszo FROM felhasznalo");

    //Email
    if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "helytelen_email";
    $emailCheck = mysqli_query($con,"SELECT email from felhasznalo where email='$email'");
    if(mysqli_num_rows($emailCheck)>0)
    {
        $errors[] = "email_contains";
    }

    //Datum
    $szul_datum2 = explode("-",$szul_datum);
    if($szul_datum2[0]<1930 || $szul_datum2[0]>2024){
        $errors[] = "invalid_year";
    }


    if(count($errors)==0){
        $password = password_hash($password,PASSWORD_DEFAULT);
        mysqli_query($con, "INSERT INTO felhasznalo (email,felhasznalo_nev,veznev,kernev,jelszo,szul_datum) 
                    VALUES ('$email','$username','$veznev','$kernev','$password','$szul_datum')");
        $_SESSION["registration_success"] = true;
    }
    else{
        $_SESSION["errors"] = $errors;
    }
    header("Location: ../../pages/profile/reg.php");
    exit();
}