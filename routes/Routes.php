<?php
require 'Router.php';

$router = new Router();

//UserController routes:

$router->get('/auth/login', [UserController::class, 'showLogin']);
$router->post('/auth/login', [UserController::class, 'handleLogin']);
$router->get('/profile', [UserController::class, 'showProfile']);
$router->get('/profile/edit', [UserController::class, 'showProfileEdit']);
$router->get('/profile/edit/password', [UserController::class, 'showPasswordEdit']);
$router->get('/profile/delete', [UserController::class, 'showDeleteConfirmation']);
$router->post('/profile/update-info', [UserController::class, 'updateUserInfo']);
$router->post('/profile/update-password', [UserController::class, 'changePassword']);
$router->post('/profile/delete', [UserController::class, 'deleteAccount']);
$router->post('/profile/update-profile-pic', [UserController::class, 'updateProfilePicture']);
$router->post('/profile/register', [UserController::class, 'register']);

//ArticleController routes:

$router->get('/news', [ArticleController::class, 'showNews']);
$router->get('/news/article', [ArticleController::class, 'showArticle']);

$router->dispatch();