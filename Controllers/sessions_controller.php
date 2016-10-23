<?php
    class SessionsController {
        public function login() {
            require_once('../public/login.php');
        }

        public function logout() {
            session_destroy();
            header('Location:login.php');
        }
    } 
?>