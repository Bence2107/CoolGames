<?php

use JetBrains\PhpStorm\NoReturn;

class UserController {
    private AuthService $authService;
    private ProfileService $profileService;
    private GameService $gameService;
    private UserDAO $userDAO;
    private View $view;

    public function __construct(AuthService $authService, ProfileService $profileService, GameService $gameService, UserDAO $userDAO, View $view) {
        $this->authService = $authService;
        $this->profileService = $profileService;
        $this->gameService = $gameService;
        $this->userDAO = $userDAO;
        $this->view = $view;
    }

    public function showProfile(array $post = [], array $files = []): void {
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
            $this->view->render('profile/profile', [
                'user' => $user,
                'ownedGames' => $ownedGames
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    #[NoReturn]
    public function handleLogin(array $postData): void {
        $user = $this->authService->login($postData["email"] ?? '', $postData["passwd"] ?? '');

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

    #[NoReturn]
    public function updateUserInfo(string $email, array $postData): void {
        $errors = $this->profileService->updateUserInfo($email, $postData);

        if (empty($errors)) {
            $_SESSION["successfull"] = true;
            // Refresh user in session
            SessionHelper::refreshUser($this->userDAO);
        } else {
            $_SESSION["errors"] = $errors;
        }
        header("Location: /profile/edit");
        exit();
    }

    #[NoReturn]
    public function changePassword(string $email, array $postData): void {
        $errors = $this->authService->changePassword(
            $email,
            $postData["old_passwd"] ?? '',
            $postData["new_passwd"] ?? '',
            $postData["new_passwd_again"] ?? ''
        );

        if (empty($errors)) {
            $_SESSION["successfull"] = true;
            header("Location: /profile/edit/password");
        } else {
            $_SESSION["errors"] = $errors;
            header("Location: /profile/edit/password");
        }
        exit();
    }

    #[NoReturn]
    public function updateProfilePicture(string $email, array $fileData): void {
        if (empty($fileData["name"] ?? null)) {
            header("Location: /profile/edit");
            exit();
        }

        $errors = $this->profileService->updateProfilePicture($email, $fileData);

        if (empty($errors)) {
            $_SESSION["successfull"] = true;
            // Refresh user in session
            SessionHelper::refreshUser($this->userDAO);
        } else {
            $_SESSION["errors"] = $errors;
        }

        header("Location: /profile/edit");
        exit();
    }

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