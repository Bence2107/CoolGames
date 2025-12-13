<?php

class SessionHelper {
    public static function ensureUserInSession(UserDAO $userDAO): void {
        if (isset($_SESSION['email']) && !isset($_SESSION['user'])) {
            $user = $userDAO->getByEmail($_SESSION['email']);
            if ($user) {
                $_SESSION['user'] = $user;   // store User object separately
            }
        }
    }

    public static function refreshUser(UserDAO $userDAO): void {
        if (isset($_SESSION['email'])) {
            $user = $userDAO->getByEmail($_SESSION['email']);
            if ($user) {
                $_SESSION['user'] = $user;   // refresh User object
            }
        }
    }

    public static function getCurrentUser(): ?User {
        return $_SESSION['user'] ?? null;   // always return User object
    }

    public static function isLoggedIn(): bool {
        return isset($_SESSION['user']);    // check User object
    }
}
