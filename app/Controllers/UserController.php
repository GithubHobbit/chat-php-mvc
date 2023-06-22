<?php

    namespace App\Controllers;
    use App\Models\UserModel;
    use Core\Error;
    class UserController extends \Core\Controller
    {
        protected $title = "Авторизация";
        
        public function profile() {
            $user_id = $_GET['user_id'];
            $user_model = new UserModel;
            $user = $user_model->getUser($user_id);
            return $this->render('profile_view', $user);
        }
    }
