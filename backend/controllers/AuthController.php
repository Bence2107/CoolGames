<?php

class AuthController {
    private View $view;

    public function __construct(View $view) {
        $this->view = $view;
    }

    public function showLogin(array $post = [], array $files = []): void {
        if (SessionHelper::isLoggedIn()) {
            header("Location: /profile");
            exit();
        }

        try {
            $this->view->render('auth/login');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function showRegister(array $post = [], array $files = []): void {
        if (SessionHelper::isLoggedIn()) {
            header("Location: /profile");
            exit();
        }

        try {
            $this->view->render('auth/register');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function logout(array $post = [], array $files = []): void {
        session_destroy();
        header("Location: /index");
        exit();
    }
}