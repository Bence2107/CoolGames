<?php

class ProfileController {
    private View $view;
    private UserDAO $userDAO;

    public function __construct(View $view, UserDAO $userDAO) {
        $this->view = $view;
        $this->userDAO = $userDAO;
    }

    public function showEdit(array $post = [], array $files = []): void {
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

        try {
            $this->view->render('profile/edit', ['user' => $user]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function showPasswordEdit(array $post = [], array $files = []): void {
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

        try {
            $this->view->render('profile/edit_password', ['user' => $user]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function showDelete(array $post = [], array $files = []): void {
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

        try {
            $this->view->render('profile/delete', ['user' => $user]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}