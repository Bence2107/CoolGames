<?php
    if(!isset($_SESSION["news"])){
        header("Location: ../../pages/news.php");
        exit();
    }
    //News
    $newsQuery = mysqli_query($con,"SELECT * FROM hir ORDER BY datum DESC");

    //New
    $new_name = null;
    if(isset($_GET['cim'])) {
        $new_name = $_GET['cim'];
    }
    $newQuery = mysqli_query($con,"SELECT * FROM hir WHERE cim='$new_name'");
    $newData = mysqli_fetch_array($newQuery);