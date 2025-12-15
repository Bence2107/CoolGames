<?php

class ProfileController {
    private View $view;
    private AuthService $authService;

    public function __construct(View $view, AuthService $authService) {
        $this->view = $view;
        $this->authService = $authService;
    }

    /**
     * Handling show Profile Edit page.
     * @return void
     */
    public function showEdit(): void {
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

        try {
            $this->view->render('profile/edit', ['user' => $user]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Handling show Password Edit page.
     * @return void
     */
    public function showPasswordEdit(): void {
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

        try {
            $this->view->render('profile/edit_password', ['user' => $user]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Handling show Profile Delete page.
     * @return void
     */
    public function showDelete(): void {
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

        try {
            $this->view->render('profile/delete', ['user' => $user]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}