<?php
    session_start();
    $_SESSION['login_failed'] = true;

    header("Location: ../../pages/profile/log.php");
    exit();