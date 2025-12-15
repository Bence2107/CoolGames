<?php

class GameService {
    private GameDAO $gameDAO;
    private PurchaseDAO $purchaseDAO;
    private RatingDAO $ratingDAO;
    private UserDAO $userDAO;

    public function __construct(
        GameDAO     $gameDAO,
        PurchaseDAO $purchaseDAO,
        RatingDAO   $ratingDAO,
        UserDAO     $userDAO
    )
    {
        $this->gameDAO = $gameDAO;
        $this->purchaseDAO = $purchaseDAO;
        $this->ratingDAO = $ratingDAO;
        $this->userDAO = $userDAO;
    }

    /**
     * Rates a Game by User
     * @param Game $game
     * @param User $user
     * @param int $ratingValue
     * @return array|null
     */
    public function rateGame(Game $game, User $user, int $ratingValue): ?array {
        // Validate rating value
        if ($ratingValue <= 0) {
            return ['success' => false, 'message' => 'invalidRating'];
        }

        // Check if user already rated this game
        if ($this->ratingDAO->hasUserRated($game, $user)) {
            return ['success' => false, 'message' => 'alreadyRated'];
        }

        // Check if user owns the game
        $purchase = new Purchase($game->getId(), $user->getEmail());
        if (!$this->purchaseDAO->isUserOwnsTheGame($purchase)) {
            return ['success' => false, 'message' => 'notOwnedRate'];
        }

        // Calculate new rating
        $ratingStats = $this->ratingDAO->getRatingStats($game);
        if ($ratingStats['count'] == 0) {
            $newRating = ($game->getRating() + $ratingValue) / 2;
        } else {
            $newRating = ($ratingStats['total'] + $ratingValue) / ($ratingStats['count'] + 1);
        }

        // Add rating
        $rating = new Rating($game->getId(), $user->getEmail(), $ratingValue);
        $this->ratingDAO->addRating($rating);

        // Update game rating
        $this->gameDAO->updateGameRating($game, $newRating);

        // Award user money (5 units)
        $newCatCredit = $user->getCatCredit() + 5;
        $user->setCatCredit($newCatCredit);
        $this->userDAO->updateCatCredit($user);

        return ['success' => true, 'message' => 'ratingSuccess'];
    }

    /**
     * Returns all Games.
     * @return array|null
     */
    public function getAllGames(): ?array {
        return $this->gameDAO->getGames();
    }

    /**
     * Returns the Top 3 Games by Rating.
     * @return array|null
     */
    public function getTopGames(): ?array {
        return $this->gameDAO->getTopThreeGames();
    }

    /**
     * Returns Game by Title.
     * @param string $name
     * @return Game|null
     */
    public function getGameByTitle(string $name): ?Game {
        return $this->gameDAO->getGameByName(trim($name));
    }

    /**
     * Get user's owned games.
     * @param User $user
     * @return array|null
     */
    public function getUserGames(User $user): ?array {
        return $this->purchaseDAO->getUserGames($user->getEmail());
    }

    /**
     * Checks if User can rate the game.
     * @param Game $game
     * @param User $user
     * @return bool
     */
    public function canUserRate(Game $game, User $user): bool {
        $purchase = new Purchase($game->getId(), $user->getEmail());
        return $this->purchaseDAO->isUserOwnsTheGame($purchase)
            && !$this->ratingDAO->hasUserRated($game, $user);
    }

    /**
     * Get User's rating on the Game.
     * @param Game $game
     * @param User $user
     * @return float|null
     */
    public function getUserRating(Game $game, User $user): ?float {
        return $this->ratingDAO->getUserRating($game, $user);
    }
}