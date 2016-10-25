<?php
    function call($controller, $action) {
        // require the file that matches the controller name
        require_once('../Controllers/' . $controller . '_controller.php');

        // create a new instance of the needed controller
        switch($controller) {
            case 'pages':
                $controller = new PagesController();
            break;
            case 'friends':
                // we need the model to query the database later in the controller
                require_once('../Models/friend.php');
                $controller = new FriendsController();
            break;
            case 'sessions':
                $controller = new SessionsController();
            break;
            case 'groups':
                require_once('../Models/friend.php');
                require_once('../Models/group.php');
                $controller = new GroupsController();
            break;
        }
        // call the action
        $controller->{ $action }();
    }

    // just a list of the controllers we have and their actions
    // we consider those "allowed" values
    $controllers = array('pages' => ['home', 'error'],
        'friends' => ['index', 'show'],
        'sessions' => ['login', 'logout'],
        'groups' => ['index', 'show', 'delete', 'url_create', 'create', 'url_add_friend', 'add_friend', 'delete_group']);

    // check that the requested controller and action are both allowed
    // if someone tries to access something else he will be redirected to the error action of the pages controller
    if (array_key_exists($controller, $controllers)) {
        if (in_array($action, $controllers[$controller])) {
            call($controller, $action);
        } else {
            call('pages', 'error');
        }
    } else {
        call('pages', 'error');
    }
?>