<?php
    namespace App\Controllers;
    use Core\Controller;
    use App\Models\UserModel;
    use App\Models\ChatModel;
    class ChatController extends Controller
    {
        public function getAllProfiles() {
            $user_model = new UserModel;
            $users = $user_model->getUsers();
            return $this->render('chats_view', $users);
        }

        public function getAllChatData() {
            $chat_model = new ChatModel;
            $user_model = new UserModel;
            $my_id = $_SESSION['user']['id'];
            $user_id = $_GET['user_id'];
            $chat = $chat_model->getChat($my_id, $user_id);
            $messages = $chat_model->getMessagesByRoomId($chat['chat_room_id']);
            $me = $user_model->getUser($my_id);
            $user = $user_model->getUser($user_id);

            return $this->render('chat_view', [
                'messages' => $messages, 
                'room_id' => $chat['chat_room_id'],
                'user_me' => $me,
                'user_to' => $user
            ]);  
        }

        public function postMessage() {
            $sender_id = $_POST['my_id'];
            $receiver_id = $_POST['user_id'];
            $room_id = $_POST['room_id'];
            $message = $_POST['message'];
            $chat_model = new ChatModel;
            $chat_model->postMessage($sender_id, $room_id, $message); 
            $lastMessage = $chat_model->getLastMessageFromChat($room_id);
            // соединяемся с локальным tcp-сервером
            $instance = stream_socket_client('tcp://127.0.0.1:1234');
            // отправляем сообщение
            fwrite($instance, json_encode(['user_id' => $receiver_id, 'message' => $lastMessage])  . "\n");
            return $this->returnJSON($lastMessage);
        }

        public function getMessagesSince($time) {
            // возвращает все сообщения, отправленные после $time, используется для обновления данных во время разговора
        }
    }
