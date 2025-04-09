<?php
    session_start();
    $currentUserData = null;
    include "../../database.php";
    include "profileData.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $errors = array();

    $veznev = $_POST["veznev"];
    $kernev = $_POST["kernev"];
    $username = $_POST["username"];
    $szul_datum = $_POST["szul_datum"];


    /*Ellenőrzések*/
    //Emptys
    if (empty(trim($veznev))) {
        $veznev = $currentUserData[2];
    }
    if (empty(trim($kernev))) {
        $kernev = $currentUserData[3];
    }
    if (empty(trim($username))) {
        $username = $currentUserData[1];
    }
    if (empty(trim($szul_datum))) {
        $szul_datum = $currentUserData[5];
    }


    //Nev
    if (trim(strlen($veznev) > 45)) {
        $errors[] = "long_veznev";
    }
    if (trim(strlen($kernev) > 45)) {
        $errors[] = "long_kernev";
    }
    if (trim(strlen($username) > 50)) {
        $errors[] = "long_username";
    }


    if (count($errors) == 0) {
        mysqli_query($con,"UPDATE felhasznalo SET veznev='$veznev',kernev='$kernev',felhasznalo_nev='$username',szul_datum='$szul_datum' WHERE email='$currentUserData[0]'");
        $_SESSION["successfull"] = true;
    } else {
        $_SESSION["errors"] = $errors;
    }
    header("Location: ../profile_edit.php");
    exit();
}