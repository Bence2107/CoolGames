<?php

class Router
{
    private array $routes = [];
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    private function add(string $method, string $uri, array $handler): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        $this->routes[] = [
            'uri' => $uri,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    public function get(string $uri, array $handler): void
    {
        $this->add('GET', $uri, $handler);
    }

    public function post(string $uri, array $handler): void
    {
        $this->add('POST', $uri, $handler);
    }

    public function dispatch(): void
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['uri'] === $requestUri && $route['method'] === $requestMethod) {
                $this->handleRoute($route);
                return;
            }
        }

        $this->handle404();
    }

    private function handleRoute(array $route): void
    {
        // Validate handler structure
        if (!isset($route['handler']) || !is_array($route['handler']) || count($route['handler']) !== 2) {
            die("Invalid route handler configuration");
        }

        $controllerClass = $route['handler'][0];
        $methodName = $route['handler'][1];

        // Validate controller class and method
        if (empty($controllerClass) || empty($methodName)) {
            die("Controller class or method name is empty");
        }

        // Ensure user is in session
        try {
            SessionHelper::ensureUserInSession($this->container->get('authService'));
        } catch (Exception $e) {
            die($e->getMessage());
        }

        // Get controller from container (automatically resolved with dependencies)
        try {
            $controller = $this->container->make($controllerClass);
        } catch (Exception $e) {
            die($e->getMessage());
        }

        // Verify method exists
        if (!method_exists($controller, $methodName)) {
            die("Method '$methodName' does not exist in controller '$controllerClass'");
        }

        // Call the appropriate method with proper parameters
        $this->callControllerMethod($controller, $methodName);
    }

    private function callControllerMethod($controller, string $methodName): void
    {
        // Special handling for methods that need specific parameters
        switch ($methodName) {
            case 'changePassword':
            case 'updateUserInfo':
                $controller->$methodName($_SESSION['email'] ?? '', $_POST);
                break;

            case 'deleteAccount':
                $controller->$methodName($_SESSION['email'] ?? '');
                break;

            case 'updateProfilePicture':
                $controller->$methodName($_SESSION['email'] ?? '', $_FILES['profile-pic'] ?? []);
                break;

            default:
                $controller->$methodName($_POST, $_FILES);
                break;
        }
    }

    private function handle404(): void
    {
        http_response_code(404);

        try {
            $controller = $this->container->get('NotFoundController');
            $controller->showNotFound();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}