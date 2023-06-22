<?php

    namespace App\Middleware;

    class Middleware 
    {
        public static function isAuth() {
            if ($_SESSION['user']) {
                header('Location: /auth/login');
                die();
            }
        } 
    }