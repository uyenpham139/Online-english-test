<?php

class Contact {
    public function index() {
        session_start();
        require_once 'FE/header.php';
        require_once 'FE/contact.php';
        require_once 'FE/footer.php';
    }
}