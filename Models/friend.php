<?php
    class Friend {
        // we define 3 attributes
        // they are public so that we can access them using $post->author directly
        public $id;
        public $first_name;
        public $last_name;
        public $email;
        public $phone;
        public $profile_img;

        public function __construct($id, $first_name, $last_name, $email, $phone, $profile_img) {
            $this->id           = $id;
            $this->first_name   = $first_name;
            $this->last_name    = $last_name;
            $this->email        = $email;
            $this->phone        = $phone;
            $this->profile_img  = $profile_img;
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();
            $req = $db->query('SELECT * FROM friends');
            foreach($req->fetchAll() as $friend) {
                $list[] = new Friend($friend['id'], $friend['first_name'], $friend['last_name'], $friend['email'], $friend['phone'], $friend['profile_img']);
            }
            return $list;
        }

        public static function find($id) {
            $db = Db::getInstance();
            $id = intval($id);
            $req = $db->prepare('SELECT * FROM friends WHERE id = :id');
            $req->execute(array('id' => $id));
            $friend = $req->fetch();
            return new Friend($friend['id'], $friend['first_name'], $friend['last_name'], $friend['email'], $friend['phone'], $friend['profile_img']);
        }
    }
?>