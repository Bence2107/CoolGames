<?php


// View.php

class View
{
    private string $viewPath = __DIR__ . '/../views/';


    /**
     * @throws Exception
     */
    public function render(string $view, array $data = []): void
    {
        $file = $this->viewPath . $view . '.php';

        if (!file_exists($file)) {
            throw new Exception("View file not found: " . $file);
        }

        extract($data);

        ob_start();
        require $file;
        ob_end_flush();
    }
}