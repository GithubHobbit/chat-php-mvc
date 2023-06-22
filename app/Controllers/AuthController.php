<?php
    namespace App\Controllers;
    use App\Models\UserModel;
    use Core\Error;
    class AuthController extends \Core\Controller
    {
        protected $title = "Авторизация";
        public function login() {
            if ($_SERVER['REQUEST_METHOD'] !== "POST") {
                return $this->render('login_view', []);
            }

            $login = $_POST['login'];
            $password = md5($_POST['password']);

            try {
                $userModel = new UserModel;
                $user = $userModel->findUser($login);
                if (!$user) {
                    return $this->render(
                        'login_view', 
                        ['message' => "Пользователя с таким логином не существует"]
                    );
                }

                if ($user['password'] !== $password) {
                    return $this->render(
                        'login_view', 
                        ['message' => "Неверный пароль"]
                    );
                }
                
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'login' => $user['login'],
                    'email' => $user['email'],
                    'fullname' => $user['fullname'],
                ];

                header('Location: /chat/getAllProfiles');
                die();
            } catch (\Throwable $e) {
                Error::ErrorPage500($e->getMessage());
            }
        }

        public function registration() {
            if ($_SERVER['REQUEST_METHOD'] !== "POST") {
                return $this->render('registration_view', []);
            }

            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $login = $_POST['login'];
            $password = $_POST['password'];

            try {
                $userModel = new UserModel;
                $user = $userModel->findUser($login);
                if ($user) {
                    return $this->render(
                        'registration_view', 
                        ['message' => 'Пользователь с таким логином уже существует.']
                    );
                }
                
                $password = md5($password);
                $id = $userModel->createUser($fullname, $email, $login, $password);
                
                $_SESSION['user'] = [
                    'id' => $id,
                    'login' => $login,
                    'email' => $email,
                    'fullname' => $fullname,
                ];

                header('Location: chat/getAllProfiles');
                return $this->render('home_view');
                
            } catch(\Throwable $e) {
                Error::ErrorPage500($e->getMessage());
            }
        }

        public function logout() {
            unset($_SESSION['user']);
            //ЧТОБЫ ГРАМОТНО РЕДИРЕКТИТЬ, МОЖНО В СЕССИИ СОЗДАТЬ МАССИВ С ПРЕДЫДУЩИМИ ЗАПРОСАМИ И ОТТУДА БРАТЬ АДРЕС
            header("Location: /auth/login");
            die;
        }

        public function my_profile() {
            $id = $_SESSION['user']['id'];
            $user_model = new UserModel;
            $user = $user_model->getUser($id);
            return $this->render('profile_view', $user);
        }
    }
