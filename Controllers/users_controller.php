<?php
    class UsersController {
        public function isActive() {
            if (!isset($_GET['user_id']))
                return call('pages', 'error');

            $user = User::find($_GET['user_id']);
        }
    } 
?>