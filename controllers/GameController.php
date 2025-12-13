<?php

use JetBrains\PhpStorm\NoReturn;

class GameController {
    private GameService $gameService;
    private UserDAO $userDAO;
    private View $view;

    public function __construct(GameService $gameService, UserDAO $userDAO, View $view) {
        $this->gameService = $gameService;
        $this->userDAO = $userDAO;
        $this->view = $view;
    }

    /**
     * Show all games page
     */
    public function showGames(): void {
        $_SESSION["games"] = true;

        if (!SessionHelper::isLoggedIn()) {
            header("Location: /auth/login");
            exit();
        }

        SessionHelper::ensureUserInSession($this->userDAO);

        $games = $this->gameService->getAllGames();
        $topGames = $this->gameService->getTopGames();

        try {
            $this->view->render('games/games', [
                'games' => $games,
                'topGames' => $topGames
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function showGame(): void {
        $_SESSION["games"] = true;

        if (!SessionHelper::isLoggedIn()) {
            header("Location: /auth/login");
            exit();
        }

        SessionHelper::ensureUserInSession($this->userDAO);

        $gameName = $_GET['name'] ?? null;
        if (!$gameName) {
            header("Location: /games");
            exit();
        }

        $game = $this->gameService->getGameByName($gameName);
        if (!$game) {
            header("Location: /games");
            exit();
        }

        $user = SessionHelper::getCurrentUser();
        $canRate = false;
        $userRating = null;

        if ($user) {
            $canRate = $this->gameService->canUserRate($game, $user);
            $userRating = $this->gameService->getUserRating($game, $user);
        }

        try {
            $this->view->render('games/game', [
                'game' => $game,
                'canRate' => $canRate,
                'userRating' => $userRating
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Rate a game
     */
    #[NoReturn]
    public function rateGame(array $post = []): void {
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

        $gameId = $_GET['id'] ?? null;
        $rating = $post['rating'] ?? null;

        if (!$gameId || !$rating) {
            header("Location: /games");
            exit();
        }

        // Parse game ID from the format used in your old code
        $gameDataCharacters = explode("'", $gameId);
        $actualGameId = $gameDataCharacters[1] ?? $gameId;

        // Get game by ID
        $games = $this->gameService->getAllGames();
        $game = null;
        foreach ($games as $g) {
            if ($g->getId() == $actualGameId) {
                $game = $g;
                break;
            }
        }

        if (!$game) {
            header("Location: /games");
            exit();
        }

        $result = $this->gameService->rateGame($game, $user, (int)$rating);
        $_SESSION[$result['message']] = true;

        // Refresh user in session with updated money
        SessionHelper::refreshUser($this->userDAO);

        header("Location: /games");
        exit();
    }

    /**
     * Show user's library (owned games)
     */
    public function showLibrary(): void {
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

        $ownedGames = $this->gameService->getUserGames($user);

        try {
            $this->view->render('games/library', [
                'ownedGames' => $ownedGames
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}