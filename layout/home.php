<?php

class Home {
    public function index() {
        session_start();
        require_once 'FE/header.php';
        require_once 'FE/home.php';
        require_once 'FE/footer.php';
    }
}