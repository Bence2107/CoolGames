<?php

class SessionHelper {
    public static function ensureUserInSession(UserDAO $userDAO): void {
        if (isset($_SESSION['email']) && !isset($_SESSION['user'])) {
            $user = $userDAO->getByEmail($_SESSION['email']);
            if ($user) {
                $_SESSION['user'] = $user;
            }
        }
    }

    /**
     * Refresh user object from database
     */
    public static function refreshUser(UserDAO $userDAO): void {
        if (isset($_SESSION['email'])) {
            $user = $userDAO->getByEmail($_SESSION['email']);
            if ($user) {
                $_SESSION['user'] = $user;
            }
        }
    }

    /**
     * Get current logged-in user
     */
    public static function getCurrentUser(): ?User {
        return $_SESSION['user'] ?? null;
    }

    /**
     * Check if user is logged in
     */
    public static function isLoggedIn(): bool {
        return isset($_SESSION['email']);
    }
}