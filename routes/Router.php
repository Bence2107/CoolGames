<?php

class Router {
    private array $routes = [];

    private function add(string $method, string $uri, array $handler): void {
        $uri = strtok($uri, '?');

        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    public function get(string $uri, array $handler): void {
        $this->add('GET', $uri, $handler);
    }

    public function post(string $uri, array $handler): void {
        $this->add('POST', $uri, $handler);
    }

    public function dispatch(): void {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['uri'] === $requestUri && $route['method'] === $requestMethod) {
                $controllerClass = $route['handler'][0];
                $methodName = $route['handler'][1];

                $pdoConnection = Database::getInstance()->getConnection();

                // Initialize DAOs
                $userDao = new UserDAO($pdoConnection);
                $articleDAO = new ArticleDAO($pdoConnection);
                $gameDAO = new GameDAO($pdoConnection);
                $basketDAO = new BasketDAO($pdoConnection);
                $purchaseDAO = new PurchaseDAO($pdoConnection);
                $ratingDAO = new RatingDAO($pdoConnection);

                SessionHelper::ensureUserInSession($userDao);

                // Initialize Services
                $authService = new AuthService($userDao);
                $profileService = new ProfileService($userDao);
                $articleService = new ArticleService($articleDAO);
                $gameService = new GameService($gameDAO, $purchaseDAO, $ratingDAO, $userDao);
                $basketService = new BasketService($basketDAO, $purchaseDAO, $userDao);

                // Initialize View
                $view = new View();

                // Initialize Controller based on type
                if ($controllerClass === 'UserController') {
                    $controller = new $controllerClass($authService, $profileService, $gameService, $userDao, $view);
                } elseif ($controllerClass === 'ArticleController') {
                    $controller = new $controllerClass($articleService, $view);
                } elseif ($controllerClass === 'GameController') {
                    $controller = new $controllerClass($gameService, $userDao, $view);
                } elseif ($controllerClass === 'BasketController') {
                    $controller = new $controllerClass($basketService, $gameService, $userDao, $view);
                } elseif ($controllerClass === 'AuthController') {
                    $controller = new $controllerClass($view);
                } elseif ($controllerClass === 'ProfileController') {
                    $controller = new $controllerClass($view, $userDao);
                } elseif ($controllerClass === 'HomeController') {
                    $controller = new $controllerClass($view);
                }

                $controller->$methodName($_POST, $_FILES);
                return;
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Page Not Found</h1>";
    }
}