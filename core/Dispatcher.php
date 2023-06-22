<?php
    namespace Core;
    use Core\Track;
    use Core\Page;
    use Core\Error;
    class Dispatcher
    {
        public function getPage(Track $track) {
            $controller_name = 
                "\\App\\Controllers\\" . ucfirst($track->controller) . "Controller";

            try {
                $result = (new $controller_name)->{$track->action}($track->param);
                return $result ?
                    $result :
                    new Page('default');
            } catch (\Throwable $e) {
                Error::ErrorPage404("Проблема в контроллере '{$controller_name}' <br> или его методе '{$track->action}'");
            }
        }
    }