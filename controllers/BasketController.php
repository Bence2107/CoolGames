<?php

use JetBrains\PhpStorm\NoReturn;

class BasketController {
    private BasketService $basketService;
    private GameService $gameService;
    private AuthService $authService;
    private View $view;

    public function __construct(BasketService $basketService, GameService $gameService, AuthService $authService , View $view) {
        $this->basketService = $basketService;
        $this->gameService = $gameService;
        $this->authService = $authService;
        $this->view = $view;
    }

    /**
     * Handles showing User's basket.
     * @return void
     */
    public function showBasket(): void {
        $_SESSION["basket"] = true;

        if (!SessionHelper::isLoggedIn()) {
            header("Location: /auth/login");
            exit();
        }

        SessionHelper::ensureUserInSession($this->authService);
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
     * Handles adding Game to User's basket.
     * @param array $post
     * @return void
     */
    #[NoReturn]
    public function addToBasket(array $post = []): void {
        if (!SessionHelper::isLoggedIn()) {
            header("Location: /auth/login");
            exit();
        }

        SessionHelper::ensureUserInSession($this->authService);
        $user = SessionHelper::getCurrentUser();

        if (!$user) {
            header("Location: /auth/login");
            exit();
        }

        $gameId = $post['game_id'] ?? null;

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
     * Handles removing Game from User's basket
     * @param array $post
     * @return void
     */
    #[NoReturn]
    public function removeFromBasket(array $post = []): void {
        if (!SessionHelper::isLoggedIn()) {
            header("Location: /auth/login");
            exit();
        }

        SessionHelper::ensureUserInSession($this->authService);
        $user = SessionHelper::getCurrentUser();

        if (!$user) {
            header("Location: /auth/login");
            exit();
        }

        $gameId = $post['game_id'] ?? null;

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
     * Handles purchasing in basket.
     * @return void
     */
    #[NoReturn]
    public function purchaseBasket(): void {
        if (!SessionHelper::isLoggedIn()) {
            header("Location: /auth/login");
            exit();
        }

        SessionHelper::ensureUserInSession($this->authService);
        $user = SessionHelper::getCurrentUser();

        if (!$user) {
            header("Location: /auth/login");
            exit();
        }

        $result = $this->basketService->purchaseBasket($user);
        $_SESSION[$result['message']] = true;

        SessionHelper::refreshUser($this->authService);

        header("Location: /basket");
        exit();
    }
}