<?php

class Controller {

    public function __construct()
    {
        session_start();
        header('Content-Type: text/html; charset=utf-8');
    }

    public function index() {
        echo 'Please create index method';
        die();
    }

    protected function loggedIn()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1 && isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    protected function loadView($view, $data = array()) {
        extract($data);
        require(__DIR__.'/../views/admin/'.$view.'.php');
    }

}