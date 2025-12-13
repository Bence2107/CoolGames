<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="/img/header/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c6bdff3b5.js" crossorigin="anonymous"></script>
    <title>Bejelentkezés</title>
</head>
<body>
<header>
    <img src="/img/header/logo.png" alt="CoolGames" class="logo">
    <nav>
        <ul class="navbar">
            <li><a href="/index">Főoldal <i class="fa-solid fa-house">&nbsp;</i></a></li>
            <li><a href="/news">Hírek <i class="fa-solid fa-newspaper">&nbsp;</i></a></li>
            <li><a href="/games">Játékok <i class="fa-solid fa-gamepad">&nbsp;</i></a></li>
            <li><a href="/basket">Kosár <i class="fa-solid fa-cart-shopping">&nbsp;</i></a></li>
            <li class="dropdown">
                <a href="/profile" id="active3">Fiók <i class="fa-solid fa-user">&nbsp;</i></a>
                <div class="dropdown_content">
                    <a href="/auth/login" id="active">Bejelentkezés</a><br>
                    <a href="/auth/register">Regisztráció</a>
                </div>
            </li>
        </ul>
    </nav>
</header>
<main>
    <?php if (isset($_SESSION['login_failed'])): ?>
        <div class="failed">
            <b>Hibás email vagy jelszó!</b>
        </div>
        <?php unset($_SESSION['login_failed']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['registration_success'])): ?>
        <div class="successfull">
            <b>Sikeres regisztráció!<br>Kérem jelentkezzen be!</b>
        </div>
        <?php unset($_SESSION['registration_success']); ?>
    <?php endif; ?>

    <div class="inner_main">
        <div id="form_box">
            <h2>Bejelentkezés</h2>
            <form method="post" action="/auth/login">
                <div class="input_field">
                    <input type="text" placeholder="Email" name="email">
                </div>
                <div class="input_field">
                    <input type="password" placeholder="Jelszó" name="passwd">
                </div>
                <input type="submit" value="Bejelentkezés">
            </form>
            <div id="register_link">
                <p>Ha még nem Regisztráltál, <a href="/auth/register">itt</a> megteheted!</p>
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