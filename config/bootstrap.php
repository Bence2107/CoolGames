<?php

/**
 * Initialize Backend components.
 */

require_once __DIR__ . '/../db/Database.php';
require_once __DIR__ . '/../controllers/helpers/SessionHelper.php';

// Models
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Game.php';
require_once __DIR__ . '/../models/Article.php';
require_once __DIR__ . '/../models/Purchase.php';
require_once __DIR__ . '/../models/Rating.php';

// DAOs
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/GameDAO.php';
require_once __DIR__ . '/../dao/ArticleDAO.php';
require_once __DIR__ . '/../dao/BasketDAO.php';
require_once __DIR__ . '/../dao/PurchaseDAO.php';
require_once __DIR__ . '/../dao/RatingDAO.php';

// Services
require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../services/ProfileService.php';
require_once __DIR__ . '/../services/GameService.php';
require_once __DIR__ . '/../services/BasketService.php';
require_once __DIR__ . '/../services/ArticleService.php';

// Controllers
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/GameController.php';
require_once __DIR__ . '/../controllers/BasketController.php';
require_once __DIR__ . '/../controllers/ArticleController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ProfileController.php';
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/NotFoundController.php';

// View
require_once __DIR__ . '/../views/View.php';

// Container and Router
require_once __DIR__ . '/Container.php';
require_once __DIR__ . '/../Router.php';

session_start();

// Create the container
$container = new Container();

// Register database connection
$container->set('pdo', function () {
    return Database::getInstance()->getConnection();
});

// Register DAOs
$container->set('userDao', function ($c) {
    return new UserDAO($c->get('pdo'));
});

$container->set('articleDao', function ($c) {
    return new ArticleDAO($c->get('pdo'));
});

$container->set('gameDao', function ($c) {
    return new GameDAO($c->get('pdo'));
});

$container->set('basketDao', function ($c) {
    return new BasketDAO($c->get('pdo'));
});

$container->set('purchaseDao', function ($c) {
    return new PurchaseDAO($c->get('pdo'));
});

$container->set('ratingDao', function ($c) {
    return new RatingDAO($c->get('pdo'));
});

// Register Services
$container->set('authService', function ($c) {
    return new AuthService($c->get('userDao'));
});

$container->set('profileService', function ($c) {
    return new ProfileService($c->get('userDao'));
});

$container->set('articleService', function ($c) {
    return new ArticleService($c->get('articleDao'));
});

$container->set('gameService', function ($c) {
    return new GameService(
        $c->get('gameDao'),
        $c->get('purchaseDao'),
        $c->get('ratingDao'),
        $c->get('userDao')
    );
});

$container->set('basketService', function ($c) {
    return new BasketService(
        $c->get('basketDao'),
        $c->get('purchaseDao'),
        $c->get('userDao')
    );
});

// Register View
$container->set('view', function () {
    return new View();
});

// Register Controllers
$container->set('UserController', function ($c) {
    return new UserController(
        $c->get('authService'),
        $c->get('profileService'),
        $c->get('gameService'),
        $c->get('view')
    );
});

$container->set('ArticleController', function ($c) {
    return new ArticleController(
        $c->get('articleService'),
        $c->get('view')
    );
});

$container->set('GameController', function ($c) {
    return new GameController(
        $c->get('gameService'),
        $c->get('authService'),
        $c->get('view')
    );
});

$container->set('BasketController', function ($c) {
    return new BasketController(
        $c->get('basketService'),
        $c->get('gameService'),
        $c->get('authService'),
        $c->get('view')
    );
});

$container->set('AuthController', function ($c) {
    return new AuthController($c->get('view'));
});

$container->set('ProfileController', function ($c) {
    return new ProfileController(
        $c->get('view'),
        $c->get('authService')
    );
});

$container->set('HomeController', function ($c) {
    return new HomeController($c->get('view'));
});


$container->set('NotFoundController', function ($c) {
    return new NotFoundController($c->get('view'));
});

// Initialize router with container
$router = new Router($container);

// Define routes
$router->get('/', ['HomeController', 'index']);
$router->get('/index', ['HomeController', 'index']);

// News routes
$router->get('/news', ['ArticleController', 'showNews']);
$router->get('/news/article', ['ArticleController', 'showArticle']);

// Auth routes
$router->get('/auth/login', ['AuthController', 'showLogin']);
$router->post('/auth/login', ['UserController', 'handleLogin']);
$router->get('/auth/register', ['AuthController', 'showRegister']);
$router->post('/auth/register', ['UserController', 'register']);
$router->post('/auth/logout', ['AuthController', 'logout']);

// Profile routes
$router->get('/profile', ['UserController', 'showProfile']);
$router->get('/profile/edit', ['ProfileController', 'showEdit']);
$router->post('/profile/edit', ['UserController', 'updateUserInfo']);
$router->get('/profile/edit/password', ['ProfileController', 'showPasswordEdit']);
$router->post('/profile/edit/password', ['UserController', 'changePassword']);
$router->post('/profile/picture', ['UserController', 'updateProfilePicture']);
$router->get('/profile/delete', ['ProfileController', 'showDelete']);
$router->post('/profile/delete', ['UserController', 'deleteAccount']);

// Game routes
$router->get('/games', ['GameController', 'showGames']);
$router->get('/games/game', ['GameController', 'showGame']);
$router->post('/games/rate', ['GameController', 'rateGame']);
$router->get('/games/library', ['GameController', 'showLibrary']);

// Basket routes
$router->get('/basket', ['BasketController', 'showBasket']);
$router->post('/basket/add', ['BasketController', 'addToBasket']);
$router->post('/basket/remove', ['BasketController', 'removeFromBasket']);
$router->post('/basket/purchase', ['BasketController', 'purchaseBasket']);

// Dispatch the request
$router->dispatch();