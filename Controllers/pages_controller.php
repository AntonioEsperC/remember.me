<?php
    class PagesController {
        public function home() {
            // Get first name, last name
            require_once('../Views/pages/home.php');
        }

        public function error() {
            require_once('../Views/pages/error.php');
        }
    }
?>