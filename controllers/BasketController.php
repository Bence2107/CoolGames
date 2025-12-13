<?php

use JetBrains\PhpStorm\NoReturn;

class BasketController {
    private BasketService $basketService;
    private GameService $gameService;
    private UserDAO $userDAO;
    private View $view;

    public function __construct(BasketService $basketService, GameService $gameService, UserDAO $userDAO, View $view) {
        $this->basketService = $basketService;
        $this->gameService = $gameService;
        $this->userDAO = $userDAO;
        $this->view = $view;
    }

    /**
     * Show user's basket
     */
    public function showBasket(array $post = [], array $files = []): void {
        $_SESSION["basket"] = true;

        if (!SessionHelper::isLoggedIn()) {
            header("Location: /auth/login");
            exit();
        }

        SessionHelper::ensureUserInSession($this->userDAO);
        $user = SessionHelper::getCurrentUser();

        if (!$user) {
            header("Location: /auth/login");
            exit();
        }

        $basketGames = $this->basketService->getUserBasket($user);
        $summary = $this->basketService->getBasketSummary($user);

        try {
            $this->view->render('basket/basket', [
                'basketGames' => $basketGames,
                'totalPrice' => $summary['total_price'],
                'reward' => $summary['reward'],
                'finalPrice' => $summary['final_price']
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Add game to basket
     */
    #[NoReturn]
    public function addToBasket(array $post = [], array $files = []): void {
        if (!SessionHelper::isLoggedIn()) {
            header("Location: /auth/login");
            exit();
        }

        SessionHelper::ensureUserInSession($this->userDAO);
        $user = SessionHelper::getCurrentUser();

        if (!$user) {
            header("Location: /auth/login");
            exit();
        }

        $gameId = $post['jatekID'] ?? null;

        if (!$gameId) {
            header("Location: /games");
            exit();
        }

        // Get game by ID
        $games = $this->gameService->getAllGames();
        $game = null;
        foreach ($games as $g) {
            if ($g->getId() == $gameId) {
                $game = $g;
                break;
            }
        }

        if (!$game) {
            header("Location: /games");
            exit();
        }

        $result = $this->basketService->addToBasket($game, $user);
        $_SESSION[$result['message']] = true;

        header("Location: /games");
        exit();
    }

    /**
     * Remove game from basket
     */
    #[NoReturn]
    public function removeFromBasket(array $post = [], array $files = []): void {
        if (!SessionHelper::isLoggedIn()) {
            header("Location: /auth/login");
            exit();
        }

        SessionHelper::ensureUserInSession($this->userDAO);
        $user = SessionHelper::getCurrentUser();

        if (!$user) {
            header("Location: /auth/login");
            exit();
        }

        $gameId = $post['jatekID'] ?? null;

        if (!$gameId) {
            header("Location: /basket");
            exit();
        }

        // Get game by ID
        $games = $this->gameService->getAllGames();
        $game = null;
        foreach ($games as $g) {
            if ($g->getId() == $gameId) {
                $game = $g;
                break;
            }
        }

        if ($game) {
            $this->basketService->removeFromBasket($game, $user);
        }

        header("Location: /basket");
        exit();
    }

    /**
     * Purchase basket
     */
    #[NoReturn]
    public function purchaseBasket(array $post = [], array $files = []): void {
        if (!SessionHelper::isLoggedIn()) {
            header("Location: /auth/login");
            exit();
        }

        SessionHelper::ensureUserInSession($this->userDAO);
        $user = SessionHelper::getCurrentUser();

        if (!$user) {
            header("Location: /auth/login");
            exit();
        }

        $result = $this->basketService->purchaseBasket($user);
        $_SESSION[$result['message']] = true;

        SessionHelper::refreshUser($this->userDAO);

        header("Location: /basket");
        exit();
    }
}