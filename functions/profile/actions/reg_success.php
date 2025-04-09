<?php
    session_start();
    $_SESSION['registration_success'] = true;

    header("Location: ../../pages/profile/reg.php");
    exit();