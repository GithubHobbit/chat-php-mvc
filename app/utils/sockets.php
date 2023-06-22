<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Workerman\Worker;

$users = [];
$ws_worker = new Worker("websocket://0.0.0.0:8000");
$ws_worker->onWorkerStart = function() use (&$users) {
    // создаём локальный tcp-сервер, чтобы отправлять на него сообщения из кода нашего сайта
    $inner_tcp_worker = new Worker("tcp://127.0.0.1:1234");
    // создаём обработчик сообщений, который будет срабатывать,
    // когда на локальный tcp-сокет приходит сообщение
    $inner_tcp_worker->onMessage = function($connection, $data) use (&$users) {
        //error_log($data, 3, "/var/tmp/php.log");
        $data = json_decode($data);
        //error_log($data, 3, serialize($users));
        if (isset($users[$data->user_id])) {
            /////error_log($data, 3, $data->user_id);
            //error_log($data, 3, $users[$data->user_id]);
            
            $user_connection = $users[$data->user_id];
            $message = json_encode($data->message);
            $user_connection->send($message);
        }
    };
    $inner_tcp_worker->listen();
};

$ws_worker->onConnect = function($connection) use (&$users) {
    $connection->onWebSocketConnect = function($connection) use (&$users) {
        $users[$_GET['my_id']] = $connection;
    };
};

$ws_worker->onClose = function($connection) use(&$users) {
    $user = array_search($connection, $users);
    unset($users[$user]);
};

// Run worker
Worker::runAll();





// require __DIR__ . '/../../vendor/autoload.php';
// use Workerman\Worker;

// $ws_worker = new Worker('websocket://0.0.0.0:8000');

// $users = [];
// $ws_worker->onConnect = function ($connection) use (&$users) {
//     echo "New connection\n: ";
//     //$users[$_GET['my_id']] = $connection;
//     echo print_r($_GET);
//     echo print_r($_POST);
//     echo $_SERVER['REQUEST_METHOD'];
//     echo $_SERVER['QUERY_STRING'];
// };

// $ws_worker->onMessage = function ($connection, $data) use (&$users) {
//     $data = json_decode($data);
//     if (isset($users[$data->user_id])) {
//         $user_connection = $users[$data->user_id];
//         $user_connection->send($data->message);
//     }
// };

// $ws_worker->onClose = function ($connection) use (&$users) {
//     echo "Connection closed\n";
//     $user = array_search($connection, $users);
//     unset($users[$user]);
// };

// // Run worker
// Worker::runAll();







// $users = [];
// $ws_worker = new Worker("websocket://0.0.0.0:8000");
// $ws_worker->onWorkerStart = function() use (&$users) {
//     $inner_tcp_worker = new Worker("tcp://127.0.0.1:1234"); 
//     $inner_tcp_worker->onMessage = function($connection, $data) use(&$users) {
//         $data = json_decode($data);
//         if (isset($users[$data->user])) {
//             $webconnection = $users[$data->user];
//             $webconnection->send($data->message);
//         }
//     };
//     $inner_tcp_worker->listen();
// };

// $ws_worker->onConnect = function($connection) use (&$users) {
//     $connection->onWebSoketConnect = function($connection) use (&$users) {
//         $users[$_GET['user']] = $connection;
//     };
// };

// $ws_worker->onClose = function($connection) use(&$users) {
//     $user = array_search($connection, $users);
//     unset($users[$user]);
// };

// Worker::runAll();