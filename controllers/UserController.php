<?php

use JetBrains\PhpStorm\NoReturn;

class UserController {
    private AuthService $authService;
    private ProfileService $profileService;
    private GameService $gameService;
    private View $view;

    public function __construct(AuthService $authService, ProfileService $profileService, GameService $gameService, View $view) {
        $this->authService = $authService;
        $this->profileService = $profileService;
        $this->gameService = $gameService;
        $this->view = $view;
    }

    /**
     * Handles showing Profile page.
     * @return void
     */
    public function showProfile(): void {
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

        $ownedGames = $this->gameService->getUserGames($user);

        try {
            $this->view->render('profile/profile', [
                'user' => $user,
                'ownedGames' => $ownedGames
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Handles Login logic.
     * @param array $postData
     * @return void
     */
    #[NoReturn]
    public function handleLogin(array $postData): void {
        $user = $this->authService->login($postData);

        if ($user) {
            $_SESSION["email"] = $user->getEmail();
            $_SESSION["user"] = $user;
            header("Location: /index");
        } else {
            $_SESSION['login_failed'] = true;
            header("Location: /auth/login");
        }
        exit();
    }

    /**
     * Handles Register logic.
     * @param array $postData
     * @return void
     */
    #[NoReturn]
    public function register(array $postData): void {
        $errors = $this->authService->validateRegistration($postData);

        if (empty($errors) && $this->authService->registerUser($postData)) {
            $_SESSION["registration_success"] = true;

            $user = $this->authService->getUserByEmail($postData["email"]);

            if ($user) {
                $_SESSION["email"] = $user->getEmail();
                $_SESSION["user"] = $user;
            }

            header("Location: /index");
        } else {
            $_SESSION["errors"] = $errors;
            $_SESSION["form_data"] = $postData;
            header("Location: /auth/register");
        }
        exit();
    }

    /**
     * Handles Update User's info logic.
     * @param string $email
     * @param array $postData
     * @return void
     */
    #[NoReturn]
    public function updateUserInfo(string $email, array $postData): void {
        $errors = $this->profileService->updateUserInfo($email, $postData);

        if (empty($errors)) {
            $_SESSION["successful"] = true;
            // Refresh user in session
            SessionHelper::refreshUser($this->authService);
        } else {
            $_SESSION["errors"] = $errors;
        }
        header("Location: /profile/edit");
        exit();
    }

    /**
     * Handles Update User's password logic.
     * @param string $email
     * @param array $postData
     * @return void
     */
    #[NoReturn]
    public function changePassword(string $email, array $postData): void {
        $errors = $this->authService->changePassword($email, $postData);

        if (empty($errors)) {
            $_SESSION["successful"] = true;
        } else {
            $_SESSION["errors"] = $errors;
        }
        header("Location: /profile/edit/password");
        exit();
    }

    /**
     * Handles Update User's picture logic.
     * @param string $email
     * @param array $fileData
     * @return void
     */
    #[NoReturn]
    public function updateProfilePicture(string $email, array $fileData): void {
        if (empty($fileData["name"] ?? null)) {
            header("Location: /profile/edit");
            exit();
        }

        $errors = $this->profileService->updateProfilePicture($email, $fileData);

        if (empty($errors)) {
            $_SESSION["successful"] = true;
            // Refresh user in session
            SessionHelper::refreshUser($this->authService);
        } else {
            $_SESSION["errors"] = $errors;
        }

        header("Location: /profile/edit");
        exit();
    }

    /**
     * Handles delete User's logic.
     * @param string $email
     * @return void
     */
    #[NoReturn]
    public function deleteAccount(string $email): void {
        if ($this->authService->deleteAccount($email)) {
            session_destroy();
            header("Location: /index");
        } else {
            $_SESSION["errors"] = ["delete_failed"];
            header("Location: /profile/delete");
        }
        exit();
    }
}