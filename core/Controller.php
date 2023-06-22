<?php
namespace Core;
use Core\Page;

class Controller {
    protected $layout = 'default';
    protected $title = '';

    public function returnJSON($messages) {
        header('Content-Type: application/json');
        $messages = json_encode($messages, JSON_UNESCAPED_UNICODE);
        echo $messages;            
        die();
    }

    protected function render($view, $data = []) {
        return new Page($this->layout, $this->title, $view, $data);
    }
}