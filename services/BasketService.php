<?php

class BasketService {
    private BasketDAO $basketDAO;
    private PurchaseDAO $purchaseDAO;
    private UserDAO $userDAO;

    public function __construct(
        BasketDAO   $basketDAO,
        PurchaseDAO $purchaseDAO,
        UserDAO     $userDAO
    )
    {
        $this->basketDAO = $basketDAO;
        $this->purchaseDAO = $purchaseDAO;
        $this->userDAO = $userDAO;
    }

    /**
     * Add Game to User's basket
     * @param Game $game
     * @param User $user
     * @return array|null
     */
    public function addToBasket(Game $game, User $user): ?array {
        // Check if user already owns the game
        $purchase = new Purchase($game->getId(), $user->getEmail());
        if ($this->purchaseDAO->isUserOwnsTheGame($purchase)) {
            return ['success' => false, 'message' => 'ownedGame'];
        }

        // Check if game is already in basket
        $basketGames = $this->basketDAO->getUsersBasket($user);
        foreach ($basketGames as $basketGame) {
            if ($basketGame->getId() === $game->getId()) {
                return ['success' => false, 'message' => 'alreadyInBasket'];
            }
        }

        // Add to basket
        if ($this->basketDAO->addToBasket($game, $user)) {
            return ['success' => true, 'message' => 'addToBasketSuccessful'];
        }

        return ['success' => false, 'message' => 'error'];
    }

    /**
     * Remove Game from User's basket
     * @param Game $game
     * @param User $user
     * @return bool (returns if the action was successful)
     */
    public function removeFromBasket(Game $game, User $user): bool {
        return $this->basketDAO->removeFromBasket($game, $user);
    }

    /**
     * Purchase all Game's, what's inside User's basket.
     * @param User $user
     * @return array|null
     */
    public function purchaseBasket(User $user): ?array {
        $basketGames = $this->basketDAO->getUsersBasket($user);

        if (empty($basketGames)) {
            return ['success' => false, 'message' => 'emptyBasket'];
        }

        // Calculate total price and reward
        $summary = $this->getBasketSummary($user);
        $totalPrice = $summary['total_price'];
        $reward = $summary['reward'];

        // Check if user has enough money
        $remainingCatCredit = ($user->getCatCredit() - $totalPrice) + $reward;
        if ($remainingCatCredit < 0) {
            return ['success' => false, 'message' => 'notEnoughMoneyError'];
        }

        // Update user money
        $user->setCatCredit($remainingCatCredit);
        $this->userDAO->updateCatCredit($user);

        // Add purchases
        foreach ($basketGames as $game) {
            $purchase = new Purchase($game->getId(), $user->getEmail());
            $this->purchaseDAO->addPurchase($purchase);
        }

        // Clear basket
        $this->basketDAO->clearBasket($user);

        return ['success' => true, 'message' => 'buySuccessful'];
    }

    /**
     * Get all Games what's inside
     * @param User $user
     * @return array|null
     */
    public function getUserBasket(User $user): ?array {
        return $this->basketDAO->getUsersBasket($user);
    }

    /**
     * Get User's basket summary
     * @param User $user
     * @return array|null (returns total price, reward, final price)
     */
    public function getBasketSummary(User $user): ?array {
        $basketGames = $this->basketDAO->getUsersBasket($user);
        $totalPrice = 0;

        foreach ($basketGames as $game) {
            $totalPrice += $game->getPrice();
        }

        $reward = floor($totalPrice * 0.15);

        return [
            'total_price' => $totalPrice,
            'reward' => $reward,
            'final_price' => $totalPrice - $reward
        ];
    }
}