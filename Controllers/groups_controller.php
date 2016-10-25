<?php
    class GroupsController {
        public function index() {
            $groups = Group::all();
            require_once('../Views/groups/index.php');
        }

        public function show() {
            // we expect a url of form ?controller=posts&action=show&id=x
            // without an id we just redirect to the error page as we need the post id to find it in the database
            if (!isset($_GET['id']))
                return call('pages', 'error');

            // we use the given id to get the right post
            $group = Group::find($_GET['id']);
            $friends = Group::getFriends($_GET['id']);
            require_once('../Views/groups/show.php');
        }

        public function url_create() {
            require_once('../Views/groups/create.php');
        }

        public function create(){
            $group = Group::create($_POST['group_name']);
            $groups = Group::all();
            require_once('../Views/groups/index.php');
        }

        public function url_add_friend(){
            if (!isset($_GET['group_id']))
                return call('pages', 'error');
            $friends = Friend::all();
            $group = Group::find($_GET['group_id']);
            require_once('../Views/groups/add_friend.php');
        }

        public function add_friend(){
            $friend_added = Group::addFriend($_POST['friend_id'], $_GET['group_id']);
            $groups = Group::all();
            require_once('../Views/groups/index.php');
        }

        public function delete_group(){
            $delete = Group::delete($_GET['group_id']);
            $groups = Group::all();
            require_once('../Views/groups/index.php');
        }
    }
?>