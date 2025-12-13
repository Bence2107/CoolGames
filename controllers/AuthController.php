<?php

use JetBrains\PhpStorm\NoReturn;

class AuthController {
    private View $view;

    public function __construct(View $view) {
        $this->view = $view;
    }

    public function showLogin(): void {
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

    public function showRegister(): void {
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

    #[NoReturn]
    public function logout(): void {
        session_destroy();
        header("Location: /index");
        exit();
    }
}