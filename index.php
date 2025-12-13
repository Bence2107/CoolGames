<?php

// Autoload or require all necessary files
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/controllers/helpers/SessionHelper.php';

// Models
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Game.php';
require_once __DIR__ . '/models/Article.php';
require_once __DIR__ . '/models/Purchase.php';
require_once __DIR__ . '/models/Rating.php';

// DAOs
require_once __DIR__ . '/dao/UserDAO.php';
require_once __DIR__ . '/dao/GameDAO.php';
require_once __DIR__ . '/dao/ArticleDAO.php';
require_once __DIR__ . '/dao/BasketDAO.php';
require_once __DIR__ . '/dao/PurchaseDAO.php';
require_once __DIR__ . '/dao/RatingDAO.php';

// Services
require_once __DIR__ . '/services/AuthService.php';
require_once __DIR__ . '/services/ProfileService.php';
require_once __DIR__ . '/services/GameService.php';
require_once __DIR__ . '/services/BasketService.php';
require_once __DIR__ . '/services/ArticleService.php';

// Controllers
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/GameController.php';
require_once __DIR__ . '/controllers/BasketController.php';
require_once __DIR__ . '/controllers/ArticleController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ProfileController.php';
require_once __DIR__ . '/controllers/HomeController.php';

// View
require_once __DIR__ . '/views/View.php';

// Router
require_once __DIR__ . '/Router.php';

session_start();


// Initialize router
$router = new Router();

// Define routes

// Home
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
