<?php
    if(isset($_SESSION["email"])){
        $currentUserEmail = $_SESSION["email"];
        $currentUserQuery = mysqli_query($con,"SELECT * FROM felhasznalo WHERE email='$currentUserEmail'");
        $currentUserData = mysqli_fetch_array($currentUserQuery);
    }
