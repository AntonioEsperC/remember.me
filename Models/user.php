<?php
    class User {
        // we define 3 attributes
        // they are public so that we can access them using $post->author directly
        public $id;
        public $first_name;
        public $last_name;
        public $email;
        public $phone;
        public $profile_img;
        public $synchronized;

        public function __construct($id, $first_name, $last_name, $email, $phone, $profile_img, $synchronized) {
            $this->id           = $id;
            $this->first_name   = $first_name;
            $this->last_name    = $last_name;
            $this->email        = $email;
            $this->phone        = $phone;
            $this->profile_img  = $profile_img;
            $this->synchronized = $synchronized;
        }

        public static function active($id) {
            $db = Db::getInstance();
            $id = intval($id);
            $req = $db->prepare('SELECT * FROM users WHERE id = :id');
            $req->execute(array('id' => $id));
            $user = $req->fetch();
            return new User($user['id'], $user['first_name'], $user['last_name'], $user['email'], $user['phone'], $user['profile_img'], $user['synchronized']);
        }
    }
?>