<?php
    namespace Core;
    
    class Track
    {
        private $controller;
        private $action;
        private $param;

        public function __construct($controller, $action, $param) {
            $this->controller = $controller;
            $this->action = $action;
            $this->param = $param;
        }

        public function __get($property) {
            return $this->$property;
        }
    }
