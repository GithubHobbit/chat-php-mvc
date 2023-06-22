<?php
    ini_set('display_errors', 1);    
    require __DIR__ . '/vendor/autoload.php';
    session_start();
    use Core\Router;
    use Core\Dispatcher;
    use Core\View;

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    try {
        $track = (new Router)->getTrack($_SERVER['REQUEST_URI']);
        $page = (new Dispatcher)->getPage($track);
        echo (new View)->render($page);        
    } catch (Throwable $e) {
        die($e->getMessage());
    }
    