<?php

class HomeController {
    private View $view;

    public function __construct(View $view) {
        $this->view = $view;
    }

    public function index(array $post = [], array $files = []): void {
        try {
            $this->view->render('home/index');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}