<?php
    namespace Core;
    use Core\Track;
    class Router {
        function getTrack($uri) {
            $controller_name = 'chat';
            $action = 'getAllProfiles';
            $param = null;
            
            $uri = explode('?', $uri)[0];
            $route = explode('/', $uri);
            if (!empty($route[1])) {
                $controller_name = $route[1];
            }
            
            if (!empty($route[2])) {
                $action = $route[2];
            }

            if (!empty($route[3])) {
                $param = $route[3];
            }

            return new Track($controller_name, $action, $param);   
        }
    }