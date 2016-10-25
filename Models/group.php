<?php
    class Group {
        public $id;
        public $group_name;
        public $group_img;

        public function __construct($id, $group_name, $group_img) {
            $this->id           = $id;
            $this->group_name   = $group_name;
            $this->group_img    = $group_img;
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();
            $req = $db->query('SELECT * FROM groups');

            // we create a list of Friend objects from the database results
            foreach($req->fetchAll() as $group) {
                $list[] = new Group($group['id'], $group['group_name'], $group['group_img']);
            }
            return $list;
        }

        public static function find($id) {
            $db = Db::getInstance();
            $id = intval($id);
            $req = $db->prepare('SELECT * FROM groups WHERE id = :id');
            $req->execute(array('id' => $id));
            $group = $req->fetch();
            return new Group($group['id'], $group['group_name'], $group['group_img']);
        }

        public static function create($name){
            $db = Db::getInstance();
            $req = $db->prepare('INSERT INTO groups (group_name, group_img) VALUES (:group_name, :group_img)');
            $req->execute(array('group_name' => $name, 'group_img' => NULL));
            return 1;
        }

        public static function addFriend($friend_id, $group_id){
            $db = Db::getInstance();
            $req = $db->prepare('INSERT INTO groups_friends (id_friend, id_group) VALUES (:id_friend, :id_group)');
            $req->execute(array('id_friend' => $friend_id, 'id_group' => $group_id));
            return 1;
        }

        public static function delete($group_id){
            $db = Db::getInstance();
            $req = $db->prepare('DELETE FROM groups WHERE id = :group_id');
            $req->execute(array('group_id' => $group_id));
            return 1;
        }

        public static function getFriends($group_id){
            $db = Db::getInstance();
            $req = $db->prepare('SELECT first_name, last_name 
                                FROM friends, groups_friends WHERE groups_friends.id_group = :group_id
                                AND friends.id = groups_friends.id_friend');
            $req->execute(array('group_id' => $group_id));
            $friends = $req->fetchAll();
            return $friends;
        }
    }
?>