<?php

    namespace App\Models;
    use Core\Model;
    class ChatModel extends Model
    {
        public function postMessage($sender_id, $room_id, $message) {
            $chat = $this->getChatByRoomId($room_id, $sender_id);
            $query = "INSERT INTO 
                messages (message, user_chat_room_id) 
                VALUES ('$message', '{$chat['id']}')";
            $this->db->query($query);
        }

        public function getChatByRoomId($room_id, $sender_id) {
            $query = "SELECT * FROM userChats 
                WHERE chat_room_id = '$room_id' 
                    AND user_id = '$sender_id'
                LIMIT 1";
            return $this->db->query($query)->fetch(\PDO::FETCH_ASSOC);
        }

        public function getMessages($my_id, $user_id) {
            $chat = $this->getChat($my_id, $user_id); 
            $query = "SELECT * FROM messages WHERE user_chat_room_id = '{$chat['id']}'";
            $messages = $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
            return $messages;
        }

        public function getMessagesByRoomId($room_id) {
            $query = 
            "SELECT *, messages.id FROM messages 
            JOIN (SELECT * FROM userChats 
                WHERE chat_room_id = $room_id) AS CHAT
            JOIN users
            WHERE user_chat_room_id = CHAT.id AND user_id = users.id
            ORDER BY posted_at";
            $chatMessages = $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
            return $chatMessages;
        }

        public function getLastMessageFromChat($room_id) {
            $query = 
            "SELECT *, messages.id FROM messages 
            JOIN (SELECT * FROM userChats 
                WHERE chat_room_id = $room_id) AS CHAT
            JOIN users
            WHERE user_chat_room_id = CHAT.id AND user_id = users.id
            ORDER BY posted_at DESC LIMIT 1";
            $lastMessage = $this->db->query($query)->fetch(\PDO::FETCH_ASSOC);
            return $lastMessage;
        }

        public function getChat($my_id, $user_id) {
            $query = "SELECT MY_CHATS.* FROM 
                (SELECT CHATS.* FROM userChats as CHATS 
                    JOIN chatRooms AS ROOMS 
                    ON CHATS.chat_room_id = ROOMS.id 
                    WHERE ROOMS.max_users = 2 
                    AND CHATS.user_id = '$my_id'
                ) AS MY_CHATS
                JOIN 
                (SELECT CHATS.* FROM userChats AS CHATS 
                    JOIN chatRooms AS ROOMS 
                    ON CHATS.chat_room_id = ROOMS.id 
                    WHERE ROOMS.max_users = 2 
                    AND CHATS.user_id = '$user_id'
                ) AS USER_CHATS
                ON MY_CHATS.chat_room_id = USER_CHATS.chat_room_id
                LIMIT 1
            ";

            $chat = $this->db->query($query)->fetch(\PDO::FETCH_ASSOC);
            if (!$chat) {
                $query = "INSERT INTO 
                    chatRooms (max_users, count_users) 
                    VALUES ('2', '2')";
                $this->db->query($query);
                $room_id = $this->db->lastInsertId();
                

                $query = "INSERT INTO 
                    userChats (chat_room_id, user_id) 
                    VALUES ('$room_id', '$my_id'), 
                           ('$room_id', '$user_id')";
                    $this->db->query($query);
                return $this->db->query("SELECT * FROM userChats WHERE chat_room_id = $room_id AND user_id = $my_id")->fetch();
            }
            return $chat;
        }
    }