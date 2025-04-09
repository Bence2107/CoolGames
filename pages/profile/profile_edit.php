<?php
    session_start();
    $errors = [];
    include_once "../../functions/database.php";
    include_once "../../functions/profile/profileData.php";
    if(!isset($_SESSION['email'])){
        header("Location: log.php");
    }
    if(isset($_SESSION["errors"])){
        $errors = $_SESSION["errors"];
    }
    unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="icon" href="../../img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Profil szerkesztése</title>
</head>
<body>
<header>
    <img src="../../img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="../../index.php">Főoldal <i class="fa-solid fa-house">&nbsp;</i></a></li>
            <li><a href="../news.php">Hírek <i class="fa-solid fa-newspaper">&nbsp;</i></a></li>
            <li><a href="../games.php">Játékok <i class="fa-solid fa-gamepad">&nbsp;</i></a></li>
            <li><a href="../basket.php">Kosár <i class="fa-solid fa-cart-shopping">&nbsp;</i></a></li>
            <?php
            if(!isset($_SESSION["email"])){
                ?>
                <li class="dropdown">
                    <a href="profile.php">Fiók <i class="fa-solid fa-user"></i></a>
                    <div class="dropdown_content">
                        <a href="log.php">Bejelentkezés</a><br>
                        <a href="reg.php">Regisztráció</a>
                    </div>
                </li>
                <?php
            } else{
                if($currentUserData[6]!=null){
                    echo '<li>
                                <a href="profile.php"><img class="header_avatar" src="data:image/png;base64,'.base64_encode($currentUserData[6]).'" alt="" id="active2"></a><p>'.$currentUserData[7]. '&#128008;</p>
                            </li>';
                }
                else{
                    echo '<li><a href="profile.php"><img src="../../img/profile/profilePicture.png" alt="" id="active2" class="header_avatar"></a> <p>'.$currentUserData[7]. '&#128008;</p> </li>';
                }
            }
            ?>
        </ul>
    </nav>
</header>
<main>
    <?php
    if (isset($_SESSION["successfull"])) {
        echo '<div class="successfull">';
        echo "<b>"."Adatok módosítva!" . "</b>";
        echo '</div>';
        unset($_SESSION["successfull"]);
    }
    if (isset($_SESSION["error"])) {
        echo '<div class="failed">';
        echo "<b>"."Nem megfelelő formátum! A megengedett képformátumok: '.jpg', '.png', '.jpeg'" . "</b>";
        echo '</div>';
        unset($_SESSION["error"]);
    }
    if (isset($_SESSION["fileSizeError"])) {
        echo '<div class="failed">';
        echo "<b>"."Túl nagy fájlméret! 3MB vagy annál kisebb lehet!"."</b>";
        echo '</div>';
        unset($_SESSION["fileSizeError"]);
    }
    ?>
    <div class="inner_main">
        <h1 id="cim">Profil módosítása</h1>
        <div class="inner">
            <div class="profile_buttons">
                <?php
                    if($currentUserData[6]!=null){
                        echo '<img class="profile_pick_2" src="data:image/png;base64,'.base64_encode($currentUserData[6]).'" alt="">';
                    }
                    else{
                        echo '<img class="profile_pick_2" src="../../img/profile/profilePicture.png" alt="">';
                    }
                ?>
                <form id="form_box" method="post"  enctype="multipart/form-data" action="../../functions/profile/actions/profile_picture_change.php">
                    <h2>Profilkép módosítása</h2>
                    <input type="file" name="profile-pic"><br>
                    <button type="submit">Profilkép Feltöltése</button>
                </form>
            </div>
            <div id="form_box2">
                <h2>Adatok módosítása</h2>
                <form method="post" action="../../functions/profile/actions/profile_info_change.php">
                    <div class="input_field">
                        <input type="text" placeholder="<?php echo $currentUserData[2] ?>" name="veznev">
                        <div class="error">
                            <?php
                            if(in_array("empty_veznev",$errors)){
                                echo "<b>"."Kérem adja meg a vezetéknevét! "."</b>";
                            }
                            if(in_array("long_veznev",$errors)){
                                echo "<b>"."Túl hosszú vezetéknév. Kérem adjon meg egy rövidebbet "."</b>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="<?php echo $currentUserData[3] ?>" name="kernev">
                        <div class="error">
                            <?php
                            if(in_array("empty_kernev",$errors)){
                                echo "<b>"."Kérem adja meg a keresztnevét! "."</b>";
                            }
                            if(in_array("long_kernev",$errors)){
                                echo "<b>"."Túl hosszú keresztnév. Kérem adjon meg egy rövidebbet!"."</b>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="input_field">
                        <input type="text" placeholder="<?php echo $currentUserData[1] ?>" name="username">
                        <div class="error">
                            <?php
                            if(in_array("empty_username",$errors)){
                                echo "<b>"."Kérem adjon meg egy felhasználónevet! "."</b>";
                            }
                            if(in_array("username_contatins",$errors)){
                                echo "<b>"."Ez a felhasználónév már létezik. Kérem válasszon másikat!"."</b>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="input_field">
                        <input type="date" name="szul_datum">
                        <div class="error">
                            <?php
                            if(in_array("empty_szul_datum",$errors)){
                                echo "<b>"."Kérem adjon meg egy dátumot! "."</b>";
                            }
                            ?>
                        </div>
                    </div>
                    <input type="submit" value="Módosít">
                </form>
        </div>
            <div class="profile_buttons">
                <button onclick="location.href='profile_edit_passwd.php'">Jelszó módosítása</button>
                <button id="warning" onclick="location.href='profile_del_question.php'">Profil törlése</button>
            </div>
    </div>
    </div>
</main>
<footer>
    <hr>
    <div>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">2024 PORT:3306&#169;</a>
    </div>
</footer>
</body>
</html>