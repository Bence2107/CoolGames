<?php

class BasketService {
    private BasketDAO $basketDAO;
    private PurchaseDAO $purchaseDAO;
    private UserDAO $userDAO;

    public function __construct(
        BasketDAO $basketDAO,
        PurchaseDAO $purchaseDAO,
        UserDAO $userDAO
    ) {
        $this->basketDAO = $basketDAO;
        $this->purchaseDAO = $purchaseDAO;
        $this->userDAO = $userDAO;
    }

    /**
     * Add game to user's basket
     */
    public function addToBasket(Game $game, User $user): array {
        // Check if user already owns the game
        $purchase = new Purchase($game->getId(), $user->getEmail());
        if ($this->purchaseDAO->userOwnsGame($purchase)) {
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
            return ['success' => true, 'message' => 'addToBasketSuccessfull'];
        }

        return ['success' => false, 'message' => 'error'];
    }

    /**
     * Remove game from basket
     */
    public function removeFromBasket(Game $game, User $user): bool {
        return $this->basketDAO->removeFromBasket($game, $user);
    }

    /**
     * Purchase all games in basket
     */
    public function purchaseBasket(User $user): array {
        $basketGames = $this->basketDAO->getUsersBasket($user);

        if (empty($basketGames)) {
            return ['success' => false, 'message' => 'emptyBasket'];
        }

        // Calculate total price and reward
        $summary = $this->getBasketSummary($user);
        $totalPrice = $summary['total_price'];
        $reward = $summary['reward'];

        // Check if user has enough money
        $remainingMoney = ($user->getCatcredit() - $totalPrice) + $reward;
        if ($remainingMoney < 0) {
            return ['success' => false, 'message' => 'notEnoughMoneyError'];
        }

        // Update user money
        $user->setCatcredit($remainingMoney);
        $this->userDAO->updateMoney($user);

        // Add purchases
        foreach ($basketGames as $game) {
            $purchase = new Purchase($game->getId(), $user->getEmail());
            $this->purchaseDAO->addPurchase($purchase);
        }

        // Clear basket
        $this->basketDAO->clearBasket($user);

        return ['success' => true, 'message' => 'buySuccessfull'];
    }

    /**
     * Get user's basket
     */
    public function getUserBasket(User $user): array {
        return $this->basketDAO->getUsersBasket($user);
    }

    /**
     * Get basket total price and reward
     */
    public function getBasketSummary(User $user): array {
        $basketGames = $this->basketDAO->getUsersBasket($user);
        $totalPrice = 0;

        foreach ($basketGames as $game) {
            $totalPrice += $game->getAr();
        }

        $reward = floor($totalPrice * 0.15);

        return [
            'total_price' => $totalPrice,
            'reward' => $reward,
            'final_price' => $totalPrice - $reward
        ];
    }
}