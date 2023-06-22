<?php
    namespace Core;
    use Core\Error;
    class View 
    {
        public function render(Page $page) {
            $view = $this->renderView($page);
            return $this->renderLayout($page, $view);
        }

        public function renderView(Page $page) {
            $view_path = $_SERVER['DOCUMENT_ROOT'] . "/app/Views/{$page->view}.php";
            if (!file_exists($view_path)) {
                Error::ErrorPage404("Не найден файл с представлением по пути {$view_path}");
            }

            ob_start();
                $data = $page->data;
                include $view_path;
            return ob_get_clean();
        }

        public function renderLayout(Page $page, $content) {
            $layout_path = $_SERVER['DOCUMENT_ROOT'] . "/app/Layouts/{$page->layout}.php";
            if (!file_exists($layout_path)) {
                Error::ErrorPage404("Не найден файл с представлением по пути {$layout_path}");
            }

            ob_start();
                $title = $page->title;
                include $layout_path;
            return ob_get_clean();
        }
    }