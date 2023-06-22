<?php
namespace Core;

class Error
{
    static function ErrorPage404($message = null) {
        ob_clean();
        $URL = 'http://' . $_SERVER['HTTP_HOST'] . '/' . '404';
        header('Location: ' . $URL); 
        http_response_code(404);
        include_once 'app/Views/404_view.php';
        die();
    }

    static function ErrorPage500($message = '') {
        ob_clean();
        $URL = 'http://' . $_SERVER['HTTP_HOST'] . '/' . '500';
        header('Location: ' . $URL); 
        http_response_code(500);
        include_once 'app/Views/500_view.php';
        die();
    }
}
