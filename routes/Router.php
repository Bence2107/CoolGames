<?php
// Ezt a fájlt kell a main index.php-ban include-olni.

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
                $userDao = new UserDAO($pdoConnection);

                $authService = new AuthService($userDao);
                $profileService = new ProfileService($userDao);

                $view = new View();

                $controller = new $controllerClass($authService, $profileService, $view);

                $controller->$methodName($_POST, $_FILES);

                return;
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Page Not Found</h1>";
    }
}