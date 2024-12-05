<?php

class Search {
    public function index() {
        session_start();
        require_once 'FE/search_page.php';
    }
}