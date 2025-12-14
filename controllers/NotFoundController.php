<?php

class NotFoundController {

    private View $view;

    public function __construct(View $view) {
        $this->view = $view;
    }

    /**
     * @used-by Router::handle404()
     */
    public function showNotFound() : void{
        http_response_code(404);
        try {
            $this->view->render('error/notFound');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}